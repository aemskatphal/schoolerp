<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Fees_head_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function createFeesHeadFunction(){
        $data['title']      = html_escape($this->input->post('fh_title'));
        $data['amount']     = html_escape($this->input->post('fh_amt'));
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('fees_head', $data);
    }

    function updateFeesHeadFunction($id){
        $data['title']  = html_escape($this->input->post('fh_title'));
        $data['amount'] = html_escape($this->input->post('fh_amt'));
        $this->db->where('fees_head_id', $id);
        $this->db->update('fees_head', $data);
    }

    function deleteFeesHeadFunction($id){
        $this->db->where('fees_head_id', $id);
        $this->db->delete('fees_head');
    }
}
