<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Student extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
  
    }

     /*student dashboard code to redirect to student page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('student Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / student dashboard code to redirect to student page if successfull login** */

    function profile($student_id){
        $this->load->helper('url');

        $student = $this->db->select('student.*, class.name as class_name, ad_class.name as ad_class_name, section.name as section_name, board.board_name, academy.academy_name, religion.religion_name, category.cat_name, cast.cast_name, student_group.group_name')
            ->join('class', 'class.class_id = student.class_id', 'left')
            ->join('class as ad_class', 'ad_class.class_id = student.ad_class_id', 'left')
            ->join('section', 'section.section_id = student.section_id', 'left')
            ->join('board', 'board.board_id = student.board_id', 'left')
            ->join('academy', 'academy.academy_id = student.academy_id', 'left')
            ->join('religion', 'religion.religion_id = student.re_id', 'left')
            ->join('category', 'category.category_id = student.cat_id', 'left')
            ->join('cast', 'cast.cast_id = student.cast_id', 'left')
            ->join('student_group', 'student_group.group_id = student.group_id', 'left')
            ->get_where('student', array('student_id' => $student_id))->row_array();

        if(empty($student)){
            $page_data['student'] = array();
            $page_data['page_title'] = get_phrase('Student Not Found');
            $this->load->view('backend/public/student_profile', $page_data);
            return;
        }

        $page_data['student'] = $student;
        $page_data['page_title'] = get_phrase('Student Details');
        $this->load->view('backend/public/student_profile', $page_data);
    }

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'student/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('student_id', $this->session->userdata('student_id'));
               $this->db->update('student', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'student/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


        function subject (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function teacher (){


            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->row()->teacher_id;


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function class_mate (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['select_student_class_id']  = $student_profile->class_id;
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['class_id']  = $student_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $student_profile = $student_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }

        function payment_history(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $student_profile = $student_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('Student History');
            $this->load->view('backend/index', $page_data);


        }



}