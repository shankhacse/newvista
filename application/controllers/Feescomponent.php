<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feescomponent extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('feescomponentmodel','feescommodel',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
            $header = "";
            
			$result['feescomponentList'] = $this->feescommodel->getAllFeescomponentList($session['school_id']); 
			$page = "dashboard/admin_dashboard/fees_component/fees_component_list_view.php";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('login','refresh');
		}
    }


    public function addFeesComponent()
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
				$feesComID = 0;
				$result['feesComponentEditdata'] = [];
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$feesComID = $this->uri->segment(3);
				$whereAry = array(
					'fees_structure.id' => $feesComID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['feesComponentEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('fees_structure',$whereAry); 

				
				
			}
			$where_ac_master = array('account_master.school_id' => $session['school_id']);
			$result['accountList']=$this->commondatamodel->getAllRecordWhere('account_master',$where_ac_master);
			$header = "";

			$page = "dashboard/admin_dashboard/fees_component/fees_component_add_edit_view.php";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('login','refresh');
		}
	}
	
	
	public function feesComponent_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$feesComID = trim(htmlspecialchars($dataArry['feesComID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
		
			$fees_desc = trim(htmlspecialchars($dataArry['fees_desc']));
			$acconut = trim(htmlspecialchars($dataArry['acconut']));
			if ($acconut=='') {
				$acconut=NULL;
			}

			if($fees_desc!="")
			{
	
				
				
				if($feesComID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"fees_desc" => $fees_desc,
						"account_id" => $acconut,
						"school_id" => $session['school_id'],
						"last_modified" => date('y-m-d')
					);

					$where_upd = array(
						"fees_structure.id" => $feesComID
					);

					$user_activity = array(
						"activity_module" => 'feescomponent',
						"action" => 'Update',
						"from_method" => 'feescomponent/feesComponent_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('fees_structure',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
					if($update)
					{
						$json_response = array(
							"msg_status" => HTTP_SUCCESS,
							"msg_data" => "Updated successfully",
							"mode" => "EDIT"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => HTTP_FAIL,
							"msg_data" => "There is some problem while updating ...Please try again."
						);
					}



				} // end if mode
				else
				{
					/*  ADD MODE
					 *	-----------------
					*/


					$array_insert = array(
						"fees_desc" => $fees_desc,
						"account_id" => $acconut,
						"school_id" => $session['school_id'],
						"created_by" => $session['userid']
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'feescomponent',
						"action" => 'Insert',
						"from_method" => 'feescomponent/feesComponent_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('fees_structure','activity_log');
					$insert_array = array($array_insert,$user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

					if($insertData)
					{
						$json_response = array(
							"msg_status" => HTTP_SUCCESS,
							"msg_data" => "Saved successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => HTTP_FAIL,
							"msg_data" => "There is some problem.Try again"
						);
					}

				} // end add mode ELSE PART




				

			}
			else
			{
				$json_response = array(
						"msg_status" =>0,
						"msg_data" => "All fields are required"
					);
			}

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('login','refresh');
		}
	}

} // end of class