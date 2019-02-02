<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('dashboardmodel','dashboardmodel',TRUE);
       
    }
  public function index(){

    $session = $this->session->userdata('user_data');
    if($this->session->userdata('user_data'))
    {
      header("Access-Control-Allow-Origin: *");
      $session = $this->session->userdata('user_data');
      $where=[
        "is_active"=>'1'
      ];
      $result['activeStdentCount']=$this->dashboardmodel->rowcountWithWhere('student_master',$where);
      $page = 'dashboard/admin_dashboard/ds-home/dashboard-home';
 
      $header = "";
 


      createbody_method($result, $page, $header, $session);
      }
    else
    {
      redirect('login','refresh');
    }
  }
  
  public function groupByList()
  {
    $session = $this->session->userdata('user_data');
    if($this->session->userdata('user_data'))
    {
      header("Access-Control-Allow-Origin: *");
      $view=$this->input->post("viewname");
      if($view=="Studentlist")
      {
        $data['Studentlist']=$this->dashboardmodel->getStudentListGroupByClassName($session['school_id'],$session['acd_session_id']);
       
      }
      $this->load->view('dashboard/admin_dashboard/ds-home/list_partial_view', $data); 
    }else{
      redirect('login','refresh');
    }
  }




}/* end of class */
