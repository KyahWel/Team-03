<?php
defined('BASEPATH') || exit('No direct script access allowed');

class AdminController extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('eventsModel');
		$this->load->model('teacherModel');
		$this->load->model('courseModel');
		$this->load->model('subjectModel');
		$this->load->model('studentModel');
		$this->load->model('classModel');
		$this->load->model('sectionModel');
		$this->load->model('examModel');
		$this->load->model('applicantModel');
		$this->load->library('session');
		$this->load->model('Authentication');
		
		if ($this->session->userdata('authenticated') != '1')
		{
			if ($this->session->userdata('authenticated') == '2') {
				$this->session->set_flashdata('logoutFaculty', 'Please logout first');
				redirect('Faculty/dashboard');
			}
			elseif ($this->session->userdata('authenticated') == '3') {
				$this->session->set_flashdata('logoutStudent', 'Please logout first');
				redirect('Student/Dashboard');
			}
			elseif ($this->session->userdata('authenticated') == '4') {
				$this->session->set_flashdata('logoutApplicant', 'Please logout first');
				redirect('Applicant/'.$this->session->userdata('auth_user')['applicantID']);
			}
			else{
				$this->session->set_flashdata('invalid', 'Error: Invalid Action');
				redirect('Login/Applicant');
			}	
		}
	}

	public function admin() {
        $data['result'] = $this->AdminModel->viewData();
        $this->load->view('Admin_Panel/admin', $data);
	}

	public function admission() {
		$data['exam'] = $this->examModel->viewData();
		$data['applicant'] = $this->applicantModel->viewData();
        $this->load->view('Admin_Panel/admission', $data);
	}

	public function announcement() {
		$data['result'] = $this->eventsModel->getAllData();
        $this->load->view('Admin_Panel/announcement', $data);
	}

	public function class() {	
		$data['class'] = $this->classModel->viewClasses();
		$data['course'] = $this->courseModel->viewData();
        $this->load->view('Admin_Panel/class', $data);
	}

	public function course() {
		$data['course'] = $this->courseModel->viewData();
		$this->load->view('Admin_Panel/course', $data);
	}

	public function dashboard() {
		$data['announcement'] = $this->eventsModel->getAllData();
		$data['teacher'] = $this->teacherModel->viewData();
		$data['student'] = $this->studentModel->viewData();
		$this->load->view('Admin_Panel/dashboard', $data);
	}

	public function faculty() {
		$data['teacher'] = $this->teacherModel->viewData();
        $this->load->view('Admin_Panel/faculty', $data);
	}

	public function section()
	{	
		$data['class'] = $this->classModel->viewClasses();
		$data['student'] = $this->studentModel->viewNoSection();
		$data['course'] = $this->courseModel->viewData();
		$data['section'] = $this->sectionModel->viewData();
		$this->load->view('Admin_Panel/section',$data);
	}

	public function subject() {
		$data['subject'] = $this->subjectModel->viewData();
		$data['course'] = $this->courseModel->viewData();
        $this->load->view('Admin_Panel/subjects', $data);
	}

	public function students() {
		$data['student'] = $this->studentModel->viewData();
        $this->load->view('Admin_Panel/students', $data);
	}

	public function changePassword() {
        $this->load->view('Admin_Panel/changePassword');
	}
}