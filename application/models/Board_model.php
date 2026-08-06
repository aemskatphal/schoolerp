<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function createBoard(){
        $data['board_name'] = html_escape($this->input->post('board_name'));
        $this->db->insert('board', $data);
        return $this->db->insert_id();
    }

    function updateBoard($board_id){
        $data['board_name'] = html_escape($this->input->post('board_name'));
        $this->db->where('board_id', $board_id);
        $this->db->update('board', $data);
    }

    function deleteBoard($board_id){
        $this->db->where('board_id', $board_id);
        $this->db->delete('board');
    }

    function getAllBoard(){
        return $this->db->order_by('board_id', 'asc')->get('board')->result_array();
    }

    function getBoardById($board_id){
        return $this->db->get_where('board', array('board_id' => $board_id))->row_array();
    }
}
