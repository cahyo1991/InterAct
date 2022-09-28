<?php
class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('conferenceappmin_model');
		$this->load->helper('form');
		$this->load->library('session');
	}
	
	public function signin()
	{
		//
		//1. Get settings: "AppName", "AppNameLeft", "AppNameRight", "AppVersion"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_appname = "";
		$setting_appnameleft = "";
		$setting_appnameright = "";
		$setting_appversion = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "AppName"){
				$setting_appname = $setting['Value'];
			}else if($setting['Property'] == "AppNameLeft"){
				$setting_appnameleft = $setting['Value'];
			}else if($setting['Property'] == "AppNameRight"){
				$setting_appnameright = $setting['Value'];
			}else if($setting['Property'] == "AppVersion"){
				$setting_appversion = $setting['Value'];
			}
		}
		
		//
		//2. Set session value for various settings
		$this->session->set_userdata('AppName', $setting_appname);
		$this->session->set_userdata('AppNameLeft', $setting_appnameleft);
		$this->session->set_userdata('AppNameRight', $setting_appnameright);
		$this->session->set_userdata('AppVersion', $setting_appversion);
		
		$data['title'] = 'Sign-in';
		
		$this->load->view('templates/header_signin', $data);
		$this->load->view('account/signin', $data);
		$this->load->view('templates/footer_signin', $data);
	}
	
	public function post_signin()
	{
		//
		//1. Get user input
		$in_username = $this->input->post('Username');
		$in_password = $this->input->post('Password');

		//
		//1.5. Trim leading zeroes...
		$in_username = ltrim($in_username, '0');
		
		//
		//2. Get settings: "ActiveEventID" and "ActivePasscode"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		$setting_activepasscode = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
			}else if($setting['Property'] == "ActivePasscode"){
				$setting_activepasscode = $setting['Value'];
			}
		}
		
		//
		//3. Check if user is authorized
		$isauthorized = false;
		if($setting_activeeventid == -1){
			//no active event
			//check passcode in tmasevent
			$condition = array('Passcode' => $in_password);
			print_r($condition);
			$event = $this->conferenceappmin_model->getEvent($condition);
			if($event){
				//$isauthorized = true;
				$setting_activeeventid = $event['EventID'];
			
				$condition = array(
					'Username'	=> $in_username,
					'Password'	=> $in_password,
					'EventID'	=> $setting_activeeventid
				);
				print_r($condition);
				$user = $this->conferenceappmin_model->getUser($condition);
				print_r($user);
				if($user){
					//successful signin
					$isauthorized = true;
					$this->session->set_userdata('User', $user);
				}else{
					//failed signin
				}
			}
		}else{
			if($setting_activepasscode == ""){
				//no active passcode, use tmasuser's Password
				$condition = array(
					'Username'	=> $in_username,
					'Password'	=> $in_password,
					'EventID'	=> $setting_activeeventid
				);
				$user = $this->conferenceappmin_model->getUser($condition);
				if($user){
					//successful signin
					$isauthorized = true;
					$this->session->set_userdata('User', $user);
				}else{
					//failed signin
				}
			}else{
				//with active passcode, check if match
				if(strtolower($in_password) == strtolower($setting_activepasscode)){
					//Password and ActivePasscode match successful
					$condition = array(
						'Username'	=> $in_username,
						'EventID'	=> $setting_activeeventid
					);
					$user = $this->conferenceappmin_model->getUser($condition);
					if($user){
						//successful signin
						$isauthorized = true;
						$this->session->set_userdata('User', $user);

						//insert log
						date_default_timezone_set('Asia/Manila');
						$inserts = array(
							'UserID'		=> $user['UserID'],
							'EventID'		=> $setting_activeeventid,
							'Action'		=> 'Sign in',
							'Description'	=> 'User successfully signed in.',
							'Timestamp'		=> date('Y-m-d H:i:s', time())
						);

						$logid = $this->conferenceappmin_model->insertLog($inserts);
					}else{
						//failed signin
					}
				}else{
					//Password and ActivePasscode match fail
				}
			}
		}
		
		//
		//4. Determine where to route after determining authorization
		if($isauthorized){
			$condition = array('EventID' => $setting_activeeventid);
			$data['event'] = $this->conferenceappmin_model->getEvent($condition);

			$this->session->set_userdata('ActiveEventID', $setting_activeeventid);

			if($data['event']['WelcomeMessage']){
				// redirect('/index.php/Account/welcome', 'location');
				redirect('/index.php/MySession', 'location');
			}else{
				redirect('/index.php/MySession', 'location');
			}

			//redirect('/index.php/MySession', 'location');

			//
			//5. Does event have active poll?
			//$condition = array('Property' => 'ActivePollID');
			//$setting_activepollid = $this->conferenceappmin_model->getSetting($condition);

			/*
			$condition = array('EventID' => $setting_activeeventid);
			$event = $this->conferenceappmin_model->getEvent($condition);
			if(($event['ActivePollID']==null)||($event['ActivePollID']==-1)){
				//no (event level) active poll ID
				//proceed to session list
				redirect('/index.php/MySession', 'location');
			}else{
				//has (event level) active poll ID
				redirect('/index.php/Poll/activepoll', 'location');
			}
			*/
		}else{
			//notify: failed signin
			$this->setAlert("danger", "ban", "Error", "Failed to signin to the event.");
			redirect('/index.php/Account/signin', 'location');
		}
	}
	
	public function signout()
	{
		$this->session->unset_userdata('User');
		redirect('/index.php/Account/signin', 'location');
	}
	
	public function register()
	{
		//
		//1. Get settings: "AppName", "AppNameLeft", "AppNameRight", "AppVersion"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_appname = "";
		$setting_appnameleft = "";
		$setting_appnameright = "";
		$setting_appversion = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "AppName"){
				$setting_appname = $setting['Value'];
			}else if($setting['Property'] == "AppNameLeft"){
				$setting_appnameleft = $setting['Value'];
			}else if($setting['Property'] == "AppNameRight"){
				$setting_appnameright = $setting['Value'];
			}else if($setting['Property'] == "AppVersion"){
				$setting_appversion = $setting['Value'];
			}
		}

		// print_r($setting);
		// die();
		
		//
		//2. Set session value for various settings
		$this->session->set_userdata('AppName', $setting_appname);
		$this->session->set_userdata('AppNameLeft', $setting_appnameleft);
		$this->session->set_userdata('AppNameRight', $setting_appnameright);
		$this->session->set_userdata('AppVersion', $setting_appversion);

		//$data['specialties'] = $this->conferenceappmin_model->getSpecialties();
		
		//$data['grouplabel'] = 'Division';
		//$data['groups'] = array('AMHERST LABORATORIES','AMHERST PARENTERALS','ASIAN ANTIBIOTICS INC','BIBC','BIOFEMME','BIOMEDIS','BIO-ONCOLOGY','BUSINESS DEVELOPMENT','CENTRAL QUALITY ASSURANCE','CONSUMER HEALTH','CORPORATE AFFAIRS','CORPORATE INFORMATION TECHNOLOGY','CORPORATE INTERNAL AUDIT','CORPORATE QUALITY ASSURANCE AND COMPLIANCE','CUSTOMER RELATIONSHIP','DISTRIBUTION','EXECUTIVE OFFICE','EXECUTIVE OFFICE - CORPORATE INTERNAL AUDIT','EXECUTIVE OFFICE - CORPORATE PLANNING','EXECUTIVE OFFICE - CORPORATE PRODUCT BOARD','EXECUTIVE OFFICE - LEGAL SERVICES','EXTERNAL AFFAIRS','FINANCE','GROWTH VENTURES','HEALTH DELIVERY SYSTEMS','HUMAN RESOURCES AND ORGANIZATION DEVELOPMENT','INNOVITELLE','INTEGRATED PLANNING AND LOGISTICS MANAGEMENT DIVISION','LRI-THERAPHARMA','MANUFACTURING','MEDICAL AFFAIRS','MEDICAL AND REGULATORY AFFAIRS','MEDICHEM','MT. GRACE HOSPITALS ','NATIONAL PRIVACY COMMISSION','PEDIATRICA','PERSONAL CARE MANUFACTURING GROUP','PHAREX','PHILIPPINE HEALTH FOOD MANUFACTURING','PORTFOLIO DEVELOPMENT AND BUSINESS ANALYTICS','PROFESSIONAL HEALTHCARE GROUP','PROFESSIONAL RELATIONS MANAGEMENT','PROPERTY SERVICES GROUP','RELIANCE','RESEARCH AND DEVELOPMENT','RITEMED','SALES AND CHANNEL DEVELOPMENT','SOURCING AND MATERIALS MANAGEMENT','THERAPHARMA','TREASURY','UL INTERNATIONAL','UL NUTRITIONALS, INC.','ULIVACCINES','UNAHCO','UNITED AMERICAN PHARMACEUTICALS','WESTMONT','(OTHERS)');

		//$data['grouplabel'] = 'Specialty';
		//$data['groups'] = array('CARDIOLOGY','DIABETOLOGY','EMERGENCY MEDICINE','ENDOCRINOLOGY','FAMILY MEDICINE','GASTROENTEROLOGY','GENERAL PRACTICE','GENERAL SURGERY','GERIATRICS','INTERNAL MEDICINE','NEPHROLOGY','NEUROLOGY','OCCUPATIONAL MEDICINE','ONCOLOGY','PULMONOLOGY','REHABILITATION MEDICINE','RHEUMATOLOGY','UROLOGY','(OTHERS)');
		
		$data['title'] = 'Register';
		
		$this->load->view('templates/header_signin', $data);
		$this->load->view('account/register', $data);
		$this->load->view('templates/footer_signin', $data);
	}
	
	public function post_register()
	{


		//
		//1. Get user input
		$in_username = $this->input->post('Username');
		$in_password = strtolower($this->input->post('Password'));
		$in_email = $this->input->post('Email');
		$in_firstname = $this->input->post('FirstName');
		$in_lastname = $this->input->post('LastName');
		//$in_specialtyid = $this->input->post('SpecialtyID');
		$in_group = $this->input->post('Group');

		
		//
		//1.5. Trim leading zeroes... if Username is PRC or EmployeeID
		$in_username = ltrim($in_username, '0');
		
		//
		//2. Get settings: "ActiveEventID" and "ActivePasscode"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		$setting_activepasscode = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
			}else if($setting['Property'] == "ActivePasscode"){
				$setting_activepasscode = $setting['Value'];
			}
		}
		
		//
		//3. Check if user is authorized
		$isauthorized = false;
		if($setting_activeeventid == -1){
			//no active event
			//check passcode in tmasevent
			$condition = array('Passcode' => $in_password);
			$event = $this->conferenceappmin_model->getEvent($condition);
			if($event){
				$isauthorized = true;
				$setting_activeeventid = $event['EventID'];
			}
		}else{
			if($setting_activepasscode == ""){
				//no active passcode, use user suggested Password
				$isauthorized = true;
			}else{
				//with active passcode, check if match
				if(strtolower($in_password) == strtolower($setting_activepasscode)){
					//Password and ActivePasscode match successful
					$isauthorized = true;
				}else{
					//Password and ActivePasscode match fail
				}
			}
		}
		
		//
		//4. Check if Username (PRC No.) for that event already exists
		$usernameexists = false;
		$condition = array('Username' => $in_username, 'EventID' => $setting_activeeventid);
		$checkuserexistence = $this->conferenceappmin_model->getUser($condition);
		if($checkuserexistence){
			$usernameexists = true;
		}
		
		//
		//5. Determine where to route after determining authorization
		if($isauthorized){
		//if(($isauthorized)&&(!$usernameexists)){
			if($usernameexists){
				//sign in
				$condition = array(
					'Username'	=> $in_username,
					'EventID'	=> $setting_activeeventid
				);
				$user = $this->conferenceappmin_model->getUser($condition);
				if($user){
					//successful signin
					$isauthorized = true;
					$this->session->set_userdata('User', $user);
					$this->session->set_userdata('ActiveEventID', $setting_activeeventid);

					//insert log
					date_default_timezone_set('Asia/Manila');
					$inserts = array(
						'UserID'		=> $user['UserID'],
						'EventID'		=> $setting_activeeventid,
						'Action'		=> 'Sign in',
						'Description'	=> 'User successfully signed in (via registration page).',
						'Timestamp'		=> date('Y-m-d H:i:s', time())
					);

					$logid = $this->conferenceappmin_model->insertLog($inserts);

					//proceed to session list
					//redirect('/index.php/MySession', 'location');

					if($event['WelcomeMessage']){
						// redirect('/index.php/Account/welcome', 'location');
						redirect('/index.php/MySession', 'location');
					}else{
						redirect('/index.php/MySession', 'location');
					}
				}else{
					//failed signin
					//notify: failed registration/sign in
					$this->setAlert("danger", "ban", "Error", "Failed to register to the event.");
					redirect('/index.php/Account/register', 'location');
				}
			}else{
				//register
				$inserts = array(
					'Username'		=> $in_username,
					'Password'		=> $in_password,
					'Email'			=> $in_email,
					'FirstName'		=> $in_firstname,
					'LastName'		=> $in_lastname,
					//'SpecialtyID'	=> $in_specialtyid,
					'Group'			=> $in_group,
					'EventID'		=> $setting_activeeventid
				);
				$inserted = $this->conferenceappmin_model->insertUser($inserts);
				
				if($inserted){
					$condition = array(
						'Username'	=> $in_username,
						'EventID'	=> $setting_activeeventid
					);
					$user = $this->conferenceappmin_model->getUser($condition);
					$this->session->set_userdata('User', $user);
					$this->session->set_userdata('ActiveEventID', $setting_activeeventid);

					//insert log
					date_default_timezone_set('Asia/Manila');
					$inserts = array(
						'UserID'		=> $user['UserID'],
						'EventID'		=> $setting_activeeventid,
						'Action'		=> 'Register',
						'Description'	=> 'User successfully registered.',
						'Timestamp'		=> date('Y-m-d H:i:s', time())
					);

					$logid = $this->conferenceappmin_model->insertLog($inserts);

					$this->setAlert("success", "check", "Success", "You have successfully registered to the event.");
					
					//proceed to session list
					//redirect('/index.php/MySession', 'location');
					//back to signin
					//redirect('/index.php/Account/signin', 'location');

					if($event['WelcomeMessage']){
						redirect('/index.php/Account/welcome', 'location');
					}else{
						redirect('/index.php/MySession', 'location');
					}
				}else{
					//notify: failed registration
					$this->setAlert("danger", "ban", "Error", "Failed to register to the event.");
					redirect('/index.php/Account/register', 'location');
				}
			}
		}else{
			//notify: failed registration
			$this->setAlert("danger", "ban", "Error", "Failed to register to the event.");
			redirect('/index.php/Account/register', 'location');
		}
	}

	public function welcome()
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			$ActiveEventID = $this->session->ActiveEventID;
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);

			//$condition = array('EventID' => $setting_activeeventid['Value']);
			$condition = array('EventID' => $ActiveEventID);
			$data['event'] = $this->conferenceappmin_model->getEvent($condition);

			$data['header_big'] = $data['event']['EventName'];
			$data['header_small'] = $data['event']['Venue'];
			$data['title'] = 'Welcome';

			$this->load->view('templates/header', $data);
			$this->load->view('account/welcome', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	//
	// For 2017 LRP Input Session
	public function check()
	{
		//
		//1. Get settings: "AppName", "AppNameLeft", "AppNameRight", "AppVersion"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_appname = "";
		$setting_appnameleft = "";
		$setting_appnameright = "";
		$setting_appversion = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "AppName"){
				$setting_appname = $setting['Value'];
			}else if($setting['Property'] == "AppNameLeft"){
				$setting_appnameleft = $setting['Value'];
			}else if($setting['Property'] == "AppNameRight"){
				$setting_appnameright = $setting['Value'];
			}else if($setting['Property'] == "AppVersion"){
				$setting_appversion = $setting['Value'];
			}
		}

		//
		//2. Get setting: "ActiveEventID"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
				break;
			}
		}

		$condition = array('EventID' => $setting_activeeventid);
		$data['event'] = $this->conferenceappmin_model->getEvent($condition);
		
		//
		//3. Set session value for various settings
		$this->session->set_userdata('AppName', $setting_appname);
		$this->session->set_userdata('AppNameLeft', $setting_appnameleft);
		$this->session->set_userdata('AppNameRight', $setting_appnameright);
		$this->session->set_userdata('AppVersion', $setting_appversion);
		
		$data['title'] = 'Check Registration';
		
		$this->load->view('templates/header_signin', $data);
		$this->load->view('account/check', $data);
		$this->load->view('templates/footer_signin', $data);
	}

	//
	// For 2017 LRP Input Session
	public function checkstatus()
	{
		//
		//1. Get user input
		$in_username = $this->input->post('Username');
		$data['username'] = $in_username;

		//
		//2. Get setting: "ActiveEventID"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
				break;
			}
		}

		$condition = array('EventID' => $setting_activeeventid);
		$data['event'] = $this->conferenceappmin_model->getEvent($condition);

		//
		//3. Check if user is registered
		$condition = array(
			'Username'	=> $in_username,
			'EventID'	=> $setting_activeeventid
		);
		$user = $this->conferenceappmin_model->getUser($condition);

		if($user){
			//registered
			$data['isregistered'] = true;
		}else{
			//not yet registered
			$data['isregistered'] = false;
		}

		$data['title'] = 'Registration Status';
		
		$this->load->view('templates/header_signin', $data);
		$this->load->view('account/checkstatus', $data);
		$this->load->view('templates/footer_signin', $data);
	}
	public function setAlert($contextualclass, $favicon, $title, $message)
	{
		$this->session->set_flashdata('alert_contextualclass', $contextualclass);
		$this->session->set_flashdata('alert_favicon', $favicon);
		$this->session->set_flashdata('alert_title', $title);
		$this->session->set_flashdata('alert_message', $message);
	}
	
}
?>