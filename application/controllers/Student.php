<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('studentmodel','studentmodel',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$header = "";
			$result['sectionList'] = $this->sectionmodel->getAllSectionList(); 
			$page = "dashboard/admin_dashboard/section/section_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function addstudent()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			//echo "seg:".$this->uri->segment(3);exit;
			if (empty($this->uri->segment(3)))
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$casteID = 0;
				$result['studentEditdata'] = [];
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$casteID = $this->uri->segment(3);
				$whereAry = array(
					'student_master.student_id' => $casteID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['studentEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('student_master',$whereAry); 
				
				
			}

			$result['genderList']=$this->commondatamodel->getAllDropdownData('gender_master');
			$result['bloodgroupList']=$this->commondatamodel->getAllDropdownData('blood_group');
			$result['casteList']=$this->commondatamodel->getAllDropdownData('caste_master');
			$result['religionList']=$this->commondatamodel->getAllDropdownData('religion_master');
			$result['occupationList']=$this->commondatamodel->getAllDropdownData('occupation_master');
			
			$header = "";

			$page = "dashboard/admin_dashboard/student/student_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('login','refresh');
		}
	}


} // end of class