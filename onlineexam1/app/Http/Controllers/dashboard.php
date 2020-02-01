<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Subject;
use App\Student;
use App\Teacher;
use App\Settings;
use App\SV;
use App\QB;
use App\Exam;
use Auth;
use File;
use Image;
use Response;

use Carbon\Carbon;

class dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkpermission');
    }

    public function index()
    {
     $StudentCount = Student::count();
     $SubjectCount = Subject::count();
	 $data = array('StudentCount' => $StudentCount, 'SubjectCount' => $SubjectCount);
	 //print_r($data);exit;
     return view('dashboard', $data);
    }
	
    public function denied()
    {
		$data = array(); 
		return view('denied', $data);
    }

    public function settings()
    {
		$settings = Settings::first();
		$data = array('settings' => $settings);
		return view('settings', $data);
    }
	
    public function settingsupdate(Request $request)
    {
     $settings = Settings::find(1);
	 $settings->showResult = $request->input('showResult');
	 $settings->noQuestion = $request->input('noQuestion');
	 $settings->timing = $request->input('timing');
	 $settings->instruction = $request->input('instruction');
	 $settings->save();
     return back()->with('success','Website setting has been updated.');
    }

    public function student()
    {
	$Student = Student::paginate(10);
	$data = array("Student" => $Student);
    return view('student', $data);
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
		return redirect('student')->with('success', $msg);
		}
		else
		{
		$msg = 'Student has not been updated due to Roll no already in used.';
		return redirect('student')->with('errors', $msg);
		}
    }
	
	
    public function studentadd(Request $request)
    { 	   
        $count = Student::where("RollNo", $request->RollNo)->count();
		if($count == 0)
		{
        $Student = new Student;
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
		$msg = 'Student has been added';
		return redirect('student')->with('success', $msg);
			}
		else
		{
		$msg = 'Student has not been added due to Roll no already in database.';
		return redirect('student')->with('errors', $msg);
		}
    }
	 
    public function studentremove($id)
    { 
       $Student = Student::find($id);
	   $Student->delete();
	   return redirect('student')->with('success', 'Student deleted successfully.');
    }
	
  public function teacher()
    {
	$Teacher = Teacher::paginate(10);
	$data = array("Teacher" => $Teacher);
    return view('teacher', $data);
    }
	public function teacheradd(Request $request)
	    { 	   
	        
	        $Teacher = new Teacher;
			$Teacher->designation = $request->Designation;
			$Teacher->name = $request->Name;
			$Teacher->email = $request->email;
			$Teacher->gender = $request->gender;
			$Teacher->address = $request->address;
			$Teacher->phone_number = $request->phone_number;
			$Teacher->date_of_birth = $request->dob;
			$Teacher->joining_date = $request->joining_date;
			$Teacher->username = $request->username;
			$password = $request->Password;
			if($request->hasFile('image'))
			{
				$img_path = 'img/upload/';
				if(!File::exists($img_path)) {
					File::makeDirectory($img_path, $mode = 0777, true, true);
				}
				if($Teacher->photo != "" AND $Teacher->photo != null)
				{
					if(File::exists($img_path."/".$Teacher->photo)) {
						unlink($img_path."/".$Teacher->photo);
					}
				}
				$image	= $request->file('image');
				$extension 	= 	$image->getClientOriginalExtension();
		    	$imageRealPath 	= 	$image->getRealPath();
				$img = Image::make($imageRealPath);
				$img->fit(130, 150);	
				$img->save(public_path($img_path."/".$Teacher->name.".".$extension));	
				$Teacher->photo = $Teacher->name.".".$extension;
			}
			if(strlen($password) >= 6)
			{
				$Teacher->password = md5($password);
				
			}
			else
			{
				if(strlen($password) != 0)
				{
				$err = 'Password should be minimum 6 character long';
				return redirect('teacher')->with('errors', $err);
				}
			}
			$Teacher->save();
			$msg = 'Teacher has been added';
			return redirect('teacher')->with('success', $msg);
				
			
	    }

	    public function permission()
	    {
	    	$data = array();
	    	return view('permission',$data);
	    }

	    public function teacherupdate(Request $request)
	    {
			
			$Teacher = Teacher::find($request->id);
			$Teacher->designation = $request->designation;
			$Teacher->name = $request->Name;
			$Teacher->email = $request->email;
			$Teacher->gender = $request->gender;
			$Teacher->address = $request->address;
			$Teacher->phone_number = $request->phone_number;
			$Teacher->date_of_birth = $request->dob;
			$Teacher->joining_date = $request->joining_date;
			if($request->hasFile('image'))
			{
			$img_path = 'img/upload/';
			if(!File::exists($img_path)) {
				File::makeDirectory($img_path, $mode = 0777, true, true);
			}
			if($Teacher->photo != "" AND $Teacher->photo != null)
			{
				if(File::exists($img_path."/".$Teacher->photo)) {
					unlink($img_path."/".$Teacher->photo);
				}
			}
			$image	= $request->file('image');
			$extension 	= 	$image->getClientOriginalExtension();
	    	$imageRealPath 	= 	$image->getRealPath();
			$img = Image::make($imageRealPath);
			$img->fit(130, 150);	
			$img->save(public_path($img_path."/".$Teacher->name.".".$extension));	
			$Teacher->photo = $Teacher->name.".".$extension;
			}
			$Teacher->save();
			$msg = 'Profile has been updated';
			return redirect('teacher')->with('success', $msg);
			
			
	    }

	     public function teacherremove($id)
		    { 
		       $Teacher = Teacher::find($id);
			   $Teacher->delete();
			   return redirect('teacher')->with('success', 'Teacher deleted successfully.');
		    }


    public function supervisor()
    {
	$Supervisor = SV::paginate(10);
	$data = array("Supervisor" => $Supervisor);
    return view('supervisor', $data);
    }
	
    public function supervisorupdate(Request $request)
    {
		$Supervisor = SV::find($request->id);
		$Supervisor->Mobile = $request->Mobile;
		$Supervisor->status = $request->status;
		$Supervisor->Name = $request->Name;
		$password1 = $request->Password;
		$password2 = $request->ConfirmPassword;
		$success = '<p>Profile has been updated</p>';
		if($password1 == $password2)
		{
			if(strlen($password1) >= 6)
			{
				$Supervisor->password = md5($password1);
				$success = $success.'Password has been updated';
			}
			else
			{
				if(strlen($password1) != 0)
				{
				$success = $success.'Password should be minimum 6 character long';
				}
			}
		}
		$Supervisor->save();
		return redirect('supervisor')->with('success', $success);
    }
	
	
    public function supervisoradd(Request $request)
    { 	   
        $Supervisor = new SV;
		$Supervisor->Mobile = $request->Mobile;
		$Supervisor->status = $request->status;
		$Supervisor->Name = $request->Name;
		$password1 = $request->Password;
		$password2 = $request->ConfirmPassword;
		if($password1 == $password2)
		{
			if(strlen($password1) >= 6)
			{
				$Supervisor->password = md5($password1);
				
		        $success = 'Supervisor credential has been Created';
	        	$Supervisor->save();
		       return redirect('supervisor')->with('success', $success);
			}
			else
			{
				if(strlen($password1) != 0)
				{
				$success = 'Password should be minimum 6 character long';
				return back()->with('errors', $success);
				}
			}
		}
		else
		{
			return back()->with('errors', "Password Not matched.");
		}
    }
	 
    public function supervisorremove(Request $request)
    { 
       $Supervisor = SV::find($request->input('id'));
	   $Supervisor->delete();
	   return redirect('supervisor')->with('success', 'Supervisor deleted successfully.');
    }
	
	
    public function subject()
    {
        $Subject = Subject::paginate(10);
		$data =array("Subject" => $Subject);
	    return view('subject', $data);
    }
	
    public function subjectadd(Request $request)
    {
        $Subject = new Subject;
		$Subject->name = $request->input('Name');
		$Subject->save();
	    return redirect('subject')->with('success', 'Subject added successfully');
    }
	 
    public function subjectremove(Request $request)
    { 
       $Subject = Subject::find($request->input('id'));
	   $Subject->delete();
	   return redirect('subject')->with('success', 'Subject removed successfully.');
    }
	public function subjectupdate(Request $request)
    { 
       $Subject = Subject::find($request->input('id'));
		$Subject->name = $request->input('Name');
		$Subject->save();
	   return redirect('subject')->with('success', 'Subject updated successfully.');
    }
	
    public function questionbank()
    {
        $QB = QB::join('subjects', 'subjects.id', '=', 'questionbank.SubjectID')->select('subjects.name as SubjectName', 'questionbank.*')->paginate(10);
		$Subject = Subject::get();
		$data =array("QB" => $QB, "Subject" => $Subject);
	    return view('questionBank', $data);
    }
	
    public function questionbankadd(Request $request)
    {
        $QB = new QB;
		$QB->Question = $request->input('Question');
		$QB->Option1 = $request->input('Option1');
		$QB->Option2 = $request->input('Option2');
		$QB->Option3 = $request->input('Option3');
		$QB->Option4 = $request->input('Option4');
		$QB->SubjectID = $request->input('SubjectID');
		$QB->save();
	    return redirect('questionbank')->with('success', 'Question added successfully');
    }
	 
    public function questionbankremove(Request $request)
    { 
       $QB = QB::find($request->input('id'));
	   $QB->delete();
	   return redirect('questionbank')->with('success', 'Question removed successfully.');
    }
	
	public function questionbankupdate(Request $request)
    { 
        $QB = QB::find($request->input('id'));
		$QB->Question = $request->input('Question');
		$QB->Option1 = $request->input('Option1');
		$QB->Option2 = $request->input('Option2');
		$QB->Option3 = $request->input('Option3');
		$QB->Option4 = $request->input('Option4');
		$QB->SubjectID = $request->input('SubjectID');
		$QB->save();
	   return redirect('questionbank')->with('success', 'Question updated successfully.');
    }
	
    public function myprofile()
    {
	 $user = Auth::user();
	 $data = array('user' => $user);
     return view('myprofile', $data);
    }
	
    public function updatemyprofile(request $request)
    {
	$user = Auth::user();
	$user->email = $request->email;
	$user->name = $request->name;
	$user->mobile = $request->mobile;
	$password1 = $request->password1; 	
    $password2 = $request->password2;
	$success = '<i class="icon fa fa-check"></i>User Details has been updated';
	if($password1 == $password2)
	{
		if(strlen($password1) >= 6)
		{
			$user->password = bcrypt($password1);
			$success = $success.'<br  /><i class="icon fa fa-check"></i>Password has been updated';
		}
		else
		{
			if(strlen($password1) != 0)
			{
			$success = $success.'<br  /><i class="icon fa fa-check"></i>Password should be minimum 6 character long';
			}
		}
	}
	$user->save();
	$data = array('user' => $user, "success"=> $success);
    return view('myprofile', $data);
    }
	
    public function exams()
    {
	$Subject = Subject::get();
	$Exam = Exam::join('students', 'students.id', "=", "exams.StudentID")->select("students.id as StudentID", "students.*", "exams.*")->paginate(10);
	$data = array('Exam' => $Exam, "Subject" => $Subject);
    return view('exams', $data);
    }
	
    public function examsview($id)
    {
	$Exam = Exam::find($id);
	$Student = Student::find($Exam->StudentID);
	$SV = SV::find($Exam->SVID);
    $Subject = Subject::find($Exam->SubjectID);
	$data = array('Exam' => $Exam, "Student" => $Student, "Subject" => $Subject, "SV" => $SV);
    return view('examsview', $data);
    }
	
    public function examsremove($id)
    { 
       $Exam = Exam::find($id);
	   $Exam->delete();
	   return redirect('exams')->with('success', 'Exam has been removed successfully.');
    }
    public function reportgenerate(Request $request)
    { 
       
	   $startdate = $request->startdate;
	   $enddate = $request->enddate;
	   $SubjectID = $request->SubjectID;
	   $Exam = Exam::join('students', 'students.id', "=", "exams.StudentID")->join('subjects', 'subjects.id', "=", "exams.SubjectID")->select("students.id as StudentID", "subjects.Name as SubjectName", "students.*", "exams.*");
	   if($SubjectID != "All")
	   {
		   $Exam = $Exam->where('SubjectID', $SubjectID);
	   }
	    if($startdate != "")
	   {
		   $Exam = $Exam->where('created_at', ">=", $startdate);
	   }
	   if($enddate != "")
	   {
		   $Exam = $Exam->where('created_at', "<=", $enddate);
	   }
	   
	   $Exam = $Exam->get();
	    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=report.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $columns = array('Roll Number', 'Name', 'Subject Name', 'Exam Submit Time', 'Exam Time Taken', 'Total Timing', 'Total Question', 'Correct Answer', 'Incorrect Answer', 'UnAttempt Questions');

    $callback = function() use ($Exam, $columns)
    {
		
       $file = fopen('php://output', 'w');
      fputcsv($file, $columns);

        foreach($Exam as $E) {
            fputcsv($file, array($E->RollNo, $E->Name, $E->SubjectName, $E->created_at, $E->TimeTaken, $E->TotalTiming, $E->TotalQuestion, $E->correctAnswer,$E->IncorrectAnswer, $E->UnAttemptAnswer));
        } 
       fclose($file); 
    };
    return response()->stream($callback, 200, $headers);
	  // return redirect('exams')->with('success', 'Exam has been removed successfully.');
    }
}
