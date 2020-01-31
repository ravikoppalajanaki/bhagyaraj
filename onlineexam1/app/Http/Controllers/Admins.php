<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Users;
use App\DH;
use App\Help;
use App\Donation;
use App\User, Hash;
use App\Notifications;
//use Illuminate\Notifications\Notifiable;
//use Illuminate\Notifications\Notification;
use Auth;
//use Notification;
class Admins extends Controller
{
    //
	
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkpermission');
    }

	
	public function index()
	{//print_r("expression");exit;
	return redirect()->route('dashboard');exit;
		 $User = User::where('id',"!=", 1);
		 if(Auth::id() != 1)
		 {
		$User =	 $User->where('id', "!=", Auth::id());
		 }
		$User =  $User->paginate(15);
	 $data = array('users' => $User);	 
	
	  $NL_NEW = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->count();
	   //print_r($data);exit; 
	  $NL = Notifications::where('isAdmin', 1)->orderby('created_at', 'desc')->get();
	  $data['NL'] = $NL;
	  $data['NL_NEW'] = $NL_NEW;
	  $affectedRows = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->update(['ReadStatus' => 1]);
     return view('admins', $data);
	}
	
	public function adminview($id)
	{
		 $User = User::find($id);
	 $data = array('user' => $User);	  
	  $NL_NEW = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->count();
	  $NL = Notifications::where('isAdmin', 1)->orderby('created_at', 'desc')->get();
	  $data['NL'] = $NL;
	  $data['NL_NEW'] = $NL_NEW;
	  $affectedRows = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->update(['ReadStatus' => 1]);
     return view('adminview', $data);
	}
	public function adminupdate(Request $request)
	{
		 $User = User::find($request->id);
		 $User->name = $request->name;
		 $User->email = $request->email;
		 $User->mobile = $request->mobile;
		 $c = $request->permission;
		 $c[] = "dashboard";
		 $c[] = "denied";
		 $c[] = "myprofile";
		 $c[] = "updatemyprofile";
		 $User->permission = json_encode($c);
		 if(strlen($request->password) > 1)
		 {
			 if($request->password != $request->password_confirm)
			 {
				 return redirect()->back()->withErrors("Password not matched")->withInput(
				$request->except('password')
				);
			 }
			 else
			 {
				$User->password = Hash::make($request->password);
		 $User->save();
		 return redirect('admins')->with('success','Admin User details and password has been updated.');
			 }
		 }
		 else
		 {
		 $User->save();
		 return redirect('admins')->with('success','Admin User has been updated.');
		 }
	}
	public function admindelete(Request $request)
	{
		 $User = User::find($request->id);
		 
		 $User->delete();
		 return redirect('admins')->with('success','Admin User has been deleted.');
		
	}
	
	public function adminadd()
	{
	 $data = array();	  
	  $NL_NEW = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->count();
	  $NL = Notifications::where('isAdmin', 1)->orderby('created_at', 'desc')->get();
	  $data['NL'] = $NL;
	  $data['NL_NEW'] = $NL_NEW;
	  $affectedRows = Notifications::where('isAdmin', 1)->where('ReadStatus', 0)->update(['ReadStatus' => 1]);
     return view('adminsadd', $data);
	}
	
	public function adminaddpost(Request $request)
	{
		 if($request->password != $request->password_confirm)
		 { 	
		return redirect('admins/add')->withErrors("Password not matched")->withInput(
		$request->except('password')
		);
		 }
		 else
		 {
			$User = new User;
		 $User->name = $request->name;
		 $User->email = $request->email;
		 $User->mobile = $request->mobile;
		  $c = $request->permission;
		 $c[] = "dashboard";
		 $c[] = "denied";
		 $c[] = "myprofile";
		 $c[] = "updatemyprofile";
		 $User->permission = json_encode($c);
		 $User->password = Hash::make($request->password);
		 $User->save();
		 return redirect('admins')->with('success','Admin User has been added.');
		 }
	}
}
