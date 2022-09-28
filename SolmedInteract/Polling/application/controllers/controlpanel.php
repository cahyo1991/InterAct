 <?php
class ControlPanel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('conferenceappmin_model');
		$this->load->helper('form');
		$this->load->library('session');
	}
	
	/* ACCOUNT
	==================================================================================================== */

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
		
		$data['title'] = 'Control Panel Sign-in';
		
		$this->load->view('templates/header_signin', $data);
		$this->load->view('controlpanel/signin', $data);
		$this->load->view('templates/footer_signin', $data);
	}
	
	public function post_signin()
	{
		//
		//1. Get user input
		$in_passcode = $this->input->post('Passcode');
		
		//
		//2. Get settings: "ActiveEventID" and "ControlPanelPasscode"
		$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		$setting_activepasscode = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
			}else if($setting['Property'] == "ControlPanelPasscode"){
				$setting_controlpanelpasscode = $setting['Value'];
			}
		}
		
		//
		//3. Check if user is authorized
		if($setting_activeeventid == -1){
			//no active event
			//check control panel passcode in tmasevent
			$condition = array('ControlPanelPasscode' => $in_passcode);
			$event = $this->conferenceappmin_model->getEvent($condition);
			if($event){
				$isauthorized = true;
				$setting_activeeventid = $event['EventID'];
			}
			$setting_controlpanelpasscode = $in_passcode;
		}else{
			$isauthorized = ($in_passcode == $setting_controlpanelpasscode);
		}
		
		if($isauthorized){
			//proceed to event moderation page
			$this->session->set_userdata('Admin', $setting_controlpanelpasscode);
			$this->session->set_userdata('ActiveEventID', $setting_activeeventid);
			//$this->session->set_userdata('Admin', $setting_activeeventid);
			
			//notify: signin successful
			$this->setAlert("success", "check", "Success", "Successfully signed in the control panel.");

			redirect('/index.php/ControlPanel/event', 'location');
		}else{
			//notify: failed signin
			$this->setAlert("danger", "ban", "Error", "Failed to signin in the control panel.");
			
			redirect('/index.php/ControlPanel/signin', 'location');
		}
	}
	
	public function signout()
	{
		$this->session->unset_userdata('Admin');
		$this->session->unset_userdata('ActiveEventID');
		redirect('/index.php/ControlPanel/signin', 'location');
	}
	
	/* EVENT
	==================================================================================================== */

	public function event()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			echo "FOO";
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			//$condition = array('Property' => 'ActivePollID');
			//$setting_activepollid = $this->conferenceappmin_model->getSetting($condition);
			//$data['ActivePollID'] = $setting_activepollid['Value'];
			
			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				$data['sessions'] = $this->conferenceappmin_model->getMySessions($condition);
				$data['files'] = $this->conferenceappmin_model->getFiles($condition);
				
				$eventpolls = array();
				foreach($data['sessions'] as $session){
					$condition = array('SessionID' => $session['SessionID']);
					$polls = $this->conferenceappmin_model->getPolls($condition);
					$eventpolls = array_merge($eventpolls, $polls);
				}
				$data['eventpolls'] = $eventpolls;
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Moderate Event';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/event', $data);
				$this->load->view('templates/footer', $data);
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}

	public function dashboard()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				$data['sessions'] = $this->conferenceappmin_model->getMySessions($condition);
				$data['files'] = $this->conferenceappmin_model->getFiles($condition);
				
				$eventpolls = array();
				foreach($data['sessions'] as $session){
					$condition = array('SessionID' => $session['SessionID']);
					$polls = $this->conferenceappmin_model->getPolls($condition);
					$eventpolls = array_merge($eventpolls, $polls);
				}
				$data['eventpolls'] = $eventpolls;

				// 1. REGISTERED USERS
				$condition = array('EventID' => $setting_activeeventid);
				$data['users'] = $this->conferenceappmin_model->getUsers($condition);

				// 2. QUESTIONS POSTED
				$data['questions'] = array();
				foreach($data['sessions'] as $session){
					$condition = array('SessionID' => $session['SessionID']);
					$qs = $this->conferenceappmin_model->getQuestions($condition);
					$data['questions'] = array_merge($data['questions'], $qs);
				}

				// 3. POLL RESPONSES
				$data['pollresponses'] = array();
				foreach($data['eventpolls'] as $eventpoll){
					$condition = array('PollID' => $eventpoll['PollID']);
					$data['pollresponses'] = array_merge($data['pollresponses'], $this->conferenceappmin_model->getPollResponses($condition));
				}
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Dashboard';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/dashboard', $data);
				$this->load->view('templates/footer', $data);
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}

	public function download_eventreport()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			
		}
	}

	/* POLL
	==================================================================================================== */
	
	public function setactivepoll($id = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			//$condition = array('Property' => 'ActivePollID');
			//$setting_activepollid = $this->conferenceappmin_model->getSetting($condition);
			//$data['ActivePollID'] = $setting_activepollid['Value'];
			
			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				$data['sessions'] = $this->conferenceappmin_model->getMySessions($condition);
				
				$eventpolls = array();
				if($id == -1){
					foreach($data['sessions'] as $session){
						$condition = array('SessionID' => $session['SessionID']);
						$polls = $this->conferenceappmin_model->getPolls($condition);
						$eventpolls = array_merge($eventpolls, $polls);
						$data['isEvent'] = true;
					}
				}else{
					$condition = array('SessionID' => $id);
					$data['mysession'] = $this->conferenceappmin_model->getMySession($condition);
					$polls = $this->conferenceappmin_model->getPolls($condition);
					$eventpolls = array_merge($eventpolls, $polls);
					$data['SessionID'] = $id;
					$data['isEvent'] = false;
				}
				$data['eventpolls'] = $eventpolls;
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Set Active Poll';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/setactivepoll', $data);
				$this->load->view('templates/footer', $data);
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}
	
	public function post_setactivepoll()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);
				$sessions = $this->conferenceappmin_model->getMySessions($condition);
				
				$eventpolls = array();
				foreach($sessions as $session){
					$condition = array('SessionID' => $session['SessionID']);
					$polls = $this->conferenceappmin_model->getPolls($condition);
					$eventpolls = array_merge($eventpolls, $polls);
				}
				
				//
				//1. Get user input
				$in_pollid = $this->input->post('SelectedPollID');
				$in_isevent = $this->input->post('isEvent');
				$SessionID = $this->input->post('SessionID');
				/*
				$in_issession = $this->input->post('isSession');
				
				if($in_issession){
					$pollidsessionid = explode('|', $in_pollid);
					$in_pollid = $pollidsessionid[0];
					$in_sessionid = $pollidsessionid[1];
				}
				*/
				
				//
				//2. Check if valid [PollID]
				$isValidPollID = false;
				foreach($eventpolls as $poll){
					if($in_pollid == $poll['PollID']){
						$isValidPollID = true;
						break;
					}
				}
				if((!$isValidPollID)&&($in_pollid == -1)){
					$isValidPollID = true;
				}
				
				//
				//xxx Update [tlkpsetting] if $isEvent = true, else, corresponding [tmassession];
				//3. Update [tmasevent] if $isEvent=true, else, corresponding [tmassession];
				if($isValidPollID){
					//Valid [PollID]
					$updated = false;					
					if($in_isevent){
						//$updates = array('Value' => $in_pollid);
						//$updated = $this->conferenceappmin_model->updateSetting("ActivePollID", $updates);
						$updates = ($in_pollid == -1) ? array('ActivePollID' => null) : array('ActivePollID' => $in_pollid);
						$updated = $this->conferenceappmin_model->updateEvent($event['EventID'], $updates);
					}else{
						//$condition = array('PollID' => $in_pollid);
						//$poll = $this->conferenceappmin_model->getPoll($condition);
						
						//$condition = array('SessionID' => $poll['SessionID']);
						//$session = $this->conferenceappmin_model->getMySession($condition);
						
						if($in_pollid == -1){
							$updates = array('ActivePollID' => null);
						}else{
							$updates = array('ActivePollID' => $in_pollid);
						}
						$updated = $this->conferenceappmin_model->updateMySession($SessionID, $updates);
					}
					
					if($updated){
						//notify: successfully updated
						$this->setAlert("success", "check", "Success", "Successfully updated active poll.");
					}else{
						//notify: failed to update
						$this->setAlert("danger", "ban", "Error", "Failed to update the active poll.");
					}
				}else{
					//Invalid [PollID]
					//notify: failed to update
					$this->setAlert("danger", "ban", "Error", "Failed to update the active poll.");
				}
				
				if($in_isevent){
					redirect('/index.php/ControlPanel/event', 'location');
				}else{
					redirect('/index.php/ControlPanel/sessiondetails/'.$SessionID, 'location');
				}
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
			
			
		}
	}
	
	public function polldetails($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('PollID' => $id);
			$data['poll'] = $this->conferenceappmin_model->getPoll($condition);
			$data['choices'] = $this->conferenceappmin_model->getChoices($condition);
			$data['pollresponses'] = $this->conferenceappmin_model->getPollResponses($condition);
			
			$condition = array('SessionID' => $data['poll']['SessionID']);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$data['users'] = $this->conferenceappmin_model->getUsers($condition);
			
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Poll Details';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/polldetails', $data);
			$this->load->view('templates/footer', $data);
		}
	}

		public function answerdetails($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('PollID' => $id);
			$data['poll'] = $this->conferenceappmin_model->getPoll($condition);
			$data['choices'] = $this->conferenceappmin_model->getChoices($condition);
			$data['pollresponses'] = $this->conferenceappmin_model->getPollResponses($condition);
			
			$condition = array('SessionID' => $data['poll']['SessionID']);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$data['users'] = $this->conferenceappmin_model->getUsers($condition);
			
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Poll Details';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/answerdetails', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function changeanswer($PollID,$ChoiceID){
		if ($PollID!='' && $ChoiceID!='') {
			$this->conferenceappmin_model->updateAnswer($PollID,$ChoiceID);
			$this->session->set_flashdata('successanswer','Answer Changed');
			redirect('/index.php/ControlPanel/answerdetails/'.$PollID, 'location');
		}
	}


	
	public function createpoll($id = 0)
	{
		$Admin = $this->session->Admin; // can be like this => $this->session->userdata('Admin')
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('SessionID' => $id);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Create Poll';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/createpoll', $data);
			$this->load->view('templates/footer', $data);
		}
	}



	public function viewRank($sessionid = 0){
		$Admin = $this->session->Admin; // can be like this => $this->session->userdata('Admin')
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('SessionID' => $sessionid);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'ViewWinner';
			$data['showwinners'] = $this->conferenceappmin_model->showrank($sessionid);
			$sqlWinner = "CALL GetFinalRank(".$sessionid.",1000)";
			// $query    = $this->db->query($sqlWinner);
			$data['showwinner']      = $this->conferenceappmin_model->getSp($sqlWinner); 
			// $query->next_result(); 
			// $query->free_result(); 
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/viewRank', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function ViewWinner($sessionid = 0){
			$limit 						= $_POST['limit'];
			$sqlWinner 					= "CALL GetFinal(".$sessionid.",".$limit.")";
			$data['showwinners'] = $this->conferenceappmin_model->showrank($sessionid);
			$data['showwinner']      	= $this->conferenceappmin_model->getSp($sqlWinner); 
									$condition = array('SessionID' => $sessionid);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
		$this->load->view('controlpanel/ViewWinner_',$data);
	}

	public function ExportWinnerExcel($sessionid = 0){
			$sqlWinner 					= "CALL GetFinal(".$sessionid.",1000)";
			$data['showwinner']      	= $this->conferenceappmin_model->getSp($sqlWinner); 
						$condition = array('SessionID' => $sessionid);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$session = $this->conferenceappmin_model->getMySession($condition);
			echo $data['title'] = 'ReportRank_'. str_replace(' ', '_', $session['SessionName']).date('h_i_s');

			$this->load->view('controlpanel/ViewWinnerReport',$data);
	}

	
	public function post_createpoll()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//
			// 1. Get input
			$in_sessionid = $this->input->post('SessionID');
			$in_poll = $this->input->post('Poll');
			$in_choices = $this->input->post('Choices');
			
			//
			// 2. Insert `tmaspoll` record
			$inserts = array(
				'Poll'	=> $in_poll,
				'SessionID'	=> $in_sessionid
			);
			$PollID = $this->conferenceappmin_model->insertPoll($inserts);
			
			//
			// 3. Insert `tmaschoice` records
			$DisplayOrder = 1;
			foreach($in_choices as $in_choice){
				if(($in_choice != null)&&(strlen(trim($in_choice)) > 0)){
					$inserts = array(
						'PollID'		=> $PollID,
						'Choice'		=> trim($in_choice),
						'DisplayOrder'	=> $DisplayOrder++
					);
					$ChoiceID = $this->conferenceappmin_model->insertChoice($inserts);
				}
			}
			
			//
			// 4. Set alert status
			if($PollID > 0){
				//notify: successfully inserted poll and choices
				$this->setAlert("success", "check", "Success", "Successfully created new poll.");
			}else{
				//notify: failed to insert poll and choices
				$this->setAlert("danger", "ban", "Error", "Failed to create new poll.");
			}
			
			redirect('/index.php/ControlPanel/sessiondetails/'.$in_sessionid, 'location');
		}
	}

	public function deletepollresponse(){
	
	$Admin = $this->session->Admin;
	if($Admin == null){
		redirect('/index.php/ControlPanel/signin', 'location');
	}else{

	
	$check = $_POST['checked_id'];
	$UserID = array();
	$PollID = array();
	
	for ($i=0; $i <count($check) ; $i++) { 
		
		array_push($UserID, substr($check[$i], 0,4));
		
		array_push($PollID, substr($check[$i], 5,4));

	}
	
	$user = implode(",",$UserID);
	$poll = implode(",",$PollID);
	$PollID = substr($check[0], 5,4);

	
	$sql = 'delete from ttrnpollresponse where userid in('.$user.') and pollid in('.$poll.')';
	$del = $this->db->query($sql);
		if($del){
			$this->setAlert("success", "check", "Success", "Successfully deleted response.");
			redirect('/index.php/ControlPanel/polldetails/'.$PollID, 'location');
		}
			

			// redirect('/index.php/ControlPanel/polldetails/', 'location');
		}
	}

	public function eventdetails($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('SessionID' => $id);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$data['polls'] = $this->conferenceappmin_model->getPolls($condition);
			$data['questions'] = $this->conferenceappmin_model->getQuestions($condition);
			
			$condition = array('EventID' => $data['session']['EventID']);
			$data['event'] = $this->conferenceappmin_model->getEvent($condition);
			$data['users'] = $this->conferenceappmin_model->getUsers($condition);
			
			$data['header_big'] = $data['event']['EventName'];
			$data['header_small'] = $data['event']['Venue'];
			$data['title'] = 'Session Details';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/sessiondetails', $data);
			$this->load->view('templates/footer', $data);
		}

	}
	/* SESSION
pollid	==================================================================================================== */

	public function sessiondetails($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('SessionID' => $id);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$data['polls'] = $this->conferenceappmin_model->getPolls($condition);
			$data['questions'] = $this->conferenceappmin_model->getQuestions($condition);
			
			$condition = array('EventID' => $data['session']['EventID']);
			$data['event'] = $this->conferenceappmin_model->getEvent($condition);
			$data['users'] = $this->conferenceappmin_model->getUsers($condition);
			
			$data['header_big'] = $data['event']['EventName'];
			$data['header_small'] = $data['event']['Venue'];
			$data['title'] = 'Session Details';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/sessiondetails', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function questionwall($id = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			if($id == -1){

			}else{
				if($id == 0){
					//get active session id
					//$condition = array('Property' => 'ActiveEventID');
					//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
					$ActiveEventID = $this->session->ActiveEventID;
					$setting_activeeventid = $ActiveEventID;
					
					$condition = array('EventID' => $setting_activeeventid);
					$event = $this->conferenceappmin_model->getEvent($condition);

					$id =  $event['ActiveSessionID'];
					//redirect('/index.php/ControlPanel/questionwall/'.$event['ActiveSessionID'], 'location');
				}
				$condition = array('SessionID' => $id);
				$data['questions'] = $this->conferenceappmin_model->getQuestions($condition);

				if($data['questions']){
					#display only published questions
					$initialQuestionsCount = count($data['questions']);
					for($i=0; $i<$initialQuestionsCount; $i++){
						if(!($data['questions'][$i]['IsPublished'])){
							unset($data['questions'][$i]);
						}
					}

					#prepend user vote info in questions
					foreach($data['questions'] AS &$question){
						#get user post votes
						$condition = array('QuestionID'	=> $question['QuestionID']);
						$question['QuestionVotes'] = $this->conferenceappmin_model->getQuestionUserVotes($condition);
					}

					#sort votes by no. of votes DESC, then by date ASC
					function cmpdate($a, $b){
						$x = $a['Timestamp'];
						$y = $b['Timestamp'];
						if ($x == $y) {
							return 0;
						}
						return ($x < $y) ? -1 : 1;
					}
					function cmpvotes($a, $b){
						$x = count($a['QuestionVotes']);
						$y = count($b['QuestionVotes']);
						if ($x == $y) {
							return cmpdate($a, $b);
						}
						return ($x > $y) ? -1 : 1;
					}
					usort($data['questions'], "cmpvotes");
				}

				$data['sessionid'] = $id;
				$data['header_big'] = 'Question Wall';
				$data['header_small'] = '';
				$data['title'] = 'Question Wall';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/questionwall', $data);
				$this->load->view('templates/footer', $data);
			}
		}
	}
	
	public function createsession()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Create Session';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/createsession', $data);
				$this->load->view('templates/footer', $data);
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}
	
	public function post_createsession()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//
			// 1. Get input
			$in_eventid = $this->input->post('EventID');
			$in_sessionname = $this->input->post('SessionName');
			$in_description = $this->input->post('Description');
			$in_displayorder = $this->input->post('DisplayOrder');
			$in_startdatetime = $this->input->post('StartDateTime');
			$in_enddatetime = $this->input->post('EndDateTime');
			$in_venue = $this->input->post('Venue');
			
			$inserts = array(
				'SessionName' => $in_sessionname,
				'Description' => $in_description,
				'DisplayOrder' => $in_displayorder,
				'StartDateTime' => $in_startdatetime,
				'EndDateTime' => $in_enddatetime,
				'Venue' => $in_venue,
				'EventID' => $in_eventid
			);
			$inserted = $this->conferenceappmin_model->insertMySession($inserts);
			
			//
			// 3. Set alert status
			if($inserted){
				//notify: successfully inserted poll and choices
				$this->setAlert("success", "check", "Success", "Successfully created new session.");
			}else{
				//notify: failed to insert poll and choices
				$this->setAlert("danger", "ban", "Error", "Failed to create new session.");
			}
			
			redirect('/index.php/ControlPanel/event', 'location');
		}
	}
	
	public function editsession($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('SessionID' => $id);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Edit Session';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/editsession', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
	public function post_editsession()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//
			// 1. Get input
			$in_sessionid = $this->input->post('SessionID');
			$in_sessionname = $this->input->post('SessionName');
			$in_description = $this->input->post('Description');
			$in_displayorder = $this->input->post('DisplayOrder');
			$in_startdatetime = $this->input->post('StartDateTime');
			$in_enddatetime = $this->input->post('EndDateTime');
			$in_venue = $this->input->post('Venue');
			
			//
			// 2. Update `tmassession` record
			$updates = array(
				'SessionName' => $in_sessionname,
				'Description' => $in_description,
				'DisplayOrder' => $in_displayorder,
				'StartDateTime' => $in_startdatetime,
				'EndDateTime' => $in_enddatetime,
				'Venue' => $in_venue
			);
			$updated = $this->conferenceappmin_model->updateMySession($in_sessionid, $updates);
			
			
			//
			// 3. Set alert status
			if($updated){
				//notify: successfully inserted poll and choices
				$this->setAlert("success", "check", "Success", "Successfully updated session.");
			}else{
				//notify: failed to insert poll and choices
				$this->setAlert("danger", "ban", "Error", "Failed to update session.");
			}
			
			redirect('/index.php/ControlPanel/event', 'location');
		}
	}

	public function setactivesession()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				$data['sessions'] = $this->conferenceappmin_model->getMySessions($condition);
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Set Active Session';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/setactivesession', $data);
				$this->load->view('templates/footer', $data);
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}

	public function post_setactivesession($value='')
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			if($setting_activeeventid){
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);
				$sessions = $this->conferenceappmin_model->getMySessions($condition);

				//
				//1. Get user input
				$in_sessionid = $this->input->post('SelectedSessionID');

				//
				//2. Check if valid [SessionID]
				$isValidSessionID = false;
				foreach($sessions as $session){
					if($in_sessionid == $session['SessionID']){
						$isValidSessionID = true;
						break;
					}
				}
				if((!$isValidSessionID)&&($in_sessionid == -1)){
					$isValidSessionID = true;
				}

				//
				//3. Update [tmasevent]
				if($isValidSessionID){
					$updates = ($in_sessionid == -1) ? array('ActiveSessionID' => null) : array('ActiveSessionID' => $in_sessionid);
					$updated = $this->conferenceappmin_model->updateEvent($event['EventID'], $updates);

					if($updated){
						//notify: successfully updated
						$this->setAlert("success", "check", "Success", "Successfully updated active session.");
					}else{
						//notify: failed to update
						$this->setAlert("danger", "ban", "Error", "Failed to update the active session.");
					}
				}else{
					//Invalid [SessionID]
					//notify: failed to update
					$this->setAlert("danger", "ban", "Error", "Failed to update the active session.");
				}
				redirect('/index.php/ControlPanel/event', 'location');
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}
	
	public function editpoll($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('PollID' => $id);
			$data['poll'] = $this->conferenceappmin_model->getPoll($condition);
			
			$condition = array('SessionID' => $data['poll']['SessionID']);
			$event = $this->conferenceappmin_model->getMySession($condition);
			
			$data['header_big'] = $event['SessionName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Edit Poll';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/editpoll', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
	public function post_editpoll()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//

			
			// 1. Get input
			$in_pollid = $this->input->post('PollID');
			$in_poll = $this->input->post('Poll');

			$updates = array(
				'Poll' => $in_poll,
			);
			$PollID = $this->conferenceappmin_model->updatePoll($in_pollid,$updates);

		// 2. Update Choice
			$in_choices = $this->input->post('Choices');
			$ChoiceID = $_POST['ChoiceID'];
			$l_choice = count($in_choices);
			
			for ($i=0; $i <$l_choice ; $i++) { 
				$sql = "UPDATE tmaschoice SET choice ='".$in_choices[$i]."' where ChoiceID=".$ChoiceID[$i];
				$Choice = $this->db->query($sql);
			}

			// 3. Insert Choice
			// where empty($in_choices)
			$in_choice = $this->input->post('Choice');
			$DisplayOrder = $l_choice +1;
			foreach($in_choice as $in_choiced){
				if($in_choiced != null){
					$inserts = array(
						'PollID'		=> $in_pollid,
						'Choice'		=> $in_choiced,
						'DisplayOrder'	=> $DisplayOrder++
					);
					$insert = $this->conferenceappmin_model->insertChoice($inserts);
				}
			}

			if ($PollID || $Choice) {
				$this->setAlert("success", "check", "Success", "Successfully updated poll.");
			} else {
				$this->setAlert("danger", "ban", "Error", "Failed to update poll.");
			}
			
		redirect('/index.php/ControlPanel/editpoll/'.$in_pollid, 'location');
		}
	}


	public function editevent($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			$condition = array('EventID' => $id);
			$data['events'] = $this->conferenceappmin_model->getEvent($condition);
			
			$data['header_big'] = $data['events']['EventName'];
			$data['header_small'] = $data['events']['Venue'];
			$data['title'] = 'Edit Event';
			
			$this->load->view('templates/header', $data);
			$this->load->view('controlpanel/editevent', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
	public function post_editevent()
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//


			// 1. Get input
			$in_eventid = $this->input->post('EventID');
			$in_eventname = $this->input->post('EventName');
			$in_passcode = $this->input->post('Passcode');
			$in_controlpanel = $this->input->post('ControlPanelPasscode');
			$in_startdate = $this->input->post('StartDate');
			$in_enddate = $this->input->post('EndDate');
			$in_venue = $this->input->post('Venue');
			$in_welcomemessage = $this->input->post('WelcomeMessage');

			$updates = array(
				'EventName' => $in_eventname,
				'Passcode' => $in_passcode,
				'ControlPanelPasscode' => $in_controlpanel,
				'StartDate' => $in_startdate,
				'EndDate' => $in_enddate,
				'Venue' => $in_venue,
				'WelcomeMessage' => $in_welcomemessage
			);
			$qryEvent = "SELECT * FROM tmasevent WHERE EventID =".$in_eventid;
			$res = $this->db->query($qryEvent)->row();
			$qryCheckPass = "SELECT * FROM tmasevent WHERE NOT passcode ='".$res->Passcode."'";
			$rest = $this->db->query($qryCheckPass)->result_array();
			$passcode = array();
			foreach ($rest as $val) {
				array_push($passcode,$val['Passcode']);
			}


			$qryCP = "SELECT * FROM tmasevent WHERE NOT ControlPanelPasscode ='".$res->ControlPanelPasscode."'";
			$result = $this->db->query($qryCP)->result_array();
			$cp = array();
			foreach ($result as $val) {
				array_push($cp,$val['ControlPanelPasscode']);
			}
			if (in_array($in_controlpanel, $cp) || in_array($in_passcode, $passcode)) {
				$this->setAlert("danger", "ban", "Error", "Failed to update event. Passcode and control panel passcode has been set.");
				redirect('/index.php/ControlPanel/EditEvent/'.$in_eventid, 'location');
			}else{

				$this->conferenceappmin_model->updateEvent($in_eventid, $updates);
				$this->setAlert("success", "check", "Success", "Successfully updated event.");
			}

		$this->conferenceappmin_model->updateEvent($in_eventid, $updates);
		$this->setAlert("success", "check", "Success", "Successfully updated event.");
		redirect('/index.php/ControlPanel/EditEvent/'.$in_eventid, 'location');
		}
	}
	public function deletesession($SessionID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('SessionID' => $SessionID);
			$poll = $this->conferenceappmin_model->getPoll($condition);
			$session = $this->conferenceappmin_model->getMySession($condition);
			

			$condition = array('EventID' => $session['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			
			$active = $event['ActiveSessionID'];

			$condition = array('SessionID' => $session['SessionID']);
			$question = $this->conferenceappmin_model->getQuestion($condition);
			$quest = $question['QuestionID'];
			print_r($quest);

			if (!empty($active)) {
				$this->setAlert("danger", "ban", "Error", "Failed to delete session because session active.");
			}elseif (!empty($quest)) {
				$this->setAlert("danger", "ban", "Error", "Failed to delete session. Please delete the question first.");
			}elseif (!empty($poll)) {
				$this->setAlert("danger", "ban", "Error", "Failed to delete session. Please delete the poll first.");
			}else{
				$condition = array('SessionID' => $SessionID);
				$delete1 = $this->conferenceappmin_model->deleteQuestion($condition);
				if($delete1){
					
					$delete2 = $this->conferenceappmin_model->deleteMySession($condition);
					if($delete2){
						$this->setAlert("success", "check", "Success", "Successfully deleted session.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete session.");
					}
				}
			
			}

			redirect('/index.php/ControlPanel/event', 'location');
		}
	}

	public function deletefile($FileID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('FileID' => $FileID);
			$file = $this->conferenceappmin_model->getFile($condition);

			if($FileID == -1){

			}else{
				$del = $this->conferenceappmin_model->deleteFile($condition);
				// 1. Delete 
				
					if($del){
						$this->setAlert("success", "check", "Success", "Successfully deleted file.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete file.");
					}		
			}

			redirect('/index.php/ControlPanel/event', 'location');
		}
	}

	public function deleteevent($EventID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('EventID' => $EventID);
			$event = $this->conferenceappmin_model->getEvent($condition);

			if($EventID == -1){

			}else{
				$del = $this->conferenceappmin_model->deleteEvent($condition);
				// 1. Delete 
				
					if($del){
						$this->setAlert("success", "check", "Success", "Successfully deleted event.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete event.");
					}		
			}

			redirect('/index.php/ControlPanel/ListEvent', 'location');
		}
	}


	public function deletepoll($PollID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('PollID' => $PollID);
			$poll = $this->conferenceappmin_model->getPoll($condition);
			$pollresponses = $this->conferenceappmin_model->getPollResponses($condition);
			$choice = $this->conferenceappmin_model->getChoice($condition);	

			$condition = array('SessionID' => $poll['SessionID']);
			$session = $this->conferenceappmin_model->getMySession($condition);
			$sessionid = $session['SessionID'];
			$sessions = $session['ActivePollID'];
			
			if (!empty($sessions)) {
				$this->setAlert("danger", "ban", "Error", "Failed to delete poll because poll active.");
			}
			elseif (!empty($pollresponses)) {
				$this->setAlert("danger", "ban", "Error", "Failed to delete poll. Please delete the response first.");
			}else{
				$condition = array('PollID' => $PollID);
				$delete1 = $this->conferenceappmin_model->deleteChoice($condition);
				if($delete1){
					$delete2 = $this->conferenceappmin_model->deletePoll($condition);
					if($delete2){
						$this->setAlert("success", "check", "Success", "Successfully deleted poll.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete poll.");
					}
				}
			
			}

			redirect('/index.php/ControlPanel/sessiondetails/'.$sessionid, 'location');
		}
	}

	public function deletechoice($ChoiceID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('ChoiceID' => $ChoiceID);
			$choice = $this->conferenceappmin_model->getChoice($condition);
			$pollid = $choice['PollID'];
			
			if($ChoiceID == -1){

			}else{
				$del = $this->conferenceappmin_model->deleteChoice($condition);
				// 1. Delete 
				
					if($del){
						$this->setAlert("success", "check", "Success", "Successfully deleted question.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete question.");
					}		
			}

			redirect('/index.php/ControlPanel/answerdetails/'.$pollid, 'location');
		}
	}

	/* QUESTION
	==================================================================================================== */




	public function publishquestion($QuestionID = -1, $IsPublished = false)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			if($QuestionID == -1){

			}else{
				$IsPublished = ($IsPublished == "true") ? true : false;
				$updates = array('IsPublished' => $IsPublished);
				$updated = $this->conferenceappmin_model->updateQuestion($QuestionID, $updates);

				if($updated){
					if($IsPublished){
						$this->setAlert("success", "check", "Success", "Successfully published question.");
					}else{
						$this->setAlert("success", "check", "Success", "Successfully unpublished question.");
					}
				}else{
					if($IsPublished){
						$this->setAlert("danger", "ban", "Error", "Failed to publish question.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to unpublish question.");
					}
				}
			}

			$condition = array('QuestionID' => $QuestionID);
			$question = $this->conferenceappmin_model->getQuestion($condition);

			redirect('/index.php/ControlPanel/sessiondetails/'.$question['SessionID'], 'location');
		}
	}

	public function deletequestion($QuestionID = -1)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{

			$condition = array('QuestionID' => $QuestionID);
			$question = $this->conferenceappmin_model->getQuestion($condition);
			$sessionid = $question['SessionID'];
			if($QuestionID == -1){

			}else{
				$condition = array('QuestionID' => $QuestionID);

				// 1. Delete votes
				$delete1 = $this->conferenceappmin_model->deleteUserQuestionVote($condition);

				if($delete1){
					// 2. Delete question
					$delete2 = $this->conferenceappmin_model->deleteQuestion($condition);
					if($delete2){
						$this->setAlert("success", "check", "Success", "Successfully deleted question.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to delete question.");
					}
				}
			}


			redirect('/index.php/ControlPanel/sessiondetails/'.$sessionid, 'location');
		}
	}
	
	/* FILE
	==================================================================================================== */
	public function downloadfile($FileID = 0){
		
			$Admin = $this->session->Admin;
			if($Admin == null){
				redirect('/index.php/ControlPanel/signin', 'location');
			}else{
			
				$condition = array('FileID' => $FileID);
				$file = $this->conferenceappmin_model->getFile($condition);

				$IsActive = $file['IsActive'];
			
					if($IsActive==0){
						$this->setAlert("danger", "ban", "Error", "Selected file is now hidden.");
						redirect('/index.php/ControlPanel/event', 'location');
					}else{
						
						$this->load->helper('download');
						$filedir = './Files/'.$file['EventID'].'/'.$file['Filename'];
			
						force_download($filedir, NULL);
					}
			}
	}

	public function uploadfile($value='')
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			if($setting_activeeventid){
				$requestmethod = $this->input->server('REQUEST_METHOD');
				if($requestmethod == "GET")
				{
					$condition = array('EventID' => $setting_activeeventid);
					$data['event'] = $this->conferenceappmin_model->getEvent($condition);
					
					$data['header_big'] = $data['event']['EventName'];
					$data['header_small'] = $data['event']['Venue'];
					$data['title'] = 'Upload New File';
					
					$this->load->view('templates/header', $data);
					$this->load->view('controlpanel/uploadfile', $data);
					$this->load->view('templates/footer', $data);
				}
				else if($requestmethod == "POST")
				{
					// 1. Get form input
					$EventID = $this->input->post('EventID');
					$Description = $this->input->post('Description');
					//$UploadFile = $this->input->post('UploadFile');

					// 2. Check if directory exists. If not, create directory.
					$path = './Files/'.$EventID;
					if(!is_dir($path)) //create the folder if it's not already exists
					{
						mkdir($path,0755,TRUE);
					}

					// 3. Upload file in filesystem.
					$config['upload_path']		= $path;
					$config['allowed_types']	= '*';
					$config['max_size']			= 102400; //in KB (= 100MB)

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('UploadFile'))
					{
						$error = array('error' => $this->upload->display_errors());
						print_r($error);
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						print_r($data);
						$Filename = $data['upload_data']['file_name'];
						$Filetype = $data['upload_data']['file_type'];
						$Filesize = $data['upload_data']['file_size'];
						$Timestamp = date('Y-m-d H:i:s', time());

						// 4. Insert DB record
						$inserts = array(
							'Filename'		=> $Filename,
							'Description'	=> $Description,
							'Filetype'		=> $Filetype,
							'Filesize'		=> $Filesize,
							'Timestamp'		=> $Timestamp,
							'EventID'		=> $EventID,
							'IsActive'		=> false
						);

						$inserted = $this->conferenceappmin_model->insertFile($inserts);

						if($inserted){
							$this->setAlert('success', "check", 'Success', 'File successfully uploaded.');
						}else{
							$this->setAlert('danger', "ban", 'Error', 'Failed to upload file.');
						}
					}
					redirect('/index.php/ControlPanel/event', 'location');
				}
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}

	public function showfile($FileID = -1, $IsActive = false)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			if($FileID == -1){

			}else{
				$IsActive = ($IsActive == "true") ? true : false;
				$updates = array('IsActive' => $IsActive);
				$updated = $this->conferenceappmin_model->updateFile($FileID, $updates);

				if($updated){
					if($IsActive){
						$this->setAlert("danger", "ban", "Error", "Failed to hide file.");
					}else{
						$this->setAlert("danger", "ban", "Error", "Failed to show file.");
					}
					
				}else{
					if($IsActive){
						$this->setAlert("success", "check", "Success", "Selected file is now hidden.");
					}else{
						$this->setAlert("success", "check", "Success", "Selected file is now available for download.");
					}
				}
			}

			redirect('/index.php/ControlPanel/event', 'location');
		}
	}

	public function editfile($id = 0)
	{
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			if($setting_activeeventid){
				$requestmethod = $this->input->server('REQUEST_METHOD');
				if($requestmethod == "GET")
				{
					$condition = array('EventID' => $setting_activeeventid);
					$data['event'] = $this->conferenceappmin_model->getEvent($condition);

					$condition = array('FileID' => $id);
					$data['file'] = $this->conferenceappmin_model->getFile($condition);
					
					$data['header_big'] = $data['event']['EventName'];
					$data['header_small'] = $data['event']['Venue'];
					$data['title'] = 'Edit File';
					
					$this->load->view('templates/header', $data);
					$this->load->view('controlpanel/editfile', $data);
					$this->load->view('templates/footer', $data);
				}
				else if($requestmethod == "POST")
				{
					// 1. Get form input
					$FileID = $this->input->post('FileID');
					$EventID = $this->input->post('EventID');
					$Description = $this->input->post('Description');
					//$UploadFile = $this->input->post('UploadFile');

					// 2. Check if directory exists. If not, create directory.
					$path = './Files/'.$EventID;
					if(!is_dir($path)) //create the folder if it's not already exists
					{
						mkdir($path,0755,TRUE);
					}

					// 3. Upload file in filesystem.
					$config['upload_path']		= $path;
					$config['allowed_types']	= '*';
					$config['max_size']			= 102400; //in KB (= 100MB)

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('UploadFile'))
					{
						$error = array('error' => $this->upload->display_errors());
						print_r($error);
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						print_r($data);
						$Filename = $data['upload_data']['file_name'];
						$Filetype = $data['upload_data']['file_type'];
						$Filesize = $data['upload_data']['file_size'];
						$Timestamp = date('Y-m-d H:i:s', time());

						// 4. Insert DB record
						$updates = array(
							'Filename'		=> $Filename,
							'Description'	=> $Description,
							'Filetype'		=> $Filetype,
							'Filesize'		=> $Filesize,
							'Timestamp'		=> $Timestamp,
							'EventID'		=> $EventID,
							'IsActive'		=> false
						);

						$updated = $this->conferenceappmin_model->updateFile($FileID, $updates);

						if($updated){
							$this->setAlert('success', "check", 'Success', 'File successfully updated.');
						}else{
							$this->setAlert('danger', "ban", 'Error', 'Failed to update file.');
						}
					}
					redirect('/index.php/ControlPanel/event', 'location');
				}
			}else{
				redirect('/index.php/ControlPanel/signout', 'location');
			}
		}
	}

	// new update
