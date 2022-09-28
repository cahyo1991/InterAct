<?php
class MySession extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('conferenceappmin_model');
		$this->load->helper('form');
		$this->load->library('session');
	}
	
	public function index()
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			if(($setting_activeeventid==null)||($setting_activeeventid==-1)){
				//no active event
			}else{
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);

				//has active poll?
				if(($event['ActivePollID']==null)||($event['ActivePollID']==-1)){
				}else{
					//redirect('/index.php/Poll/details/'.$setting_activepollid['Value'], 'location');
					$data['activepollexists'] = true;
				}

				//has active session?
				if(($event['ActiveSessionID']==null)||($event['ActiveSessionID']==-1)){
				}else{
					$data['activesessionexists'] = true;
				}

				//$condition = array('Property' => 'ActiveEventID');
				//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
				//$condition = array('EventID' => $setting_activeeventid['Value']);
				//$event = $this->conferenceappmin_model->getEvent($condition);
				
				$data['event'] = $event;
				$data['sessions'] = $this->conferenceappmin_model->getMySessions($condition);

				$data['header_big'] = $event['EventName'];
				$data['header_small'] = $event['Venue'];
				$data['title'] = 'Sessions';
				
				$this->load->view('templates/header', $data);
				$this->load->view('session/index', $data);
				$this->load->view('templates/footer', $data);
			}
		}
	}

	public function SessionDetail($id=0)
	{
					$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			$condition = array('EventID' => $setting_activeeventid);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$sessions = $this->conferenceappmin_model->getMySessions($condition);
			
			$isSessionIDFound = false;
			foreach($sessions as $session){
				if($id==$session['SessionID']){
					$isSessionIDFound = true;
					break;
				}
			}
			
			if($isSessionIDFound){
				//$id (SessionID) found
				$condition = array('SessionID' => $id);
				$session = $this->conferenceappmin_model->getMySession($condition);
				
				//if(($session['ActivePollID']==null)||($session['ActivePollID']==-1)){
					$data['header_big'] = $event['EventName'];
					$data['header_small'] = $event['Venue'];
					$data['title'] = 'Session';
					
					$data['session'] = $session;
					
					$this->load->view('templates/header', $data);
					$this->load->view('session/SessionDetail', $data);
					$this->load->view('templates/footer', $data);
				//}else{
				//	redirect('/index.php/Poll/details/'.$session['ActivePollID'], 'location');
				//}
			}else{
				//$id (SessionID) not found
				redirect('/index.php/MySession', 'location');
			}
		}
	}
	
	public function details($id = 0)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			$condition = array('EventID' => $setting_activeeventid);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$sessions = $this->conferenceappmin_model->getMySessions($condition);
			
			$isSessionIDFound = false;
			foreach($sessions as $session){
				if($id==$session['SessionID']){
					$isSessionIDFound = true;
					break;
				}
			}
			
			if($isSessionIDFound){
				//$id (SessionID) found
				$condition = array('SessionID' => $id);
				$session = $this->conferenceappmin_model->getMySession($condition);
				
				//if(($session['ActivePollID']==null)||($session['ActivePollID']==-1)){
					$data['header_big'] = $event['EventName'];
					$data['header_small'] = $event['Venue'];
					$data['title'] = 'Session';
					
					$data['session'] = $session;
					
					$this->load->view('templates/header', $data);
					$this->load->view('session/details', $data);
					$this->load->view('templates/footer', $data);
				//}else{
				//	redirect('/index.php/Poll/details/'.$session['ActivePollID'], 'location');
				//}
			}else{
				//$id (SessionID) not found
				redirect('/index.php/MySession', 'location');
			}
		}
	}
	
	public function detailask($id = 0)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;
			
			$condition = array('EventID' => $setting_activeeventid);
			$event = $this->conferenceappmin_model->getEvent($condition);
			$sessions = $this->conferenceappmin_model->getMySessions($condition);
			
			$isSessionIDFound = false;
			foreach($sessions as $session){
				if($id==$session['SessionID']){
					$isSessionIDFound = true;
					break;
				}
			}
			
			if($isSessionIDFound){
				//$id (SessionID) found
				$condition = array('SessionID' => $id);
				$session = $this->conferenceappmin_model->getMySession($condition);
				
				//if(($session['ActivePollID']==null)||($session['ActivePollID']==-1)){
					$data['header_big'] = $event['EventName'];
					$data['header_small'] = $event['Venue'];
					$data['title'] = 'Session';
					
					$data['session'] = $session;
					
					$this->load->view('templates/header', $data);
					$this->load->view('session/detailask', $data);
					$this->load->view('templates/footer', $data);
				//}else{
				//	redirect('/index.php/Poll/details/'.$session['ActivePollID'], 'location');
				//}
			}else{
				//$id (SessionID) not found
				redirect('/index.php/MySession', 'location');
			}
		}
	}
}
?>