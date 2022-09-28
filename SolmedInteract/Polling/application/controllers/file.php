<?php
class File extends CI_Controller {

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
		}
			//$condition = array('Property' => 'ActiveEventID');
			//$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);
			$ActiveEventID = $this->session->ActiveEventID;

			//if(($setting_activeeventid==null)||($setting_activeeventid['Value'] == -1)){
				////no active event
				//redirect('/index.php/Account/signin', 'location');
			//}else{
				$condition = array('EventID' => $ActiveEventID);
				$data['event'] = $this->conferenceappmin_model->getEvent($condition);
				$data['files'] = $this->conferenceappmin_model->getFiles($condition);

				if(count($data['files']) == 0){
					$this->setAlert("info", "info", "Info", "There are no files available for download as of the moment. Please check again soon.");
					redirect('/index.php/MySession', 'location');
				}

				$data['header_big'] = $data['event']['EventName'];
				$data['header_small'] = $data['event']['Venue'];
				$data['title'] = 'Download';
				
				$this->load->view('templates/header', $data);
				$this->load->view('file/index', $data);
				$this->load->view('templates/footer', $data);
			//}
	}

	public function download($id)
	{
		$User = $this->session->User;
		if($User == null){
			redirect('/index.php/Account/signin', 'location');
		}else{
			$condition = array('Property' => 'ActiveEventID');
			$setting_activeeventid = $this->conferenceappmin_model->getSetting($condition);

			$condition = array('FileID' => $id);
			$file = $this->conferenceappmin_model->getFile($condition);

			//insert log
			date_default_timezone_set('Asia/Manila');
			$inserts = array(
				'UserID'		=> $User['UserID'],
				'EventID'		=> $setting_activeeventid['Value'],
				'Action'		=> 'Download file',
				'Description'	=> 'Downloaded file "'.$file['Filename'].'" (FileID = '.$file['FileID'].').',
				'Timestamp'		=> date('Y-m-d H:i:s', time())
			);

			$logid = $this->conferenceappmin_model->insertLog($inserts);

			$this->load->helper('download');
			$filedir = './Files/'.$file['EventID'].'/'.$file['Filename'];
			force_download($filedir, NULL);
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