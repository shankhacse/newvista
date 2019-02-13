<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feespaymentmodel extends CI_Model{

/* component list by class and multiple month*/
	public function getFeesComponentListbyClass($classid,$monthids){
		$where = array(
						'fees_session.class_id' =>$classid
					);

		$data = [];
		$query = $this->db->select("
									fees_structure.fees_desc,
									SUM(fees_session.amount) AS sum_amount
				")
				->from('fees_session')
				->join('fees_structure','fees_structure.id = fees_session.fees_id','INNER')
				->join('fees_strucrure_month_dtl','fees_strucrure_month_dtl.fees_structure_id = fees_structure.id','INNER')
				->where($where)
				->where_in('fees_strucrure_month_dtl.month_id',$monthids)
				->group_by('fees_structure.fees_desc')
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}


/* component list by class and single month*/

	public function getFeesComponentListbyClassMonth($classid,$monthid){
		$where = array(
						'fees_session.class_id' =>$classid,
						'fees_strucrure_month_dtl.month_id' =>$monthid
					);

		$data = [];
		$query = $this->db->select("
									fees_structure.fees_desc,
									fees_session.amount,
									fees_structure.id as fees_comp_id
				")
				->from('fees_session')
				->join('fees_structure','fees_structure.id = fees_session.fees_id','INNER')
				->join('fees_strucrure_month_dtl','fees_strucrure_month_dtl.fees_structure_id = fees_structure.id','INNER')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}


	/* component list sum amount by class and single month*/

	public function getFeesComponentListSumbyClassMonth($classid,$monthid){
		$where = array(
						'fees_session.class_id' =>$classid,
						'fees_strucrure_month_dtl.month_id' =>$monthid
					);

		$data = [];
		$query = $this->db->select("
									fees_structure.fees_desc,
									sum(fees_session.amount) as sum_amount,
									fees_session.id
				")
				->from('fees_session')
				->join('fees_structure','fees_structure.id = fees_session.fees_id','INNER')
				->join('fees_strucrure_month_dtl','fees_strucrure_month_dtl.fees_structure_id = fees_structure.id','INNER')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	           $row = $query->row();
	           return $data = $row;
	             
	        }
			else
			{
	            return $data;
	        }
	       
		
	}



	/*student details by payment id*/

	public function getStudentDetailsByPaymentId($paymentid){
		$session = $this->session->userdata('user_data');
		$where = array(
						'payment_master.payment_id' =>$paymentid,
						'payment_master.acdm_session_id' =>$session['acd_session_id']
						
					);

		$data = [];
		$query = $this->db->select("payment_master.payment_id,
									payment_master.student_id,
									class_master.classname,
									academic_details.rollno,
									section_master.section,
									student_master.name AS student_name,
									payment_master.payment_date,
									payment_master.payment_mode")
				->from('payment_master')
				->join('class_master','class_master.id = payment_master.class_id','INNER')
				->join('academic_details','academic_details.id = payment_master.academic_dtl_id','INNER')
				->join('section_master','section_master.id = academic_details.section_id','INNER')
				->join('student_master','student_master.student_id = payment_master.student_id','INNER')
				
				->where($where)
				->limit(1)
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	           $row = $query->row();
	           return $data = $row;
	             
	        }
			else
			{
	            return $data;
	        }
	       
		
	}


	/* get payment component list details for edit*/

	public function getFeesComponentListbyPaymentId($paymentid){
		$where = array(
						'payment_master.payment_id' =>$paymentid
						
					);

		$data = [];
		$query = $this->db->select("
									fees_structure.fees_desc,
									SUM(payment_details.amount) AS sum_amount
				")
				->from('payment_master')
				->join('payment_details','payment_details.payment_master_id=payment_master.payment_id','INNER')
				->join('fees_structure','fees_structure.id=payment_details.fees_component_id','INNER')
				->group_by('fees_structure.fees_desc')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}


		/* get payment month details by payment id for edit*/

	public function getPaymentMonthbyPaymentId($paymentid){
		$where = array(
						'payment_master.payment_id' =>$paymentid
						
					);

		$data = [];
		$query = $this->db->select("
									payment_month_dtl.month_id
				")
				->from('payment_master')
				->join('payment_month_dtl','payment_month_dtl.payment_master_id=payment_master.payment_id','INNER')
				
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}

} //end of class