<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feespayment extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('Studentmodel','Studentmodel',TRUE);
		$this->load->model('feespaymentmodel','feespaymentmodel',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$header = "";
			
				
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['sectionList']=$this->commondatamodel->getAllDropdownData('section_master');
			$result['monthList']=$this->commondatamodel->getAllDropdownData('month_master');
			$page = "dashboard/admin_dashboard/fees_payment/fees_payment_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function paymentEdit()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$header = "";
			$result['mode'] = "EDIT";
			$paymentid = $this->uri->segment(3);
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['sectionList']=$this->commondatamodel->getAllDropdownData('section_master');
			$result['monthList']=$this->commondatamodel->getAllDropdownData('month_master');
			$result['studentinfo']=$this->feespaymentmodel->getStudentDetailsByPaymentId($paymentid);
			$result['fessComponentData']=$this->feespaymentmodel->getFeesComponentListbyPaymentId($paymentid);
			$result['paymentMonthList']=$this->feespaymentmodel->getPaymentMonthbyPaymentId($paymentid);

			foreach ($result['paymentMonthList'] as $key => $value) {
				$sel_month[]=$value->month_id;
			}

			foreach ($sel_month as  $value) {
            	$monthids[]=$value;
            	$where_mon_id = array('month_master.id' =>$value);
            	$monthData=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_mon_id);
            	$result['monthsname'][]=$monthData->month_code;
            }

             $result['monthids_string'] = implode(',', $monthids);
			//pre($result['monthsname']);
			$page = "dashboard/admin_dashboard/fees_payment/fees_payment_view_edit";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function payment_history()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$header = "";
			
				
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['sectionList']=$this->commondatamodel->getAllDropdownData('section_master');
			$result['monthList']=$this->commondatamodel->getAllDropdownData('month_master');
			$page = "dashboard/admin_dashboard/fees_payment/payment_history_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('login','refresh');
		}
	}



	/* get  district by state*/
public function getStudent()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$classid = $this->input->post('acdm_class');
			$acdm_section = $this->input->post('acdm_section');

			/*$where_dist = array('district.state_id' => $stateid, ); 
			$result['districtList']=$this->commondatamodel->getAllRecordWhere('district',$where_dist);*/

			if ($classid!='0' && $acdm_section!='0') {
				
			$result['studentList']=$this->Studentmodel->getStudentListbyClassSection($classid,$acdm_section);
			}elseif($classid!='0'){
			$result['studentList']=$this->Studentmodel->getStudentListbyClass($classid);
			}
			else{
			$result['studentList']=[];	
			}


			/*pre($result['studentList']);

			exit;*/
			 

			$page = "dashboard/admin_dashboard/fees_payment/student_view";
			//$partial_view = $this->load->view($page,$result);
			echo $this->load->view($page, $result, TRUE);
			//echo $partial_view;
		}
		else
		{
			redirect('login','refresh');
		}
	}



	public function getPaymentComponentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

		    $result['mode'] = "ADD";
		    $result['btnText'] = "Save";
			
            $studentid = $dataArry['studentid'];
            $result['studentid']=$studentid;
            $sel_month = $dataArry['sel_month'];
            $session['school_id'];
            $session['acd_session_id'];


            foreach ($sel_month as  $value) {
            	$monthids[]=$value;
            	$where_mon_id = array('month_master.id' =>$value);
            	$monthData=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_mon_id);
            	$result['monthsname'][]=$monthData->month_code;
            }

             $result['monthids_string'] = implode(',', $monthids);
            //$destination_array = explode(',', $string_version);
            //print_r($destination_array);
            $result['studentData']=$this->Studentmodel->getStudentDataEditbyId($studentid,$session['acd_session_id']);
          
          	$classid=$result['studentData']->class_id;
          	

          	$result['fessComponentData']=$this->feespaymentmodel->getFeesComponentListbyClass($classid,$monthids);


			//pre($result['fessComponentData']);
			$page = "dashboard/admin_dashboard/fees_payment/fees_payment_compnent_view.php";
			$partial_view = $this->load->view($page, $result, TRUE);
			echo $partial_view;
		}
		else
		{
			redirect('login','refresh');
		}
	}

/* get component list for edit*/

