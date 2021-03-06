<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class classModel extends CI_Model {

	public function __construct(){	
		$this->load->database();
	}

	public function checkExist(){
		$this->db->select('*');
		$this->db->from('class');
		$this->db->where('class_code',$_POST['classcode']);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return NULL;
		}
		else{
			return 0;
		}
	}

	public function insertData($subjectID,$timeFrom,$timeTo,$day,$room)
	{	
			$data = array(
				'classID' => NULL,
				'class_code' => $_POST['classcode'],
				'teacherID' => NULL,
				'subjectID' => $subjectID,
				'start_time' => $timeFrom,
				'end_time' => $timeTo,
				'day' => $day,
				'room_no' => $room,
				'courseID' => $_POST['courseID'],
				'yearlevelClass' => $_POST['yearlevel'],
				'isTaken' => 0,
				'statusClass' => 1
			);
			$this->db->insert('class',$data);
		
	}

	public function viewClasses()
	{
		$query = $this->db->query('	SELECT * FROM class 
									LEFT JOIN subjects_table 
									ON class.subjectID = subjects_table.subjectID 
									LEFT JOIN course_table 
									ON subjects_table.courseID = course_table.courseID 
									GROUP BY class.class_code');
		return $query->result();
	}

	public function ClassList($courseID, $yearlevel){
		$query = $this->db->query('	SELECT * FROM class 	
									WHERE courseID = '.$courseID.' AND yearlevelClass ='.$yearlevel.' GROUP BY class_code');
		return $query->result();
	}
	

	public function getData($classcode)
	{	
		$this->db->select('*');
		$this->db->from('class');
		$this->db->where('class_code',$classcode);
		$data=$this->db->get();
		$prof = $data->row();
		if($prof->teacherID==NULL){
			$query = $this->db->query('	SELECT * FROM class 
										JOIN subjects_table 
										ON class.subjectID = subjects_table.subjectID 
										JOIN course_table 
										ON subjects_table.courseID = course_table.courseID 
										WHERE class.class_code = "'.$classcode.'"');
		}
		else{
			$query = $this->db->query('	SELECT * FROM class 
										JOIN subjects_table 
										ON class.subjectID = subjects_table.subjectID 
										JOIN teacher_accounts 
										ON class.teacherID = teacher_accounts.teacherID 
										JOIN course_table 
										ON subjects_table.courseID = course_table.courseID
										WHERE class.class_code = "'.$classcode.'"');
		}
		return $query->result_array();
	}


	public function updateData($subjectID,$timeFrom,$timeTo,$day,$room,$profID,$classcode)
	{	
			$data = array(
				'teacherID' => $profID,
				'start_time' => $timeFrom,
				'end_time' => $timeTo,
				'day' => $day,
				'room_no' => $room,
			);
			$this->db->where('class_code',$classcode);
			$this->db->where('subjectID',$subjectID);
			$this->db->update('class',$data);
			
			$data = array(
				'teacherID' => $profID,
			);
			$this->db->where('class_code',$classcode);
			$this->db->where('subjectID',$subjectID);
			$this->db->update('student_grades',$data);
			
	}

	public function deactivateData($classcode){
		$data = array(
			'statusClass' => 0
		);
		$this->db->where('class_code',$classcode);
		$this->db->update('class',$data);
	}

	public function reactivateData($classcode){
		$data = array(
			'statusClass' => 1
		);
		$this->db->where('class_code',$classcode);
		$this->db->update('class',$data);
	}

}