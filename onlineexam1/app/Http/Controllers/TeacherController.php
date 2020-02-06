<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;
use App\Student;
use App\Teacher;
use App\Permission;
use App\Settings;
use App\SV;
use App\QB;
use App\Exam;
use Auth;
use File;
use Image;
use Response;

use Carbon\Carbon;

class TeacherController extends Controller
{
    public function __construct()
    {
      
    }
	
	public function login()
	{
		$data = array();
		return view('teacher.login', $data);
	}
	
	public function loginpost(Request $request)
	{
		 $username = $request->input('Username');
		 $password = $request->input('password');
		 $password = md5($password);
		 $where = ['password' => $password,'username'=> $username];
		 $Teacher = Teacher::where($where)->count();
		 $errors = array();
		 if($Teacher == 0)
		 {
             $errors[] = "Wrong credential.";
		 }
		 if(count($errors) == 0)
		 {
		 $Teacher = Teacher::where($where)->first();
		  //echo"<pre>";print_r($Teacher);exit;
		 $teacher_details = array("Teacher" => $Teacher);
		 $request->session()->regenerate();
		 session(['teacher_details' => $Teacher]);
		 return view('teacherdashboard', $teacher_details);
		 //session()->get('data');
		 }
		 else
		 {
			 return back()->withErrors($errors);
		 }
	}
	
	
	
	
}
