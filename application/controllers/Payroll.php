<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payroll extends CI_Controller { 

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->_enforce_module_access();
    }

    /**Role based module access check**/
    private function _enforce_module_access() {
        enforce_module_access(array(
            'salary_payment' => array('hr.salary_payment'),
            'create'         => array('hr.salary_payment'),
            'review'         => array('hr.salary_payment'),
            'view_payslip'   => array('hr.salary_payment'),
            'advance_salary' => array('hr.advance_salary'),
            'salary_statement' => array('hr'),
        ));
    }

    public function index() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        redirect(base_url() . 'payroll/salary_payment', 'refresh');
    }

    function salary_payment(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

        $month_year = date('Y-m');
        if($this->input->post('search')){
            $month_year = $this->input->post('month_year');
        }

        $page_data['page_name']    = 'salary_payment';
        $page_data['page_title']   = get_phrase('Salary Payment');
        $page_data['month_year']   = $month_year;
        $page_data['salary_list']  = $this->payroll_model->getSalaryPaymentList($month_year);
        $this->load->view('backend/index', $page_data);
    }

    function create($teacher_id = null, $month = null, $year = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

        if($teacher_id == null || $month == null || $year == null){
            redirect(base_url() . 'payroll/salary_payment', 'refresh');
        }

        $month_year = $year . '-' . $month;
        $staff_id = $this->input->post('staff_id');

        if($this->input->post('paid')){
            $total_allowance = floatval($this->input->post('total_allowance'));
            $total_deduction = floatval($this->input->post('total_deduction'));
            $net_salary = floatval($this->input->post('net_salary'));

            $payment_data = array(
                'teacher_id'            => $staff_id,
                'month_year'            => $month_year,
                'amount'                => $total_allowance,
                'advance_deduction'     => $total_deduction,
                'net_payable'           => $net_salary,
                'status'                => 1,
                'payment_date'          => date('Y-m-d'),
                'entry_user'            => 'Administrator',
                'remarks'               => $this->input->post('remarks')
            );
            $this->payroll_model->createSalaryPayment($payment_data);

            $allowances = $this->input->post('allowance');
            if(!empty($allowances)){
                $this->payroll_model->saveSalaryAllowances($staff_id, $month_year, $allowances);
            }

            $deductions = $this->input->post('deduction');
            if(!empty($deductions)){
                $this->payroll_model->saveSalaryDeductions($staff_id, $month_year, $deductions);
            }

            $this->session->set_flashdata('flash_message', get_phrase('Salary paid successfully'));
            redirect(base_url() . 'payroll/salary_payment', 'refresh');
        }

        $page_data['page_name']    = 'create_salary_payment';
        $page_data['page_title']   = get_phrase('Pay Salary');
        $page_data['teacher']      = $this->payroll_model->getTeacherSalary($teacher_id);
        $page_data['month_year']   = $month_year;
        $page_data['month']        = $month;
        $page_data['year']         = $year;
        $page_data['allowances']   = $this->payroll_model->getSalaryAllowances($teacher_id);
        $page_data['deductions']   = $this->payroll_model->getSalaryDeductions($teacher_id, $month_year);
        $page_data['is_paid']      = $this->payroll_model->checkSalaryPaid($teacher_id, $month_year);
        $this->load->view('backend/index', $page_data);
    }

    function advance_salary($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

        if($param1 == 'insert'){
            $data = array(
                'staff_id'            => $this->input->post('staff_id'),
                'financial_year'      => $this->input->post('financial_year'),
                'month_year'          => $this->input->post('month_year'),
                'expense_category_id' => $this->input->post('expense_category_id'),
                'reason'              => $this->input->post('reason'),
                'advance_date'        => $this->input->post('advance_date'),
                'amount'              => $this->input->post('amount'),
                'balance_amount'      => $this->input->post('amount'),
                'bank_id'             => $this->input->post('bank_id'),
                'transaction_type'    => $this->input->post('transaction_type'),
                'status'              => 0,
                'review_status'       => 0,
                'entry_user'          => 'Administrator'
            );
            $this->db->insert('advance_salary', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'payroll/advance_salary', 'refresh');
        }

        if($param1 == 'delete'){
            $this->db->where('advance_salary_id', $param2);
            $this->db->delete('advance_salary');
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'payroll/advance_salary', 'refresh');
        }

        if($param1 == 'status'){
            $record = $this->db->get_where('advance_salary', array('advance_salary_id' => $param2))->row();
            $new_status = ($record->status == 0) ? 1 : 0;
            $this->db->where('advance_salary_id', $param2);
            $this->db->update('advance_salary', array('status' => $new_status));
            redirect(base_url(). 'payroll/advance_salary', 'refresh');
        }

        if($param1 == 'update'){
            $data = array(
                'advance_date'        => $this->input->post('advance_date'),
                'amount'              => $this->input->post('amount'),
                'expense_category_id' => $this->input->post('expense_category_id'),
                'bank_id'             => $this->input->post('bank_id'),
                'transaction_type'    => $this->input->post('transaction_type'),
                'reason'              => $this->input->post('reason')
            );
            $this->db->where('advance_salary_id', $param2);
            $this->db->update('advance_salary', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'payroll/advance_salary', 'refresh');
        }

        $page_data['page_name']        = 'advance_salary';
        $page_data['page_title']       = get_phrase('Advance Salary');
        $page_data['advance_salaries'] = $this->db->order_by('advance_salary_id', 'desc')->get('advance_salary')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function salary_statement(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

        $month_year_from = date('Y-m');
        $month_year_to = date('Y-m');

        if($this->input->post('searchstm')){
            $month_year_from = $this->input->post('month_year_from');
            $month_year_to = $this->input->post('month_year_to');
        }

        $page_data['page_name']      = 'salary_statement';
        $page_data['page_title']     = get_phrase('Salary Statement');
        $page_data['month_year_from'] = $month_year_from;
        $page_data['month_year_to']  = $month_year_to;
        $page_data['statement']      = $this->payroll_model->getSalaryStatement($month_year_from, $month_year_to);
        $this->load->view('backend/index', $page_data);
    }

    function review($salary_payment_id = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
        if($salary_payment_id == null) redirect(base_url() . 'payroll/salary_statement', 'refresh');

        $record = $this->db->get_where('salary_payment', array('salary_payment_id' => $salary_payment_id))->row();
        $new_status = ($record->review_status == 1) ? 0 : 1;
        $this->db->where('salary_payment_id', $salary_payment_id);
        $this->db->update('salary_payment', array('review_status' => $new_status));
        redirect(base_url() . 'payroll/salary_statement', 'refresh');
    }

    function view_payslip($salary_payment_id = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
        if($salary_payment_id == null) redirect(base_url() . 'payroll/salary_statement', 'refresh');

        $payslip = $this->payroll_model->getPayslipData($salary_payment_id);
        if(empty($payslip)){
            $this->session->set_flashdata('flash_message', get_phrase('Payslip not found'));
            redirect(base_url() . 'payroll/salary_statement', 'refresh');
        }

        $page_data['page_name']  = 'view_payslip';
        $page_data['page_title'] = get_phrase('View Payslip');
        $page_data['payslip']    = $payslip;
        $this->load->view('backend/index', $page_data);
    }
}
