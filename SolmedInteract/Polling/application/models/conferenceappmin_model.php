<?php

class Conferenceappmin_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function GetDetailUser($id='')
	{
		$qry = $this->db->get_where('tmasuser',array('UserID'=>$id))->row_array();
		return $qry;
	}
	
	/* tlkpsetting
	==================================================================================================== */
	public function getSetting($data = array('Property' => ""))
	{
		if($data['Property'] == ""){
			return null;
		}else{
			$query = $this->db->get_where('tlkpsetting', $data);
			return $query->row_array();
		}
	}

	public function updateAnswer($PollID,$ChoiceID){
		$sql = "UPDATE tmaspoll SET ChoiceID=".$ChoiceID." WHERE PollID =".$PollID;
		return $this->db->query($sql);
	}
	
	public function getSettings()
	{
		$query = $this->db->get_where('tlkpsetting');
		return $query->result_array();
	}

	public function getSp($sqlSp){
			$query    					= $this->db->query($sqlSp);
			$res   				      	= $query->result_array(); 
			$query->next_result(); 
			$query->free_result();
			return $res;

	}
	
	public function updateSetting($Property = "", $data = array('Value' => ""))
	{
		if($Property == ""){
			return false;
		}else{
			$this->db->where('Property', $Property);
			$this->db->update('tlkpsetting', $data);
			return true;
		}
	}
	
	/* tlkpspecialty
	==================================================================================================== */
	public function getSpecialty($data = array('SpecialtyID' => -1))
	{
		if($data['SpecialtyID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tlkpspecialty', $data);
			return $query->row_array();
		}
	}
	
	public function getSpecialties()
	{
		$query = $this->db->order_by('Specialty')->get('tlkpspecialty');
		return $query->result_array();
	}
	
	/* tmaschoice
	==================================================================================================== */
	public function getChoice($data = array('ChoiceID' => -1))
	{
		if($data['ChoiceID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmaschoice', $data);
			return $query->row_array();
		}
	}
	
	public function getChoices($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			return null;
		}else{
			$query = $this->db->order_by("DisplayOrder", "asc")->get_where('tmaschoice', $data);
			return $query->result_array();
		}
	}
	
	public function insertChoice($data = array('PollID' => -1, 'Choice' => ""))
	{
		if(($data['PollID'] == -1)||($data['Choice'] == "")){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('tmaschoice', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	public function updateChoice($PollID = -1, $data = array('Choice' => ""))
	{
		if($PollID	 == -1){
			return false;
		}else{
			$this->db->where('PollID', $PollID);
			$this->db->update('tmaschoice', $data);
			return true;
		}
	}
	
	public function deleteChoice($data = array('ChoiceID' => -1))
	{
		if($data['ChoiceID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmaschoice', $data);
			return true; #delete successful
		}
	}
	
	/* tmasevent
	==================================================================================================== */
	public function getEvent($data = array('EventID' => -1))
	{
		//if(!(isset($data['EventID']))||($data['EventID'] == -1)){
		if($data['EventID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmasevent', $data);
			return $query->row_array();
		}
	}
	
	public function getEvents()
	{
		$query = $this->db->get('tmasevent');
		return $query->result_array();
	}
	
	public function insertEvent($data = array('EventID' => -1))
	{
		if($data['EventID'] == -1){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('tmasevent', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	public function updateEvent($EventID = -1, $data = array('EventName' => ""))
	{
		if($EventID == -1){
			return false;
		}else{
			$this->db->where('EventID', $EventID);
			$this->db->update('tmasevent', $data);
			return true;
		}
	}
	
	public function deleteEvent($data = array('EventID' => -1))
	{
		if($data['EventID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmasevent', $data);
			return true; #delete successful
		}
	}

	/* tmasfile
	==================================================================================================== */
	public function getFile($data = array('FileID' => -1))
	{
		$query = $this->db->get_where('tmasfile', $data);
		return $query->row_array();
	}

	public function getFiles($data = array('EventID' => -1))
	{
		if($data['EventID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmasfile', $data);
			return $query->result_array();
		}
	}

	public function insertFile($data = array('EventID' => -1, 'Filename' => ''))
	{
		if(($data['EventID'] == -1)||($data['Filename'] == ''))
		{
			return false; #insert failed
		}
		else
		{
			$this->db->insert('tmasfile', $data);
			return true; #insert successful
		}
	}

	public function updateFile($FileID = -1, $data = array('IsActive' => false))
	{
		if($FileID == -1){
			return false;
		}else{
			$this->db->where('FileID', $FileID);
			$this->db->update('tmasfile', $data);
			return true;
		}
	}

	public function deleteFile($data = array('FileID' => -1))
	{
		if($data['FileID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmasfile', $data);
			return true; #delete successful
		}
	}
	
	/* tmaspoll
	==================================================================================================== */
	public function getPoll($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmaspoll', $data);
			return $query->row_array();
		}
	}
	
	public function getPolls($data = array('SessionID' => -1))
	{
		if($data['SessionID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmaspoll', $data);
			return $query->result_array();
		}
	}
	
	public function insertPoll($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('tmaspoll', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	public function updatePoll($PollID = -1, $data = array('EventName' => ""))
	{
		if($PollID == -1){
			return false;
		}else{
			$this->db->where('PollID', $PollID);
			$this->db->update('tmaspoll', $data);
			return true;
		}
	}

	public function updatePollObj($PollID = -1, $data = array('Poll' => ""))
	{
		if($PollID == -1){
			return false;
		}else{
			$this->db->where('PollID', $PollID);
			$this->db->update('tmaspoll', $data);
			return true;
		}
	}
	
	public function deletePoll($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmaspoll', $data);
			return true; #delete successful
		}
	}
	
	/* tmassession
	==================================================================================================== */
	public function getMySession($data = array('SessionID' => -1))
	{
		if($data['SessionID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmassession', $data);
			return $query->row_array();
		}
	}
	
	public function getMySessions($data = array('EventID' => -1))
	{
		if($data['EventID'] == -1){
			return null;
		}else{
			$query = $this->db->order_by("DisplayOrder", "asc")->get_where('tmassession', $data);
			return $query->result_array();
		}
	}
	
	public function insertMySession($data = array('SessionID' => -1))
	{
		if($data['SessionID'] == -1){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('tmassession', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	public function updateMySession($SessionID = -1, $data = array('SessionName' => ""))
	{
		if($SessionID == -1){
			return false;
		}else{
			$this->db->where('SessionID', $SessionID);
			$this->db->update('tmassession', $data);
			return true;
		}
	}
	
	public function deleteMySession($data = array('SessionID' => -1))
	{
		if($data['SessionID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmassession', $data);
			return true; #delete successful
		}
	}
	
	/* tmasuser
	==================================================================================================== */
	public function getUser($data = array('UserID' => -1))
	{
		//if($data['UserID'] == -1){
		//	return null;
		//}else{
			$query = $this->db->get_where('tmasuser', $data);
			return $query->row_array();
		//}
	}
	
	public function getUsers($data = array('EventID' => -1))
	{
		if($data['EventID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('tmasuser', $data);
			return $query->result_array();
		}
	}
	
	public function insertUser($data = array('UserID' => -1))
	{
		if($data['UserID'] == -1){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('tmasuser', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	public function updateUser($UserID = -1, $data = array('Password' => ""))
	{
		if($UserID == -1){
			return false;
		}else{
			$this->db->where('UserID', $UserID);
			$this->db->update('tmasuser', $data);
			return true;
		}
	}
	
	public function deleteUser($data = array('UserID' => -1))
	{
		if($data['UserID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('tmasuser', $data);
			return true; #delete successful
		}
	}

	/* treluserquestionvote
	==================================================================================================== */
	public function getUserQuestionVote($data = array('UserID' => -1, 'QuestionID' => -1))
	{
		if(($data['UserID'] == -1)||($data['QuestionID'] == -1)){
			return null;
		}else{
			$query = $this->db->get_where('treluserquestionvote', $data);
			return $query->row_array();
		}
	}

	public function getUserQuestionVotes($data = array('UserID' => -1))
	{
		if($data['UserID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('treluserquestionvote', $data);
			return $query->result_array();
		}
	}

	public function getQuestionUserVotes($data = array('QuestionID' => -1))
	{
		if($data['QuestionID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('treluserquestionvote', $data);
			return $query->result_array();
		}
	}

	public function insertUserQuestionVote($data = array('UserID' => -1, 'QuestionID' => -1))
	{
		if(($data['UserID'] == -1)||($data['QuestionID'] == -1)){
			return false; #insert failed
		}else{
			$this->db->insert('treluserquestionvote', $data);
			return true; #insert successful
		}
	}

	public function deleteUserQuestionVote($data = array('UserID' => -1, 'QuestionID' => -1))
	{
		if(($data['UserID'] == -1)||($data['QuestionID'] == -1)){
			return false; #delete failed
		}else{
			$this->db->delete('treluserquestionvote', $data);
			return true; #delete successful
		}
	}

	/* ttrnlog
	==================================================================================================== */

	public function insertLog($data = array('Action' => ""))
	{
		if($data['Action'] == ""){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('ttrnlog', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}
	
	/* ttrnpollresponse
	==================================================================================================== */
	public function getPollResponse($data = array('UserID' => -1, 'PollID' => -1))
	{
		if(($data['UserID'] == -1)||($data['PollID'] == -1)){
			return null;
		}else{
			$query = $this->db->get_where('ttrnpollresponse', $data);
			return $query->row_array();
		}
	}
	
	public function getPollResponses($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			return null;
		}else{
			$query = $this->db->order_by('Timestamp', 'ASC')->get_where('ttrnpollresponse', $data);
			return $query->result_array();
		}
	}
	
	public function insertPollResponse($data = array('UserID' => -1, 'PollID' => -1, 'ChoiceID' => -1))
	{
		if(($data['UserID'] == -1)||($data['PollID'] == -1)||($data['ChoiceID'] == -1)){
			return false; #insert failed
			//return -1;
		}else{

$cek = $this->db->get_where('ttrnpollresponse',array('UserID'=>$data['UserID'], 'PollID' => $data['PollID'] , 'ChoiceID' => $data['ChoiceID'] ))->num_rows();
		if ($cek > 0) {
			return true;
		}else{
			$this->db->insert('ttrnpollresponse', $data);
			return true;
		}


			// try{
			// 	$this->db->insert('ttrnpollresponse', $data);
			// 
			// }catch(Exception $e){
			// 	return true;
			// }
			 #insert successful
			//return $this->db->insert_id();
		}
	}
	
	public function updatePollResponse($UserID = -1, $PollID = -1, $data = array('ChoiceID' => -1))
	{
		if(($data['UserID'] == -1)||($data['PollID'] == -1)){
			return false;
		}else{
			$condition = array('UserID' => $UserID, 'PollID' => $PollID);
			$this->db->where($condition);
			$this->db->update('ttrnpollresponse', $data);
			return true;
		}
	}
	
	public function deletePollResponse($data = array('PollID' => -1))
	{
		if($data['PollID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('ttrnpollresponse', $data);
			return true; #delete successful
		}
	}
	
	/* ttrnquestion
	==================================================================================================== */
	public function getQuestion($data = array('QuestionID' => -1))
	{
		if($data['QuestionID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('ttrnquestion', $data);
			return $query->row_array();
		}
	}

	public function getQuestions($data = array('SessionID' => -1))
	{
		if($data['SessionID'] == -1){
			return null;
		}else{
			$query = $this->db->get_where('ttrnquestion', $data);
			return $query->result_array();
		}
	}

	public function insertQuestion($data = array('Question' => ""))
	{
		if($data['Question'] == ""){
			//return false; #insert failed
			return -1;
		}else{
			$this->db->insert('ttrnquestion', $data);
			//return true; #insert successful
			return $this->db->insert_id();
		}
	}

	public function updateQuestion($QuestionID = -1, $data = array('IsPublished' => false))
	{
		if($QuestionID == -1){
			return false;
		}else{
			$this->db->where('QuestionID', $QuestionID);
			$this->db->update('ttrnquestion', $data);
			return true;
		}
	}

	public function deleteQuestion($data = array('QuestionID' => -1))
	{
		if($data['QuestionID'] == -1){
			return false; #delete failed
		}else{
			$this->db->delete('ttrnquestion', $data);
			return true; #delete successful
		}
	}


	//showrank 
	public function showrank($SessionID=0){
		$sql = "select pr.UserID,u.Username,pr.PollID,pr.ChoiceID,pr.TImestamp,p.ChoiceID as CorrectAnswer,
case when pr.ChoiceID = p.ChoiceID then 1 else 0 end as Status,p.SessionID from ttrnpollresponse
pr left join tmaspoll p on pr.PollID = p.PollID
left join tmasuser u on pr.UserID = u.UserID
where p.SessionID = ".$SessionID."
order by status desc,Timestamp asc";
    	$qry = $this->db->query($sql);
    	return $qry->result_array();
	}
}
?>