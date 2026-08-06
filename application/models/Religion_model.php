<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Religion_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function createReligion(){
        $data['religion_name'] = html_escape($this->input->post('re_name'));
        $this->db->insert('religion', $data);
    }

    function updateReligion($religion_id){
        $data['religion_name'] = html_escape($this->input->post('re_name'));
        $this->db->where('religion_id', $religion_id);
        $this->db->update('religion', $data);
    }

    function deleteReligion($religion_id){
        $this->db->where('religion_id', $religion_id);
        $this->db->delete('religion');
    }

    function createCategory(){
        $data['re_id']    = html_escape($this->input->post('re_id'));
        $data['cat_name'] = html_escape($this->input->post('cat_name'));
        $this->db->insert('category', $data);
    }

    function updateCategory($category_id){
        $data['re_id']    = html_escape($this->input->post('re_id'));
        $data['cat_name'] = html_escape($this->input->post('cat_name'));
        $this->db->where('category_id', $category_id);
        $this->db->update('category', $data);
    }

    function deleteCategory($category_id){
        $this->db->where('category_id', $category_id);
        $this->db->delete('category');
    }

    function createCast(){
        $data['re_id']   = html_escape($this->input->post('re_id'));
        $data['cat_id']  = html_escape($this->input->post('cat_id'));
        $data['cast_name'] = html_escape($this->input->post('cast_name'));
        $this->db->insert('cast', $data);
    }

    function updateCast($cast_id){
        $data['re_id']   = html_escape($this->input->post('re_id'));
        $data['cat_id']  = html_escape($this->input->post('cat_id'));
        $data['cast_name'] = html_escape($this->input->post('cast_name'));
        $this->db->where('cast_id', $cast_id);
        $this->db->update('cast', $data);
    }

    function deleteCast($cast_id){
        $this->db->where('cast_id', $cast_id);
        $this->db->delete('cast');
    }

    function getCategoryByReligion($re_id){
        return $this->db->get_where('category', array('re_id' => $re_id))->result_array();
    }

    /***********  Mother Tongue  *******************/
    function createMotherTongue(){
        $data['mother_tongue_name'] = html_escape($this->input->post('mt_name'));
        $this->db->insert('mother_tongue', $data);
    }

    function updateMotherTongue($mother_tongue_id){
        $data['mother_tongue_name'] = html_escape($this->input->post('mt_name'));
        $this->db->where('mother_tongue_id', $mother_tongue_id);
        $this->db->update('mother_tongue', $data);
    }

    function deleteMotherTongue($mother_tongue_id){
        $this->db->where('mother_tongue_id', $mother_tongue_id);
        $this->db->delete('mother_tongue');
    }

    function getAllMotherTongue(){
        return $this->db->get('mother_tongue')->result_array();
    }

    function getMotherTongueById($mother_tongue_id){
        return $this->db->get_where('mother_tongue', array('mother_tongue_id' => $mother_tongue_id))->result_array();
    }

    /***********  Previous School  *******************/
    function createPreviousSchool(){
        $data['name']         = html_escape($this->input->post('name'));
        $data['contactname']  = html_escape($this->input->post('contactname'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['udiseno']      = html_escape($this->input->post('udiseno'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['website']      = html_escape($this->input->post('website'));
        $data['address']      = html_escape($this->input->post('address'));
        $this->db->insert('previous_school', $data);
    }

    function updatePreviousSchool($previous_school_id){
        $data['name']         = html_escape($this->input->post('name'));
        $data['contactname']  = html_escape($this->input->post('contactname'));
        $data['email']        = html_escape($this->input->post('email'));
        $data['udiseno']      = html_escape($this->input->post('udiseno'));
        $data['phone']        = html_escape($this->input->post('phone'));
        $data['website']      = html_escape($this->input->post('website'));
        $data['address']      = html_escape($this->input->post('address'));
        $this->db->where('previous_school_id', $previous_school_id);
        $this->db->update('previous_school', $data);
    }

    function deletePreviousSchool($previous_school_id){
        $this->db->where('previous_school_id', $previous_school_id);
        $this->db->delete('previous_school');
    }

    function getAllPreviousSchool(){
        return $this->db->get('previous_school')->result_array();
    }

    function getPreviousSchoolById($previous_school_id){
        return $this->db->get_where('previous_school', array('previous_school_id' => $previous_school_id))->result_array();
    }

}
