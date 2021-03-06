<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contramodel extends CI_Model{
    
    public function getAccountList($school_id)
	{
        $where=[
            "school_id"=>$school_id,
            "is_active"=>"Y"            
        ];
        $where_in=array(33,34);
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

    public function getAllContraVoucherList($school_id,$acd_session_id,$accnt_year_id)
    {
        $where=[
            "school_id"=>$school_id,
            "acdm_session_id"=>$acd_session_id,
            "accnt_year_id"=>$accnt_year_id,
            "transaction_type"=>'CN'
        ];
        $data = array();
        $query=$this->db->select('*')
                    ->from('voucher_master')
                    ->where($where)
                    ->order_by('id')
                    ->get();
        if($query->num_rows()> 0)
        {
            foreach ($query->result() as $rows)
			{
				$data[]=array(
                    "id"=>$rows->id,
                    "voucher_ac_detail"=>$this->getVoucherDetailById($rows->id),
                    "voucher_number"=>$rows->voucher_number,
                    "voucher_date"=>$rows->voucher_date,
                    "narration"=>$rows->narration,
                    "cheque_number"=>$rows->cheque_number,
                    "cheque_date"=>$rows->cheque_date,
                    "chq_clear_on"=>$rows->chq_clear_on,
                    "is_chq_clear"=>$rows->is_chq_clear,
                    "transaction_type"=>$rows->transaction_type,
                    "created_by"=>$rows->created_by,
                    "school_id"=>$rows->school_id,
                    "acdm_session_id"=>$rows->acdm_session_id,
                    "accnt_year_id"=>$rows->accnt_year_id,
                    "serial_number"=>$rows->serial_number,
                    "vouchertype"=>$rows->vouchertype,
                    "paid_to"=>$rows->paid_to,
                    "total_debit"=>$rows->total_debit,					
                    "total_credit"=>$rows->total_credit
                );
            }
            return $data;
        }else{
            return $data;
        }
    }

    public function getVoucherDetailById($id)
	{
        $where=[
            "voucher_detail.voucher_master_id="=>$id
        ];
		$data = array();
		$this->db->select("voucher_detail.*,account_master.* ")
                ->from('voucher_detail')
                ->join('account_master','voucher_detail.account_master_id=account_master.account_id','LEFT')
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
    


    



} //end of class