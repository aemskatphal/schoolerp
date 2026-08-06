    <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                    </li>
                    <li class="user-pro">
                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) { $face_file = 'uploads/default.jpg'; }
                        ?>
                        <a class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">
                        <?php
                            $account_type = $this->session->userdata('login_type');
                            $account_id   = $account_type.'_id';
                            $name = $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                            echo $name;
                        ?></span></a>
                    </li>

                    <!-- Dashboard -->
                    <?php if (has_module_access('dashboard')): ?>
                    <li><a href="<?php echo base_url();?>admin/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a></li>
                    <?php endif; ?>

                    <!-- Masters -->
                    <?php if (has_module_access('masters')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database" data-icon="7"></i> <span class="hide-menu">Masters<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="masters">
                            <?php if (has_submodule_access('masters', 'religion')): ?>
                            <li><a href="<?php echo base_url();?>admin/religion">Religion</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('masters', 'category')): ?>
                            <li><a href="<?php echo base_url();?>admin/category">Category</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('masters', 'cast')): ?>
                            <li><a href="<?php echo base_url();?>admin/caste">Caste</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('masters', 'mother_tongue')): ?>
                            <li><a href="<?php echo base_url();?>admin/mother_tongue">Mother Tongue</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('masters', 'previous_school')): ?>
                            <li><a href="<?php echo base_url();?>admin/previous_school">Previous School</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Academics -->
                    <?php if (has_module_access('academics')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-mortar-board" data-icon="7"></i> <span class="hide-menu">Academics<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="academics">
                            <?php if (has_submodule_access('academics', 'new_enquiries')): ?>
                            <li><a href="<?php echo base_url();?>admin/new_enquiries">New Enquiries</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('academics', 'manage_events')): ?>
                            <li><a href="<?php echo base_url();?>admin/manage_events">Manage Events</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('academics', 'manage_documents')): ?>
                            <li><a href="<?php echo base_url();?>admin/manage_documents">Manage Documents</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Human Resource -->
                    <?php if (has_module_access('hr')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" data-icon="7"></i> <span class="hide-menu">Human Resource<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="hr">
                            <?php if (has_submodule_access('hr', 'department')): ?>
                            <li><a href="<?php echo base_url();?>admin/department">Department</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('hr', 'staff_list')): ?>
                            <li><a href="<?php echo base_url();?>admin/staff_list">Staff List</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('hr', 'advance_salary')): ?>
                            <li><a href="<?php echo base_url();?>payroll/advance_salary">Advance Salary</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('hr', 'salary_payment')): ?>
                            <li><a href="<?php echo base_url();?>payroll/salary_payment">Salary Payment</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url();?>payroll/salary_statement">Salary Statement</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Manage Students -->
                    <?php if (has_module_access('students')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap" data-icon="7"></i> <span class="hide-menu">Manage Students<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="students">
                            <?php if (has_submodule_access('students', 'academy')): ?>
                            <li><a href="<?php echo base_url();?>admin/academy">Academy</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'board')): ?>
                            <li><a href="<?php echo base_url();?>admin/board">Board</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'standard')): ?>
                            <li><a href="<?php echo base_url();?>admin/standard">Standard</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'division')): ?>
                            <li><a href="<?php echo base_url();?>admin/division">Division</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'group')): ?>
                            <li><a href="<?php echo base_url();?>admin/group">Group</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'pending_admission')): ?>
                            <li><a href="<?php echo base_url();?>admin/pre_student_information">Pending Admission</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'admission_form')): ?>
                            <li><a href="<?php echo base_url();?>admin/admission_form">Admission Form</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'student_list')): ?>
                            <li><a href="<?php echo base_url();?>admin/student_list">Student List</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('students', 'promotion_history')): ?>
                            <li><a href="<?php echo base_url();?>admin/promotion_history">Promotion History</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Fee Collection -->
                    <?php if (has_module_access('fees')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-credit-card" data-icon="7"></i> <span class="hide-menu">Fee Collection<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="fees">
                            <?php if (has_submodule_access('fees', 'fees_head')): ?>
                            <li><a href="<?php echo base_url();?>admin/fees_head">Fees Head</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'fees_template')): ?>
                            <li><a href="<?php echo base_url();?>admin/fees_template">Fees Template</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'create_invoice')): ?>
                            <li><a href="<?php echo base_url();?>admin/student_payment">Create Invoice</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'manage_invoice')): ?>
                            <li><a href="<?php echo base_url();?>admin/student_invoice">Manage Invoice</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'manage_receipt')): ?>
                            <li><a href="<?php echo base_url();?>admin/manage_receipt">Manage Receipt</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'fees_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/pending_fees">Fees Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'fees_notice_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/fees_notice_report">Fees Notice Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('fees', 'fees_discount_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/fees_discount_report">Fees Discount Report</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Accounts -->
                    <?php if (has_module_access('accounts')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book" data-icon="7"></i> <span class="hide-menu">Accounts<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="accounts">
                            <?php if (has_submodule_access('accounts', 'bank')): ?>
                            <li><a href="<?php echo base_url();?>admin/bank">Bank</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'bank_account')): ?>
                            <li><a href="<?php echo base_url();?>admin/bank_account">Bank Account</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'expense_category')): ?>
                            <li><a href="<?php echo base_url();?>expense/expense_category">Expense Category</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'cashbook')): ?>
                            <li><a href="<?php echo base_url();?>admin/cashbook">Cashbook</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'daily_cashbook')): ?>
                            <li><a href="<?php echo base_url();?>admin/daily_cashbook">Daily Cashbook</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'bank_statement_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/bank_statement_report">Bank Statement Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'daily_expense')): ?>
                            <li><a href="<?php echo base_url();?>admin/daily_expense">Daily Expense</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'journal_voucher')): ?>
                            <li><a href="<?php echo base_url();?>admin/journal_voucher">Journal Voucher</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('accounts', 'jv_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/journal_voucher_report">Journal Voucher Report</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Reports -->
                    <?php if (has_module_access('reports')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart" data-icon="7"></i> <span class="hide-menu">Reports<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="reports">
                            <?php if (has_submodule_access('reports', 'std_div_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/standard_division_report">Standard &amp; Division Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('reports', 'lc_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/leaving_certificate_report">Leaving Certificate Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('reports', 'religion_category_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/religion_category_report">Religion Category Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('reports', 'gender_wise_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/gender_wise_report">Gender-wise Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('reports', 'uid_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/uid_report">UID Report</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('reports', 'student_count_report')): ?>
                            <li><a href="<?php echo base_url();?>admin/student_count_report">Student Count Report</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Organization -->
                    <?php if (has_module_access('org')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building" data-icon="7"></i> <span class="hide-menu">Organization<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="org">
                            <?php if (has_submodule_access('org', 'org_details')): ?>
                            <li><a href="<?php echo base_url();?>admin/org_details">Org Details</a></li>
                            <?php endif; ?>
                            <?php if (has_submodule_access('org', 'org_documents')): ?>
                            <li><a href="<?php echo base_url();?>admin/org_documents">Org Documents</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- User Management -->
                    <?php if (has_module_access('users')): ?>
                    <li><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-plus" data-icon="7"></i> <span class="hide-menu">User Management<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level" data-nav="users">
                            <?php if (has_submodule_access('users', 'new_user')): ?>
                            <li><a href="<?php echo base_url();?>admin/newAdministrator">New User</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Logout -->
                    <li><a href="<?php echo base_url();?>login/logout" class="waves-effect"><i class="fa fa-power-off p-r-10"></i> <span class="hide-menu">Logout</span></a></li>

                </ul>
            </div>
        </div>
