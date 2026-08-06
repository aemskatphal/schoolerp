<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Event_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

    function createNoticeboardFunction(){

        $page_data['title'] =   html_escape($this->input->post('title'));
        $page_data['location'] =   html_escape($this->input->post('location'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));

        $this->db->insert('noticeboard', $page_data);
    }

    function updateNoticeboardFunction($param2){

        $page_data['title'] =   html_escape($this->input->post('title'));
        $page_data['location'] =   html_escape($this->input->post('location'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));

        $this->db->where('notice_id', $param2);
        $this->db->update('noticeboard', $page_data);
    }

    function deleteNoticeboardFunction($param2){
        $this->db->where('notice_id', $param2);
        $this->db->delete('noticeboard');

    }
	

	
	
}
