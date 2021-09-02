<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\User;
use App\Models\Subject;
class TeacherController extends Controller
{
    public function LoginTeacher(Request $request)
    {
            $request->validate([
              'UserId' => 'required|digits:9', //only 9 digits id
              'password' => 'required|min:6',
          ]);
          $user = DB::table('users')
              ->where('id', $request->input('UserId')) //get user matcing with userid
              ->where('type', 'Teacher ') //get user matching with userid
              ->first();
          if ($user) {
              //if email username exists
              if ($user->password == $request->input('password')) {
                  //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching

                  $request->session()->put('teacher', $request->input('UserId')); //add useerid to session
                  return redirect('teacher/main'); //go to home if correct
              } else {
                  return redirect('teacher/login')->with(
                      'error',
                      "Wrong Information"
                  ); //wrong password return to login
            }
        } else {
              return redirect('teacher/login')->with('error', "Wrong Information"); //wrong userid return to login
        }
        
    }
  

    public function GetMaterials()//get the view that make instructor upload materials
    {
        return view("teacher.materials");
    }

     public function UploadMaterials(Request $req)//upload materials to students
    {    
        $rules = [
            'file_name' => 'required|',
            'file_description' => 'required|',
            'upload_file' => 'required|mimes:pdf,docs,doc,xlx,xlxs,zip,png,jpg,txt,mp4|max:2048',//2mb 
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('/teacher/materials')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                    $data=new Material;//new instance from class
                    $file=$req->upload_file;
                    $filename=time().'.'.$file->getClientOriginalExtension();
                    $req->upload_file->move('assets',$filename);//move file to assets

                    $data->file=$filename;
                    $data->name=$req->file_name;
                    $data->description=$req->file_description;
                    $data->save();//insert into database
                    return redirect()->back();
                    
    }

    public function GetGrades()//return the view with students that enroll with the course that the instrcutor teach to submit gradess
    {    
       $list=DB::table('doexam')
        ->join('teaches','doexam.SubjectId','=','teaches.SubjectId')
        ->join('students','doexam.IdStudent','=','students.userid')
        ->where('IdTeacher',session('teacher'))
        ->get();
      
        return view("teacher.grades",["list"=>$list]);
            //return view("teacher.grades");
    }

    public function SubmitGrades(Request $req)//function to submit the graddes of each student 
    {
        $affected = DB::table('doexam')
          ->where('IdStudent', $req->id)
          ->where('IdExam',$req->idexam)
          ->update([
              'Grade' => $req->grade,
          ]);
          if ($affected !== null) {
            return response()->json([
                "res" => "Grades Submitted successfully",
            ]);
        }
    }

    public function GetAttendance()//return the student enroll in the course to take attendance
    {
        $room=DB::table('classroom')->get();
        $subjects=DB::table('teaches')
        ->join('subjects',"teaches.SubjectId","=","subjects.id")
        ->where('IdTeacher',session('teacher'))
        ->get();
        return view("teacher.attendance",compact('room','subjects'));
    }

    public function CreateLecture(Request $req)//insert into db values
    {
        $lectureid=DB::table('lecture')->insert([
                'created_at' => date('Y-m-d H:i:s'),
        ]);

        $students=DB::table('enroll')//get the students enrolled with course passed
        ->join("students","enroll.StudentId","=","students.userid")
        ->where('enroll.SubjectId',$req->subject_id)
        ->get();

        $subjects=DB::table('teaches')
        ->join('subjects',"teaches.SubjectId","=","subjects.id")
        ->where('IdTeacher',session('teacher'))
        ->get();

        $room=DB::table('classroom')->get();
        $students->room=$req->id_room;
        return view('teacher.attendance',compact('students','subjects','room'));
    }
  

    public function SubmitAttendance(Request $req)
    {
        
        $lecture=DB::table('lecture')//get the id of the latest
        ->max('Id');

        $attending=DB::table('attend')->insert([
            'IdLecture' => $lecture,
            'IdRoom' => $req->room,
            'IdTeacher' =>session('teacher'),
            'IdStudent' => $req->id,
        ]);
        if ($attending) {
            return response()->json([
                "res"=>"Attendance is submitted"
            ]); 
        }
        else{
            return response()->json([
                "res"=>"Error"
            ]);
        }
            
    }

    public function TeacherLogout()
    {
       //delete session('staff') when logout
        if (session()->has('teacher')) {
            session()->pull('teacher');
        }
        return redirect('teacher/login');
    }
    
    public function TeacherChangePass(Request $req)//change pass of instructor
    {
      $rules = [
        'CurrentPassword' => 'required|',
        'NewPassword' => 'required|min:6|max:12',
        'new_confirm_password' => 'required|same:NewPassword',
          ];
          $validator = Validator::make($req->all(),$rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
                return redirect('teacher/changepass')//return to the page
                ->withInput()
                ->withErrors($validator);//send errors
              }
              else{
                $userid=session('teacher');//take the id of the admin
                $user=User::find($userid);//get user info

                  if($user->password==$req->CurrentPassword){//check if old password matches
                    $affected=DB::table('users')
                        ->where('id',$userid)
                        ->update([
                            'Password' => $req->NewPassword,//update password
                        ]);

                        if ($affected !== null) {//if updated
                            return redirect('teacher/changepass')->with(
                                'status',
                                "Password updated successfully"
                            );
                        } else {
                            return redirect('teacher/changepass')->with(//eror in updating
                                'error',
                                "Password Updating failed"
                            );
                        }
                  }
                  else{
                    return redirect('teacher/changepass')->with(//password didnt match
                        'error',
                        "Old password doesnt matched"
                    );
                  }

              }
    }

    public function TeacherProfile($id)//get the info of the user where id passed
    {
            $info=DB::table('teachers')
            ->where('id', $id)
            ->get();
            return view('teacher.profile', ['teacher'=>$info]);
    }
    public function UpdateInfo(Request $req)//function to update the information of the user
    {
        
        $rules = [
            'fn' => 'required|',
            'phone' => 'required|digits:8',
            'dob' => 'required|',
            'Gender' => 'required|',
            'email' => 'required|',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('teacher/profile/'.$req->UserID.'')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
        $affected = DB::table('teachers')
        ->where('id', $req->UserID)
        ->update([
              'fn' => $req->fn,
              'email' => $req->email,
              'tel' => $req->phone,
              'dob' => $req->dob,
              'gender' => $req->Gender,

          ]);

        if ($affected !== null) {
            return redirect('teacher/profile/'.$req->UserID.'')->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect('teacher/profile/'.$req->UserID.'')->with(
                'error',
                "Profile Updated failed"
            );
        }
    }

    public function GetExam()//get exam page with info
    {
        $subjects=Subject::all();
       return view('teacher.exam',["subjects"=>$subjects]);
    }
    public function AssignExam(Request $req)//assign the exam
    {
         
        $rules = [
            'subject_id' => 'required|',
            'exam_type' => 'required|',
            'exam_date' => 'required|',
            'exam_time' => 'required|',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('teacher/exams')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }

                    DB::table('exam')->insert([//insert exam type in table exam
                        'TypeExam' => $req->exam_type,
                       
                    ]);
                    $examid = DB::getPdo()->lastInsertId();//get the id of the exam inserted

                    $students=DB::table('enroll')//get students enrolled in the assigned exam subject
                    ->select("StudentId")
                    ->where('SubjectId',$req->subject_id)
                    ->get();
                    foreach ($students as $key) {//foreach student insert into table doexam
                        DB::table('doexam')->insert([//insert exam type in table exam
                            'IdExam' =>  $examid,
                            'IdStudent' => $key->StudentId,
                            'SubjectId' => $req->subject_id,
                            'Date' =>"$req->exam_date $req->exam_time",
                            //grade is null when grade is generated update the grade
                           
                        ]);
                    }
                    return  redirect('/teacher/exams');
    
    }

}
