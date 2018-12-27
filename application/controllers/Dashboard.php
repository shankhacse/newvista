<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
       
    }
  public function index(){

    $session = $this->session->userdata('user_data');
    if($this->session->userdata('user_data'))
    {
      header("Access-Control-Allow-Origin: *");
      $session = $this->session->userdata('user_data');
      $page = 'dashboard/admin_dashboard/ds-home/dashboard-home';
      $result = "";
      $header = "";
 


      createbody_method($result, $page, $header, $session);
      }
    else
    {
      redirect('login','refresh');
    }
  }
}
