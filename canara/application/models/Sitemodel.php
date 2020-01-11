<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->library('ion_auth');
        
    }
    
    
    /*
    
    	returns all available sites
    
    */
    
    public function all( $forUserID = '' ) {
    
    	//if $forUserID is set, this means we're looking for the sites belonging to a specific user
    
    	if( $forUserID == '' ) {
    
    		$user = $this->ion_auth->user()->row();
    		$userID = $user->id;
    
    		if( !$this->ion_auth->is_admin() ) {    		
    	
    			$this->db->where('users_id', $userID);
    	
    		}
    	
    	} else {
    	
    		$this->db->where('users_id', $forUserID);
    	
    	}
    	
    	$this->db->from('sites');
    	$this->db->where('sites_trashed', 0);
    	$this->db->join('users', 'sites.users_id = users.id');
    	
    	$query = $this->db->get();
    	
    	$res = $query->result();
    	
		
		$allSites = array();//array holding all sites and associated data
		
		foreach( $res as $site ) {
		
            $temp = array();
			$pages = array();
			
			$temp['siteData'] = $site;
			
			
			//get the number of pages
			
			$query = $this->db->from('pages')->where('sites_id', $site->sites_id)->get();
			
			$res = $query->result();
			foreach ($res as $key => $value) {
                $pages[$key]['id'] = $value->pages_id; 
                $pages[$key]['name'] = $value->pages_name; 
            }
            $temp['pages'] = $pages;
			$temp['nrOfPages'] = $query->num_rows();
			
			$this->db->flush_cache();
			
			
			//grab the first frame for each site, if any
			
			$q = $this->db->from('pages')->where('pages_name', 'index')->where('sites_id', $site->sites_id)->get();
			
			if( $q->num_rows() > 0 ) {
			
				$res = $q->result();
			
				$indexPage = $res[0];
			
				$q = $this->db->from('frames')->where('pages_id', $indexPage->pages_id)->where('revision', 0)->order_by('frames_id', 'asc')->limit(1)->get();
			
				if( $q->num_rows() > 0 ) {
			
					$res = $q->result();
			
					$temp['lastFrame'] = $res[0];
				
				} else {
					
					$temp['lastFrame'] = '';
				
				}
			
			} else {
			
				$temp['lastFrame'] = '';
			
			}
			
			
			$allSites[] = $temp;
		
		}
		
		return $allSites;
		    
    }
    
    
    /*
	    
	    
	    checks to see if a site belongs to this user
	    
    */
    
    public function isMine( $siteID ) {
	    
	    $user = $this->ion_auth->user()->row();
    	
    	$userID = $user->id;
    	
    	
    	$q = $this->db->from('sites')->where('sites_id', $siteID)->get();
    	
    	if( $q->num_rows() > 0 ) {
	    	
	    	$res = $q->result();
	    	
	    	if( $res[0]->users_id != $userID ) {
		    	
		    	return false;
		    	
	    	} else {
		    	
		    	return true;
		    	
	    	}
	    	
    	} else {
	    	
	    	return false;
	    	
    	}
	    
    }
    
    
    
    /*
    
    	creates a new, empty shell site	
    	
    */
    
    public function createNew() {
    
    	$user = $this->ion_auth->user()->row();
    	
    	$userID = $user->id;
    
    	//create site
    	$data = array(
    	   'sites_name' => 'My New Site',
    	   'users_id' => $userID,
    	   'sites_created_on' => time()
    	);
    	
    	$this->db->insert('sites', $data); 
    	
    	$newSiteID = $this->db->insert_id();
    	
    	
    	//create empty index page
    	
		$data = array(
			'sites_id' => $newSiteID,
			'pages_name' => 'index',
			'pages_timestamp' => time()
		);
		
		$this->db->insert('pages', $data); 
    	
    	return $newSiteID;
    	
    }
    
    
    
    
    /*
    	
    	creates a new site item, including pages and frames
    
    */
    
    public function create($siteName, $siteData) {
    
    	$user = $this->ion_auth->user()->row();
    	
    	$userID = $user->id;
    	
    	
    	//create the site item first
    	
    	$data = array(
    		'users_id' => $userID,
    		'sites_name' => $siteName,
    	   	'sites_created_on' => time()
    	);
    	
    	$this->db->insert('sites', $data); 
    	
    	
    	$siteID = $this->db->insert_id();
    	
    	//die( "ID: ".$this->db->insert_id() );
    	    	
    	
    	//next we create the pages and frames
    	
    	foreach( $siteData as $pageName => $frames ) {
    	
    		$data = array(
    			'sites_id' => $siteID,
    			'pages_name' => $pageName,
    			'pages_timestamp' => time()
    		);
    		
    		$this->db->insert('pages', $data); 
    		
    		$pageID = $this->db->insert_id();
    		
    		
    		
    		//page is done, now all the frames for this page
    		
    		foreach( $frames as $frameData ) {
    		
    			$data = array(
    				'pages_id' => $pageID,
    				'sites_id' => $siteID,
    				'frames_content' => $frameData['frameContent'],
    				'frames_height' => $frameData['frameHeight'],
    				'frames_original_url' => $frameData['originalUrl'],
					'frames_sandbox' => $frameData['frameSandbox'],
					'frames_loaderfunction' => $frameData['frameLoaderfunction'],
    				'frames_timestamp' => time()
    			);
    			
    			$this->db->insert('frames', $data);
				    		
    		}
    	
    	}
    	
    	return $siteID;
    
    }
    
    
    
    /*
    	
    	updates an existing site item, including pages and frames
    	
    */
    
    public function update($siteData, $pages) {    
    
       	//update the site details first
        $data = array(
   	        'sites_name' => $siteData['sites_name'],
            'sites_lastupdate_on' => time(),
            'viewmode' => $siteData['responsiveMode']
        );
    	
        $this->db->where('sites_id', $siteData['sites_id']);
        $this->db->update('sites', $data);
        
        
        //update the pages
        foreach( $pages as $page => $pageData ) {

            if( $pageData['status'] == 'changed' ) {//dealing with a changed page

                if( !isset($pageData['pageID']) || $pageData['pageID'] == 0 ) {
                
                    $query = $this->db->from('pages')->where('sites_id', $siteData['sites_id'])->where('pages_name', $page)->get();
                    
                    $pageDataOld = $query->result();
                    
                    $pageID = $pageDataOld[0]->pages_id;

                } else {

                    $pageID = $pageData['pageID'];

                }
                
                $data = array(
                    'pages_name' => $page,
                    'pages_timestamp' => time(),
                    'pages_title' => $pageData['pageSettings']['title'],
                    'pages_meta_keywords' => $pageData['pageSettings']['meta_keywords'],
                    'pages_meta_description' => $pageData['pageSettings']['meta_description'],
                    'pages_header_includes' => $pageData['pageSettings']['header_includes'],
                    'pages_css' => $pageData['pageSettings']['page_css']
                );

                $this->db->where('pages_id', $pageID);
                $this->db->update('pages', $data);

            } elseif( $pageData['status'] == 'new' ) {
                
                $data = array(
                    'sites_id' => $siteData['sites_id'],
                    'pages_name' => $page,
                    'pages_timestamp' => time(),
                    'pages_title' => $pageData['pageSettings']['title'],
                    'pages_meta_keywords' => $pageData['pageSettings']['meta_keywords'],
                    'pages_meta_description' => $pageData['pageSettings']['meta_description'],
                    'pages_header_includes' => $pageData['pageSettings']['header_includes'],
                    'pages_css' => $pageData['pageSettings']['page_css']
                );
                
                $this->db->insert('pages', $data);
                $pageID = $this->db->insert_id();
                
            }

            //echo $this->db->last_query();
            
            //page done, onto the blocks
            //push existing frames into revision	    	
			
            $data = array(
                'revision' => 1
            );
    		
            $this->db->where('pages_id', $pageID);
            $this->db->update('frames', $data);
			
			if( isset($pageData['blocks']) ) {
            
            	foreach( $pageData['blocks'] as $block ) {
                
                	$data = array(
                    	'pages_id' => $pageID,
                    	'sites_id' => $siteData['sites_id'],
                    	'frames_content' => $block['frameContent'],
                    	'frames_height' => $block['frameHeight'],
                    	'frames_original_url' => $block['originalUrl'],
                    	'frames_sandbox' => ($block['sandbox'] == 'true')? 1: 0,
                    	'frames_loaderfunction' => $block['loaderFunction'],
                    	'frames_timestamp' => time(),
                        'frames_global' => (isset($block['frames_global']))? 1: 0,
                	);
    			
                	$this->db->insert('frames', $data); 
                
            	}
				
			}
            
        }
    
    }
    
    
    /* 
    	
    	updates a site's meta data (name, ftp details, etc)
    
    */
     
  	public function updateSiteData($siteData) {
  	
  		
  		//test the FTP data
  		
  		$this->load->model('ftpmodel');
  		
  		$path = ( $siteData['siteSettings_ftpPath'] != '' )? $siteData['siteSettings_ftpPath'] : "/";
  		
  		$result = $this->ftpmodel->test( $siteData['siteSettings_ftpServer'], $siteData['siteSettings_ftpUser'], $siteData['siteSettings_ftpPassword'], $siteData['siteSettings_ftpPort'], $path );
  		
  		$ftpOk = 0;
  		
  		if ( $result['connection'] ) {
  		
  			$ftpOk = 1;
  			  		
  		}
  		
  		
  		$data = array(
  			'sites_name' => $siteData['siteSettings_siteName'],
			'ftp_server' => $siteData['siteSettings_ftpServer'],
  			'ftp_user' => $siteData['siteSettings_ftpUser'],
  			'ftp_password' => $siteData['siteSettings_ftpPassword'],
  			'ftp_path' => $siteData['siteSettings_ftpPath'],
  			'ftp_port' => $siteData['siteSettings_ftpPort'],
  			'ftp_ok' => $ftpOk,
  			'remote_url' => $siteData['siteSettings_remoteUrl'],
			'global_css' => $siteData['siteSettings_siteCSS']
 		);
  		
  		$this->db->where('sites_id', $siteData['siteID']);
  		$this->db->update('sites', $data);
  		
  		if( $ftpOk == 1 ) {
  		
  			return true;
  		
  		} else {
  		
  			return false;
  		
  		}
  	
	}
	
	
	
	/*
		returns a single site, without pages/frames
	*/
	
	public function siteData($siteID) {
		
		$query = $this->db->from('sites')->where('sites_id', $siteID)->get();
		
		if( $query->num_rows() > 0 ) {
			
			$res = $query->result();
			
			return $res[0];
			
		} else {
			
			return false;
			
		}
		
	}
     
    
    
    
    /*
    
    	takes a site ID and returns all the site data, or false is the site doesn't exist
    	
    */
    
    public function getSite($siteID) {
    
    	$query = $this->db->from('sites')->where('sites_id', $siteID)->get();
    	    	
    	if( $query->num_rows() == 0 ) {
    	
    		return false;
    	
    	} 
    	
    	$res = $query->result();
    	
    	$site = $res[0];
    	
    	$siteArray = array();
    	$siteArray['site'] = $site;
    	
    	
    	//get the pages + frames
        $where ='sites_id ='. $site->sites_id;
       /* if(isset($_SESSION['pages'])){
            if($_SESSION['pages'] == ''){
    	       $where .= " AND pages_id IN (0)";
           } else {
                $where .= " AND pages_id IN (".$_SESSION['pages'].")";
           }
        }*/
    	$query = $this->db->from('pages')->where($where)->get();
    	
    	$res = $query->result();
    	
    	$pageFrames = array();
    	
    	foreach( $res as $page ) {
    	
    		//get the frames for each page
    		
    		$query = $this->db->from('frames')->where('pages_id', $page->pages_id)->where('revision', 0)->order_by('frames_id')->get();
            
            $pageDetails = array();
            $pageDetails['blocks'] = $query->result();
            $pageDetails['page_id'] = $page->pages_id;
            $pageDetails['pages_title'] = $page->pages_title;
            $pageDetails['meta_description'] = $page->pages_meta_description;
            $pageDetails['meta_keywords'] = $page->pages_meta_keywords;
            $pageDetails['header_includes'] = $page->pages_header_includes;
            $pageDetails['page_css'] = $page->pages_css;
    		
    		$pageFrames[$page->pages_name] = $pageDetails;
    		    	
    	}
    	
    	$siteArray['pages'] = $pageFrames;
    	
    	
    	//grab the assets folders as well
    	$this->load->helper('directory');
    	
    	$folderContent = directory_map($this->config->item('elements_dir'), 2);
    	
    	$assetFolders = array();
    	
    	foreach( $folderContent as $key => $item ) {
    	
    		if( is_array($item) ) {
    		
    			array_push($assetFolders, $key);
    		
    		}
    	
    	}
    	
    	
    	$siteArray['assetFolders'] = $assetFolders;
    	
    	return $siteArray;
    
    }
    
    
    
    /*
    
    	grabs a single frame and returns it
    
    */
    
    public function getSingleFrame($frameID) {
    
    	$query = $this->db->from('frames')->where('frames_id', $frameID)->get();
    	
    	$res = $query->result();
    	
    	return $res[0];
    
    }
    
    
    
    /*
    	
    	gets the assets and pages of a site
    
    */
    
    public function getAssetsAndPages( $siteID ) {
    
    	//get the asset folders first, we only grab the first level folders inside $this->config->item('elements_dir')
    	
    	$this->load->helper('directory');
    	
    	$folderContent = directory_map($this->config->item('elements_dir'), 2);
    	
    	$assetFolders = array();
    	
    	foreach( $folderContent as $key => $item ) {
    	
    		if( is_array($item) ) {
    		
    			array_push($assetFolders, $key);
    		
    		}
    	
    	}
    	
    	
    	
    	//now we get the pages
    	
    	$query = $this->db->from('pages')->where('sites_id', $siteID)->get();
    
    	$pages = $query->result();
    	
    	$return = array();
    	
    	$return['assetFolders'] = $assetFolders;
    	$return['pages'] = $pages;
    	
    	return $return;
    	
    }
    
    
    
    /*
    
    	moves a site to the trash
    	
    */
    
    public function trash($siteID) {
    
    	$data = array(
    		'sites_trashed' => 1
    	);
    	
    	$this->db->where('sites_id', $siteID);
    	$this->db->update('sites', $data); 
    
    }
    
    
    
    /*
    	
    	returns all admin images
    	
    */
    
    public function adminImages() {
    
    	//$folderContent = directory_map($this->config->item('images_dir'), 2);
		$temp = explode("|", $this->config->item('images_allowedExtensions'));
    	$adminImages = array();
		$pt = FCPATH . $this->config->item('images_dir');
		$di = new RecursiveDirectoryIterator($pt);
		foreach (new RecursiveIteratorIterator($di) as $file) {
			$name = $file->getFilename();
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if(!in_array($ext, $temp) || strlen($name) < 3){
				continue;
			}
			if($file == $pt.'/'.$name) {
				$adminImages[] = array($file->getMTime(), $file->getFilename());
			}
		}
		usort ( $adminImages, function( $a, $b ) {
			return $a[0] < $b[0];
		});
		if(!empty($adminImages)){
			foreach($adminImages as $ar){
				$newAr[] = $ar[1];
			}
			return $newAr;
		}
		else{
			return false;
		}
    	/*if( $folderContent ) {
    	
    		//print_r( $folderContent );
    	
    		$adminImages = array();
    	
    		foreach( $folderContent as $key => $item ) {
    	
    			if( !is_array($item) ) {
    		
    				//check the file extension
    			
    				$ext = pathinfo($item, PATHINFO_EXTENSION);
    				
    				
    				//prep allowed extensions array
    				
    				$temp = explode("|", $this->config->item('images_allowedExtensions'));
    				
    			
    				if( in_array($ext, $temp) ) {
    		
    					array_push($adminImages, $item);
    			
    				}
    						
    			}
    	
    		}
    	
    		return $adminImages;
    	
    	} else {
    	
    		return false;
    	
    	}*/
    
    }
    
    
    
    /*
    
    	trashes a users' sites
    
    */
    
    public function deleteAllFor( $userID ) {
    
    	$data = array(
    		'sites_trashed' => 1
    	);
    	
    	$this->db->where('users_id', $userID);
    	$this->db->update('sites', $data);
    
    }
	
	
	
	/*
		
		grabs a singlepage for preview
	
	*/
	
	public function getPage($siteID, $pageName) {
		
		$q = $this->db->from('pages')->where('sites_id', $siteID)->where('pages_name', $pageName)->order_by('pages_timestamp', 'asc')->get()->row();
		
		if( $q->pages_preview != '' ) {
		
			return $q;
		
		} else {
			
			return false;
			
		}
		
	}
    
    
    /*
    
        Marks site as published
    
    */
    
    public function published($siteID) {
        
        $data = array(
            'ftp_published' => 1,
            'publish_date' => time()
        );
        
        $this->db->where('sites_id', $siteID);
        $this->db->update('sites', $data);
                
    }
    
}