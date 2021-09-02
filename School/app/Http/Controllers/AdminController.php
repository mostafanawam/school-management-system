<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Calender;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Calendar;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Subject;
use App\Models\Schedule;
class AdminController extends Controller
{
    public function LoginAdmin(Request $request)
    {
            $request->validate([
              'UserId' => 'required|digits:9', //only 9 digits id
              'password' => 'required|min:6',
          ]);
          $user = DB::table('users')
              ->where('id', $request->input('UserId')) //get user matcing with userid
              ->where('type', 'Admin ') //get user matching with userid
              ->first();
          if ($user) {
              //if email username exists
              if ($user->password == $request->input('password')) {
                  //  if(Hash::check($request->input('password'),$user->password)){//check hashed password matching

                  $request->session()->put('admin', $request->input('UserId')); //add useerid to session
                  return redirect('admin/main'); //go to home if correct
              } else {
                  return redirect('admin/login')->with(
                      'error',
                      "Wrong Information"
                  ); //wrong password return to login
              }
          } else {
              return redirect('admin/login')->with('error', "Wrong Information"); //wrong userid return to login
          }
        
    }
    public function GetSchedule()
    {
      $instructors=Teacher::all();//gett all the instructors
      $courses=Subject::all();//get all the courses
      $schedule=DB::table('schedule')
      ->orderBy('time_start', 'asc')
      ->get();
      return view('admin.schedule',compact('instructors','courses','schedule'));
    }

    public function set_session(Request $req)//add sessions to schedule
    {
      $rules = [
        'from_1' => 'required|',
        'to_1' => 'required|',
        'teacher_1' => 'required|',
        'subject_1' => 'required|',    
        ];
     
        $validator = Validator::make($req->all(),$rules);//check if all rule are true
        if ($validator->fails()) {//if rules are false
                    return redirect('/admin/schedule')//return to the page
                    ->withInput()
                    ->withErrors($validator);//send errors
                }
      $day_1=new Schedule;
      $day_1->day_nb=$req->day;
      $day_1->time_start= $req->from_1;
      $day_1->time_end=$req->to_1;
      $day_1->teacher=$req->teacher_1;
      $day_1->subject=$req->subject_1;
      $day_1->save();
      return redirect('admin/schedule');
    }
    public function deleteSession($id)//delete session according to passed id
  {
    $session=Schedule::find($id);
    $session->delete();
    return redirect('/admin/schedule');
  }



    public function GetCalendar(Request $request)//calendat to student only view
    {
      if($request->ajax()) {
           $data = Calender::whereDate('start', '>=', $request->start)
  
                     ->whereDate('end',   '<=', $request->end)
  
                     ->get(['id', 'title', 'start', 'end']);
           return response()->json($data);
      }
  
      return view('student.calendar');
  
    }
    public function index(Request $request)//caledner to admin where he can update
  {
    if($request->ajax()) {
         $data = Calender::whereDate('start', '>=', $request->start)
  
                   ->whereDate('end',   '<=', $request->end)
  
                   ->get(['id', 'title', 'start', 'end']);
         return response()->json($data);
    }
  
    return view('admin.calendar');
  }
  public function ajax(Request $request)
  
