<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('createbody_method'))
{
    function createbody_method($body_content_data = '',$body_content_page = '',$body_content_header='',$data,$heared_menu_content='')
    {
      
	  
	  $CI =& get_instance();
	  
	
	 $CI->load->model('menumodel','',TRUE);
	 $CI->load->library('template');
	 /* leftmenu */
	
	 $left_menu = $CI->menumodel->getAllAdministrativeMenu('admin_menu_master');
	 //$user_role = $CI->menumodel->getAllRoleById();

	 $data['bodyview'] = $body_content_page;
	 $data['leftmenusidebar'] = '';
	 $data['headermenu'] = $body_content_header;
	 //$data['web_user_role']=$user_role;
	
	 $CI->template->setHeader($heared_menu_content);
	 $CI->template->setBody($body_content_data);
	 $CI->template->setLeftmenu($left_menu);
	
	 
	 //$CI->template->view('default_layout', array('body'=>$body_content_page,'leftmenu'=>'leftmenu_view'), $data);
	   $CI->template->view('default_view', array('body'=>$body_content_page), $data);
		
	
    }   
}