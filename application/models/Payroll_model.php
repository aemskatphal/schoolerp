<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_model extends CI_Model { 

    function __construct()
    {
        parent::__construct();
    }

    function getSalaryPaymentList($month_year){
        $this->db->select('teacher.*, department.name as department_name, salary_payment.salary_payment_id, salary_payment.status as payment_status, salary_payment.amount as paid_amount, salary_payment.payment_date');
        $this->db->from('teacher');
        $this->db->join('department', 'department.department_id = teacher.department_id', 'left');
        $this->db->join('salary_payment', "salary_payment.teacher_id = teacher.teacher_id AND salary_payment.month_year = '" . $this->db->escape_str($month_year) . "'", 'left');
        $this->db->where('teacher.status', 1);
        $this->db->order_by('teacher.teacher_id', 'asc');
        return $this->db->get()->result_array();
    }

    function getTeacherSalary($teacher_id){
        return $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
    }

    function getAdvanceDeduction($teacher_id, $month_year){
        $this->db->select_sum('amount');
        $this->db->where('staff_id', $teacher_id);
        $this->db->where('month_year', $month_year);
        $this->db->where('status', 0);
        $result = $this->db->get('advance_salary')->row();
        return $result ? $result->amount : 0;
    }

    function getSalaryAllowances($teacher_id){
        return $this->db->get_where('salary_allowance', array('teacher_id' => $teacher_id))->result_array();
    }

    function checkSalaryPaid($teacher_id, $month_year){
        $result = $this->db->get_where('salary_payment', array(
            'teacher_id' => $teacher_id,
            'month_year' => $month_year,
            'status' => 1
        ))->row();
        return $result ? true : false;
    }

    function createSalaryPayment($data){
        $existing = $this->db->get_where('salary_payment', array(
            'teacher_id' => $data['teacher_id'],
            'month_year' => $data['month_year']
        ))->row();

        if($existing){
            $this->db->where('salary_payment_id', $existing->salary_payment_id);
            return $this->db->update('salary_payment', $data);
        } else {
            return $this->db->insert('salary_payment', $data);
        }
    }

    function markAdvancePaid($teacher_id, $month_year){
        $this->db->where('staff_id', $teacher_id);
        $this->db->where('month_year', $month_year);
        $this->db->where('status', 0);
        $this->db->update('advance_salary', array('status' => 1));
    }

    function getSalaryStatement($month_year_from, $month_year_to){
        $this->db->select('salary_payment.salary_payment_id, salary_payment.review_status,
            teacher.teacher_id, teacher.name as teacher_name, teacher.phone as mobile_no, teacher.sex,
            department.name as department_name,
            designation.name as designation_name,
            salary_payment.amount as salary, salary_payment.advance_deduction as deduction, salary_payment.net_payable,
            salary_payment.entry_user, salary_payment.month_year,
            bank.account_holder_name, bank.account_number, bank.bank_name as bank_name_col, bank.branch, bank.ifsc_code, bank.account_type, bank.city');
        $this->db->from('salary_payment');
        $this->db->join('teacher', 'teacher.teacher_id = salary_payment.teacher_id', 'left');
        $this->db->join('department', 'department.department_id = teacher.department_id', 'left');
        $this->db->join('designation', 'designation.designation_id = teacher.designation_id', 'left');
        $this->db->join('bank', 'bank.bank_id = teacher.bank_id', 'left');
        $this->db->where('salary_payment.status', 1);
        $this->db->where('salary_payment.month_year >=', $month_year_from);
        $this->db->where('salary_payment.month_year <=', $month_year_to);
        $this->db->order_by('salary_payment.month_year', 'asc');
        $this->db->order_by('teacher.name', 'asc');
        return $this->db->get()->result_array();
    }

    function getDepartmentName($department_id){
        $result = $this->db->get_where('department', array('department_id' => $department_id))->row();
        return $result ? $result->name : '';
    }

    function getSalaryDeductions($teacher_id, $month_year){
        return $this->db->get_where('salary_deduction', array(
            'teacher_id' => $teacher_id,
            'month_year' => $month_year
        ))->result_array();
    }

    function saveSalaryAllowances($teacher_id, $month_year, $allowances){
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('month_year', $month_year);
        $this->db->delete('salary_allowance');

        if(!empty($allowances)){
            foreach($allowances as $allow){
                if(!empty($allow['name']) && isset($allow['amount'])){
                    $this->db->insert('salary_allowance', array(
                        'teacher_id' => $teacher_id,
                        'month_year' => $month_year,
                        'name'       => $allow['name'],
                        'amount'     => $allow['amount']
                    ));
                }
            }
        }
    }

    function saveSalaryDeductions($teacher_id, $month_year, $deductions){
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('month_year', $month_year);
        $this->db->delete('salary_deduction');

        if(!empty($deductions)){
            foreach($deductions as $ded){
                if(!empty($ded['name']) && isset($ded['amount']) && floatval($ded['amount']) > 0){
                    $this->db->insert('salary_deduction', array(
                        'teacher_id'      => $teacher_id,
                        'month_year'      => $month_year,
                        'deduction_name'  => $ded['name'],
                        'deduction_amount' => $ded['amount']
                    ));
                }
            }
        }
    }

    function getPayslipData($salary_payment_id){
        $payment = $this->db->get_where('salary_payment', array('salary_payment_id' => $salary_payment_id))->row();
        if(empty($payment)) return null;

        $teacher = $this->db->get_where('teacher', array('teacher_id' => $payment->teacher_id))->row();
        $department = $this->db->get_where('department', array('department_id' => $teacher->department_id))->row();
        $designation = $this->db->get_where('designation', array('designation_id' => $teacher->designation_id))->row();
        $allowances = $this->db->get_where('salary_allowance', array('teacher_id' => $payment->teacher_id, 'month_year' => $payment->month_year))->result_array();
        $deductions = $this->db->get_where('salary_deduction', array('teacher_id' => $payment->teacher_id, 'month_year' => $payment->month_year))->result_array();
        $settings = $this->db->where('type', 'system_name')->get('settings')->row();

        return (object) array(
            'payment'      => $payment,
            'teacher'      => $teacher,
            'department'   => $department,
            'designation'  => $designation,
            'allowances'   => $allowances,
            'deductions'   => $deductions,
            'system_name'  => $settings ? $settings->description : ''
        );
    }
}
