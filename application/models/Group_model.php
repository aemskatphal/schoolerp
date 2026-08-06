<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function createGroup(){
        $data['group_name'] = html_escape($this->input->post('group_name'));
        $this->db->insert('student_group', $data);
        return $this->db->insert_id();
    }

    function updateGroup($group_id){
        $data['group_name'] = html_escape($this->input->post('group_name'));
        $this->db->where('group_id', $group_id);
        $this->db->update('student_group', $data);
    }

    function deleteGroup($group_id){
        $this->db->where('group_id', $group_id);
        $this->db->delete('student_group');
    }

    function getAllGroup(){
        return $this->db->order_by('group_id', 'asc')->get('student_group')->result_array();
    }

    function getGroupById($group_id){
        return $this->db->get_where('student_group', array('group_id' => $group_id))->row_array();
    }
}
