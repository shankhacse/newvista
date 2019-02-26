<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commondatamodel extends CI_Model{
	
	public function insertSingleTableData($table,$data){
            $lastinsert_id = 0;
        try {
            $this->db->trans_begin();

            $this->db->insert($table, $data);
            $lastinsert_id = $this->db->insert_id();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $lastinsert_id=0;
                return $lastinsert_id;
            } else {
                $this->db->trans_commit();
                return $lastinsert_id;
            }
        } catch (Exception $err) {
            echo $err->getTraceAsString();
        }
    }
    
    public function updateSingleTableData($table,$data,$where){

        
        try {
            $this->db->trans_begin();
            //$this->db->where($where);
			$this->db->update($table, $data,$where);
			$this->db->last_query();
			
            //$affectedRow = $this->db->affected_rows();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
                return FALSE;
            } else {
                $this->db->trans_commit();
                
                return TRUE;
            }
        } catch (Exception $exc) {
             return FALSE;
        }
    }
    
    public function deleteTableData($table,$where)
    {
        $this->db->delete($table, $where); 
    }

	/* 
		@insertMultiTableData('name of table array','insert value as array')
		@date 14.11.2017
		@By Mithilesh
	*/
	
	public function insertMultiTableData($tblnameArry,$insertArray){
		try{
            $this->db->trans_begin();
			
			for($i=0;$i<sizeof($insertArray);$i++)
			{
				 $this->db->insert($tblnameArry[$i], $insertArray[$i]);
				 
			}
			if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
		catch (Exception $err) {
            echo $err->getTraceAsString();
        }
	}
	
	
	public function checkExistanceData($table,$where)
	{
		
		$this->db->select('*')
				->from($table)
				->where($where);
		$query = $this->db->get();
	
		if($query->num_rows()>0){
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	public function getAllDropdownData($table)
	{
		$data = array();
		$this->db->select("*")
				->from($table);
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}
	
	public function getSingleRowByWhereCls($table,$where)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->limit(1);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		
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
	
	
	public function getAllRecordWhere($table,$where)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where);
		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


		
	public function getAllRecordWhereNotIn($table,$ignorarray=[])
	{  
		$data = array();
		$this->db->select("*")
				->from($table)
				->where_not_in('id',$ignorarray);
		$query = $this->db->get();
		echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	public function getAllRecordWhereOrderBy($table,$where,$orderby)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->order_by($orderby);
		$query = $this->db->get();
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	public function getAllRecordOrderByLike($table,$likecolumn,$likeStr,$orderby,$ordertag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->like($likecolumn,$likeStr,'after')
				->order_by($orderby,$ordertag);
		$query = $this->db->get();
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


	public function getAllRecordOrderByLikeWhere($table,$where,$likecolumn,$likeStr,$orderby,$ordertag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->like($likecolumn,$likeStr,'after')
				->order_by($orderby,$ordertag);
		$query = $this->db->get();
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	public function getAllRecordOrderBy($table,$orderby,$orderTag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->order_by($orderby,$orderTag);
		$query = $this->db->get();
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	/*
	@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
	*/
	public function updateData_WithUserActivity($upd_tbl_name,$upd_data,$upd_where,$user_actvty_tbl,$user_actvy_data)
	{
		 try {
            $this->db->trans_begin();
			$this->db->where($upd_where);
            $this->db->update($upd_tbl_name,$upd_data);
         //   echo $this->db->last_query();
			$this->db->insert($user_actvty_tbl, $user_actvy_data);
			
			
				
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
		catch (Exception $err) {
            echo $err->getTraceAsString();
        }
	}


	/* fetching Data For All type of document from any module
	*  @getDocumentDetailData('where upload_from_module_id,upload_from_module');
	*  On 23.01.2018
	*  By Mithilesh
	*/

	public function getDocumentDetailData($where)
	{

		$data = array();
		$this->db->select("*")
				->from('document_upload_all')
				->join('document_type','document_type.id = document_upload_all.document_type_id','INNER')
				->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }

	}


	public function rowcount($table)
	{
		
		$this->db->select('*')
				->from($table);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}
        /**
         * @author Abhik
         * @param type $table
         * @param type $column
         * @param type $dataType
         * @return boolean
         */
        
        public function duplicateValueCheck($table="",$where="")
        {
            
			$query = $this->db->select("*")->from($table)->where($where)->get();
			
            if($query->num_rows()>0){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
            
            
        }


        public function insertSingleTableDataRerurnInsertId($table,$data){
		
			$this->db->insert($table, $data);
		    $insert_ID = $this->db->insert_id();
            return $insert_ID;
		}
		
		//added by sandipan on 14.02.2019
		public function createVoucherNumber($school_id,$acd_session_id,$prefix)
		{
			$where=[
				"id"=>$acd_session_id
			];
			$year=$this->getSingleRowByWhereCls('academic_session_master',$where);
			$start_yr=substr($year->start_yr,2);
			$end_yr=substr($year->end_yr,2);
			$serial=$this->getSerialnumber($school_id,$acd_session_id);
			
			$voucher_no=$prefix."/".$serial."/".$start_yr."-".$end_yr;
			// echo $voucher_no;exit;
			return $voucher_no;
		}


		public function getSerialnumber($school_id,$acd_session_id)
		{
		   
			$lastnumber = (int)(0);
			$serialno="";
			$sql="SELECT *
				FROM voucher_srl_master
				WHERE school_id='".$school_id."'
				AND acd_session_id='$acd_session_id'
				LOCK IN SHARE MODE";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				  $row = $query->row(); 
				  $lastnumber = $row->srl_no;
			}
			$digit = (int)(log($lastnumber,10)+1) ; 
		  
		   
			if($digit==5){
				$serialno ="0".$lastnumber;
			}
			elseif($digit==4){
				  $serialno = "00".$lastnumber;
			}
			elseif($digit==3){
				$serialno = "000".$lastnumber;
			}
			elseif($digit==2){
				$serialno = "0000".$lastnumber;
			}
			elseif($digit==1){
				$serialno = "00000".$lastnumber;
			}
			$lastnumber = $lastnumber + 1;
			
			//update
			$upddata = [
				'srl_no' => $lastnumber,
			];
			$where = [
				'school_id' => $school_id,
				'acd_session_id'=>$acd_session_id
				];
			$this->db->where($where); 
			$this->db->update('voucher_srl_master', $upddata);
			return $serialno;
		}




		public function getOnlyBankAndCashAccountList($school_id)
		{
			$where=[
				"school_id"=>$school_id,
				"is_active"=>"Y"            
			];
			$where_in=array(33,34);//id-33(cash),id-34(bank)
			$data = array();
			$this->db->select("*")
					->from('account_master')
					->where($where)
					->where_in('group_id',$where_in)
					->order_by('account_name');
					
			$query = $this->db->get();
			// echo $this->db->last_query();exit;
	
			if($query->num_rows()> 0)
			{
				foreach ($query->result() as $rows)
				{
					$data[] = $rows;
				}
				// pre($data);
				return $data;
				 
			}
			else
			{
				 return $data;
			 }
		}

		public function getListOfAccountWhereAccountsAreNotInBankAndCashGroup($school_id)
		{
			$where=[
				"account_master.school_id"=>$school_id,
				"account_master.is_active"=>"Y"            
			];
			$where_in=array('Cash','Bank');
			$data = array();
			$this->db->select("*")
					->from('account_master')
					->join('group_master','account_master.group_id=group_master.id','INNER')
					->where($where)
					->where_not_in('group_master.group_description',$where_in)
					->order_by('account_master.account_name');
					
			$query = $this->db->get();	
			if($query->num_rows()> 0)
			{
				foreach ($query->result() as $rows)
				{
					$data[] = $rows;
				}
				// pre($data);
				return $data;
				 
			}
			else
			{
				 return $data;
			 }
		}


	
	
}