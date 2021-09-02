<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Calendar;
use Illuminate\Support\Facades\Validator;
use App\Models\Calender;
use App\Models\Material;
use App\Models\User;
class StudentController extends Controller
{
  public function LoginStudent(Request $request)
  {
    $request->validate([
      'UserId' => 'required|digits:9', //only 9 digits id
      'password' => 'required|min:6',
  ]);
  $user = DB::table('users')
      ->where('id', $request->input('UserId')) //get user matcing with userid
      ->where('type', 'Student ') //get user matching with userid
      ->first();
  if ($user) {
      //if email username exists
      if ($user->password == $request->input('password')) {
          //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching

          $request->session()->put('student', $request->input('UserId')); //add useerid to session
          return redirect('student/main'); //go to home if correct
      } else {
          return redirect('student/login')->with(
              'error',
              "Wrong Information"
          ); //wrong password return to login
      }
  } else {
      return redirect('student/login')->with('error', "Wrong Information"); //wrong userid return to login
  }

  }

  public function getcalendar(Request $request)//calendat to student only view
  {
    if($request->ajax()) {
         $data = Calender::whereDate('start', '>=', $request->start)

                   ->whereDate('end',   '<=', $request->end)
                   ->get(['id', 'title', 'start', 'end']);
         return response()->json($data);
    }

    return view('student.calendar');

  }
  public function get_schedule()//get sched and displa to students
  {
    $schedule=DB::table('schedule')
    ->orderBy('time_start', 'asc')
    ->get();
     
    return view('student.schedule',["schedule"=>$schedule]);

  }
  public function ShowMaterials()//function to send all materials uploaded
  {
      $data=Material::all();
     return view("student.materials",["data"=>$data]);
  }

  public function DownloadFile($file)//function to download the passed file
  {
       return response()->download(public_path('assets/'.$file));//download the filepassed
  }

  function logoutStudent()
    {
        //delete session('staff') when logout
        if (session()->has('student')) {
            session()->pull('student');
        }
        return redirect('student/login');
    }

    public function StudentChangePassword(Request $req)
    {
      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('student/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('student');//take the id of the admin
                  $user=User::find($userid);//get user info

                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);
                          if ($affected !== null) {//if updated
                              return redirect('student/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('student/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('student/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }
                }
    }
    public function StudentProfile($id)//get the info of the user where id passed
    {
            $info=DB::table('students')
            ->where('userid', $id)
            ->get();
            return view('student.profile', ['student'=>$info]);
    }
    public function UpdateInfo(Request $req)//function to update the information of the user
    {
        
        $rules = [
            'fn' => 'required|',
            'phone' => 'required|digits:8',
            'dob' => 'required|',
            'Gender' => 'required|',
            'email' => 'required|',
            'language'=>'required|'
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('student/profile/'.$req->UserID.'')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
        $affected = DB::table('students')
        ->where('userid', $req->UserID)
        ->update([
              'fn' => $req->fn,
              'email' => $req->email,
              'tel' => $req->phone,
              'dob' => $req->dob,
              'gender' => $req->Gender,
              'language'=>$req->language
          ]);

        if ($affected !== null) {
            return redirect('student/profile/'.$req->UserID.'')->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect('student/profile/'.$req->UserID.'')->with(
                'error',
                "Profile Updated failed"
            );
        }
    }
    public function GetResults()
    {
        //results of each course
        $res = DB::table("doexam")
            ->where("IdStudent", session("student"))
            ->get();

        $subjects=DB::table('subjects')
        ->join("doexam","subjects.id","=","doexam.SubjectId")
        ->get();
        return view("student.results", ["results" => $res,"subjects"=>$subjects]);
    }

}
