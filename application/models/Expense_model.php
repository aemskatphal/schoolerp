<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Expense_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    function insertExpenseCategory(){

        $page_data = array(
            'name' => $this->input->post('name'),
			);

        $this->db->insert('expense_category', $page_data);
    }

// The function below upate expense category //
    function updateExpenseCategory($param2){
        $page_data = array(
            'name' => $this->input->post('name'),
			);

        $this->db->where('expense_category_id', $param2);
        $this->db->update('expense_category', $page_data);
    }

    function deleteExpenseCategory($param2){
        $this->db->where('expense_category_id', $param2);
        $this->db->delete('expense_category');
    }


    function insertExpense(){

        $page_data['title']                         =   $this->input->post('title');
        $page_data['expense_category_id']           =   $this->input->post('expense_category_id');
        $page_data['description']                   =   $this->input->post('description');
        $page_data['payment_type']                  =  'expense';
        $page_data['method']                        =   $this->input->post('method');
        $page_data['amount']                        =   $this->input->post('amount');
        $page_data['timestamp']                     =   strtotime($this->input->post('timestamp'));
        $page_data['date']                          =   $this->input->post('timestamp');
        $page_data['year']                          =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;
        $this->db->insert('payment', $page_data);
    }

    function updateExpense($param2){

        $page_data['title']                         =   $this->input->post('title');
        $page_data['expense_category_id']           =   $this->input->post('expense_category_id');
        $page_data['description']                   =   $this->input->post('description');
        $page_data['payment_type']                  =  'expense';
        $page_data['method']                        =   $this->input->post('method');
        $page_data['amount']                        =   $this->input->post('amount');
        $page_data['timestamp']                     =   strtotime($this->input->post('timestamp'));
        $page_data['date']                          =   $this->input->post('timestamp');

        $this->db->where('payment_id', $param2);
        $this->db->update('payment', $page_data);
    }

    function deleteExpense($param2){
        $this->db->where('payment_id', $param2);
        $this->db->delete('payment');
    }


    function insertCashbook(){

        $payment_type = ($this->input->post('payment_type') == 'credit') ? 'income' : 'expense';
        $transaction_type = $this->input->post('transaction_type');

        if($payment_type == 'expense'){
            $title = $this->input->post('person_org_name');
            $expense_category_id = $this->input->post('expense_category_id');
        }else{
            $title = 'School Fee';
            $expense_category_id = 0;
        }

        $name = $this->session->userdata('name');
        $entry_user = !empty($name) ? $name : 'Administrator';

        $page_data = array(
            'title'                 =>  $title,
            'expense_category_id'   =>  $expense_category_id,
            'description'           =>  $this->input->post('description'),
            'payment_type'          =>  $payment_type,
            'method'                =>  $transaction_type,
            'amount'                =>  $this->input->post('total_amount'),
            'receipt_no'            =>  $this->input->post('receipt_no'),
            'person_org_name'       =>  $this->input->post('person_org_name'),
            'timestamp'             =>  strtotime($this->input->post('timestamp')),
            'date'                  =>  $this->input->post('timestamp'),
            'year'                  =>  $this->input->post('financial_year'),
            'bank_id'               =>  $this->input->post('bank_id'),
            'contra_entry'          =>  $this->input->post('contra_entry'),
            'entry_user'            =>  $entry_user
        );

        $this->db->insert('payment', $page_data);
    }

    function updateCashbook($param2){

        $payment_type = ($this->input->post('payment_type') == 'credit') ? 'income' : 'expense';

        if($payment_type == 'expense'){
            $title = $this->input->post('person_org_name');
            $expense_category_id = $this->input->post('expense_category_id');
        }else{
            $title = 'School Fee';
            $expense_category_id = 0;
        }

        $page_data = array(
            'title'                 =>  $title,
            'expense_category_id'   =>  $expense_category_id,
            'description'           =>  $this->input->post('description'),
            'payment_type'          =>  $payment_type,
            'method'                =>  $this->input->post('transaction_type'),
            'amount'                =>  $this->input->post('total_amount'),
            'receipt_no'            =>  $this->input->post('receipt_no'),
            'person_org_name'       =>  $this->input->post('person_org_name'),
            'timestamp'             =>  strtotime($this->input->post('timestamp')),
            'date'                  =>  $this->input->post('timestamp'),
            'year'                  =>  $this->input->post('financial_year'),
            'bank_id'               =>  $this->input->post('bank_id'),
            'contra_entry'          =>  $this->input->post('contra_entry')
        );

        $this->db->where('payment_id', $param2);
        $this->db->update('payment', $page_data);
    }

    function deleteCashbook($param2){
        $this->db->where('payment_id', $param2);
        $this->db->delete('payment');
    }


}
