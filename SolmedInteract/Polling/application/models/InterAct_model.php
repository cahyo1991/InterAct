<?php

class InterAct_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function GET_SessionPoll($data = array('SessionID' => -1))
	{
		$query1 = $this->db->get_where('tmassession', $data);
		$session = $query1->row_array();
		


		if($session != null) {
			$query2 = $this->db->get_where('tmaspoll', array('PollID' => $session['ActivePollID']));
			return $query2->row_array();
		}
		else {
			return null;
		}
	}
	
	/* tmaspoll
	================================================== */
	public function getPoll($data = array('PollID' => -1))
	{
		$query = $this->db->get_where('tlkpsetting', array('Property' => 'ActiveEventID'));
		$Setting = $query->row_array();

		$query = $this->db->get_where('tmasevent', array('EventID' => $Setting['Value']));
		$Poll = $query->row_array();

		$data = array('PollID' => $Poll['ActivePollID']);

		$query = $this->db->get_where('tmaspoll', $data);
		return $query->row_array();
	}
	// public function getPoll($data = array('PollID' => -1))
	// {
		// $query = $this->db->get_where('tlkpsetting', array('Property' => 'ActiveEventID'));
		// $Setting = $query->row_array();

		// $query = $this->db->get_where('tmasevent', array('EventID' => $Setting['Value']));
		// $Poll = $query->row_array();

		// $data = array('PollID' => $Poll['ActivePollID']);

		// $query = $this->db->get_where('tmaspoll', $data);
		// return $query->row_array();
	// }
	
	public function getChoices($data = array('PollID' => -1))
	{
		$query = $this->db->get_where('tmaschoice', $data);
			
		return $query->result_array();
	}
	
	public function getPollResponse($data = array('PollID' => -1))
	{
		$query = $this->db->get_where('ttrnpollresponse', $data);

		return $query->result_array();
	}

	public function getPollResponse1($data = array('PollID' => -1))
	{
		$query = $this->db->get_where('ttrnpollresponse', $data);

		return $query->result_array();
	}
}

?>