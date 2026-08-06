<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into student house //
    function createStudentHouse(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'description'      => html_escape($this->input->post('description'))
	    );

        $this->db->insert('house', $page_data);
    }

// The function below update student house //
    function updateStudentHouse($param2){
        $page_data = array(
            'name'         => html_escape($this->input->post('name')),
            'description'  => html_escape($this->input->post('description'))
	    );

        $this->db->where('house_id', $param2);
        $this->db->update('house', $page_data);
    }

    // The function below delete from student house table //
    function deleteStudentHouse($param2){
        $this->db->where('house_id', $param2);
        $this->db->delete('house');
    }



    // The function below insert into student category //
    function createstudentCategory(){

        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );
        $this->db->insert('student_category', $page_data);
    }

// The function below update student category //
    function updatestudentCategory($param2){
        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );

        $this->db->where('student_category_id', $param2);
        $this->db->update('student_category', $page_data);
    }

    // The function below delete from student category table //
    function deletestudentCategory($param2){
        $this->db->where('student_category_id', $param2);
        $this->db->delete('student_category');
    }




    //  the function below insert into student table
    function createNewStudent(){

        $password = $this->input->post('password');
        $password = !empty($password) ? sha1($password) : sha1('123456');

        $page_data = array(
            'ad_year'             => html_escape($this->input->post('ad_year')),
            'ad_type'             => html_escape($this->input->post('ad_type')),
            'academy_id'          => html_escape($this->input->post('academy_id')),
            'ad_date'             => html_escape($this->input->post('ad_date')),
            'gen_reg_no'          => html_escape($this->input->post('gen_reg_no')),
            'board_id'            => html_escape($this->input->post('board_id')),
            'student_no'          => html_escape($this->input->post('student_no')),
            'uid'                 => html_escape($this->input->post('uid')),
            'ad_remarks'          => html_escape($this->input->post('ad_remarks')),
            'name'                => html_escape($this->input->post('name')),
            'father_name'         => html_escape($this->input->post('father_name')),
            'mother_name'         => html_escape($this->input->post('mother_name')),
            'parent_phone'        => html_escape($this->input->post('parent_phone')),
            'sex'                 => html_escape($this->input->post('sex')),
            'birthday'            => html_escape($this->input->post('birthday')),
            're_id'               => html_escape($this->input->post('re_id')),
            'bank_id'             => html_escape($this->input->post('bank_id')),
            'father_profession'   => html_escape($this->input->post('father_profession')),
            'mother_profession'   => html_escape($this->input->post('mother_profession')),
            'phone'               => html_escape($this->input->post('phone')),
            'nationality'         => html_escape($this->input->post('nationality')),
            'place_birth'         => html_escape($this->input->post('birth_place')),
            'cat_id'              => html_escape($this->input->post('cat_id')),
            'account_number'      => html_escape($this->input->post('account_number')),
            'father_edu_id'       => html_escape($this->input->post('father_edu_id')),
            'mother_edu_id'       => html_escape($this->input->post('mother_edu_id')),
            'blood_group'         => html_escape($this->input->post('blood_gp')),
            'm_tongue'            => html_escape($this->input->post('mt_id')),
            'address'             => html_escape($this->input->post('address')),
            'village'             => html_escape($this->input->post('address')),
            'tal'                 => '',
            'dist'                => '',
            'cast_id'             => html_escape($this->input->post('cast_id')),
            'residential'         => html_escape($this->input->post('residential')),
            'ps_attended'         => html_escape($this->input->post('ps_id')),
            'group_id'            => html_escape($this->input->post('group_id')),
            'class_id'            => html_escape($this->input->post('class_id')),
            'ad_class_id'         => html_escape($this->input->post('class_id')),
            'section_id'          => html_escape($this->input->post('section_id')),
            'password'            => $password,
            'status'              => 0,
            'login_status'        => '1',
            'roll'                => substr(md5(uniqid(rand(), true)), 0, 7),
            'entry_user'          => $this->session->userdata('name') ? $this->session->userdata('name') : 'Administrator',
            'religion'            => html_escape($this->input->post('re_id')),
            'student_category_id' => html_escape($this->input->post('cat_id')),
        );
        
    $this->db->insert('student', $page_data);
    $student_id = $this->db->insert_id();

    // Handle photo upload
    if(!empty($_FILES['userfile']['tmp_name'])){
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
        $this->db->where('student_id', $student_id);
        $this->db->update('student', array('photo' => $student_id . '.jpg'));
    }

    // Generate QR code automatically for the student
    $upload_path = 'uploads/student_qr_code/';
    if(!is_dir($upload_path)) mkdir($upload_path, 0777, true);

    $filename = 'std_'.md5(uniqid()).'.png';
    $filepath = $upload_path.$filename;

    $qr_text = base_url().'student/profile/'.$student_id;

    require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
    QRcode::png($qr_text, $filepath, QR_ECLEVEL_L, 6, 2);

    $this->db->where('student_id', $student_id);
    $this->db->update('student', array('qr_code' => $filename));

    }


    //the function below update student
    function updateNewStudent($param2){
        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email'         => html_escape($this->input->post('email')),
            'ps_attended'   => html_escape($this->input->post('ps_attended')),
            'ps_address'    => html_escape($this->input->post('ps_address')),
            'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'student_category_id' => html_escape($this->input->post('student_category_id')),
            'club_id'             => html_escape($this->input->post('club_id'))
	    );
        $this->db->where('student_id', $param2);
        $this->db->update('student', $page_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');

    }

    // the function below deletes from student table
    function deleteNewStudent($param2){
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
    }

	


	
	
}