  {
      switch ($request->type) {
         case 'add':
            $event = Calender::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
           break;
  
         case 'update':
            $event = Calender::find($request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            return response()->json($event);
           break;
         case 'delete':
            $event = Calender::find($request->id)->delete();
            return response()->json($event);
           break;
         default:
  
           # code...
  
           break;
  
      }
    }
public function adduser(Request $request)
{
    
          $rules = [
        'userid' => 'required|digits:9',//9 digits id is accepted
        'password' => 'required|min:6|max:12',//password between 6-12
        'fullname'=>'required',
        'type' => 'required',
        ];
        

        $validator = Validator::make($request->all(),$rules);//check if all rule are true
        if ($validator->fails()) {//if rules are false
              return redirect('admin/adduser')//return to the page
              ->withInput()
              ->withErrors($validator);//send errors
            }
            else{
                  $data = $request->input();//get values from form
            try{
                        $user = new User;//new Model
                        $user->id = $data['userid'];//set values
                        $user->password =  $data['password'];
                        $user->type = $data['type'];
                        $user->save();//insert values

                      if($data['type']=='Teacher'){//add userid to teacher table
                        $fm = new Teacher;//new Model
                        $fm->id=$data['userid'];
                        $fm->fn=$data['fullname'];
                        $fm->save();
                      }
                      if($data['type']=='Student'){//add userid to student table
                        $fm = new Student;//new Model
                        $fm->userid=$data['userid'];
                        $fm->fn=$data['fullname'];
                        $fm->save();
                      }
                      if($data['type']=='Admin'){//add userid to student table
                        $fm = new Admin;//new Model
                        $fm->id=$data['userid'];
                        $fm->fn=$data['fullname'];
                        $fm->save();
                      }

              return redirect('/admin/userlist')->with('status',"User Inserted successfully");//redirect to users with success message
            }
            catch(Exception $e){
              return redirect('/admin/userlist')->with('failed',"Operation Failed");//fail if error
              } 
        }
}
    public function userlist()
    {
      $users = User::all();
      return view('admin.users',['users'=>$users]); //go to users page with users list
    }  

    function deleteuser($id){//function to delete user
      $user = User::find($id);//find if id passed in the url exist
      if(!$user){//if user not found
        return redirect('/admin/userlist')->with('status',"User Not Found");
      }//else if found
      $user->delete(); //delete user
        return redirect('/admin/userlist')->with('status',"User Deleted successfully");//redirect with success message
  }

  function ViewUser($id){//return the user data passed through parimeter
    $users = User::find($id);
    return view('admin.viewuser',['users'=>$users]);
  }
  function UpdateUser(Request $req){//update user data
    $affected = DB::table('users')
        ->where('id', $req->UserID)
        ->update([
            'Password' => $req->Password,
            'Type' => $req->Type,
        ]);

        if ($affected !== null) {//if updated
            return redirect('admin/userlist')->with(
                'status',
                "User Updated"
            );
        } else {
            return redirect('admin/userlist')->with(//not updated
                'error',
                "User Updated failed"
            );
        }
  }
  function logout()
    {
        //delete session('admin') when logout
        if (session()->has('admin')) {
            session()->pull('admin');
        }
        return redirect('admin/login');
    }

    public function ChangePassword(Request $req){//change the password of admin
      $rules = [
          'CurrentPassword' => 'required|',
          'NewPassword' => 'required|min:6|max:12',
          'new_confirm_password' => 'required|same:NewPassword',
            ];
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                  return redirect('admin/changepass')//return to the page
                  ->withInput()
                  ->withErrors($validator);//send errors
                }
                else{
                  $userid=session('admin');//take the id of the admin
                  $user=User::find($userid);//get user info
                    if($user->password==$req->CurrentPassword){//check if old password matches
                      $affected=DB::table('users')
                          ->where('id',$userid)
                          ->update([
                              'Password' => $req->NewPassword,//update password
                          ]);

                          if ($affected !== null) {//if updated
                              return redirect('admin/changepass')->with(
                                  'status',
                                  "Password updated successfully"
                              );
                          } else {
                              return redirect('admin/changepass')->with(//eror in updating
                                  'error',
                                  "Password Updating failed"
                              );
                          }
                    }
                    else{
                      return redirect('admin/changepass')->with(//password didnt match
                          'error',
                          "Old password doesnt matched"
                      );
                    }

                }
    }
    public function AdminProfile($id)//get the info of the user where id passed
    {
        $info=DB::table('admins')
      ->where('id', $id)
      ->get();
        return view('admin.profile', ['admin'=>$info]);
    }
    public function UpdateInfo(Request $req)//function to update the information of the user
    {
        
        $rules = [
            'fn' => 'required|',
            'phone' => 'required|digits:8',
            'dob' => 'required|',
            'Gender' => 'required|',
            'email' => 'required|',
            'Rank' => 'required|',
            ];
         
            $validator = Validator::make($req->all(),$rules);//check if all rule are true
            if ($validator->fails()) {//if rules are false
                        return redirect('admin/profile/'.$req->UserID.'')//return to the page
                        ->withInput()
                        ->withErrors($validator);//send errors
                    }
                  
        $affected = DB::table('admins')
          ->where('id', $req->UserID)
          ->update([
              'fn' => $req->fn,
              'email' => $req->email,
              'tel' => $req->phone,
              'dob' => $req->dob,
              'gender' => $req->Gender,
              'rank' => $req->Rank,
          ]);

        if ($affected !== null) {
            return redirect('admin/profile/'.$req->UserID.'')->with(
                'status',
                "Profile Updated"
            );
        } else {
            return redirect('admin/profile/'.$req->UserID.'')->with(
                'error',
                "Profile Updated failed"
            );
        }
    }

      
}
