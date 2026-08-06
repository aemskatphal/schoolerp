<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    function admission_form($qr_token = '') {
        $page_data['qr_token'] = $qr_token;
        $page_data['academy_id'] = '';
        $page_data['academy_name'] = '';

        if (!empty($qr_token)) {
            $academy = $this->db->get_where('academy', array('qr_code' => $qr_token . '.png'))->row_array();
            if ($academy) {
                $page_data['academy_id'] = $academy['academy_id'];
                $page_data['academy_name'] = $academy['academy_name'];
            }
        }

        $page_data['classes'] = $this->db->order_by('sort_order', 'asc')->get('class')->result_array();
        $page_data['boards'] = $this->db->order_by('board_id', 'asc')->get('board')->result_array();
        $page_data['religions'] = $this->db->get('religion')->result_array();
        $page_data['categories'] = $this->db->get('category')->result_array();
        $page_data['mother_tongues'] = $this->db->get('mother_tongue')->result_array();
        $page_data['student_groups'] = $this->db->get('student_group')->result_array();
        $page_data['previous_schools'] = $this->db->order_by('name', 'asc')->get('previous_school')->result_array();
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $current_session = $this->db->get_where('settings', array('type' => 'session'))->row();
        $page_data['current_year'] = $current_session ? $current_session->description : date('Y').'-'.(date('Y')+1);

        $this->load->view('backend/public/admission_form', $page_data);
    }

    function create($qr_token = '') {
        $upload_path = 'uploads/pre_student/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $data = array();
        $data['ad_year']         = html_escape($this->input->post('ad_year'));
        $data['ad_date']         = date('Y-m-d');
        $data['academy_id']      = intval($this->input->post('academy_id'));
        $data['class_id']        = intval($this->input->post('class_id'));
        $data['ad_class_id']     = intval($this->input->post('class_id'));
        $data['section_id']      = intval($this->input->post('section_id'));
        $data['board_id']        = intval($this->input->post('board_id'));
        $data['group_id']        = intval($this->input->post('group_id'));
        $data['student_no']      = html_escape($this->input->post('student_no'));
        $data['uid']             = html_escape($this->input->post('uid'));
        $data['name']            = html_escape($this->input->post('name'));
        $data['father_name']     = html_escape($this->input->post('father_name'));
        $data['mother_name']     = html_escape($this->input->post('mother_name'));
        $data['parent_phone']    = html_escape($this->input->post('parent_phone'));
        $data['phone']           = html_escape($this->input->post('phone'));
        $data['re_id']           = intval($this->input->post('re_id'));
        $data['cat_id']          = intval($this->input->post('cat_id'));
        $data['cast_id']         = intval($this->input->post('cast_id'));
        $data['nationality']     = html_escape($this->input->post('nationality'));
        $data['birth_place']     = html_escape($this->input->post('birth_place'));
        $data['sex']             = html_escape($this->input->post('sex'));
        $data['ps_id']           = html_escape($this->input->post('ps_id'));
        $data['blood_gp']        = html_escape($this->input->post('blood_gp'));
        $data['mt_id']           = intval($this->input->post('mt_id'));
        $data['address']         = html_escape($this->input->post('address'));
        $data['village']         = html_escape($this->input->post('address'));
        $data['tal']             = '';
        $data['dist']            = '';
        $data['birthday']        = html_escape($this->input->post('birthday'));
        $data['status']          = 'pending';
        $data['ad_type']         = 'Regular';

        $files = array('leaving_certificate', 'marksheet', 'aadhar_card_student', 'aadhar_card_parent', 'userfile', 'migration_certificate');
        $this->load->library('upload');
        foreach ($files as $file_field) {
            if (!empty($_FILES[$file_field]['name'])) {
                $config = array();
                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'pdf|png|jpeg|jpg';
                $config['max_size']      = 5120;
                $config['file_name']     = $file_field . '_' . time() . '_' . rand(1000, 9999);
                $this->upload->initialize($config);
                if ($this->upload->do_upload($file_field)) {
                    $upload_data = $this->upload->data();
                    $data[$file_field] = $upload_data['file_name'];
                }
            }
        }

        $this->db->insert('pre_student', $data);
        $inserted_id = $this->db->insert_id();

        $ps_name = trim($data['ps_id']);
        if(!empty($ps_name)){
            $existing_ps = $this->db->get_where('previous_school', array('name' => $ps_name))->row_array();
            if(!$existing_ps){
                $this->db->insert('previous_school', array('name' => $ps_name));
                $new_ps_id = $this->db->insert_id();
            } else {
                $new_ps_id = $existing_ps['previous_school_id'];
            }
            $this->db->where('pre_student_id', $inserted_id);
            $this->db->update('pre_student', array('ps_id' => $new_ps_id));
        }

        $this->session->set_flashdata('submitted_id', $inserted_id);
        redirect(base_url() . 'pre_student/success/' . $qr_token, 'refresh');
    }

    function success($qr_token = '') {
        $inserted_id = $this->session->flashdata('submitted_id');
        if (empty($inserted_id)) {
            redirect(base_url() . 'pre_student/admission_form/' . $qr_token, 'refresh');
        }
        echo $this->load->view('backend/public/admission_form_success', array('inserted_id' => $inserted_id), true);
        exit;
    }

    function get_class_section($class_id = '') {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        $html = '<option value="">Select</option>';
        foreach ($sections as $row) {
            $html .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
        echo $html;
    }

    function get_religion_category($re_id = '') {
        $categories = $this->db->get_where('category', array('re_id' => $re_id))->result_array();
        $html = '<option value="">Select</option>';
        foreach ($categories as $row) {
            $html .= '<option value="' . $row['category_id'] . '">' . $row['cat_name'] . '</option>';
        }
        echo $html;
    }

    function get_category_cast($cat_id = '') {
        $casts = $this->db->get_where('cast', array('cat_id' => $cat_id))->result_array();
        $html = '<option value="">Select</option>';
        foreach ($casts as $row) {
            $html .= '<option value="' . $row['cast_id'] . '">' . $row['cast_name'] . '</option>';
        }
        echo $html;
    }

    function get_board_groups($board_id = '') {
        $groups = $this->db->get('student_group')->result_array();
        $html = '<option value="">Select</option>';
        foreach ($groups as $row) {
            $html .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
        }
        echo $html;
    }
}
