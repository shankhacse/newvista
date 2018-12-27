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


} // end of class