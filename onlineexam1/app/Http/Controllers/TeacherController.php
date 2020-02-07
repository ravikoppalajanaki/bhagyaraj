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
		 $username = $request->Username;
		 $password = $request->password;
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
		$teacher_details = array("Teacher" => $Teacher);
		 $request->session()->regenerate();
		 session(['teacher_details' => $Teacher]);
		 
		 echo "success";
		 }
		 else
		 {
		 	echo "Wrong credentials";
		 }
	}
	public function dashboard()
	{
		if(!session()->has('teacher_details'))
		{
			return redirect()->route('teacherlogin');
		}
		$data = array();
		return view('teacherdashboard', $data);
	}

	public function students()
	{
		if(!session()->has('teacher_details'))
		{
			return redirect()->route('teacherlogin');
		}
		 $teachername = session('teacher_details.name');
		$Student=Student::where('Teacher', $teachername)->paginate(10);
		$where = ['role' => 'Teacher','module_name'=>'Student'];
		$Permission=Permission::select('add','edit','delete','view')->where($where)->get()->toArray();
		//print_r($Permission);exit;
		if (count($Permission)>0) {
			$add_permission=$Permission[0]['add'];
			$edit_permission=$Permission[0]['edit'];
			$delete_permission=$Permission[0]['delete'];
			$view_permission=$Permission[0]['view'];
		}
		else{
			$add_permission=$edit_permission=$delete_permission=$view_permission=1;
		}
		//print_r($add_permission);exit;
		$data = array('Student'=>$Student,'add_permission'=>$add_permission,'edit_permission'=>$edit_permission,'delete_permission'=>$delete_permission,'view_permission'=>$view_permission);
		return view('teacherstudent', $data);
	}
	public function studentadd(Request $request)
	{
		$count = Student::where("RollNo", $request->RollNo)->count();
		if($count == 0)
		{
        $Student = new Student;
		$Student->RollNo = $request->RollNo;
		$Student->Name = $request->Name;
		$Student->Teacher = session('teacher_details.name');
		if($request->hasFile('image'))
		{
		$img_path = 'img/upload/';
		if(!File::exists($img_path)) {
			File::makeDirectory($img_path, $mode = 0777, true, true);
		}
		if($Student->img != "" AND $Student->img != null)
		{
			if(File::exists($img_path."/".$Student->img)) {
				unlink($img_path."/".$Student->img);
			}
		}
		$image	= $request->file('image');
		$extension 	= 	$image->getClientOriginalExtension();
    	$imageRealPath 	= 	$image->getRealPath();
		$img = Image::make($imageRealPath);
		$img->fit(130, 150);	
		$img->save(public_path($img_path."/".$Student->RollNo.".".$extension));	
		$Student->img = $Student->RollNo.".".$extension;
		}
		$Student->save();
		$msg = 'Student has been added';
		return redirect('teacher/students')->with('success', $msg);
			}
		else
		{
		$msg = 'Student has not been added due to Roll no already in database.';
		return redirect('teacher/students')->with('errors', $msg);
		}
	}
	public function studentupdate(Request $request)
	{
		$count = Student::where("RollNo", $request->RollNo)->where('id', '!=', $request->id)->count();
		if($count == 0)
		{
		$Student = Student::find($request->id);
		$Student->RollNo = $request->RollNo;
		$Student->Name = $request->Name;
		if($request->hasFile('image'))
		{
		$img_path = 'img/upload/';
		if(!File::exists($img_path)) {
			File::makeDirectory($img_path, $mode = 0777, true, true);
		}
		if($Student->img != "" AND $Student->img != null)
		{
			if(File::exists($img_path."/".$Student->img)) {
				unlink($img_path."/".$Student->img);
			}
		}
		$image	= $request->file('image');
		$extension 	= 	$image->getClientOriginalExtension();
    	$imageRealPath 	= 	$image->getRealPath();
		$img = Image::make($imageRealPath);
		$img->fit(130, 150);	
		$img->save(public_path($img_path."/".$Student->RollNo.".".$extension));	
		$Student->img = $Student->RollNo.".".$extension;
		}
		$Student->save();
		$msg = 'Profile has been updated';
		return redirect('teacher/students')->with('success', $msg);
		}
		else
		{
		$msg = 'Student has not been updated due to Roll no already in used.';
		return redirect('teacher/students')->with('errors', $msg);
		}
	}
	public function studentremove($id)
	{
		$Student = Student::find($id);
	   $Student->delete();
	   return redirect('teacher/students')->with('success', 'Student deleted successfully.');
	}
	public function logout(Request $request)
	{
		$request->session()->flush();
		return redirect()->route('teacherlogin');
	}
	
	
	
	
}
