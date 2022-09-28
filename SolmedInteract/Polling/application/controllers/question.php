<?php
class Question extends CI_Controller {

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

			if(($setting_activeeventid == null)||($setting_activeeventid == -1)){
				//no active event
				redirect('/index.php/Account/signin', 'location');
			}else{
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);

				if(($event['ActiveSessionID'] == null)||($event['ActiveSessionID'] == -1)){
					//no active session
					//$this->setAlert("info", "info", "Info", "There are no active sessions as of the moment. Please check again soon.");
					$this->setAlert("info", "info", "Info", "There is no active session as of the moment. Please check again soon.");
					redirect('/index.php/MySession', 'location');
				}else{
					$condition = array('SessionID' => $event['ActiveSessionID']);
					$data['activesession'] = $this->conferenceappmin_model->getMySession($condition);
				}

				$data['header_big'] = $event['EventName'];
				$data['header_small'] = $event['Venue'];
				$data['title'] = 'Ask';
				
				$this->load->view('templates/header', $data);
				$this->load->view('question/index', $data);
				$this->load->view('templates/footer', $data);
			}
		}
	}

	public function listing($id = -1)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			if((($setting_activeeventid == null)||($setting_activeeventid == -1))&&($id != -1)){
				//no active event AND $id != -1
			}else{
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);

				if((($event['ActiveSessionID'] == null)||($event['ActiveSessionID'] == -1))&&($id == -1)){
					//no active session AND $id == -1
				}else{
					//$condition = array('SessionID' => $event['ActiveSessionID'], 'IsPublished' => true);
					$condition = ($id != -1) ? array('SessionID' => $id) : array('SessionID' => $event['ActiveSessionID']);
					$data['questions'] = $this->conferenceappmin_model->getQuestions($condition);

					if($data['questions']){
						#display only published questions and questions posted by the current user
						$initialQuestionsCount = count($data['questions']);
						for($i=0; $i<$initialQuestionsCount; $i++){
							if((!($data['questions'][$i]['IsPublished']))&&($data['questions'][$i]['UserID'] != $User['UserID'])){
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
						#Sort questions according to number of votes, then by date
						usort($data['questions'], "cmpvotes");
						function cmpdate_reverse($a, $b){
							$x = $a['Timestamp'];
							$y = $b['Timestamp'];
							if ($x == $y) {
								return 0;
							}
							return ($x < $y) ? 1 : -1;
						}
						#Sort questions according to timestamp only
						//usort($data['questions'], "cmpdate_reverse");
					}
				}

				$condition = array('UserID' => $User['UserID']);
				$data['userquestionvotes'] = $this->conferenceappmin_model->getUserQuestionVotes($condition);

				/*
				echo 'id = ('.$id.')<br /><br />';
				echo 'x = ('.$event['ActiveSessionID'].')<br /><br />';
				print_r($data['questions']);
				*/
				
				$data['sessionid'] = $id;

				$this->load->view('question/listing', $data);
			}
		}
	}

	public function togglevote($id = -1, $sessionid = -1)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			if($id == -1){
				redirect('/index.php/Question', 'location');
			}else{
				$condition = array('UserID' => $User['UserID'], 'QuestionID' => $id);
				$userquestionvote = $this->conferenceappmin_model->getUserQuestionVote($condition);

				if($userquestionvote){
					//unvote
					$deleted = $this->conferenceappmin_model->deleteUserQuestionVote($condition);

					if($deleted){
					}else{
						$this->setAlert("danger", "ban", "Error", "Unable to unvote the selected question.");
					}
				}else{
					//vote
					$inserted = $this->conferenceappmin_model->insertUserQuestionVote($condition);

					if($inserted){
					}else{
						$this->setAlert("danger", "ban", "Error", "Unable to cast vote for the selected question.");
					}
				}

				if($sessionid == -1){
					redirect('/index.php/Question', 'location');
				}else{
					redirect('/index.php/MySession/details/'.$sessionid, 'location');
				}
				
			}
		}
	}

	public function post_submitquestion()
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			//
			//1. Get user input
			$in_question = $this->input->post('Question');
			$in_postasanonymous = $this->input->post('PostAsAnonymous');

			//
			//2. Get active session
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;
			$setting_activeeventid = $ActiveEventID;

			if(($setting_activeeventid == null)||($setting_activeeventid == -1)){
				//no active event
				$in_sessionid = $this->input->post('SessionID');
				if($in_sessionid){
					//insert question
					date_default_timezone_set('Asia/Manila');
					$inserts = array(
						'Question'		=> $in_question,
						'Timestamp'		=> date('Y-m-d H:i:s', time()),
						'IsPublished'	=> false,
						'IsAnonymous'	=> ($in_postasanonymous) ? true : false,
						'UserID'		=> $User['UserID'],
						'SessionID'		=> $in_sessionid
					);

					$questionid = $this->conferenceappmin_model->insertQuestion($inserts);

					if($questionid){
						$inserts = array('UserID' => $User['UserID'], 'QuestionID' => $questionid);
						$inserted = $this->conferenceappmin_model->insertUserQuestionVote($inserts);

						if($inserted){
							$this->setAlert("success", "check", "Success", "Your question is being published...");
				
						}
					}
					redirect('/index.php/MySession/detailask/'.$in_sessionid, 'location');
				}else{
					$this->setAlert("danger", "ban", "Error", "Failed to submit question. Invalid session.");
					redirect('/index.php/Question', 'location');
				}
			}else{
				$condition = array('EventID' => $setting_activeeventid);
				$event = $this->conferenceappmin_model->getEvent($condition);

				$in_sessionid = $this->input->post('SessionID');

				//if(($event['ActiveSessionID'] == null)||($event['ActiveSessionID'] == -1)){
				if($in_sessionid == -1){
					//no active session
					$this->setAlert("danger", "ban", "Error", "Failed to submit question. There are no active sessions set yet.");
					redirect('/index.php/Question', 'location');
				}else{
					//insert question
					date_default_timezone_set('Asia/Manila');
					$inserts = array(
						'Question'		=> $in_question,
						'Timestamp'		=> date('Y-m-d H:i:s', time()),
						'IsPublished'	=> false,
						'IsAnonymous'	=> ($in_postasanonymous) ? true : false,
						'UserID'		=> $User['UserID'],
						//'SessionID'		=> $event['ActiveSessionID']
						'SessionID'		=> $in_sessionid
					);

					$questionid = $this->conferenceappmin_model->insertQuestion($inserts);

					if($questionid){
						$inserts = array('UserID' => $User['UserID'], 'QuestionID' => $questionid);
						$inserted = $this->conferenceappmin_model->insertUserQuestionVote($inserts);

						if($inserted){
							$this->setAlert("success", "check", "Success", "Your question is being published...");
						}

					}
					//redirect('/index.php/Question', 'location');
					redirect('/index.php/MySession/detailask/'.$in_sessionid, 'location');
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