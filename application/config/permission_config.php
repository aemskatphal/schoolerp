<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['permission_modules'] = array(

    'dashboard' => array(
        'name' => 'Dashboard',
        'icon' => 'ti-dashboard',
        'submodules' => array(),
    ),

    'masters' => array(
        'name' => 'Masters',
        'icon' => 'fa fa-database',
        'submodules' => array(
            'religion'       => array('name' => 'Religion',       'actions' => array('edit', 'delete', 'export', 'create')),
            'category'       => array('name' => 'Category',       'actions' => array('edit', 'delete', 'export', 'create')),
            'cast'           => array('name' => 'Caste',          'actions' => array('edit', 'delete', 'export', 'create')),
            'mother_tongue'  => array('name' => 'Mother Tongue',  'actions' => array('edit', 'delete', 'export', 'create')),
            'previous_school'=> array('name' => 'Previous School','actions' => array('edit', 'delete', 'export', 'create')),
        ),
    ),

    'academics' => array(
        'name' => 'Academics',
        'icon' => 'fa fa-mortar-board',
        'submodules' => array(
            'new_enquiries'   => array('name' => 'New Enquiries',   'actions' => array('edit', 'delete')),
            'manage_events'   => array('name' => 'Manage Events',   'actions' => array('edit', 'delete')),
            'manage_documents'=> array('name' => 'Manage Documents', 'actions' => array('view', 'bulk_lc', 'bulk_idcard', 'bonafide', 'lc', 'form_15a', 'covering', 'character', 'id_card_75')),
        ),
    ),

    'hr' => array(
        'name' => 'Human Resource',
        'icon' => 'fa fa-users',
        'submodules' => array(
            'department'      => array('name' => 'Department',      'actions' => array('edit', 'delete', 'export', 'create')),
            'staff_list'      => array('name' => 'Staff List',      'actions' => array('edit', 'delete', 'export')),
            'advance_salary'  => array('name' => 'Advance Salary',  'actions' => array('edit', 'delete', 'export')),
            'salary_payment'  => array('name' => 'Salary Payment',  'actions' => array('create', 'edit', 'delete', 'export')),
        ),
    ),

    'students' => array(
        'name' => 'Manage Students',
        'icon' => 'fa fa-graduation-cap',
        'submodules' => array(
            'academy'             => array('name' => 'Academy',             'actions' => array('edit', 'delete', 'active', 'export', 'create')),
            'board'               => array('name' => 'Board',               'actions' => array('edit', 'delete', 'export', 'create')),
            'standard'            => array('name' => 'Standard',            'actions' => array('edit', 'delete', 'export', 'create')),
            'division'            => array('name' => 'Division',            'actions' => array('edit', 'delete', 'export', 'create')),
            'group'               => array('name' => 'Group',               'actions' => array('edit', 'delete', 'export', 'create')),
            'pending_admission'   => array('name' => 'Pending Admission',   'actions' => array('view', 'delete', 'export')),
            'admission_form'      => array('name' => 'Admission Form',      'actions' => array()),
            'student_list'        => array('name' => 'Student List',        'actions' => array('student_promotion', 'bulk_lc', 'bulk_idcard', 'view', 'print_form', 'edit', 'delete', 'export')),
            'promotion_history'   => array('name' => 'Promotion History',   'actions' => array()),
        ),
    ),

    'fees' => array(
        'name' => 'Fee Collection',
        'icon' => 'fa fa-credit-card',
        'submodules' => array(
            'fees_head'          => array('name' => 'Fees Head',          'actions' => array('edit', 'delete', 'export', 'create')),
            'fees_template'      => array('name' => 'Fees Template',      'actions' => array('edit', 'delete', 'export')),
            'create_invoice'     => array('name' => 'Create Invoice',     'actions' => array()),
            'manage_invoice'     => array('name' => 'Manage Invoice',     'actions' => array('edit', 'delete', 'export')),
            'manage_receipt'     => array('name' => 'Manage Receipt',     'actions' => array('edit', 'delete', 'export')),
            'fees_report'        => array('name' => 'Fees Report',        'actions' => array()),
            'fees_notice_report' => array('name' => 'Fees Notice Report', 'actions' => array()),
            'fees_discount_report'=>array('name' => 'Fees Discount Report','actions' => array()),
        ),
    ),

    'accounts' => array(
        'name' => 'Accounts',
        'icon' => 'fa fa-book',
        'submodules' => array(
            'bank'                  => array('name' => 'Bank',                  'actions' => array('edit', 'delete', 'export', 'create')),
            'bank_account'          => array('name' => 'Bank Account',          'actions' => array('edit', 'delete', 'export', 'create')),
            'expense_category'      => array('name' => 'Expense Category',      'actions' => array('edit', 'delete', 'export', 'create')),
            'cashbook'              => array('name' => 'Cashbook',              'actions' => array('edit', 'delete', 'export')),
            'daily_cashbook'        => array('name' => 'Daily Cashbook',        'actions' => array()),
            'bank_statement_report' => array('name' => 'Bank Statement Report', 'actions' => array()),
            'daily_expense'         => array('name' => 'Daily Expense',         'actions' => array()),
            'journal_voucher'       => array('name' => 'Journal Voucher',       'actions' => array('edit', 'delete')),
            'jv_report'             => array('name' => 'Journal Voucher Report','actions' => array()),
        ),
    ),

    'reports' => array(
        'name' => 'Reports',
        'icon' => 'fa fa-bar-chart',
        'submodules' => array(
            'std_div_report'            => array('name' => 'Standard & Division Report', 'actions' => array()),
            'lc_report'                 => array('name' => 'Leaving Certificate Report', 'actions' => array()),
            'religion_category_report'  => array('name' => 'Religion Category Report',   'actions' => array()),
            'gender_wise_report'        => array('name' => 'Gender-wise Report',          'actions' => array()),
            'uid_report'                => array('name' => 'UID Report',                  'actions' => array()),
            'student_count_report'      => array('name' => 'Student Count Report',        'actions' => array()),
        ),
    ),

    'org' => array(
        'name' => 'Organization',
        'icon' => 'fa fa-building',
        'submodules' => array(
            'org_details'    => array('name' => 'Org Details',    'actions' => array()),
            'org_documents'  => array('name' => 'Org Documents',  'actions' => array('edit', 'delete')),
        ),
    ),

    'users' => array(
        'name' => 'User Management',
        'icon' => 'fa fa-user-plus',
        'submodules' => array(
            'new_user' => array('name' => 'New User', 'actions' => array('edit', 'delete', 'assign_role')),
        ),
    ),

);

$config['action_labels'] = array(
    'edit'              => 'Edit',
    'delete'            => 'Delete',
    'view'              => 'View',
    'active'            => 'Active',
    'create'            => 'Create',
    'export'            => 'Export',
    'copy'              => 'Copy',
    'csv'               => 'CSV',
    'excel'             => 'Excel',
    'print'             => 'Print',
    'student_promotion' => 'Student Promotion',
    'bulk_lc'           => 'Bulk LC Print',
    'bulk_idcard'       => 'Bulk ID Card Print',
    'print_form'        => 'Print Form',
    'bonafide'          => 'Bonafide',
    'lc'                => 'LC',
    'form_15a'          => 'Form 15A',
    'covering'          => 'Covering',
    'character'         => 'Character',
    'id_card_75'        => 'ID Card 75% Attendance',
    'assign_role'       => 'Assign Role',
);
