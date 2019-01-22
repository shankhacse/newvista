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
            $header = "";
            $result['module'] = "Group";
            $result['groupList']=$this->accountsmodel->getAllGroupList();
            // print_r($result);exit;   
			$page = "dashboard/admin_dashboard/accounts/group_list";
			createbody_method($result, $page, $header, $session);
            
        }else{
            redirect('login','refresh');
        }
    }
    public function group()
    {
        $session=$this->session->userdata('user_data');
        if($this->session->userdata('user_data'))
		{
            // echo "ID-".$this->uri->segment(3);exit;
            if (empty($this->uri->segment(3)))
			{
               
                $result['module'] = "Group";		
                $result['mode'] = "ADD";		
                $result['btnText'] = "Submit";
                $result['btnTextLoader'] = "Saving...";
                $result['editgroup']=[];
                	
            }else{
                $result['module'] = "Group";	
                $result['mode'] = "EDIT";	
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $group_id = $this->uri->segment(3);
				$whereAry = array(
					'id' => $group_id
                );
                $result['editgroup'] = $this->commondatamodel->getSingleRowByWhereCls('group_master',$whereAry); 
            }	
            $header = "";
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
            //  print_r($this->input->post());exit;
            $group_description=$this->input->post("group_description");
            $main_category=$this->input->post("main_category");
            $sub_category=$this->input->post("sub_category");
            $mode=$this->input->post("mode"); 
            if($this->input->post("is_active")=="Y" && $this->input->post("is_active")!="")
                {
                    $is_active="Y";
                }else{
                    $is_active="N";
                } 
            $insert_arr['is_active']=$is_active ;                      
            $table="group_master";
            $insert_arr['group_description']=$group_description ;
            $insert_arr['main_category']=$main_category ;
            $insert_arr['sub_category']=$sub_category ; 
            $insert_arr['is_special']="Y" ;    
            if ($mode=="ADD") {   
                $insert=$this->commondatamodel->insertSingleTableData($table,$insert_arr);
            }else{
                $id=$this->input->post("id");
                // $insert_arr['is_special']=$this->input->post("is_special");
                $whereAry = array(
					'id' => $id
                );                
                $insert=$this->commondatamodel->updateSingleTableData($table,$insert_arr,$whereAry);
            }
           
            if($insert)
            {
                $json_response = array(
                    "msg_status" => HTTP_SUCCESS,
                    "msg_data" => "Saved successfully",
                    "mode" => "ADD"
                );
            }else{
                $json_response = array(
                    "msg_status" => HTTP_FAIL,
                    "msg_data" => "There is some problem.Try again"
                );
            }
            header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
        }else{
            redirect('login','refresh');
        }
        
        
        
    }
}