public function getPaymentComponentListPaymentEdit()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

		    $result['mode'] = "EDIT";
		    $result['btnText'] = "Update";
			
            $studentid = $dataArry['studentid'];
            $result['paymentID'] = $dataArry['paymentID'];
           
            $result['studentid']=$studentid;
            $sel_month = $dataArry['sel_month'];
            $session['school_id'];
            $session['acd_session_id'];


            foreach ($sel_month as  $value) {
            	$monthids[]=$value;
            	$where_mon_id = array('month_master.id' =>$value);
            	$monthData=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_mon_id);
            	$result['monthsname'][]=$monthData->month_code;
            }

             $result['monthids_string'] = implode(',', $monthids);
            //$destination_array = explode(',', $string_version);
            //print_r($destination_array);
            $result['studentData']=$this->Studentmodel->getStudentDataEditbyId($studentid,$session['acd_session_id']);
          
          	$classid=$result['studentData']->class_id;
          	

          	$result['fessComponentData']=$this->feespaymentmodel->getFeesComponentListbyClass($classid,$monthids);


			//pre($result['fessComponentData']);
			$page = "dashboard/admin_dashboard/fees_payment/fees_payment_compnent_view.php";
			$partial_view = $this->load->view($page, $result, TRUE);
			echo $partial_view;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	/* payment details save and edit */

	public function payment_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$paymentID = $this->input->post('paymentID');
			$mode = $this->input->post('mode');
			$studentid = $this->input->post('studentid');
			$monthids = $this->input->post('monthids');
			$payment_mode = $this->input->post('payment_mode');
			$payment_date = $this->input->post('payment_date');

			$monthids_array = explode(',', $monthids);

			 if($payment_date!=""){
				$payment_date = str_replace('/', '-', $payment_date);
				$payment_date = date("Y-m-d",strtotime($payment_date));
			 }
			 else{
				 $payment_date = NULL;
		    }
			$total_pay_amount = $this->input->post('total_pay_amount');

			
			$result['studentData']=$this->Studentmodel->getStudentDataEditbyId($studentid,$session['acd_session_id']);
          
          	$classid=$result['studentData']->class_id;
          	$academic_dtl_id=$result['studentData']->academic_dtl_id;
			
	
			
			


			if($studentid!="")
			{
	
				
				
				if($paymentID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$payment_master_id=$paymentID;
					$payment_mst_array_upd = array(
						"payment_date" => $payment_date,
						"payment_mode" => $payment_mode,
						"total_amount" => $total_pay_amount,
						"last_modified" => date('Y-m-d')
					);

					$where_upd_payment_mst = array(
						"payment_master.payment_id" => $paymentID
					);

					$user_activity = array(
						"activity_module" => 'caste',
						"action" => 'Update',
						"from_method" => 'caste/caste_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('payment_master',$payment_mst_array_upd,$where_upd_payment_mst,'activity_log',$user_activity);

					$where_payment_mon_dtl = array('payment_month_dtl.payment_master_id' =>$paymentID);
					$delete1 = $this->commondatamodel->deleteTableData('payment_month_dtl',$where_payment_mon_dtl);

					$where_payment_details = array('payment_details.payment_master_id' =>$paymentID);
					$delete1 = $this->commondatamodel->deleteTableData('payment_details',$where_payment_details);

					/* start month loop*/
					foreach ($monthids_array as $key => $value) {
						$monthid=$value;
						$fessComponentListData=$this->feespaymentmodel->getFeesComponentListbyClassMonth($classid,$value);
						$fessComsumData=$this->feespaymentmodel->getFeesComponentListSumbyClassMonth($classid,$value);
						$total_amount_monthly=$fessComsumData->sum_amount;

						//pre($fessComponentListData);

						$payment_month_dtl_array = array(
							'payment_master_id' => $payment_master_id, 
							'month_id' => $monthid, 
							'amount' => $total_amount_monthly, 
						    'created_by' => $session['userid']
						);

						$month_dtl_insertId = $this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_month_dtl',$payment_month_dtl_array);

							foreach ($fessComponentListData as $fesscomlistdata) {

								$payment_details_array = array(
										'payment_master_id' => $payment_master_id, 
										'month_id' => $monthid, 
										'payment_month_dtl_id' => $month_dtl_insertId, 
										'fees_component_id' => $fesscomlistdata->fees_comp_id, 
										'amount' => $fesscomlistdata->amount, 
										'created_by' => $session['userid']
										 );

								$user_activity = array(
								"activity_module" => 'Feespayment',
								"action" => 'Insert',
								"from_method" => 'Feespayment/payment_action',
								"user_id" => $session['userid'],
								"ip_address" => getUserIPAddress(),
								"user_browser" => getUserBrowserName(),
								"user_platform" => getUserPlatform()
								
							 );

						$tbl_name = array('payment_details','activity_log');
						$insert_array = array($payment_details_array,$user_activity);
						$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

							}


						
					} /* end of month loop*/
					
					
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

            

					$array_payment_master = array(
						"academic_dtl_id" => $academic_dtl_id,
						"class_id" => $classid,
						"school_id" => $session['school_id'],
						"acdm_session_id" => $session['acd_session_id'],
						"student_id" => $studentid,
						"payment_date" => $payment_date,
						"payment_mode" => $payment_mode,
						"total_amount" => $total_pay_amount,
						"created_by" => $session['userid']
					);
					
					$payment_master_id = $this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_master',$array_payment_master);

					/* start month loop*/
					foreach ($monthids_array as $key => $value) {
						$monthid=$value;
						$fessComponentListData=$this->feespaymentmodel->getFeesComponentListbyClassMonth($classid,$value);
						$fessComsumData=$this->feespaymentmodel->getFeesComponentListSumbyClassMonth($classid,$value);
						$total_amount_monthly=$fessComsumData->sum_amount;

						//pre($fessComponentListData);

						$payment_month_dtl_array = array(
							'payment_master_id' => $payment_master_id, 
							'month_id' => $monthid, 
							'amount' => $total_amount_monthly, 
						    'created_by' => $session['userid']
						);

						$month_dtl_insertId = $this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_month_dtl',$payment_month_dtl_array);

							foreach ($fessComponentListData as $fesscomlistdata) {

								$payment_details_array = array(
										'payment_master_id' => $payment_master_id, 
										'month_id' => $monthid, 
										'payment_month_dtl_id' => $month_dtl_insertId, 
										'fees_component_id' => $fesscomlistdata->fees_comp_id, 
										'amount' => $fesscomlistdata->amount, 
										'created_by' => $session['userid']
										 );

								$user_activity = array(
								"activity_module" => 'caste',
								"action" => 'Insert',
								"from_method" => 'caste/caste_action',
								"user_id" => $session['userid'],
								"ip_address" => getUserIPAddress(),
								"user_browser" => getUserBrowserName(),
								"user_platform" => getUserPlatform()
								
							 );

						$tbl_name = array('payment_details','activity_log');
						$insert_array = array($payment_details_array,$user_activity);
						$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

							}


						
					} /* end of month loop*/
					
	
					

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


/* payment list details*/


public function getPaymentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			 $from_date = $dataArry['from_date'];
			 $to_date = $dataArry['to_date'];
			 $acdm_class = $dataArry['acdm_class'];
			 if ($acdm_class=='') {
			 	$acdm_class=0;
			 }
			 $acdm_section = $dataArry['acdm_section'];
			 $studentid = $dataArry['studentid'];

			 	 if($from_date!=""){
				$from_date = str_replace('/', '-', $from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				 }
				 else{
					 $from_date = NULL;
			    }

			    if($to_date!=""){
				$to_date = str_replace('/', '-', $to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				 }
				 else{
					 $to_date = NULL;
			    }

			   $result['from_date']=$from_date;
			   $result['to_date']=$to_date;
			   $result['acdm_class']=$acdm_class;
			   $result['acdm_section']=$acdm_section;
			   $result['studentid']=$studentid;
//exit;
			$page = "dashboard/admin_dashboard/fees_payment/payment_history_partial_view.php";
			$partial_view = $this->load->view($page, $result, TRUE);
			echo $partial_view;
		}
		else
		{
			redirect('login','refresh');
		}
	}


public function updatePaymentMaster(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$paymentID = trim($this->input->post('paymentID'));
			$mode = trim($this->input->post('mode'));
			$payment_mode = trim($this->input->post('payment_mode'));
			$payment_date = trim($this->input->post('payment_date'));

			 if($payment_date!=""){
				$payment_date = str_replace('/', '-', $payment_date);
				$payment_date = date("Y-m-d",strtotime($payment_date));
			 }
			 else{
				 $payment_date = NULL;
		    }
			
			$update_array  = array(
				"payment_date" => $payment_date,
				"payment_mode" => $payment_mode
				);
				
			$where = array(
				"payment_master.payment_id" => $paymentID
				);
			
			
				$user_activity = array(
								"activity_module" => 'Feespayment',
								"action" => 'Insert',
								"from_method" => 'Feespayment/payment_action',
								"user_id" => $session['userid'],
								"ip_address" => getUserIPAddress(),
								"user_browser" => getUserBrowserName(),
								"user_platform" => getUserPlatform()
								
							 );
				$update = $this->commondatamodel->updateData_WithUserActivity('payment_master',$update_array,$where,'activity_log',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
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

}//end of class