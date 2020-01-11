<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->library('ion_auth');
        
    }
    
    
    /*
    
    	returns all available users
    
    */
    
    public function getAll() {
    
    	$query = $this->db->from('users')->get();
    	
    	return $query->result();
    
    }
    
    
    
    /*
    	
    	returns all images belonging to user
    	
    */
    
    public function getUserImages( $userID ) {
    
    	if( is_dir( $this->config->item('images_uploadDir')."/".$userID ) ) {
			$temp = explode("|", $this->config->item('images_allowedExtensions'));
			$userImages = array();
			$pt = FCPATH . $this->config->item('images_uploadDir')."/".$userID;
			$di = new RecursiveDirectoryIterator($pt);
			foreach (new RecursiveIteratorIterator($di) as $file) {
				$name = $file->getFilename();
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				if(!in_array($ext, $temp) || strlen($name) < 3){
					continue;
				}
				if($file == $pt.'/'.$name) {
					$userImages[] = array($file->getMTime(), $file->getFilename());
				}
			}
			usort ( $userImages, function( $a, $b ) {
				return $a[0] < $b[0];
			});
			if(!empty($userImages)){
				foreach($userImages as $ar){
					$newAr[] = $ar[1];
				}
				return $newAr;
			}
			else{
				return false;
			}
			
    		/* $folderContent = directory_map($this->config->item('images_uploadDir')."/".$userID, 2);
    		
    		//die( print_r($folderContent) );
    		
    		if( $folderContent ) {
    		
    			$userImages = array();
    		
    			foreach( $folderContent as $key => $item ) {
    		
    				if( !is_array($item) ) {
    			
    					//check the file extension
    				                        
                        $ext = pathinfo($item, PATHINFO_EXTENSION);
    					
    					
    					//prep allowed extensions array
    				
    					$temp = explode("|", $this->config->item('images_allowedExtensions'));
    				
    					if( in_array($ext, $temp) ) {
    				
    						array_push($userImages, $item);
    				
    					}
    							
    				}
    		
    			}
    		
    			return $userImages;
    		
    		} else {
    		
    			return false;
    		
    		} */
    	
    	} else {
    	
    		return false;
    	
    	}
    
    }
    
    
    
    /*
    	
    	returns all users including their sites
    
    */
    
    public function getUsersPlusSites($userID = '') {
    
    	$return = array();
    	
    	//get the app users
    	
    	if( $userID == '' ) {
    	
    		$users = $this->ion_auth->users()->result();
    	
    	} else {
    	
    		$users = $this->ion_auth->user($userID)->result();
    	
    	}
    	    
    	foreach( $users as $user ) {
    	
    		$temp = array();
    		
    		$temp['userData'] = $user;
    		
    		if( $this->ion_auth->is_admin( $user->id ) ) {
    		
    			$temp['is_admin'] = 'yes';
    		
    		} else {
    		
    			$temp['is_admin'] = 'no';
    		
    		}
    		
    		
    		//get this user's sites
    		$temp['sites'] = $this->sitemodel->all( $user->id );
    		
    		
    		//push into the final array
    		$return[] = $temp;
    	
    	}
    	
    	//die( print_r($return) );
    	
    	return $return;
    
    }
    
}