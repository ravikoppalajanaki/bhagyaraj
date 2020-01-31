<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\SV;
use App\Subject;
use App\Settings;
use App\QB;
use App\Exam;

class ExamController extends Controller
{
    public function __construct()
    {
      
    }
	
	public function login()
	{
		
		$Subject = Subject::get();
		$data = array("Subject" => $Subject);
		return view('website.login', $data);
	}
	
	public function loginpost(Request $request)
	{
		 $RollNo = $request->input('RollNo');
		 $password = $request->input('password');
		 $Subject = $request->input('Subject');
		 $password = md5($password);
		 $Student = Student::where("RollNo", $RollNo)->count();
		 $SV = SV::where("password", $password)->count();
		 $errors = array();
		 if($Student > 1)
		 {
			 $errors[] = "More then one student find with this roll no. Kindly contact your admin.";
		 }
		 if($SV > 1)
		 {
			 $errors[] = "More then one Supervisor find with this Password Key. Kindly contact your admin.";
		 }
		 if($Student == 0 OR $SV == 0)
		 {
             $errors[] = "Wrong credential.";
		 }
		 if(count($errors) == 0)
		 {
		 $Student = Student::where("RollNo", $RollNo)->first();
		 $SV = SV::where("password", $password)->first();
		 $Subject = Subject::find($Subject);
		 $Settings = Settings::find(1);
		 $data = array("Student" => $Student, "SV" => $SV, "Subject" => $Subject, "Settings" => $Settings);
		 $request->session()->regenerate();
		 session(['data' => $data]);
		 return view('website.examconfirmstart', $data);
		 //session()->get('data');
		 }
		 else
		 {
			 return back()->withErrors($errors);
		 }
	}
	
	
	public function examStart()
	{
		if(!session()->has('data'))
		{
			return redirect()->route('examlogin');
		}
		$data = session()->get('data');
		$Student = $data['Student'];
		$SV = $data['SV'];
		$Settings = $data['Settings'];
		$Subject = $data['Subject'];
        $QB = QB::where('SubjectID', $Subject->id)->limit($Settings->noQuestion)->inRandomOrder()->get();
		$data = array("Student" => $Student, "SV" => $SV, "Subject" => $Subject, "Settings" => $Settings, "QB" => $QB);
		return view('website.examstart', $data);
	}
	
	public function examFinished(Request $request)
	{
		if(!session()->has('data'))
		{
			return redirect()->route('examlogin');
		}
		
		$data = session()->get('data');
		$Student = $data['Student'];
		$SV = $data['SV'];
		$Settings = Settings::find(1);
		$Subject = $data['Subject'];
		$questionid = $request->input('questionid');
		$TimeTaken = $request->input('TimeTaken');
		$ANS = $request->input('ANS');
		$correctAnswer = 0;
		$IncorrectAnswer = 0;
		$UnAttemptAnswer = 0;
		$r = array();
		foreach($questionid as $key=>$value)
		{
			$question = QB::find($value);
			if(isset($ANS[$key]))
			{
				if($ANS[$key] == $question->Option1)
				{
					$AnswerStatus = "Correct";
					$correctAnswer++;
				}
				else
				{
					$AnswerStatus = "Incorrect";
					$IncorrectAnswer++;
				}
				$SelectedOption = $ANS[$key];
			}
			else
			{
				$AnswerStatus = "Not Attempt";
				$UnAttemptAnswer++;
				$SelectedOption = "Not Selected";
			}
			$r[] = array("QuestionID" => $value, "SelectedOption" => $SelectedOption, "AnswerStatus" => $AnswerStatus);
		}
		$r = json_encode($r);
		$Exam = new Exam;
		$Exam->StudentID = $Student->id;
		$Exam->SubjectID = $Subject->id;
		$Exam->SVID = $SV->id;
		$Exam->ExamData = $r;
		$Exam->TimeTaken = $TimeTaken;
		$Exam->TotalQuestion = $Settings->noQuestion;
		$Exam->correctAnswer = $correctAnswer;
		$Exam->IncorrectAnswer = $IncorrectAnswer;
		$Exam->UnAttemptAnswer = $UnAttemptAnswer;
		$Exam->TotalTiming = $Settings->timing;
		$Exam->save();
		$request->session()->pull('data');
		$data = array("Student" => $Student, "SV" => $SV, "Subject" => $Subject, "Settings" => $Settings, "correctAnswer" => $correctAnswer, "IncorrectAnswer" => $IncorrectAnswer, "UnAttemptAnswer" => $UnAttemptAnswer, "TimeTaken" => $TimeTaken);
		return view('website.examfinished', $data);
	}
	
}
