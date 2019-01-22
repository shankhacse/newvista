<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('accountsmodel','accountsmodel',TRUE);
		$this->load->model('commondatamodel','commondatamodel',TRUE);
    }

    public function index()
    {
        $session=$this->session->userdata('user_data');
        if($this->session->userdata('user_data'))
		{
        //echo "hii";
            
        }else{
            redirect('login','refresh');
        }
    }
    public function group()
    {
        $session=$this->session->userdata('user_data');
        if($this->session->userdata('user_data'))
		{
            $header = "";
			$result['module'] = "Group";		
			$page = "dashboard/admin_dashboard/accounts/group";
			createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}

    }
    public function GroupInsert()
    {
        $session=$this->session->userdata('user_data');
        if($this->session->userdata('user_data'))
		{
            // print_r($this->input->post());exit;
            $group_description=$this->input->post("group_description");
            $main_category=$this->input->post("main_category");
            $sub_category=$this->input->post("sub_category");
            if($this->input->post("is_active")=="Y" && $this->input->post("is_active")!="")
            {
                $is_active="Y";
            }else{
                $is_active="N";
            }            
            $table="group_master";
            $insert_arr['group_description']=$group_description ;
            $insert_arr['main_category']=$main_category ;
            $insert_arr['sub_category']=$sub_category ;
            $insert_arr['is_active']=$is_active ;
            $insert=$this->commondatamodel->insertSingleTableData($table,$insert_arr);
            if($insert)
            {
                $result['msg'] = '<div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Group Added Successfully</div>';
            }else{
                $result['msg'] = '<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There is some problem.Try again</div>';
            }
            $result['module'] = "Group";
            $header = "";					
			$page = "dashboard/admin_dashboard/accounts/group";
			createbody_method($result, $page, $header, $session);
        }else{
            redirect('login','refresh');
        }
        
        
        
    }
}