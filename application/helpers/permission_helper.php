<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('_get_admin_level')) {
    function _get_admin_level() {
        $CI =& get_instance();
        $level = $CI->session->userdata('level');
        if (!empty($level)) return $level;
        $admin_id = $CI->session->userdata('login_user_id');
        if (empty($admin_id)) return '2';
        $row = $CI->db->select('level')->where('admin_id', $admin_id)->get('admin')->row();
        if ($row) {
            $CI->session->set_userdata('level', $row->level);
            return $row->level;
        }
        return '2';
    }
}

if (!function_exists('has_permission')) {
    function has_permission($permission_key) {
        if (_get_admin_level() == '1') return true;
        $CI =& get_instance();
        $admin_id = $CI->session->userdata('login_user_id');
        if (empty($admin_id)) return false;
        $exists = $CI->db->where('admin_id', $admin_id)->where('permission_key', $permission_key)->count_all_results('admin_permissions');
        return $exists > 0;
    }
}

if (!function_exists('get_admin_permissions')) {
    function get_admin_permissions($admin_id = null) {
        $CI =& get_instance();
        if ($admin_id === null) {
            $admin_id = $CI->session->userdata('login_user_id');
        }
        if (empty($admin_id)) return array();
        $rows = $CI->db->where('admin_id', $admin_id)->get('admin_permissions')->result_array();
        $perms = array();
        foreach ($rows as $row) {
            $perms[$row['permission_key']] = true;
        }
        return $perms;
    }
}

if (!function_exists('has_module_access')) {
    function has_module_access($module_key) {
        return has_permission($module_key);
    }
}

if (!function_exists('has_submodule_access')) {
    function has_submodule_access($module_key, $submodule_key) {
        return has_permission($module_key . '.' . $submodule_key);
    }
}

if (!function_exists('has_action')) {
    function has_action($module_key, $submodule_key, $action) {
        return has_permission($module_key . '.' . $submodule_key . '.' . $action);
    }
}

if (!function_exists('enforce_module_access')) {
    function enforce_module_access($permission_map) {
        $CI =& get_instance();
        if ($CI->session->userdata('admin_login') != 1) return;
        if (_get_admin_level() == '1') return;
        $method = $CI->router->fetch_method();
        if (!isset($permission_map[$method])) return;
        $required = (array) $permission_map[$method];
        foreach ($required as $permission_key) {
            if (has_permission($permission_key)) return;
        }
        $CI->output->set_status_header(403);
        echo $CI->load->view('backend/admin/access_denied', array(), true);
        exit;
    }
}

if (!function_exists('get_login_redirect_url')) {
    function get_login_redirect_url($login_type) {
        $CI =& get_instance();
        if ($login_type !== 'admin') return $login_type . '/dashboard';
        if (_get_admin_level() == '1') return 'admin/dashboard';

        $landing_pages = array(
            'dashboard'                     => 'admin/dashboard',
            'masters.religion'              => 'admin/religion',
            'masters.category'              => 'admin/category',
            'masters.cast'                  => 'admin/caste',
            'masters.mother_tongue'         => 'admin/mother_tongue',
            'masters.previous_school'       => 'admin/previous_school',
            'academics.new_enquiries'       => 'admin/new_enquiries',
            'academics.manage_events'       => 'admin/manage_events',
            'academics.manage_documents'    => 'admin/manage_documents',
            'hr.department'                 => 'admin/department',
            'hr.staff_list'                 => 'admin/staff_list',
            'hr.advance_salary'             => 'admin/advance_salary',
            'hr.salary_payment'             => 'payroll/salary_payment',
            'hr.salary_statement'           => 'payroll/salary_statement',
            'students.academy'              => 'admin/academy',
            'students.board'                => 'admin/board',
            'students.standard'             => 'admin/standard',
            'students.division'             => 'admin/division',
            'students.group'                => 'admin/group',
            'students.pending_admission'    => 'admin/pre_student_information',
            'students.admission_form'       => 'admin/admission_form',
            'students.student_list'         => 'admin/student_list',
            'students.promotion_history'    => 'admin/promotion_history',
            'fees.fees_head'                => 'admin/fees_head',
            'fees.fees_template'            => 'admin/fees_template',
            'fees.create_invoice'           => 'admin/create_invoice',
            'fees.manage_invoice'           => 'admin/manage_invoice',
            'fees.manage_receipt'           => 'admin/manage_receipt',
            'fees.fees_report'              => 'admin/pending_fees',
            'fees.fees_notice_report'       => 'admin/fees_notice_report',
            'fees.fees_discount_report'     => 'admin/fees_discount_report',
            'accounts.bank'                 => 'admin/bank',
            'accounts.bank_account'         => 'admin/bank_account',
            'accounts.cashbook'             => 'admin/cashbook',
            'accounts.daily_cashbook'       => 'admin/daily_cashbook',
            'accounts.bank_statement_report'=> 'admin/bank_statement_report',
            'accounts.daily_expense'        => 'admin/daily_expense',
            'accounts.expense_category'     => 'expense/expense_category',
            'accounts.journal_voucher'      => 'admin/journal_voucher',
            'accounts.jv_report'            => 'admin/journal_voucher_report',
            'reports.std_div_report'        => 'admin/standard_division_report',
            'reports.lc_report'             => 'admin/leaving_certificate_report',
            'reports.religion_category_report' => 'admin/religion_category_report',
            'reports.gender_wise_report'    => 'admin/gender_wise_report',
            'reports.uid_report'            => 'admin/uid_report',
            'reports.student_count_report'  => 'admin/student_count_report',
            'org.org_details'               => 'admin/org_details',
            'org.org_documents'             => 'admin/org_documents',
            'users.new_user'                => 'admin/newAdministrator',
        );

        foreach ($landing_pages as $permission_key => $url) {
            if (has_permission($permission_key)) return $url;
        }

        return 'admin/dashboard';
    }
}
