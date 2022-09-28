<?php
class PollChart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PollChart_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->load->library('session');
	}

	public function result($sid = null)
	{
		// $this->session->set_userdata('sid', $sid);
		
		$data = array('sid' => $sid);

		$this->load->view('pollchart/result', $data);
	}
	
	public function GET_Poll($sid = null)
	{
		// $parameter = array('SessionID' => $this->session->userdata('sid'));
		
		$parameter = array('SessionID' => $sid);
		$result = $this->PollChart_model->GET_SessionPoll($parameter);
		
		if($result != null) {
			echo json_encode($result);
		}
		else {
			echo json_encode(null);
		}
		
	}

	public function GET_Choices($pid = null)
	{
		$choices = array();
		
		//$parameter = array('PollID' => $this->session->userdata('PollID'));
		$parameter = array('PollID' => $pid);
		
		// echo json_encode($pid);
		if($pid != null) {
						
			$pollchoices = $this->PollChart_model->getChoices($parameter);
			// $pollresponse = $this->PollChart_model->getPollResponse($parameter);
			// $specialties = array_unique(array_map(function($field) {
					// return $field['Group'];
				// }, $pollresponse));

			foreach($pollchoices as $choice){
				$choices[] = $choice['Choice'];
			}
			
			echo json_encode($choices);
		}
		else
		{
			echo json_encode(null);
		}
	}
	
	public function GET_Result($pid = null, $mode = true)
	{
		$specialties = array();
		$choices = array();
		$responses = array();
		$choice_values = array();
		
		$parameter = array('PollID' => $pid);
		
		$pollchoices = $this->PollChart_model->getChoices($parameter);
		$pollresponse = $this->PollChart_model->getPollResponse1($parameter);

		if($pollresponse != null) {
		
			$sum = 0;
			foreach($pollchoices as $choice){

				$choices[] = $choice['Choice'];

				$results_choice = $this->find_items($pollresponse, 'Choice', $choice['Choice']);

				if(count($results_choice) > 0)
					{
						// $choice_values[] = (int)array_column($results_choice,'Count')[0];
						// $sum += (int)array_column($results_choice,'Count')[0];
						
						$ctr = (int)current(array_column($results_choice,'Count'));
						
						$choice_values[] = $ctr;
						$sum += $ctr;
					}
					else
					{
						$choice_values[] = 0;
					}
			}
			
			$responses[] = array(
						'name' => 'User Response',
						'data' => $choice_values
						);

			foreach ($responses as &$value) {
				foreach ($value['data'] as &$v) {
					$roundval = round((($v / $sum) * 100.00), 2);
					if($roundval == 0)
					{
						$v = null;
					}
					else
					{
						$v = $roundval;
					}
				}
			}

			unset($value);
			unset($v);
		
		}
		
		echo json_encode($responses);
	}

	public function find_items($array, $findwhat, $value, $found = array()){
		foreach($array as $k=>$v){
				if(is_array($v)){
				 	$result = $this->find_items($v,$findwhat,$value,$found);
					if($result === true){
						$found[] = $v; 	
					}else{
						$found = $result;
					}
				}else{
					if($k==$findwhat && $v==$value){
						return TRUE;
					}
				}
		}
		return $found;
	}
}
?>