<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Fees_template_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function createFeesTemplateFunction(){
        $data['academy_id']    = html_escape($this->input->post('academy_id'));
        $data['class_id']      = html_escape($this->input->post('class_id'));
        $data['group_id']      = html_escape($this->input->post('group_id'));
        $data['academic_year'] = html_escape($this->input->post('academic_year'));
        $data['amount']        = html_escape($this->input->post('total_amt'));
        $data['description']   = html_escape($this->input->post('description'));
        $data['entry_user']    = $this->session->userdata('name');
        $data['created_at']    = date('Y-m-d H:i:s');
        $this->db->insert('fees_template', $data);
        $template_id = $this->db->insert_id();

        $productNames = $this->input->post('productName');
        $prices = $this->input->post('price');
        if(!empty($productNames) && is_array($productNames)){
            foreach($productNames as $key => $fh_id){
                if(!empty($fh_id)){
                    $item_data = array(
                        'fees_template_id' => $template_id,
                        'fees_head_id'     => $fh_id,
                        'amount'           => !empty($prices[$key]) ? $prices[$key] : 0
                    );
                    $this->db->insert('fees_template_item', $item_data);
                }
            }
        }
    }

    function updateFeesTemplateFunction($id){
        $data['academy_id']    = html_escape($this->input->post('academy_id'));
        $data['class_id']      = html_escape($this->input->post('class_id'));
        $data['group_id']      = html_escape($this->input->post('group_id'));
        $data['academic_year'] = html_escape($this->input->post('academic_year'));
        $data['amount']        = html_escape($this->input->post('total_amt'));
        $data['description']   = html_escape($this->input->post('description'));
        $this->db->where('fees_template_id', $id);
        $this->db->update('fees_template', $data);

        $this->db->where('fees_template_id', $id);
        $this->db->delete('fees_template_item');

        $productNames = $this->input->post('productName');
        $prices = $this->input->post('price');
        if(!empty($productNames) && is_array($productNames)){
            foreach($productNames as $key => $fh_id){
                if(!empty($fh_id)){
                    $item_data = array(
                        'fees_template_id' => $id,
                        'fees_head_id'     => $fh_id,
                        'amount'           => !empty($prices[$key]) ? $prices[$key] : 0
                    );
                    $this->db->insert('fees_template_item', $item_data);
                }
            }
        }
    }

    function deleteFeesTemplateFunction($id){
        $this->db->where('fees_template_id', $id);
        $this->db->delete('fees_template');
    }

    function getFeesTemplateList(){
        $this->db->select('fees_template.*, academy.name as academy_name, class.name as class_name, student_group.group_name as group_name');
        $this->db->from('fees_template');
        $this->db->join('academy', 'academy.academy_id = fees_template.academy_id', 'left');
        $this->db->join('class', 'class.class_id = fees_template.class_id', 'left');
        $this->db->join('student_group', 'student_group.group_id = fees_template.group_id', 'left');

        if($this->input->post('academy_id')){
            $this->db->where('fees_template.academy_id', $this->input->post('academy_id'));
        }
        if($this->input->post('class_id')){
            $this->db->where('fees_template.class_id', $this->input->post('class_id'));
        }
        if($this->input->post('group_id')){
            $this->db->where('fees_template.group_id', $this->input->post('group_id'));
        }
        if($this->input->post('academic_year')){
            $this->db->where('fees_template.academic_year', $this->input->post('academic_year'));
        }

        $this->db->order_by('fees_template.fees_template_id', 'DESC');
        return $this->db->get()->result_array();
    }

    function countAll(){
        return $this->db->count_all('fees_template');
    }

    function countFiltered(){
        $this->db->from('fees_template');
        if($this->input->post('academy_id')){
            $this->db->where('fees_template.academy_id', $this->input->post('academy_id'));
        }
        if($this->input->post('class_id')){
            $this->db->where('fees_template.class_id', $this->input->post('class_id'));
        }
        if($this->input->post('group_id')){
            $this->db->where('fees_template.group_id', $this->input->post('group_id'));
        }
        if($this->input->post('academic_year')){
            $this->db->where('fees_template.academic_year', $this->input->post('academic_year'));
        }
        return $this->db->count_all_results();
    }
}
