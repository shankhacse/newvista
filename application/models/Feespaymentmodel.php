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
									sum(fees_session.amount) as sum_amount
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


} //end of class