<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exam;

use App\Models\Subject;

//for password hide
use Illuminate\Support\Facades\Hash;

//for login and logout
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;

//for mails smtp
use App\Models\PasswordReset;
use Mail;
use Illuminate\Support\Str; //
use Illuminate\Support\Facades\Url; //to take a live domain if we want to use 
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    
     public function loadRegister()
     {
         return view('register');
     }

     public function studentRegister(Request $request)
     {

         //validation
         $request->validate([
             'name' => 'string|required|min:2',
             'email' => 'string|email|required|max:100|unique:users',
             'password' =>'string|required|confirmed|min:6'
         ]);

         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $user->save();

         return back()->with('success','Your Register has been successful.');

     }

    public function loadLogin()
    {
        //check for login if the login user is admin then it will redirect to the admindashboard and if it is user login then it will redirect to the studentdashboard
        if(Auth::user() && Auth::user()->is_admin == 1){
            return redirect('/admin/dashboard');
        }
        elseif(Auth::user() && Auth::user()->is_admin == 0){
            return redirect('/dashboard');
        }

       return view('login'); 
    }

    //userlogin function
    public function userLogin(Request $request)
    {
        //email validation
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'

        ]);

        //storing in usercredential
        $userCredential = $request -> only ('email','password');
        //to check if it is correct
        //if correct
        if(Auth::attempt($userCredential)){

            //if the user is admin
            if(Auth::user()->is_admin ==1){
                return redirect('/admin/dashboard');
            }

            //if the user is not admin it will redirect to the user dashboard
            elseif(Auth::user()->attempt == 1){
                return view('/sorry');
            }else{
                return redirect('/dashboard');
            }
        }
        //if it is incorrect
        else{
            return back()->with('error','user name and password is incorrect');
        }

    }

    //function for loading the student dashboard
    public function loadDashboard()
    {
        //$exams = Exam::with('subjects')->get();
        $user_exam_code = Auth::user()->exam_code;
        $exams = Exam::with('subjects')->where('subject_id',$user_exam_code,)->get();
        //die($exams);
        return view('student.dashboard',['exams'=>$exams]);
    }

    //function for loading the admin dashboard //and showing all the subjects data
    public function adminDashboard()
    {
        //$subjects = subject::all();
        return view('admin.landing');
    }

    //function for logout
    public function logout(Request $request)
    {
        $request -> session()->flush();
        Auth::logout();
        return redirect('/');
    }

    //Auth for forgetpassword
    public function forgetPasswordLoad(){
        return view('forget-password');
    }


    //creating the email to send for forget password
    public function forgetPassword(Request $request){
        //using mail function to verify the smtp is working or not
        try{
            $user = User::where('email',$request->email)->get();

            if(count($user) > 0){
                
                //storing in the token variable
                $token = Str::reandom(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;

                //email
                $data['urtl'] = $url;
                $data['email'] = $request->email;
                $data['title'] = 'Password Resert';
                $data['body'] = 'Please click the below link to reset password.';

                Mail::send('forgetPasswordMail',['data'=>$data],function($message) use ($data){
                    $message ->to($data['email'])->subject($data['title']);
                });//passing the data

                $dateTime = Carbon::now()->format('Y-m-d H:i:s');//date

                PasswordReset::updateOrCreate(
                    ['email'=>$request->email],//condition
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $dateTime
                    ]//value input
                );

                return back()->with('success','Please check your mail to reset your password.');

            }
            else{
                return back()->with('error'.'Email does not exist!');
            }
        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
}
