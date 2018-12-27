<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class studentmodel extends CI_Model{


	public function getAllStudentList(){
		$data = [];
		$query = $this->db->select("*")
				->from('student_master')
			    ->order_by('student_master.name')
				->get();
			
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