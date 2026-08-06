<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teacher_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insetTeacherFunction (){

        $bank_data['account_holder_name'] = $this->input->post('account_holder_name');
        $bank_data['account_number'] = $this->input->post('account_number');
        $bank_data['bank_name'] = $this->input->post('bank_name');
        $bank_data['branch'] = $this->input->post('branch');
        $bank_data['ifsc_code'] = $this->input->post('ifsc_code');
        $bank_data['account_type'] = $this->input->post('account_type');
        $bank_data['city'] = $this->input->post('city');

        $this->db->insert('bank', $bank_data);
        $bank_id = $this->db->insert_id();


        $teacher_array = array(
            'name'                  => $this->input->post('name'),
            'role'                  => $this->input->post('role') ?: '',
			'teacher_number'        => $this->input->post('teacher_number'),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('re_id'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
			'phone'                 => $this->input->post('phone'),
			'facebook'              => $this->input->post('facebook') ?: '',
        	'twitter'               => $this->input->post('twitter') ?: '',
            'googleplus'            => $this->input->post('googleplus') ?: '',
            'linkedin'              => $this->input->post('linkedin') ?: '',
            'qualification'         => $this->input->post('qualification') ?: '',
			'marital_status'        => $this->input->post('marital_status'),
			'password'              => sha1($this->input->post('password')),
        	'department_id'         => $this->input->post('department_id'),
            'designation_id'        => $this->input->post('designation_id'),
            'date_of_joining'       => $this->input->post('date_of_joining'),
            'joining_salary'        => $this->input->post('net_salary'),
			'status'                => 1,
			'date_of_leaving'       => $this->input->post('date_of_leaving') ?: '',
			'edu_id'                => $this->input->post('edu_id') ?: '',
			'uidno'                 => $this->input->post('uidno') ?: '',
			're_id'                 => $this->input->post('re_id') ?: '',
			'cast_id'               => $this->input->post('cast_id') ?: '',
			'mt_id'                 => $this->input->post('mt_id') ?: ''
            );
        
            $teacher_array['file_name'] = isset($_FILES["file_name"]["name"]) ? $_FILES["file_name"]["name"] : '';
            $teacher_array['email'] = $this->input->post('email');
            $teacher_array['bank_id'] = $bank_id;
            $teacher_array['login_status'] = '';

            $this->db->insert('teacher', $teacher_array);
            $teacher_id = $this->db->insert_id();

            if(isset($_FILES["file_name"]["name"]) && $_FILES["file_name"]["name"] != ''){
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);
            }
            if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != ''){
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            }

            $allowances = $this->input->post('allowance');
            if(!empty($allowances)){
                foreach($allowances as $allow){
                    if(!empty($allow['name']) && isset($allow['amount'])){
                        $this->db->insert('salary_allowance', array(
                            'teacher_id' => $teacher_id,
                            'name'       => $allow['name'],
                            'amount'     => $allow['amount']
                        ));
                    }
                }
            }

            $net_salary = $this->input->post('net_salary');
            $this->db->where('teacher_id', $teacher_id);
            $this->db->update('teacher', array('joining_salary' => $net_salary));
    }


    function updateTeacherFunction($param2){

        $teacher_data = array(
            'name'                  => $this->input->post('name'),
            'role'                  => $this->input->post('role') ?: '',
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('re_id'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
            'phone'                 => $this->input->post('phone'),
            'email'                 => $this->input->post('email'),
			'facebook'              => $this->input->post('facebook') ?: '',
        	'twitter'               => $this->input->post('twitter') ?: '',
            'googleplus'            => $this->input->post('googleplus') ?: '',
            'linkedin'              => $this->input->post('linkedin') ?: '',
            'qualification'         => $this->input->post('qualification') ?: '',
			'marital_status'        => $this->input->post('marital_status'),
			'department_id'         => $this->input->post('department_id'),
			'designation_id'        => $this->input->post('designation_id'),
			'edu_id'                => $this->input->post('edu_id') ?: '',
			'uidno'                 => $this->input->post('uidno') ?: '',
			're_id'                 => $this->input->post('re_id') ?: '',
			'cast_id'               => $this->input->post('cast_id') ?: '',
			'mt_id'                 => $this->input->post('mt_id') ?: '',
			'date_of_joining'       => $this->input->post('date_of_joining'),
			'date_of_leaving'       => $this->input->post('date_of_leaving') ?: '',
			'joining_salary'        => $this->input->post('net_salary')
            );

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $teacher_data);

            $teacher = $this->db->get_where('teacher', array('teacher_id' => $param2))->row();
            if(!empty($teacher->bank_id)){
                $bank_data = array(
                    'account_holder_name' => $this->input->post('account_holder_name'),
                    'account_number'      => $this->input->post('account_number'),
                    'bank_name'           => $this->input->post('bank_name'),
                    'branch'              => $this->input->post('branch'),
                    'ifsc_code'           => $this->input->post('ifsc_code'),
                    'account_type'        => $this->input->post('account_type'),
                    'city'                => $this->input->post('city')
                );
                $this->db->where('bank_id', $teacher->bank_id);
                $this->db->update('bank', $bank_data);
            }

            $this->db->where('teacher_id', $param2);
            $this->db->delete('salary_allowance');
            $allowances = $this->input->post('allowance');
            if(!empty($allowances)){
                foreach($allowances as $allow){
                    if(!empty($allow['name']) && isset($allow['amount'])){
                        $this->db->insert('salary_allowance', array(
                            'teacher_id' => $param2,
                            'name'       => $allow['name'],
                            'amount'     => $allow['amount']
                        ));
                    }
                }
            }

            if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != ''){
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            }
    }


    function deleteTeacherFunction($param2){

        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
        $this->db->where('teacher_id', $param2);
        $this->db->delete('salary_allowance');
    }
	

}
