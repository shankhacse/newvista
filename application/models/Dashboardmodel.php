<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboardmodel extends CI_Model{
    public function rowcountWithWhere($table,$where)
    {
            
        $this->db->select('*')
                ->from($table)
                ->join('academic_details','student_master.student_id=academic_details.student_id')
                ->where($where);

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


    public function getStudentListGroupByClassName($school_id,$acd_session_id)
    {
        $where=[ 
            "academic_details.acdm_session_id"=>$acd_session_id,
            "academic_details.school_id"=>$school_id,  
            "student_master.is_active"=>'1'
        ];
        $data = [];
            $query = $this->db->select("student_master.*,academic_details.*,class_master.classname,section_master.section")
                    ->from('academic_details')
                    ->join('student_master','academic_details.student_id=student_master.student_id','INNER')
                    ->join('class_master','academic_details.class_id=class_master.id','LEFT')
                    ->join('section_master','academic_details.section_id=section_master.id','LEFT')
                    ->where($where)
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

    




}/* end of class */