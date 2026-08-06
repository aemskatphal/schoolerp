<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academy_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function createAcademy(){
        $data['academy_name'] = html_escape($this->input->post('academy_name'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['password']     = sha1($this->input->post('password'));
        $data['status']       = '1';
        $this->db->insert('academy', $data);
        return $this->db->insert_id();
    }

    function updateAcademy($academy_id){
        $data['academy_name'] = html_escape($this->input->post('academy_name'));
        $data['email']        = html_escape($this->input->post('email'));
        if($this->input->post('password') != ''){
            $data['password'] = sha1($this->input->post('password'));
        }
        $this->db->where('academy_id', $academy_id);
        $this->db->update('academy', $data);
    }

    function deleteAcademy($academy_id){
        $this->db->where('academy_id', $academy_id);
        $this->db->delete('academy');
    }

    function changeStatus($academy_id){
        $current = $this->db->get_where('academy', array('academy_id' => $academy_id))->row();
        if($current->status == '1'){
            $new_status = '2';
        }else{
            $new_status = '1';
        }
        $this->db->where('academy_id', $academy_id);
        $this->db->update('academy', array('status' => $new_status));
    }

    function getAllAcademy(){
        return $this->db->order_by('academy_id', 'asc')->get('academy')->result_array();
    }

    function getAcademyById($academy_id){
        return $this->db->get_where('academy', array('academy_id' => $academy_id))->row_array();
    }

    function getAcademyCountByYear($year){
        $this->db->select('COUNT(academy_id) as total');
        $this->db->where('YEAR(created_at) <=', substr($year, 0, 4));
        $result = $this->db->get('academy')->row();
        return $result->total;
    }

    function getStudentsCountByClassForAcademy($academy_id, $year = ''){
        $this->db->select('class.class_id, class.name as class_name,
            COUNT(student.student_id) as total,
            SUM(CASE WHEN student.sex = "male" THEN 1 ELSE 0 END) as male,
            SUM(CASE WHEN student.sex = "female" THEN 1 ELSE 0 END) as female');
        $this->db->from('class');
        $this->db->join('student', 'student.class_id = class.class_id', 'left');
        if(!empty($academy_id) && $academy_id != '0'){
            $this->db->where('student.academy_id', $academy_id);
        }
        if(!empty($year)){
            $this->db->where('student.ad_year', $year);
        }
        $this->db->group_by('class.class_id');
        $this->db->order_by('class.name_numeric', 'asc');
        $query = $this->db->get();
        $rows = $query->result_array();

        $result = array();
        $grand_total = 0;
        $grand_male = 0;
        $grand_female = 0;

        foreach($rows as $row){
            $result[] = array(
                'class_name' => $row['class_name'],
                'total'      => intval($row['total']),
                'male'       => intval($row['male']),
                'female'     => intval($row['female'])
            );
            $grand_total += intval($row['total']);
            $grand_male += intval($row['male']);
            $grand_female += intval($row['female']);
        }

        return array('classes' => $result, 'grand_total' => $grand_total, 'grand_male' => $grand_male, 'grand_female' => $grand_female);
    }
}
