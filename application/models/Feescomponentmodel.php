<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feescomponentmodel extends CI_Model{


	public function getAllFeescomponentList($school_id){
        $data = [];
        $where = array('fees_structure.school_id' =>$school_id);
		$query = $this->db->select("*")
				->from('fees_structure')
				->where($where)
			    ->order_by('fees_structure.id')
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