public function Ranks(){
			$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}
			$sessionid = ($_POST["sessionId"] !="" &&  isset($_POST["sessionId"])) ? $_POST["sessionId"] : 3  ;
			$limit = $_POST["limit"];
					$condition = array('SessionID' => $sessionid);
			$data['session'] = $this->conferenceappmin_model->getMySession($condition);
			$condition = array('EventID' => $data['session']['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'ViewWinner';
			$data['showwinners'] = $this->conferenceappmin_model->showrank($sessionid);
			$sqlWinner = "CALL GetFinalRank(".$sessionid.",".$limit.")";
			// $query    = $this->db->query($sqlWinner);
			$data['showwinner'] = $this->conferenceappmin_model->getSp($sqlWinner); 
			// $query->next_result(); 
			// $query->free_result(); 
			$this->load->view('controlpanel/viewRanking', $data);
}

public function ListEvent(){
				$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}
			
				$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		$setting_activepasscode = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
			}else if($setting['Property'] == "ControlPanelPasscode"){
				$setting_controlpanelpasscode = $setting['Value'];
			}
		}
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Create Event';
				$data["event"] = $this->db->get("tmasevent")->result();
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/ListEvent', $data);
				$this->load->view('templates/footer', $data);
}

public function saveEvent(){
			$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}
	$data = array(
		'EventName' => $_POST["EventName"] ,
		'Passcode' => $_POST["Passcode"],
		'ControlPanelPasscode' => $_POST["ControlPanelPasscode"]  ,
		'StartDate' => $_POST["StartDateTime"] ,
		'EndDate' =>  $_POST["EndDateTime"] ,
		'Venue' => $_POST["Venue"] ,
		'WelcomeMessage' => $_POST["WelcomeMessage"] 
			);
		$this->db->insert('tmasevent',$data);
		$this->session->set_flashdata("successSave","Add Event Success");
		redirect('/index.php/ControlPanel/CreateEvent');
}

	public function CreateEvent(){
		$Admin = $this->session->Admin;
		if ($Admin!=null) {
			
				$settings = $this->conferenceappmin_model->getSettings();
		$setting_activeeventid = -1;
		$setting_activepasscode = "";
		foreach($settings AS $setting){
			if($setting['Property'] == "ActiveEventID"){
				$setting_activeeventid = $setting['Value'];
			}else if($setting['Property'] == "ControlPanelPasscode"){
				$setting_controlpanelpasscode = $setting['Value'];
			}
		}
				$condition = array('EventID' => $setting_activeeventid);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				
				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Create Event';
				
				$this->load->view('templates/header', $data);
				$this->load->view('controlpanel/CreateEvent', $data);
				$this->load->view('templates/footer', $data);
	}else{
		redirect('/index.php/ControlPanel/signin', 'location');
	}
}
	// new update 

	/* ALERT
	==================================================================================================== */
	
	public function setAlert($contextualclass, $favicon, $title, $message)
	{
		$this->session->set_flashdata('alert_contextualclass', $contextualclass);
		$this->session->set_flashdata('alert_favicon', $favicon);
		$this->session->set_flashdata('alert_title', $title);
		$this->session->set_flashdata('alert_message', $message);
	}
	
	public function showLoading(){
		$this->load->view('templates/loading');
	}

	public function GetRanks(){
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}
		$sessionid = $_POST['sessionId'];
		$limit = $_POST['limit'];
		$condition = array('SessionID' => $sessionid);
		$data['session'] = $this->conferenceappmin_model->getMySession($condition);
		$condition = array('EventID' => $data['session']['EventID']);
		$event = $this->conferenceappmin_model->getEvent($condition);	
		$sqlWinner = "CALL GetFinalRank(".$sessionid.",".$limit.")";
		
		$data['showwinner'] = $this->conferenceappmin_model->getSp($sqlWinner);
	
		$this->load->view('controlpanel/getRanks',$data);
		
		
		
	}

	public function GetPosition(){
		$Admin = $this->session->Admin;
		if($Admin == null){
			redirect('/index.php/ControlPanel/signin', 'location');
		}
		$sessionid = $_POST['sessionId'];
		$limit = $_POST['limit'];
		$condition = array('SessionID' => $sessionid);
		$data['session'] = $this->conferenceappmin_model->getMySession($condition);
		$condition = array('EventID' => $data['session']['EventID']);
		$event = $this->conferenceappmin_model->getEvent($condition);	
		$sqlWinner = "CALL GetFinalRank(".$sessionid.",".$limit.")";
		
		$data['showwinner'] = $this->conferenceappmin_model->getSp($sqlWinner);
	
		$this->load->view('controlpanel/getPosition',$data);
		
		
		
	}
}


?>