<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountsmodel extends CI_Model 
{
    public function getAllGroupList(){
		$data = [];
		$query = $this->db->select("*")
				->from('group_master')
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			// print_r($data);exit;
	        return $data;
	       
		
	}
}
