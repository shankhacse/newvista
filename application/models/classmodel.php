<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class classmodel extends CI_Model{


	public function getAllClassList(){
		$data = [];
		$query = $this->db->select("*")
				->from('class_master')
			    ->order_by('class_master.classname')
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