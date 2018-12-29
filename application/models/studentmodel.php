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

		public function getStudentbyStudentId($student_id){
		$data = [];
		$where = array('student_master.student_id' =>$student_id);
		$query = $this->db->select("student_master.*,
									academic_details.rollno,
									class_master.classname,
									section_master.section

			")
				->from('student_master')
				->join('academic_details','academic_details.student_id = student_master.student_id','INNER')
				->join('class_master','class_master.id = academic_details.class_id','INNER')
				->join('section_master','section_master.id = academic_details.section_id','INNER')
				->where($where)
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

	public function getStudentListbyClassSection($sel_class,$sel_section){
		$data = [];
		$where = array(
						'academic_details.class_id' =>$sel_class,
						'academic_details.section_id' =>$sel_section
					);
		$query = $this->db->select("student_master.*,
									academic_details.rollno,
									class_master.classname,
									section_master.section

			")
				->from('student_master')
				->join('academic_details','academic_details.student_id = student_master.student_id','INNER')
				->join('class_master','class_master.id = academic_details.class_id','INNER')
				->join('section_master','section_master.id = academic_details.section_id','INNER')
				->where($where)
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

		public function getStudentListbyClass($sel_class){
		$data = [];
		$where = array(
						'academic_details.class_id' =>$sel_class
					);
		$query = $this->db->select("student_master.*,
									academic_details.rollno,
									class_master.classname,
									section_master.section

			")
				->from('student_master')
				->join('academic_details','academic_details.student_id = student_master.student_id','INNER')
				->join('class_master','class_master.id = academic_details.class_id','INNER')
				->join('section_master','section_master.id = academic_details.section_id','INNER')
				->where($where)
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


		public function inserIntoStudent($data,$sesion_data)
	{
		try
		{
        	$this->db->trans_begin();
			$insert_student_data = array();
			$insert_user_activity = array();
			$is_file_uploaded = "N";
			if(isset($data['docFile']['fileName']))
			{
				if(sizeof($data['docFile']['fileName']['name'])>0)
				{
					$is_file_uploaded = "Y";
				}
				else
				{
					$is_file_uploaded = "N";
				}
			}
            

			

			$insert_student_data = array(
				'reg_no' => $data['reg_no'],   
				'form_sl_no' => $data['form_sl_no'], 
				'admission_dt' => $data['admission_dt'], 
				'dob' => $data['dob'], 
				'name' => $data['name'], 
				'gender_id' => $data['gender_id'], 
				'blood_gr_id' => $data['blood_gr_id'], 
				'caste_id' => $data['caste_id'], 
				'religion_id' => $data['religion_id'], 
				'father_name' => $data['father_name'], 
				'father_contact_no' => $data['father_contact_no'], 
				'father_occupation_id' => $data['father_occupation_id'], 
				'fathers_income' => $data['fathers_income'], 
				'mother_name' => $data['mother_name'], 
				'mother_contact_no' => $data['mother_contact_no'], 
				'mother_occupation_id' => $data['mother_occupation_id'], 
				'mother_income' => $data['mother_income'], 
				'guardian_name' => $data['guardian_name'], 
				'relationship_id' => $data['relationship_id'], 
				'present_area' => $data['present_area'], 
				'present_town' => $data['present_town'], 
				'present_po' => $data['present_po'], 
				'present_ps' => $data['present_ps'], 
				'present_pin' => $data['present_pin'], 
				'present_state_id' => $data['present_state_id'], 
				'present_dist_id' => $data['present_dist_id'], 
				'area' => $data['area'], 
				'town' => $data['town'], 
				'post_office' => $data['post_office'], 
				'police_station' => $data['police_station'], 
				'pin_code' => $data['pin_code'], 
				'state_id' => $data['state_id'], 
				'dist_id' => $data['dist_id'], 

				'is_file_uploaded' => $is_file_uploaded,  
				 
				'created_by' => $sesion_data['userid'],  
				'is_active' => 1,  
				  
			);
			
			$student_insert = $this->db->insert('student_master', $insert_student_data);
			#echo $this->db->last_query();
			$student_insert_ID = $this->db->insert_id();


			 $insert_into_academic = array(
			 	'student_id' => $student_insert_ID, 
			 	'acdm_session_id' => $data['acdm_session_id'], 
			 	'class_id' => $data['class_id'], 
			 	'section_id' => $data['section_id'], 
			 	'rollno' => $data['rollno'], 
			 	'created_by' => $sesion_data['userid'] 
			 );

			$academic_insert = $this->db->insert('academic_details', $insert_into_academic);
			#echo $this->db->last_query();
			$academic_insert_ID = $this->db->insert_id();
			
			
			
			$insert_where = array(
				"masterID" => $student_insert_ID,
				"From" => "Admission",
			);
			
			if($is_file_uploaded=="Y")
			{

				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Registration',
				
				"action" => "Insert",
				"from_method" => "student/saveStudent",
				"user_id" => $sesion_data['userid'],
				
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform()
			);
			
			$user_activity = $this->db->insert('activity_log', $insert_user_activity);
		    #echo $this->db->last_query();
			if($this->db->trans_status() === FALSE) 
			{
	            $this->db->trans_rollback();
	            return false;
	        } 
			else 
				{
		            $this->db->trans_commit();
		            return true;
		        }
	        }
			catch (Exception $err) 
			{
	            echo $err->getTraceAsString();
	        }
	}



	public function insertIntoUploadFile($data,$session_data,$where_data)
	{ 
		if($data['mode']=="EDIT" && $data['studentID']>0)
		{

			$where_student = array(
				"uploaded_documents_all.upload_from_module_id" => $data['studentID'],
				"uploaded_documents_all.upload_from_module" => $where_data['From']
				);

				$this->db->where($where_student);
				$this->db->delete('uploaded_documents_all'); 

		}

		//$dir = APPPATH . 'assets/document/trainerUpload/'; //FCPATH . '/posts';
		//$dir = APPPATH . 'assets/application_extension/';
		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/img';

		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/newvista/assets/documents/admission_upload'; //server

		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/newvista/assets/documents/profile_picture'; //local
		
		//echo "<br>";
		
		//exit;
		
		$config = array(
			'upload_path' => $dir1,
			'allowed_types' => 'docx|doc|pdf|jpg|png|txt|xls|xlsx',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	
       $count_docs = sizeof($data['docFile']['fileName']['name']);
       $srl_no=1;
       	for($i=0;$i<sizeof($data['docFile']['fileName']['name']);$i++)
        {
      		$_FILES['images[]']['name']= $_FILES['fileName']['name'][$i];
            $_FILES['images[]']['type']= $_FILES['fileName']['type'][$i];
            $_FILES['images[]']['tmp_name']= $_FILES['fileName']['tmp_name'][$i];
            $_FILES['images[]']['error']= $_FILES['fileName']['error'][$i];
            $_FILES['images[]']['size']= $_FILES['fileName']['size'][$i];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('images[]'))
			{
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
               $detail_array =array(
					"random_file_name" => $file_name,
					"document_type_id" => $data['docType'][$i],
					"user_file_name" => $data['userFilename'][$i],
					"uploaded_file_desc" => $data['fileDesc'][$i],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Admission",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('uploaded_documents_all',$detail_array);	
             	#echo $this->db->last_query();
            }
        }

        // If File Not Changed Then insert Info
        $countChanged = sizeof($data['isChangedFile']);

       // echo "Count Changed ".$countChanged;
      //  exit;

        for($k=0;$k<$countChanged;$k++)
        {
        	$detail_array_edit = array();

        	if($data['isChangedFile'][$k]=="N")
        	{   
				$detail_array_edit =array(
					"random_file_name" => $data['randomFileName'][$k],
					"document_type_id" => $data['docType'][$k],
					"user_file_name" => $data['prvFilename'][$k],
					"uploaded_file_desc" => $data['fileDesc'][$k],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Admission",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

				$this->db->insert('uploaded_documents_all',$detail_array_edit);
				#echo $this->db->last_query();	
			}
        }

	}


} //end of class