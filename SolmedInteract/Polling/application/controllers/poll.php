<?php
class Poll extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('conferenceappmin_model');
		$this->load->helper('form');
		$this->load->library('session');
	}
	
	public function activepoll()
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActivePollID');
			//$setting_activepollid = $this->conferenceappmin_model->getSetting($condition);
			
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);

			$ActiveEventID = $this->session->ActiveEventID;

			//if(($setting_activeeventid==null)||($setting_activeeventid['Value'] == -1)){
				////no active event
				//redirect('/index.php/Account/signin', 'location');
			//}else{
				//$condition = array('EventID' => $setting_activeeventid['Value']);
				$condition = array('EventID' => $ActiveEventID);
				$event = $this->conferenceappmin_model->getEvent($condition);

				if(($event['ActivePollID']==null)||($event['ActivePollID']==-1)){
					//no (event level) active poll ID
					$this->setAlert("info", "info", "Info", "There is no active poll as of the moment. Please check again soon.");
					redirect('/index.php/MySession', 'location');
				}else{
					//has (event level) active poll ID
					redirect('/index.php/Poll/index/'.$event['ActivePollID'], 'location');
				}
			//}
		}
	}


	public function index($id = 0, $isresponse = false)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			$condition = array('PollID' => $id);
			$poll = $this->conferenceappmin_model->getPoll($condition);
			$condition = array('SessionID' => $poll['SessionID']);
			$session = $this->conferenceappmin_model->getMySession($condition);
			$condition = array('EventID' => $session['EventID']);
			$event = $this->conferenceappmin_model->getEvent($condition);

			//check if user has already sent a response...
			$condition = array('UserID' => $User['UserID'], 'PollID' => $id);
			$pollresponse = $this->conferenceappmin_model->getPollResponse($condition);

			if($pollresponse == null){
				//no response yet to the poll
			}else{
				//already sent response to the poll
				//if($isresponse){
					$data['isresponse'] = true;
				//}
			}

			$data['id'] = $id;
			$data['isresponse'] = ($isresponse) ? 'true' : 'false';

			$data['header_big'] = $event['EventName'];
			$data['header_small'] = $event['Venue'];
			$data['title'] = 'Poll';
			
			$this->load->view('templates/header', $data);
			$this->load->view('poll/index', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
	public function details($id = 0, $isresponse = false, $SessionID = -1)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			$data['sessionlabel'] = 'Active Poll';
			if($SessionID != -1){
				$condition = array('SessionID' => $SessionID);
				$session = $this->conferenceappmin_model->getMySession($condition);
				$id = $session['ActivePollID'];

				$data['SessionID'] = $SessionID;
				$data['sessionlabel'] = $session['SessionName'];
			}

			$condition = array('PollID' => $id);
			$poll = $this->conferenceappmin_model->getPoll($condition);
			$choices = $this->conferenceappmin_model->getChoices($condition);

			//check if user has already sent a response...
			$condition = array('UserID' => $User['UserID'], 'PollID' => $id);
			$pollresponse = $this->conferenceappmin_model->getPollResponse($condition);

			if($pollresponse == null){
				//no response yet to the poll
				$data['poll'] = $poll;
				$data['choices'] = $choices;
			}else{
				//already sent response to the poll
				if($isresponse){
					$data['isresponse'] = true;
				}
			}
			
			$this->load->view('poll/details', $data);
		}
	}
	
	public function respond($id = 0, $SessionID = -1)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			$condition = array('ChoiceID' => $id);
			$choice = $this->conferenceappmin_model->getChoice($condition);
			
			date_default_timezone_set('Asia/Manila');
			$inserts = array(
				'UserID'	=> $User['UserID'],
				'PollID'	=> $choice['PollID'],
				'ChoiceID'	=> $id,
				'Timestamp'	=> date('Y-m-d H:i:s', time())
			);
			$inserted = $this->conferenceappmin_model->insertPollResponse($inserts);

			if($SessionID != -1){
				if($inserted){
					//successfully submitted response to active poll
					redirect('/index.php/MySession/details/'.$SessionID, 'location');
				}else{
					//failed to submit reponse to active poll
					redirect('/index.php/MySession/details/'.$SessionID, 'location');
				}
			}else{
				if($inserted){
					//successfully submitted response to active poll
					redirect('/index.php/Poll/index/'.$choice['PollID']."/true", 'location');
				}else{
					//failed to submit reponse to active poll
					redirect('/index.php/Poll/index/'.$choice['PollID'], 'location');
				}
			}
			
		}
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