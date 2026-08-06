<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('student_model');                    // Load Apllication Model Here
                $this->load->model('exam_question_model');              // Load Apllication Model Here
                $this->load->model('student_payment_model');            // Load Apllication Model Here
                $this->load->model('event_model');                      // Load Apllication Model Here
                $this->load->model('language_model');                      // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
                $this->load->model('religion_model');                   // Load Religion Model Here
                $this->load->model('academy_model');                    // Load Academy Model Here
                $this->load->model('board_model');                      // Load Board Model Here
                $this->load->model('fees_head_model');                  // Load Fees Head Model Here
                $this->load->model('fees_template_model');               // Load Fees Template Model Here
                $this->_enforce_module_access();                         // Enforce role based module access
    }

    /**Role based module access check - blocks direct URL access to modules the admin has no permission for**/
    private function _enforce_module_access() {
        enforce_module_access($this->_admin_access_map());
    }

    private function _admin_access_map() {
        $map = array(
            // dashboard
            'dashboard'                    => array('dashboard'),
            'dashboard_counter'            => array('dashboard'),
            'dashboard_counter_yearwaise'  => array('dashboard'),
            'dashboard_counter_daywaise'   => array('dashboard'),
            'dailyreport'                  => array('dashboard'),

            // masters
            'religion'                     => array('masters.religion'),
            'category'                     => array('masters.category'),
            'caste'                        => array('masters.cast'),
            'mother_tongue'                => array('masters.mother_tongue'),
            'previous_school'              => array('masters.previous_school'),
            'modal_add_cast'               => array('masters.cast'),
            'modal_add_previous_school'    => array('masters.previous_school'),

            // academics
            'new_enquiries'                => array('academics.new_enquiries'),
            'list_enquiry'                 => array('academics.new_enquiries'),
            'enquiry_category'             => array('academics.new_enquiries'),
            'manage_events'                => array('academics.manage_events'),
            'manage_documents'             => array('academics.manage_documents'),
            'documentList'                 => array('academics.manage_documents'),
            'print_student_document'       => array('academics.manage_documents'),

            // hr
            'department'                   => array('hr.department'),
            'get_designation'              => array('hr.department'),
            'delete_designation'           => array('hr.department'),
            'staff_list'                   => array('hr.staff_list'),
            'get_employees'                => array('hr.staff_list'),
            'staff_status'                 => array('hr.staff_list'),
            'edit_staff'                   => array('hr.staff_list'),
            'advance_salary'               => array('hr.advance_salary'),

            // students
            'academy'                      => array('students.academy'),
            'view_academy'                 => array('students.academy'),
            'academy_counter'              => array('students.academy'),
            'academyqrcodeprintFn'         => array('students.academy'),
            'generateAcademyQrCode'        => array('students.academy'),
            'modal_add_academy'            => array('students.academy'),
            'board'                        => array('students.board'),
            'modal_add_board'              => array('students.board'),
            'standard'                     => array('students.standard'),
            'classes'                      => array('students.standard'),
            'division'                     => array('students.division'),
            'section'                      => array('students.division'),
            'sections'                     => array('students.division'),
            'group'                        => array('students.group'),
            'modal_add_group'              => array('students.group'),
            'pre_student_information'      => array('students.pending_admission'),
            'prestudentList'               => array('students.pending_admission'),
            'view_pre_student'             => array('students.pending_admission'),
            'view_pre_student_update'      => array('students.pending_admission'),
            '_approve_pre_student'         => array('students.pending_admission'),
            'admission_form'               => array('students.admission_form'),
            'checkforgrn'                  => array('students.admission_form'),
            'new_student'                  => array('students.student_list'),
            'student_list'                 => array('students.student_list'),
            'studentList'                  => array('students.student_list'),
            'getStudentClasswise'          => array('students.student_list'),
            'student_information'          => array('students.student_list'),
            'edit_student'                 => array('students.student_list'),
            'resetStudentPassword'         => array('students.student_list'),
            'delete_student'               => array('students.student_list'),
            'view_student'                 => array('students.student_list'),
            'view_student_update'          => array('students.student_list'),
            'view_student_add_document'    => array('students.student_list'),
            'view_student_update_document' => array('students.student_list'),
            'view_student_delete_document' => array('students.student_list'),
            'student_transfer_modal'       => array('students.student_list'),
            'student_transfer'             => array('students.student_list'),
            'qrcodeprintFn'                => array('students.student_list'),
            'print_student_form'           => array('students.student_list'),
            'promotion_history'            => array('students.promotion_history'),
            'promotion_history_list'       => array('students.promotion_history'),

            // fees
            'fees_head'                    => array('fees.fees_head'),
            'get_all_feehead'              => array('fees.fees_head'),
            'get_feehead_info'             => array('fees.fees_head'),
            'fees_template'                => array('fees.fees_template'),
            'create_fees_template'         => array('fees.fees_template'),
            'checkfeestemplate'            => array('fees.fees_template'),
            'edit_fees_template'           => array('fees.fees_template'),
            'fees_template_update'         => array('fees.fees_template'),
            'feestempList'                 => array('fees.fees_template'),
            'student_payment'              => array('fees.create_invoice'),
            'create_invoice'               => array('fees.create_invoice'),
            'get_class_student'            => array('fees.create_invoice'),
            'get_class_mass_student'       => array('fees.create_invoice'),
            'get_fess_template'            => array('fees.create_invoice'),
            'student_invoice'              => array('fees.manage_invoice'),
            'manage_invoice'               => array('fees.manage_invoice'),
            'student_invoice_dashboard'    => array('fees.manage_invoice'),
            'invoiceList'                  => array('fees.manage_invoice'),
            'student_invoice_details'      => array('fees.manage_invoice'),
            'edit_invoice'                 => array('fees.manage_invoice'),
            'student_payment_single'       => array('fees.manage_invoice'),
            'manage_receipt'               => array('fees.manage_receipt'),
            'receiptList'                  => array('fees.manage_receipt'),
            'edit_receipt'                 => array('fees.manage_receipt'),
            'delete_receipt'               => array('fees.manage_receipt'),
            'pending_fees'                 => array('fees.fees_report'),
            'fees_report'                  => array('fees.fees_report'),
            'get_class_section_fees'       => array('fees.fees_report'),
            'fees_notice_report'           => array('fees.fees_notice_report'),
            'fees_discount_report'         => array('fees.fees_discount_report'),

            // accounts
            'bank'                         => array('accounts.bank'),
            'bank_account'                 => array('accounts.bank_account'),
            'cashbook'                     => array('accounts.cashbook'),
            'cashbookList'                 => array('accounts.cashbook'),
            'daily_cashbook'               => array('accounts.daily_cashbook'),
            'bank_statement_report'        => array('accounts.bank_statement_report'),
            'daily_expense'                => array('accounts.daily_expense'),
            'journal_voucher'              => array('accounts.journal_voucher'),
            'journal_voucher_print'        => array('accounts.journal_voucher'),
            'get_client_list'              => array('accounts.journal_voucher'),
            'add_client_ajax'              => array('accounts.journal_voucher'),
            'journal_voucher_report'       => array('accounts.jv_report'),

            // reports
            'standard_division_report'     => array('reports.std_div_report'),
            'leaving_certificate_report'   => array('reports.lc_report'),
            'religion_category_report'     => array('reports.religion_category_report'),
            'gender_wise_report'           => array('reports.gender_wise_report'),
            'uid_report'                   => array('reports.uid_report'),
            'student_count_report'         => array('reports.student_count_report'),

            // org
            'org_details'                  => array('org.org_details'),
            'org_documents'                => array('org.org_documents'),

            // users
            'newAdministrator'             => array('users.new_user'),
            'updateAdminRole'              => array('users.new_user'),
            'save_admin_permissions'       => array('users.new_user'),
        );
        return $map;
    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() 
	{
    if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login') == 1) redirect(base_url() . get_login_redirect_url('admin'), 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */


    function manage_profile($param1 = null, $param2 = null, $param3 = null){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function enquiry_category($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'insert'){
   
        $this->crud_model->enquiry_category();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);


        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

       $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function list_enquiry ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->crud_model->insert_enquiry();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
        }

        if($param1 == 'delete')
        {
            if($this->input->post('enq_ids')){
                $ids = explode(',', $this->input->post('enq_ids'));
                $this->crud_model->bulk_delete_enquiry($ids);
            } else {
                $this->crud_model->delete_enquiry($param2);
            }
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            if($this->input->post('enq_ids')){
                echo 'ok';
                exit;
            }
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
    
        }

        $page_data['page_name']     = 'list_enquiry';
        $page_data['page_title']    = get_phrase('All Enquiries');
        $page_data['select_enquiry']  = $this->db->get('enquiry')->result_array();
        $this->load->view('backend/index', $page_data);

    }

    function new_enquiries($param1 = null, $param2 = null, $param3 = null){
        $this->list_enquiry($param1, $param2, $param3);
    }



    function club ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->crud_model->insert_club();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'update'){
            $this->crud_model->update_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }


        if($param1 == 'delete'){
            $this->crud_model->delete_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
    
            }


        $page_data['page_name']     = 'club';
        $page_data['page_title']    = get_phrase('Manage Club');
        $page_data['select_club']  = $this->db->get('club')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function circular($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_circular();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/circular', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/circular', 'refresh');

        }


        if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/circular', 'refresh');


        }

        $page_data['page_name']         = 'circular';
        $page_data['page_title']        = get_phrase('Manage Circular');
        $page_data['select_circular']   = $this->db->get('circular')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function parent($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_parent();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/parent', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        $page_data['page_name']         = 'parent';
        $page_data['page_title']        = get_phrase('Manage Parent');
        $page_data['select_parent']   = $this->db->get('parent')->result_array();
        $this->load->view('backend/index', $page_data);
    }


 





  


    function teacher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }


        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
    
        }

        $page_data['page_name']     = 'teacher';
        $page_data['page_title']    = get_phrase('Manage Teacher');
        $page_data['select_teacher']  = $this->db->get('teacher')->result_array();
        $this->load->view('backend/index', $page_data);

    }

    function get_designation($department_id = null){

        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

 


    function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }


    /***********  The function manages Staff List  ***********************/
    function staff_list($param1 = null, $param2 = null, $param3 = null){

        $this->session->set_flashdata('error_message', '');

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/staff_list', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/staff_list', 'refresh');
        }

        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/staff_list', 'refresh');
        }

        $page_data['page_name']      = 'staff_list';
        $page_data['page_title']     = get_phrase('Staff List');
        $page_data['select_teacher'] = $this->db->get('teacher')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function staff_status($teacher_id = null){
        $teacher = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        if($teacher->status == 1)
            $new_status = 2;
        else
            $new_status = 1;
        $this->db->where('teacher_id', $teacher_id);
        $this->db->update('teacher', array('status' => $new_status));
        redirect(base_url(). 'admin/staff_list', 'refresh');
    }

    function edit_staff($teacher_id = null){
        $this->session->set_flashdata('error_message', '');
        $page_data['page_name']  = 'edit_staff';
        $page_data['page_title'] = get_phrase('Edit Staff');
        $page_data['teacher_id'] = $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    function get_religion_cast($re_id = null){
        $cast = $this->db->get_where('cast', array('re_id' => $re_id))->result_array();
        echo '<option value="">Select</option>';
        foreach($cast as $row){
            echo '<option value="'.$row['cast_id'].'">'.$row['cast_name'].'</option>';
        }
    }

    function modal_add_cast($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'insert'){
            $data = array(
                're_id'      => $this->input->post('re_id'),
                'cat_id'     => $this->input->post('cat_id'),
                'cast_name'  => html_escape($this->input->post('cast_name'))
            );
            $this->db->insert('cast', $data);
            echo json_encode(array('status' => 'ok', 'id' => $this->db->insert_id(), 'name' => $data['cast_name']));
        }else{
            $page_data['religions'] = $this->db->get('religion')->result_array();
            $page_data['categories'] = $this->db->get('category')->result_array();
            $this->load->view('backend/admin/modal_add_cast.php', $page_data);
        }
    }

    function modal_add_academy($param1 = null){
        if($param1 == 'insert'){
            $data = array(
                'academy_name' => html_escape($this->input->post('academy_name')),
                'email'        => html_escape($this->input->post('email')),
                'password'     => sha1($this->input->post('password')),
            );
            $this->db->insert('academy', $data);
            echo json_encode(array('status' => 'ok', 'id' => $this->db->insert_id(), 'name' => $data['academy_name']));
        }else{
            $this->load->view('backend/admin/modal_add_academy.php');
        }
    }

    function modal_add_board($param1 = null){
        if($param1 == 'insert'){
            $data = array(
                'board_name' => html_escape($this->input->post('board_name'))
            );
            $this->db->insert('board', $data);
            echo json_encode(array('status' => 'ok', 'id' => $this->db->insert_id(), 'name' => $data['board_name']));
        }else{
            $this->load->view('backend/admin/modal_add_board.php');
        }
    }

    function modal_add_previous_school($param1 = null){
        if($param1 == 'insert'){
            $data = array(
                'name' => html_escape($this->input->post('name')),
                'contactname' => html_escape($this->input->post('contactname')),
                'phone' => html_escape($this->input->post('phone')),
                'email' => html_escape($this->input->post('email')),
                'address' => html_escape($this->input->post('address')),
            );
            $this->db->insert('previous_school', $data);
            echo json_encode(array('status' => 'ok', 'id' => $this->db->insert_id(), 'name' => $data['name']));
        }else{
            $this->load->view('backend/admin/modal_add_previous_school.php');
        }
    }

    function modal_add_group($param1 = null){
        if($param1 == 'insert'){
            $data = array(
                'group_name' => html_escape($this->input->post('group_name'))
            );
            $this->db->insert('student_group', $data);
            echo json_encode(array('status' => 'ok', 'id' => $this->db->insert_id(), 'name' => $data['group_name']));
        }else{
            $this->load->view('backend/admin/modal_add_group.php');
        }
    }


    /***********  The function manages Advance Salary  ***********************/
    function advance_salary($param1 = null, $param2 = null, $param3 = null){

        $this->session->set_flashdata('error_message', '');

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
                'entry_user'          => $this->session->userdata('login_type') == 'admin' ? 'Administrator' : $this->session->userdata('login_type')
            );
            $this->db->insert('advance_salary', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/advance_salary', 'refresh');
        }

        if($param1 == 'delete'){
            $this->db->where('advance_salary_id', $param2);
            $this->db->delete('advance_salary');
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/advance_salary', 'refresh');
        }

        if($param1 == 'status'){
            $record = $this->db->get_where('advance_salary', array('advance_salary_id' => $param2))->row();
            if($record->status == 0)
                $new_status = 1;
            else
                $new_status = 0;
            $this->db->where('advance_salary_id', $param2);
            $this->db->update('advance_salary', array('status' => $new_status));
            redirect(base_url(). 'admin/advance_salary', 'refresh');
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
            redirect(base_url(). 'admin/advance_salary', 'refresh');
        }

        $page_data['page_name']        = 'advance_salary';
        $page_data['page_title']       = get_phrase('Advance Salary');
        $page_data['advance_salaries'] = $this->db->order_by('advance_salary_id', 'desc')->get('advance_salary')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    /***********  The function manages Class Information  ***********************/
      function classes ($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
            $this->class_model->createClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }

        if($param1 == 'update'){
            $this->class_model->updateClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }


        if($param1 == 'delete'){
            $this->class_model->deleteClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
    
        }

        $page_data['page_name']     = 'class';
        $page_data['page_title']    = get_phrase('Manage Class');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages Section  ***********************/
    function section ($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
        $this->section_model->createSectionFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/division', 'refresh');
        }

        if($param1 == 'update'){
        $this->section_model->updateSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/division', 'refresh');
        }

        if($param1 == 'delete'){
        $this->section_model->deleteSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/division', 'refresh');
        }

        $page_data['page_name']     = 'section';
        $page_data['page_title']    = get_phrase('Manage Division');
        $this->load->view('backend/index', $page_data);
    }

    function division ($param1 = null, $param2 = null, $param3 = null){
        return $this->section($param1, $param2, $param3);
    }

        function sections ($class_id = null){

            if($class_id == '')
            $class_id = $this->db->get('class')->first_row()->class_id;
            
            $page_data['page_name']     = 'section';
            $page_data['class_id']      = $class_id;
            $page_data['page_title']    = get_phrase('Manage Section');
            $this->load->view('backend/index', $page_data);

        }
    



    function get_class_section_subject($class_id){
        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector', $page_data);

    }



    function section_subject_edit($class_id, $class_routine_id){

    $page_data['class_id']          =   $class_id;
    $page_data['class_routine_id']  =   $class_routine_id;
    $this->load->view('backend/admin/class_routine_section_subject_edit', $page_data);

    }


    /***********  The function manages school dormitory  ***********************/
    function dormitory ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createDormitoryFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');

    }

    $page_data['page_name']     = 'dormitory';
    $page_data['page_title']    = get_phrase('Manage Dormitory');
    $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages hostel room  ***********************/
    function hostel_room ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createHostelRoomFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');

    }

    $page_data['page_name']     = 'hostel_room';
    $page_data['page_title']    = get_phrase('Hostel Room');
    $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages hostel category  ***********************/
    function hostel_category ($param1 = null, $param2 = null, $param3 = null){

    if($param1 == 'create'){
        $this->dormitory_model->createHostelCategoryFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');

    }

    $page_data['page_name']     = 'hostel_category';
    $page_data['page_title']    = get_phrase('Hostel Category');
    $this->load->view('backend/index', $page_data);
    }



    /***********  The function manages academic syllabus ***********************/
    function academic_syllabus ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
        $this->academic_model->createAcademicSyllabus();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }

    if($param1 == 'update'){
        $this->academic_model->updateAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }


    if($param1 == 'delete'){
        $this->academic_model->deleteAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');

        }

        $page_data['page_name']     = 'academic_syllabus';
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    function get_class_subject($class_id){
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
            foreach($subjects as $key => $subject)
            {
                echo '<option value="'.$subject['subject_id'].'">'.$subject['name'].'</option>';
            }
    }

    function get_class_section($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }
    }


    function download_academic_syllabus($academic_syllabus_code){
        $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
        // Loading download from helper.
        $this->load->helper('download');
        $get_download_content = file_get_contents('uploads/syllabus' . $get_file_name);
        $name = $file_name;
        force_download($name, $get_download_content);
    }

    function get_academic_syllabus ($class_id = null){

        if($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
        
        $page_data['page_name']     = 'academic_syllabus';
        $page_data['class_id']      = $class_id;
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete student from students' table ***********************/
    function new_student ($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
            $this->student_model->createNewStudent();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'update'){
            $this->student_model->updateNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'delete'){
            $this->student_model->deleteNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');

        }

        $page_data['page_name']     = 'new_student';
        $page_data['page_title']    = get_phrase('Admission Form');
        $this->load->view('backend/index', $page_data);
    }

    function admission_form($param1 = null, $param2 = null, $param3 = null){
        return $this->new_student($param1, $param2, $param3);
    }

    function student_list(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $this->student_information();
    }

    /**************************  search student function with ajax starts here   ***********************************/
    function getStudentClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/showStudentClasswise', $page_data);
    }
    /**************************  search student function with ajax ends here   ***********************************/


    function edit_student($student_id){

        $page_data['student_id']      = $student_id;
        $page_data['page_name']     = 'edit_student';
        $page_data['page_title']    = get_phrase('Edit Student');
        $this->load->view('backend/index', $page_data);
    }


    function resetStudentPassword ($student_id) {
        $password['password']               =   sha1($this->input->post('new_password'));
        $confirm_password['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
        if ($password['password'] == $confirm_password['confirm_new_password']) {
           $this->db->where('student_id', $student_id);
           $this->db->update('student', $password);
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/student_information', 'refresh');
    }

    function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
        
        if ($_POST) {
	
            // Loop all the students of $class_id
            $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $key => $student) {
            $attendance_status = $this->input->post('status_' . $student['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $student['student_id']);
            $this->db->where('date', $full_date);
    
            $this->db->update('attendance', array('status' => $attendance_status));
    
                   if ($attendance_status == 2) 
            {
                     // SMS notification removed
            }
        }
    
            $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
            redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
        }

        $page_data['date'] = $date;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['page_title'] = get_phrase('Manage Attendance');
        $this->load->view('backend/index', $page_data);

    }

    function attendance_selector(){
        $date = $this->input->post('timestamp');
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");
        redirect(base_url(). 'admin/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
    }


    function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
        
        if ($_POST) {
        redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
        }
        
        $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        foreach ($classes as $key => $class) {
            if (isset($class_id) && $class_id == $class['class_id'])
                $class_name = $class['name'];
            }
                    
        $sections = $this->db->get('section')->result_array();
            foreach ($sections as $key => $section) {
                if (isset($section_id) && $section_id == $section['section_id'])
                    $section_name = $section['name'];
        }
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
        $this->load->view('backend/index', $page_data);
    }


    /******************** Load attendance with ajax code starts from here **********************/
	function loadAttendanceReport($class_id, $section_id, $month, $year)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $this->load->view('backend/admin/loadAttendanceReport' , $page_data);
    }
    /******************** Load attendance with ajax code ends from here **********************/
    

    /******************** print attendance report **********************/
	function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
    {
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $page_data['page_name'] = 'printAttendanceReport';
        $page_data['page_title'] = "Attendance Report";
        $this->load->view('backend/index', $page_data);
    }
    /******************** /Ends here **********************/
    


     /***********  The function below add, update and delete exam question table ***********************/
    function examQuestion ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->exam_question_model->createexamQuestion();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_question_model->updateexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_question_model->deleteexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        $page_data['page_name']     = 'examQuestion';
        $page_data['page_title']    = get_phrase('Exam Question');
        $this->load->view('backend/index', $page_data);
    }
     /***********  The function below add, update and delete exam question table ends here ***********************/


    /***********  The function below add, update and delete examination table ***********************/
    function createExamination ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->exam_model->createExamination();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_model->updateExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_model->deleteExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        $page_data['page_name']     = 'createExamination';
        $page_data['page_title']    = get_phrase('Create Exam');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete examination table ends here ***********************/

    /***********  The function below add, update and delete student payment table ***********************/
    function create_invoice($student_id = null){
        if($student_id){
            $inv_count = $this->db->get_where('invoice', array('student_id' => $student_id))->num_rows();
            if($inv_count > 0){
                redirect(base_url().'admin/student_invoice_details/'.$student_id, 'refresh');
                return;
            }
        }
        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Create Invoice');
        $page_data['student_id']    = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_payment ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'single_invoice'){
            $this->student_payment_model->createStudentSinglePaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            $redirect_student_id = $this->input->post('redirect_student_id');
            if($redirect_student_id){
                redirect(base_url(). 'admin/student_invoice_details/'.$redirect_student_id, 'refresh');
            }else{
                redirect(base_url(). 'admin/student_invoice', 'refresh');
            }
        }

        if($param1 == 'mass_invoice'){
            $this->student_payment_model->createStudentMassPaymentFunction();
            $student_ids = $this->input->post('student_id');
            $first_student_id = !empty($student_ids) ? $student_ids[0] : null;
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            if($first_student_id){
                redirect(base_url(). 'admin/student_invoice_details/'.$first_student_id, 'refresh');
            } else {
                redirect(base_url(). 'admin/student_invoice', 'refresh');
            }
        }

        if($param1 == 'update_invoice'){
            $this->student_payment_model->updateStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'delete_discount_attmt'){
            $inv = $this->db->get_where('invoice', array('invoice_id' => $param2))->row_array();
            if($inv && !empty($inv['discount_file'])){
                $file_path = FCPATH . 'uploads/discount/' . $inv['discount_file'];
                if(file_exists($file_path)) unlink($file_path);
            }
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', array('discount_file' => '', 'discount' => 0));
            $this->session->set_flashdata('flash_message', get_phrase('Discount attachment deleted'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'take_payment'){
            $this->student_payment_model->takeNewPaymentFromStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/manage_receipt', 'refresh');
        }

        if($param1 == 'carry_forward'){
            $done = $this->student_payment_model->carryForwardDueFunction(intval($param2));
            $this->session->set_flashdata('flash_message', $done ? get_phrase('Previous dues carried forward successfully') : get_phrase('No outstanding dues to carry forward'));
            $inv = $this->db->get_where('invoice', array('invoice_id' => intval($param2)))->row_array();
            $redirect_student_id = !empty($inv) ? $inv['student_id'] : null;
            redirect(base_url(). 'admin/student_invoice_details/'.$redirect_student_id, 'refresh');
        }


        if($param1 == 'delete_invoice'){
            $this->student_payment_model->deleteStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Student Payment');
        $this->load->view('backend/index', $page_data);
    }   
    /***********  / Student payment ends here ***********************/

    /***********  Receipt starts here ***********************/
    function manage_receipt(){
        $page_data['page_name']  = 'manage_receipt';
        $page_data['page_title'] = get_phrase('Manage Receipt');
        $page_data['class_id']   = $this->input->get('class_id');
        $page_data['from']       = $this->input->get('from');
        $page_data['to']         = $this->input->get('to');
        $page_data['year']       = $this->input->get('year');
        $this->load->view('backend/index', $page_data);
    }

    function receiptList(){
        if(!$this->session->userdata('admin_login')){
            echo json_encode(array('draw'=>1,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>array()));
            return;
        }

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $class_id = $this->input->post('class_id');
        $admin_id = $this->input->post('admin_id');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $year = $this->input->post('year');

        $total_records = $this->db->query("SELECT COUNT(*) as cnt FROM payment WHERE payment_type='income'")->row()->cnt;

        $where = "payment.payment_type='income'";
        if(!empty($class_id)){
            $where .= " AND COALESCE(invoice.class_id, student.class_id)='" . intval($class_id) . "'";
        }
        if(!empty($year)){
            $where .= " AND payment.year='" . $this->db->escape_str($year) . "'";
        }
        if(!empty($from)){
            $where .= " AND payment.timestamp >= " . intval(strtotime($from));
        }
        if(!empty($to)){
            $where .= " AND payment.timestamp <= " . intval(strtotime($to) + 86399);
        }
        if(!empty($admin_id)){
            $admin = $this->db->get_where('admin', array('admin_id' => $admin_id))->row_array();
            if($admin){
                $where .= " AND student.entry_user='" . $this->db->escape_str($admin['name']) . "'";
            }
        }

        $search = $this->input->post('search');
        $search_value = isset($search['value']) ? trim($search['value']) : '';
        if(!empty($search_value)){
            $s = $this->db->escape_like_str($search_value);
            $where .= " AND (CAST(payment.payment_id AS CHAR) LIKE '%" . $s . "%'
                OR CAST(payment.invoice_id AS CHAR) LIKE '%" . $s . "%'
                OR student.name LIKE '%" . $s . "%'
                OR payment.year LIKE '%" . $s . "%'
                OR class.name LIKE '%" . $s . "%'
                OR CAST(payment.amount AS CHAR) LIKE '%" . $s . "%'
                OR REPLACE(FORMAT(payment.amount, 0), ',', '') LIKE '%" . $s . "%'
                OR payment.description LIKE '%" . $s . "%'
                OR CASE payment.method WHEN '1' THEN 'Online' WHEN '2' THEN 'Cash' WHEN '3' THEN 'Cheque' ELSE payment.method END LIKE '%" . $s . "%'
                OR payment.entry_user LIKE '%" . $s . "%'
                OR CONCAT(payment.payment_id, '-', YEAR(FROM_UNIXTIME(payment.timestamp))) LIKE '%" . $s . "%')";
        }

        $filtered_result = $this->db->query("SELECT COUNT(*) as cnt FROM payment
            LEFT JOIN student ON student.student_id = payment.student_id
            LEFT JOIN invoice ON invoice.invoice_id = payment.invoice_id
            LEFT JOIN class ON class.class_id = COALESCE(invoice.class_id, student.class_id)
            WHERE $where");
        $filtered_records = $filtered_result->row()->cnt;

        $sql = "SELECT payment.*, invoice.class_id as inv_class_id, student.name as student_name, student.class_id as student_class_id, student.entry_user 
                FROM payment 
                LEFT JOIN invoice ON invoice.invoice_id = payment.invoice_id
                LEFT JOIN student ON student.student_id = payment.student_id 
                LEFT JOIN class ON class.class_id = COALESCE(invoice.class_id, student.class_id)
                WHERE $where 
                ORDER BY payment.payment_id DESC 
                LIMIT " . intval($length) . " OFFSET " . intval($start);
        $payments = $this->db->query($sql)->result_array();

        $data = array();
        foreach($payments as $row){
            $inv_class_id = !empty($row['inv_class_id']) ? $row['inv_class_id'] : $row['student_class_id'];
            $class_info = $this->db->get_where('class', array('class_id' => $inv_class_id))->row_array();
            $std_name = $class_info ? $class_info['name'] : '-';

            $receipt_no = $row['payment_id'] . '-' . date('Y', $row['timestamp']);

            if($row['method'] == '1') $method = 'Online';
            elseif($row['method'] == '2') $method = 'Cash';
            elseif($row['method'] == '3') $method = 'Cheque';
            else $method = $row['method'];

            $student_name = $row['student_name'] ? $row['student_name'] : '-';
            $entry_user = $row['entry_user'] ? $row['entry_user'] : '-';

            $action = '';
            if (has_action('fees', 'manage_receipt', 'view')) {
                $action .= '<a href="'.base_url('report/view/StudentpaymentReceipt/'.$row['invoice_id'].'/'.$row['payment_id']).'" target="_blank"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-print"></i></button></a> ';
            }
            if (has_action('fees', 'manage_receipt', 'edit')) {
                $action .= '<button type="button" onclick="showAjaxModal(\''.base_url().'modal/popup/edit_receipt/'.$row['payment_id'].'\')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button> ';
            }
            if (has_action('fees', 'manage_receipt', 'delete')) {
                $action .= '<button type="button" onclick="confirm_modal(\''.base_url().'admin/delete_receipt/'.$row['payment_id'].'\')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button>';
            }

            $data[] = array(
                $row['payment_id'],
                date('d-m-Y', $row['timestamp']),
                $action,
                $row['invoice_id'],
                $receipt_no,
                $student_name,
                $row['year'],
                $std_name,
                number_format($row['amount'], 0, '.', ''),
                $method,
                $row['description'],
                $entry_user
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $filtered_records,
            "data" => $data
        );
        echo json_encode($output);
    }

    function edit_receipt($receipt_id = null){
        $receipt = $this->db->get_where('payment', array('payment_id' => $receipt_id))->row_array();
        if(!$receipt){ $this->session->set_flashdata('flash_message', get_phrase('Receipt not found')); redirect(base_url().'admin/manage_receipt', 'refresh'); }

        $page_data = array(
            'payment_id'   => $receipt_id,
            'student_id'   => $receipt['student_id'],
            'invoice_id'   => $receipt['invoice_id'],
            'amount'       => $receipt['amount'],
            'method'       => $this->input->post('method'),
            'description'  => $this->input->post('description'),
            'timestamp'    => $this->input->post('timestamp'),
            'bank_id'      => $this->input->post('bank_id'),
            'contra_entry' => $this->input->post('contra_entry'),
        );

        $this->student_payment_model->updateReceiptFunction($receipt_id, $page_data);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url().'admin/manage_receipt', 'refresh');
    }

    function delete_receipt($receipt_id = null){
        if(!$receipt_id){ redirect(base_url().'admin/manage_receipt', 'refresh'); }

        $receipt = $this->db->get_where('payment', array('payment_id' => $receipt_id))->row_array();
        if($receipt){
            $invoice_id = $receipt['invoice_id'];
            $amount = $receipt['amount'];
            $student_id = $receipt['student_id'];
            $year = $receipt['year'];

            $this->db->trans_start();
            $this->db->where('payment_id', $receipt_id);
            $this->db->delete('payment');

            $this->db->where('invoice_id', $invoice_id);
            $this->db->set('amount_paid', 'amount_paid - ' . $amount, FALSE);
            $this->db->set('due', 'due + ' . $amount, FALSE);
            $this->db->update('invoice');

            $inv = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
            if($inv && $inv->due > 0){
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', array('status' => '2'));
            }
            if($inv){
                $this->student_payment_model->syncAcademicHistoryLedger(intval($inv->student_id), $inv->year);
            }

            $user = $this->session->userdata('name');
            $this->db->insert('audit_log', array(
                'action'      => 'RECEIPT_DELETED',
                'description' => 'Receipt ' . $receipt_id . ' (Rs ' . $amount . ') deleted for invoice ' . $invoice_id . ' student ' . $student_id . ' year ' . $year,
                'entity_type' => 'payment',
                'entity_id'   => $receipt_id,
                'user_name'   => !empty($user) ? $user : 'Administrator',
                'created_at'  => date('Y-m-d H:i:s'),
            ));
            $this->db->trans_complete();
        }
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url().'admin/manage_receipt', 'refresh');
    }
    /***********  Receipt ends here ***********************/

    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id, 'status' => 0))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }


    function get_class_mass_student($year = '', $class_id = '', $academy_id = '', $group_id = '', $auto_student_id = ''){

        $this->db->from('student');
        $this->db->where('student.status', 0);
        if(!empty($year)) $this->db->where('student.ad_year', $year);
        if(!empty($class_id)) $this->db->where('student.class_id', $class_id);
        if(!empty($academy_id)) $this->db->where('student.academy_id', $academy_id);
        if(!empty($group_id)) $this->db->where('student.group_id', $group_id);

        $students = $this->db->get()->result_array();

        $already_invoiced = array();
        if(!empty($students)){
            foreach($students as $s){
                $inv_count = 0;
                if(!empty($year)){
                    $inv_count = $this->db->get_where('invoice', array('student_id' => $s['student_id'], 'year' => $year))->num_rows();
                }
                if($inv_count > 0){
                    $already_invoiced[] = $s;
                }
            }
        }

        foreach($already_invoiced as $del){
            foreach($students as $k => $v){
                if($v['student_id'] == $del['student_id']){
                    unset($students[$k]);
                }
            }
        }
        $students = array_values($students);

        if(empty($students)){
            echo '<blockquote class="text-center" id="stderrormsg">No students available — all selected students already have invoices.</blockquote>';
            return;
        }

        $total = count($students);
        echo '<button type="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">Select All</button>';
        echo '<button type="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">Unselect All</button>';
        echo ' Total(<b>'.$total.'&nbsp;students</b> found)<br><br>';
        echo '<table class="table table-bordered">';
        echo '<tr><th>Sr.No</th><th>Name</th><th>Remark</th><th>Edit</th></tr>';
        $i = 1;
        foreach($students as $student){
            $checked = 'checked';
            if(!empty($auto_student_id) && intval($auto_student_id) != intval($student['student_id'])){
                $checked = '';
            }
            echo '<tr>';
            echo '<td><div class="col-sm-12">'.$i.'</div></td>';
            echo '<td><div class="col-sm-12"><label><input type="checkbox" class="check" name="student_id[]" value="'.$student['student_id'].'" '.$checked.'>&nbsp;'.$student['name'].'</label></div></td>';
            echo '<td><div class="col-sm-12"></div></td>';
            echo '<td><div class="col-sm-12"><a href="'.base_url('admin/view_student/'.$student['student_id']).'" target="_blank"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a></div></td>';
            echo '</tr>';
            $i++;
        }
        echo '</table>';
    }

    function get_fess_template($class_id = 0, $academy_id = 0, $group_id = 0, $year = ''){
        if(empty($year)){
            $session_row = $this->db->get_where('settings', array('type' => 'session'))->row();
            $year = $session_row ? $session_row->description : '';
        }
        if(empty($year)) return;

        $this->db->where('class_id', $class_id);
        $this->db->where('academy_id', $academy_id);
        $this->db->where('academic_year', $year);
        if(!empty($group_id)){
            $this->db->where('group_id', $group_id);
            $template = $this->db->get('fees_template')->row_array();
            if(empty($template)){
                $this->db->reset_query();
                $this->db->where('class_id', $class_id);
                $this->db->where('academy_id', $academy_id);
                $this->db->where('academic_year', $year);
                $this->db->group_start();
                $this->db->where('group_id', 0);
                $this->db->or_where('group_id', NULL);
                $this->db->group_end();
                $template = $this->db->get('fees_template')->row_array();
            }
        } else {
            $this->db->where('academic_year', $year);
            $this->db->group_start();
            $this->db->where('group_id', 0);
            $this->db->or_where('group_id', NULL);
            $this->db->group_end();
            $template = $this->db->get('fees_template')->row_array();
        }
        if(empty($template)) return;

        $items = $this->db->get_where('fees_template_item', array('fees_template_id' => $template['fees_template_id']))->result_array();
        if(empty($items)) return;

        $fee_heads = $this->db->get('fees_head')->result_array();
        $total = intval($template['amount']);
        ?>
        <div class="load-animate animated fadeInUp">
        <input type="hidden" name="fee_template_id" value="<?php echo intval($template['fees_template_id']);?>">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered" id="invoiceItem">
                    <tbody>
                    <tr style="background-color: #eee;">
                        <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                        <th width="25%">Title</th>
                        <th width="10%">Amount</th>
                        <th width="15%">Total</th>
                    </tr>
                    <?php $row_num = 0; foreach($items as $item): $row_num++; ?>
                    <tr>
                        <td><input class="itemRow" type="checkbox"></td>
                        <td>
                            <select class="form-control" id="productName_<?php echo $row_num;?>" name="productName[]" onchange="getProductData(<?php echo $row_num;?>)" required>
                                <option value="">select</option>
                                <?php foreach($fee_heads as $fh):
                                    $sel = ($item['fees_head_id'] == $fh['fees_head_id']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $fh['fees_head_id'];?>" <?php echo $sel; ?>><?php echo $fh['title'];?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td><input type="number" value="<?php echo intval($item['amount']);?>" name="price[]" id="price_<?php echo $row_num;?>" class="form-control price" autocomplete="off"></td>
                        <td><input type="number" value="<?php echo intval($item['amount']);?>" name="total[]" id="total_<?php echo $row_num;?>" class="form-control total" autocomplete="off" readonly></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <button class="btn btn-default" id="addRows" type="button">+ Add More</button>
                <button class="btn btn-default delete" id="removeRows" type="button">- Delete</button>
            </div>
        </div>
        <br>
        <div class="row col-sm-12 mycontainer">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offset-sm-8">
                <span class="form-inline">
                    <div class="form-group">
                        <label class="col-md-12">Subtotal: &nbsp;</label>
                        <div class="input-group col-sm-12">
                            <div class="input-group-addon currency">&#8377;</div>
                            <input value="<?php echo $total;?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Total: &nbsp;</label>
                        <div class="input-group col-sm-12">
                            <div class="input-group-addon currency">&#8377;</div>
                            <input value="<?php echo $total;?>" type="number" class="form-control" name="total_amt" id="totalAftertax" placeholder="Total" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Amount Paid: &nbsp;</label>
                        <div class="input-group col-sm-12">
                            <div class="input-group-addon currency">&#8377;</div>
                            <input type="number" value="0" class="form-control" name="paid_amt" id="amountPaid" placeholder="Amount Paid" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Amount Due: &nbsp;</label>
                        <div class="input-group col-sm-12">
                            <div class="input-group-addon currency">&#8377;</div>
                            <input value="<?php echo $total;?>" type="number" class="form-control" name="due_amt" id="amountDue" placeholder="Amount Due" readonly>
                        </div>
                    </div>
                </span>
            </div>
        </div>
        <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Description</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function student_invoice(){
        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $page_data['classes']       = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $page_data['boards']        = $this->db->get('board')->result_array();
        $page_data['academies']     = $this->db->get('academy')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function manage_invoice(){
        $this->student_invoice();
    }

    function student_invoice_dashboard($class_id = '', $year = '', $type = 'all'){
        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $page_data['classes']       = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $page_data['boards']        = $this->db->get('board')->result_array();
        $page_data['academies']     = $this->db->get('academy')->result_array();
        $page_data['selected_class_id'] = $class_id;
        $page_data['selected_year'] = $year;
        if ($type == 'paid') {
            $page_data['selected_paystatus'] = '1';
        } elseif ($type == 'due') {
            $page_data['selected_paystatus'] = '2';
        } elseif ($type == 'discount' || $type == 'yes') {
            $page_data['selected_discntstatus'] = '1';
        }
        $this->load->view('backend/index', $page_data);
    }

    function invoiceList(){
        if($this->session->userdata('admin_login') != 1){
            echo json_encode(array('draw' => intval($this->input->post('draw')), 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => array()));
            return;
        }

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $class_id = $this->input->post('class_id');
        $paystatus = $this->input->post('paystatus');
        $discntstatus = $this->input->post('discntstatus');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $year = $this->input->post('year');
        $board_id = $this->input->post('board_id');
        $academy_id = $this->input->post('academy_id');

        $sql = "SELECT i.*, s.name AS student_name, s.class_id AS student_class_id, c.name AS class_name
                FROM invoice i
                LEFT JOIN student s ON s.student_id = i.student_id
                LEFT JOIN class c ON c.class_id = i.class_id
                WHERE 1=1";

        if(!empty($class_id)){
            $sql .= " AND s.class_id = " . intval($class_id);
        }
        if(!empty($paystatus)){
            $sql .= " AND i.status = " . intval($paystatus);
        }
        if(!empty($discntstatus)){
            if($discntstatus == '1'){
                $sql .= " AND i.discount > 0";
            } else {
                $sql .= " AND i.discount = 0";
            }
        }
        if(!empty($board_id)){
            $sql .= " AND s.board_id = " . intval($board_id);
        }
        if(!empty($academy_id)){
            $sql .= " AND s.academy_id = " . intval($academy_id);
        }
        if(!empty($year)){
            $sql .= " AND i.year = '" . $this->db->escape_str($year) . "'";
        }
        if(!empty($from)){
            $sql .= " AND i.creation_timestamp >= '" . $this->db->escape_str($from) . "'";
        }
        if(!empty($to)){
            $sql .= " AND i.creation_timestamp <= '" . $this->db->escape_str($to) . "'";
        }

        $sql .= " ORDER BY i.invoice_id DESC";

        $result_query = $this->db->query($sql);
        $totalRecords = $result_query->num_rows();

        if($length != -1){
            $sql .= " LIMIT " . $length . " OFFSET " . $start;
        }
        $result = $this->db->query($sql)->result_array();

        $data = array();
        $sr = $start + 1;
        foreach($result as $row){
            $date = '';
            if(!empty($row['creation_timestamp'])){
                $ts = strtotime($row['creation_timestamp']);
                $date = $ts ? date('d-m-Y', $ts) : $row['creation_timestamp'];
            }

            $status_badge = '';
            if($row['status'] == 1){
                $status_badge = '<span class="label label-success">paid</span>';
            } elseif($row['status'] == 2){
                $status_badge = '<span class="label label-danger">unpaid</span>';
            } elseif($row['status'] == 3){
                $status_badge = '<span class="label label-primary">carry</span>';
            } else {
                $status_badge = '<span class="label label-warning">partial</span>';
            }

            $actions = '';
            if($row['status'] != 3){
                if (has_action('fees', 'manage_invoice', 'edit')) {
                    $actions .= '<a href="'.base_url('admin/edit_invoice/'.$row['invoice_id']).'"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>&nbsp;';
                }
            }
            if (has_action('fees', 'manage_invoice', 'delete')) {
                $actions .= '<a><button type="button" onclick="confirm_modal(&quot;'.base_url('admin/student_payment/delete_invoice/'.$row['invoice_id']).'&quot;)" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>';
            }

            $details = '';
            if($row['status'] == 2){
                $details = '<a href="'.base_url('admin/student_invoice_details/'.$row['student_id']).'"><span class="label label-inverse"><i class="fa fa-inr"></i> Pay now</span></a>';
            }

            $data[] = array(
                $sr,
                $date,
                $row['invoice_id'],
                $actions,
                $status_badge,
                $details,
                $row['student_name'],
                $row['year'],
                $row['class_name'],
                number_format($row['amount']),
                number_format($row['discount']) . (!empty($row['discount_file']) ? ' <a href="'.base_url('uploads/discount/'.$row['discount_file']).'" target="_blank"><button type="button" class="btn btn-success btn-rounded btn-sm">File&nbsp;<i class="fa fa-arrow-circle-right"></i></button></a>&nbsp;<button class="btn btn-danger icon btn-circle btn-xs" onclick="confirm_modal(&quot;'.base_url('admin/student_payment/delete_discount_attmt/'.$row['invoice_id']).'&quot;)"><i class="fa fa-trash-o"></i></button>' : '&nbsp;'),
                number_format($row['amount_paid']),
                number_format($row['due']),
                $row['description'],
                $row['entry_user']
            );
            $sr++;
        }

        echo json_encode(array(
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ));
    }

    function student_invoice_details($student_id = null){
        if($student_id == null){
            redirect(base_url().'admin/student_invoice', 'refresh');
        }
        $page_data['page_name']     = 'student_invoice_details';
        $page_data['page_title']    = get_phrase('Student Fee Details');
        $page_data['student_id']    = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function edit_invoice($invoice_id = null){
        if($invoice_id == null){
            redirect(base_url().'admin/manage_invoice', 'refresh');
        }
        $page_data['page_name']     = 'edit_invoice';
        $page_data['page_title']    = get_phrase('Edit Invoice');
        $page_data['invoice_id']    = $invoice_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_payment_single($student_id = null){
        if($student_id == null){
            redirect(base_url().'admin/manage_invoice', 'refresh');
        }

        $existing = $this->db->get_where('invoice', array('student_id' => $student_id))->num_rows();
        if($existing > 0){
            redirect(base_url().'admin/student_invoice_details/'.$student_id, 'refresh');
        }

        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Create Invoice');
        $page_data['student_id']    = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    /***********  Fees Head CRUD starts here ***********************/
    function fees_head($param1 = null, $param2 = null){
        if($param1 == 'create'){
            $this->fees_head_model->createFeesHeadFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/fees_head', 'refresh');
        }
        if($param1 == 'update'){
            $this->fees_head_model->updateFeesHeadFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/fees_head', 'refresh');
        }
        if($param1 == 'delete'){
            $this->fees_head_model->deleteFeesHeadFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/fees_head', 'refresh');
        }
        $page_data['page_name']  = 'fees_head';
        $page_data['page_title'] = get_phrase('Fees Head');
        $this->load->view('backend/index', $page_data);
    }
    /***********  Fees Head CRUD ends here ***********************/

    /***********  Fees Template CRUD starts here ***********************/
    function fees_template($param1 = null, $param2 = null){
        if($param1 == 'delete'){
            $this->fees_template_model->deleteFeesTemplateFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/fees_template', 'refresh');
        }
        $page_data['page_name']  = 'fees_template';
        $page_data['page_title'] = get_phrase('Fees Template');
        $this->load->view('backend/index', $page_data);
    }

    function create_fees_template($param1 = null){
        if($param1 == 'create'){
            $this->fees_template_model->createFeesTemplateFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/fees_template', 'refresh');
        }
        $page_data['page_name']  = 'create_fees_template';
        $page_data['page_title'] = get_phrase('Create Fees Template');
        $this->load->view('backend/index', $page_data);
    }

    function checkfeestemplate($class_id = 0, $academy_id = 0, $group_id = 0, $year = ''){
        if ($this->session->userdata('admin_login') != 1) { echo '0'; return; }
        if(empty($year)){
            $session_row = $this->db->get_where('settings', array('type' => 'session'))->row();
            $year = $session_row ? $session_row->description : '';
        }
        $this->db->where('academy_id', $academy_id);
        $this->db->where('class_id', $class_id);
        if(!empty($year)) {
            $this->db->where('academic_year', $year);
        }
        if(!empty($group_id) && $group_id != '0') {
            $this->db->where('group_id', $group_id);
        } else {
            $this->db->group_start();
            $this->db->where('group_id', 0);
            $this->db->or_where('group_id', NULL);
            $this->db->group_end();
        }
        $count = $this->db->count_all_results('fees_template');
        echo ($count > 0) ? '1' : '0';
    }

    function get_all_feehead($allproduct = 0){
        if ($this->session->userdata('admin_login') != 1) { echo json_encode([]); return; }
        $fees = $this->db->get('fees_head')->result();
        echo json_encode($fees);
    }

    function get_feehead_info($fee_head_id = 0){
        if ($this->session->userdata('admin_login') != 1) { echo '0'; return; }
        $row = $this->db->get_where('fees_head', array('fees_head_id' => $fee_head_id))->row();
        echo $row ? $row->amount : 0;
    }

    function edit_fees_template($id = null){
        $page_data['page_name']  = 'edit_fees_template';
        $page_data['page_title'] = get_phrase('Edit Fees Template');
        $page_data['param2']     = $id;
        $this->load->view('backend/index', $page_data);
    }

    function fees_template_update($id = null){
        $this->fees_template_model->updateFeesTemplateFunction($id);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/fees_template', 'refresh');
    }

    function feestempList(){
        if ($this->session->userdata('admin_login') != 1) { 
            echo json_encode(array("draw"=>1,"recordsTotal"=>0,"recordsFiltered"=>0,"data"=>[])); 
            return; 
        }

        $academy_id = $this->input->post('academy_id');
        $class_id = $this->input->post('class_id');
        $group_id = $this->input->post('group_id');
        $academic_year = $this->input->post('academic_year');

        $this->db->select('fees_template.*, academy.academy_name as academy_name, class.name as class_name, student_group.group_name as group_name');
        $this->db->from('fees_template');
        $this->db->join('academy', 'academy.academy_id = fees_template.academy_id', 'left');
        $this->db->join('class', 'class.class_id = fees_template.class_id', 'left');
        $this->db->join('student_group', 'student_group.group_id = fees_template.group_id', 'left');
        $total_records = $this->db->count_all_results('', false);

        if(!empty($academy_id)) $this->db->where('fees_template.academy_id', $academy_id);
        if(!empty($class_id)) $this->db->where('fees_template.class_id', $class_id);
        if(!empty($group_id)) $this->db->where('fees_template.group_id', $group_id);
        if(!empty($academic_year)) $this->db->where('fees_template.academic_year', $academic_year);

        $search_value = $this->input->post('search');
        if(!empty($search_value['value'])){
            $search = $search_value['value'];
            $this->db->group_start();
            $this->db->like('fees_template.description', $search);
            $this->db->or_like('academy.academy_name', $search);
            $this->db->or_like('class.name', $search);
            $this->db->group_end();
        }

        $this->db->order_by('fees_template.fees_template_id', 'DESC');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        if(!empty($length) && $length != -1){
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        $list = $query->result_array();

        $data = array();
        $i = $start + 1;
        foreach($list as $record){
            $row = array();
            $row[] = $i++;
            $row[] = date('d-m-Y', strtotime($record['created_at']));
            $ft_actions = '';
            if (has_action('fees', 'fees_template', 'edit')) {
                $ft_actions .= '<a href="'.base_url('admin/edit_fees_template/'.$record['fees_template_id']).'"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>&nbsp;';
            }
            if (has_action('fees', 'fees_template', 'delete')) {
                $ft_actions .= '<a><button type="button" onclick="confirm_modal(\''.base_url('admin/fees_template/delete/'.$record['fees_template_id']).'\')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>';
            }
            $row[] = $ft_actions;
            $row[] = $record['academy_name'];
            $row[] = $record['class_name'];
            $row[] = $record['group_name'];
            $row[] = !empty($record['academic_year']) ? $record['academic_year'] : '-';
            $row[] = number_format($record['amount']);
            $row[] = $record['description'];
            $row[] = $record['entry_user'];
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data,
        );
        echo json_encode($output, JSON_INVALID_UTF8_SUBSTITUTE);
    }
    /***********  Fees Template CRUD ends here ***********************/



    /***********  The function below manages school event ***********************/
    function noticeboard ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $page_data['page_title']    = get_phrase('School Event');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

    /***********  The function below manages school events (alias) ***********************/
    function manage_events ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_events', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/manage_events', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_events', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $page_data['page_title']    = get_phrase('Manage Events');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events (alias) ends here ***********************/

    /***********  The function below manages department ***********************/
    function department ($param1 = null, $param2 = null, $param3 = null){
        $this->load->model('department_model');

        if($param1 == 'insert'){
            $this->department_model->insertDepartmentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/department', 'refresh');
        }

        if($param1 == 'update'){
            $this->department_model->updateDepartmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/department', 'refresh');
        }

        if($param1 == 'delete'){
            $this->department_model->deleteDepartmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/department', 'refresh');
        }

        $page_data['page_name']     = 'department';
        $page_data['page_title']    = get_phrase('Manage Department');
        $this->load->view('backend/index', $page_data);
    }

    function delete_designation($department_id = ''){
        $this->db->where('designation_id', $department_id);
        $this->db->delete('designation');
        echo 'success';
    }
    /***********  The function that manages department ends here ***********************/

    /***********  The function below manages student documents ***********************/
    function manage_documents(){
        $page_data['page_name']     = 'manage_documents';
        $page_data['page_title']    = get_phrase('Manage Documents');
        $this->load->view('backend/index', $page_data);
    }

    function documentList(){
        if ($this->session->userdata('admin_login') != 1) { echo json_encode(array('data'=>[])); return; }
        $this->db->reset_query();
        $columns = array(0=>'student_id',1=>'student_id',2=>'ad_year',3=>'student_id',4=>'student_id',5=>'student_id',6=>'student_id',7=>'student_id',8=>'student_id',9=>'ad_date',10=>'photo',11=>'qr_code',12=>'student_no',13=>'name',14=>'class_id',15=>'section_id',16=>'sex',17=>'re_id',18=>'cat_id',19=>'cast_id',20=>'uid',21=>'phone',22=>'blood_group',23=>'address',24=>'birthday',25=>'ad_type',26=>'father_name',27=>'mother_name',28=>'board_id',29=>'academy_id',30=>'parent_phone',31=>'parent_uid',32=>'group_id',33=>'entry_user',34=>'student_id');

        $this->db->select('student.*, class.name as class_name, section.name as section_name, board.board_name, academy.academy_name, religion.religion_name, category.cat_name, cast.cast_name, student_group.group_name');
        $this->db->join('class', 'class.class_id = student.class_id', 'left');
        $this->db->join('section', 'section.section_id = student.section_id', 'left');
        $this->db->join('board', 'board.board_id = student.board_id', 'left');
        $this->db->join('academy', 'academy.academy_id = student.academy_id', 'left');
        $this->db->join('religion', 'religion.religion_id = student.re_id', 'left');
        $this->db->join('category', 'category.category_id = student.cat_id', 'left');
        $this->db->join('cast', 'cast.cast_id = student.cast_id', 'left');
        $this->db->join('student_group', 'student_group.group_id = student.group_id', 'left');

        $this->db->from('student');

        $search_value = $this->input->post('search');
        if(!empty($search_value['value'])){
            $search = $search_value['value'];
            $this->db->group_start();
            $this->db->like('student.name', $search);
            $this->db->or_like('student.father_name', $search);
            $this->db->or_like('student.uid', $search);
            $this->db->or_like('student.student_no', $search);
            $this->db->or_like('student.phone', $search);
            $this->db->group_end();
        }

        $class_id = $this->input->post('class_id');
        if(!empty($class_id)) $this->db->where('student.class_id', $class_id);

        $board_id = $this->input->post('board_id');
        if(!empty($board_id)) $this->db->where('student.board_id', $board_id);

        $group_id = $this->input->post('group_id');
        if(!empty($group_id)) $this->db->where('student.group_id', $group_id);

        $academy_id = $this->input->post('academy_id');
        if(!empty($academy_id)) $this->db->where('student.academy_id', $academy_id);

        $ad_type = $this->input->post('ad_type');
        if(!empty($ad_type)) $this->db->where('student.ad_type', $ad_type);

        $status = $this->input->post('status');
        if(!empty($status) && $status != '') $this->db->where('student.status', $status);

        $year = $this->input->post('year');
        if(!empty($year)) $this->db->where('student.ad_year', $year);

        $from = $this->input->post('from');
        $to = $this->input->post('to');
        if(!empty($from)) $this->db->where('student.ad_date >=', $from);
        if(!empty($to)) $this->db->where('student.ad_date <=', $to);

        $this->db->where('student.status !=', 3);

        $total_records = $this->db->count_all_results('', false);

        $this->db->order_by('student.student_id', 'desc');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        if(!empty($length) && $length != -1){
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        $students = $query->result_array();

        $student_ids = array_column($students, 'student_id');
        $docs_by_student = array();
        if (!empty($student_ids)) {
            $this->db->where_in('student_id', $student_ids);
            $all_docs = $this->db->get('student_documents')->result_array();
            foreach ($all_docs as $doc) {
                $docs_by_student[$doc['student_id']][] = $doc;
            }
        }

        $data = array();
        $i = $start + 1;
        foreach($students as $row){
            $photo = !empty($row['photo']) ? '<img src="'.base_url().'uploads/student_image/'.$row['photo'].'" width="30" height="30" class="img-circle">' : '<img src="'.base_url().'uploads/default.png" width="30" height="30" class="img-circle">';

            $qr = '';
            if(!empty($row['qr_code']) && file_exists('uploads/student_qr_code/'.$row['qr_code'])){
                $qr = '<a href="'.base_url().'uploads/student_qr_code/'.$row['qr_code'].'" target="_blank"><img src="'.base_url().'uploads/student_qr_code/'.$row['qr_code'].'" width="30"></a>';
            }

            $ad_type_label = ($row['ad_type'] == 2) ? 'RTE' : 'Regular';

            $reg_no = !empty($row['student_no']) ? $row['student_no'] : $row['student_id'];
            $session_val = !empty($row['ad_year']) ? $row['ad_year'] : '';

            $sid = $row['student_id'];
            $doc_btns = '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/StudentBonafide/insert/'.$sid.'/stdbn\')" class="btn btn-success btn-circle btn-xs" title="Bonafide"><i class="fa fa-file"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/LeavingCertificate/insert/'.$sid.'\')" class="btn btn-danger btn-circle btn-xs" title="Leaving Certificate"><i class="fa fa-download"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/StudentLetter/insert/'.$sid.'\')" class="btn btn-warning btn-circle btn-xs" title="Form-15A"><i class="fa fa-print"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/CoveringLetter/insert/'.$sid.'\')" class="btn btn-primary btn-circle btn-xs" title="Covering Letter"><i class="fa fa-file-o"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/CharacterCertificate/insert/'.$sid.'\')" class="btn btn-success btn-circle btn-xs" title="Character Certificate"><i class="fa fa-print"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/Attendance75/insert/'.$sid.'\')" class="btn btn-info btn-circle btn-xs" title="75% Attendance"><i class="fa fa-check-square-o"></i></button></a> ';
            $doc_btns .= '<a href="#"><button type="button" onclick="confirm_print(\''.base_url().'report/view/studentIdCard/insert/'.$sid.'\')" class="btn btn-inverse btn-circle btn-xs" title="Student IdCard"><i class="fa fa-user"></i></button></a>';

            $row_data = array();
            $row_data[] = '<input type="checkbox" name="student_ids[]" class="selectRow" value="'.$sid.'" />';
            if (has_action('academics', 'manage_documents', 'view')) {
                $row_data[] = '<a href="'.base_url().'admin/view_student/'.$sid.'" title="View Student" class="btn btn-success btn-rounded btn-sm" style="color:#fff"><i class="fa fa-eye"></i> View</a>';
            } else {
                $row_data[] = '';
            }
            $name_style = ($row['status'] == 1) ? ' style="color:#ff0000;"' : (($row['status'] == 2) ? ' style="color:#d4a017;"' : '');
            $row_data[] = '<span'.$name_style.'>'.$row['name'].'</span>';
            $row_data[] = $session_val;
            if (has_action('academics', 'manage_documents', 'bonafide')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/StudentBonafide/insert/'.$sid.'/stdbn\')" class="btn btn-success btn-circle btn-xs" title="Bonafide"><i class="fa fa-file"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'lc')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/LeavingCertificate/insert/'.$sid.'\')" class="btn btn-danger btn-circle btn-xs" title="Leaving Certificate"><i class="fa fa-download"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'form_15a')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/StudentLetter/insert/'.$sid.'\')" class="btn btn-warning btn-circle btn-xs" title="Form-15A"><i class="fa fa-print"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'covering')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/CoveringLetter/insert/'.$sid.'\')" class="btn btn-primary btn-circle btn-xs" title="Covering Letter"><i class="fa fa-file-o"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'character')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/CharacterCertificate/insert/'.$sid.'\')" class="btn btn-success btn-circle btn-xs" title="Character Certificate"><i class="fa fa-print"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'bulk_idcard')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/studentIdCard/insert/'.$sid.'\')" class="btn btn-inverse btn-circle btn-xs" title="Student IdCard"><i class="fa fa-user"></i></button>';
            } else {
                $row_data[] = '';
            }
            if (has_action('academics', 'manage_documents', 'id_card_75')) {
                $row_data[] = '<button type="button" onclick="confirm_print(\''.base_url().'report/view/Attendance75/insert/'.$sid.'\')" class="btn btn-info btn-circle btn-xs" title="75% Attendance"><i class="fa fa-check-square-o"></i></button>';
            } else {
                $row_data[] = '';
            }
            $row_data[] = $row['ad_date'];
            $row_data[] = $photo;
            $row_data[] = $qr;
            $row_data[] = $reg_no;
            $row_data[] = $row['class_name'];
            $row_data[] = $row['section_name'];
            $row_data[] = $row['sex'];
            $row_data[] = $row['religion_name'];
            $row_data[] = $row['cat_name'];
            $row_data[] = $row['cast_name'];
            $row_data[] = $row['uid'];
            $row_data[] = $row['phone'];
            $row_data[] = $row['blood_group'];
            $row_data[] = $row['address'];
            $row_data[] = $row['birthday'];
            $row_data[] = $ad_type_label;
            $row_data[] = $row['father_name'];
            $row_data[] = $row['mother_name'];
            $row_data[] = $row['board_name'];
            $row_data[] = $row['academy_name'];
            $row_data[] = $row['parent_phone'];
            $row_data[] = $row['parent_uid'];
            $row_data[] = $row['group_name'];
            $row_data[] = $row['entry_user'];

            $docs = isset($docs_by_student[$sid]) ? $docs_by_student[$sid] : array();
            $doc_html = '';
            if(!empty($docs)){
                $doc_count = count($docs);
                $doc_html .= '<div style="max-height:38px;overflow:hidden;display:flex;flex-wrap:wrap;gap:3px;align-items:center;" title="'.$doc_count.' document(s)">';
                foreach($docs as $doc){
                    $file_url = base_url().'uploads/std_document/'.$doc['document_file'];
                    $ext = strtolower(pathinfo($doc['document_file'], PATHINFO_EXTENSION));
                    $is_image = in_array($ext, array('jpg','jpeg','png','gif','bmp','webp'));
                    if($is_image){
                        $doc_html .= '<a href="javascript:void(0);" onclick="previewDocument(\''.$file_url.'\', \''.$ext.'\', \''.html_escape(addslashes($doc['document_type'])).'\', \''.html_escape(addslashes($doc['remarks'])).'\')" title="'.html_escape($doc['document_type']).'"><img src="'.$file_url.'" alt="'.html_escape($doc['document_type']).'" style="width:32px;height:32px;object-fit:cover;border-radius:3px;border:1px solid #ddd;cursor:pointer;" onerror="this.style.display=\'none\'"></a>';
                    } else {
                        $doc_html .= '<a href="'.$file_url.'" target="_blank" title="'.html_escape($doc['document_type']).'"><i class="fa fa-file-o" style="font-size:16px;color:#3498db;"></i></a> ';
                    }
                }
                $doc_html .= '<span class="label label-info" style="font-size:9px;margin-left:2px;">'.$doc_count.'</span>';
                $doc_html .= '</div>';
            } else {
                $doc_html = '<span class="text-muted" style="font-size:11px;">No docs</span>';
            }
            $row_data[] = $doc_html;

            $data[] = $row_data;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($total_records),
            "recordsFiltered" => intval($total_records),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    /***********  The function that manages student documents ends here ***********************/

     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }


    /***********  The function below manages school marks ***********************/
    function marks ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');

                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                    redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/marks', 'refresh');
                }
            }

            if($this->input->post('operation') == 'update_student_subject_score'){

                $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                    foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                        $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                        $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

                        $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                        $this->db->update('mark', $page_data);  
                    }

                    $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                    redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/



    /***********  The function below manages school marks ***********************/
     function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['subject_id']    =  $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

                redirect(base_url(). 'admin/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/student_marksheet_subject', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
                foreach ($select_student_first as $key => $dispay_student_from_student_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'admin/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'student_marksheet_subject';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/



    
    /***********  The function below manages new admin ***********************/
    function newAdministrator ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'update'){
            $this->admin_model->updateAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'status'){
            $this->admin_model->updateStatus($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Status updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        $page_data['page_name']     = 'newAdministrator';
        $page_data['page_title']    = get_phrase('New Administrator');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages administrator ends here ***********************/

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }

    function save_admin_permissions($admin_id = 0){
        if ($this->session->userdata('admin_login') != 1) { echo 'unauthorized'; return; }
        $permissions = $this->input->post('permissions');
        if (!is_array($permissions)) $permissions = array();
        $this->db->where('admin_id', $admin_id)->delete('admin_permissions');
        if (!empty($permissions)) {
            $rows = array();
            foreach ($permissions as $perm) {
                $rows[] = array('admin_id' => $admin_id, 'permission_key' => $this->db->escape_str($perm));
            }
            $this->db->insert_batch('admin_permissions', $rows);
        }
        echo 'ok';
    }

    function ajax_student_serach(){
        if ($this->session->userdata('admin_login') != 1) {
            echo json_encode(array());
            return;
        }
        $query = $this->input->post('query');
        if(empty($query)){
            echo json_encode(array());
            return;
        }
        $students = $this->db->select('student_id, name')
            ->like('name', $query)
            ->limit(20)
            ->get('student')
            ->result_array();
        $result = array();
        foreach($students as $student){
            $result[] = array(
                'url'   => base_url('admin/view_student/' . $student['student_id']),
                'value' => $student['name']
            );
        }
        echo json_encode($result);
    }

    function dashboard_counter($year = '', $from = '', $to = '') {
        if ($this->session->userdata('admin_login') != 1) {
            echo '0>,0>,0>,0>,0>,0>,0>,0';
            return;
        }

        $from_escaped = $this->db->escape($from);
        $to_escaped   = $this->db->escape($to);
        $from_ts      = !empty($from) ? strtotime($from) : 0;
        $to_ts        = !empty($to) ? strtotime($to) + 86399 : 0;

        $total_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('amount');
        $query1 = $this->db->get_where('invoice', array('year' => $year));
        if ($query1->num_rows() > 0) { $total_amount = $query1->row()->amount; }

        $paid_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('amount_paid');
        $query2 = $this->db->get_where('invoice', array('year' => $year));
        if ($query2->num_rows() > 0) { $paid_amount = $query2->row()->amount_paid; }

        $discount_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('discount');
        $query_disc = $this->db->get_where('invoice', array('year' => $year));
        if ($query_disc->num_rows() > 0) { $discount_amount = $query_disc->row()->discount; }

        $due_amount = $total_amount - $paid_amount - $discount_amount;

        $birthday_count = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->where('DAYOFYEAR(birthday) >= DAYOFYEAR(' . $from_escaped . ')');
            $this->db->where('DAYOFYEAR(birthday) <= DAYOFYEAR(' . $to_escaped . ')');
        }
        $birthday_count = $this->db->count_all_results('student');

        $student_count = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->where('ad_date >=', $from);
            $this->db->where('ad_date <=', $to);
            $this->db->where('status !=', 3);
        }
        $student_count = $this->db->count_all_results('student');

        $expense_amount = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->select_sum('amount');
            $this->db->where('payment_type', 'expense');
            $this->db->where('timestamp >=', $from_ts);
            $this->db->where('timestamp <=', $to_ts);
            $query3 = $this->db->get('payment');
            if ($query3->num_rows() > 0) { $expense_amount = $query3->row()->amount; }
        }

        $today_collection = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->select_sum('amount');
            $this->db->where('payment_type', 'income');
            if (!empty($year)) $this->db->where('year', $year);
            $this->db->where('timestamp >=', $from_ts);
            $this->db->where('timestamp <=', $to_ts);
            $query4 = $this->db->get('payment');
            if ($query4->num_rows() > 0) { $today_collection = $query4->row()->amount; }
        }

        $currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;

        echo $currency . ' ' . number_format($total_amount, 0) . '>,' .
             $currency . ' ' . number_format($paid_amount, 0) . '>,' .
             $currency . ' ' . number_format($due_amount, 0) . '>,' .
             $birthday_count . '>,' .
             $student_count . '>,' .
             $currency . ' ' . number_format($expense_amount, 0) . '>,' .
             $currency . ' ' . number_format($today_collection, 0) . '>,' .
             $currency . ' ' . number_format($discount_amount, 0);
    }

    function dashboard_counter_yearwaise($year = '') {
        if ($this->session->userdata('admin_login') != 1) {
            echo '0>,0>,0>,0';
            return;
        }

        $total_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('amount');
        $query1 = $this->db->get_where('invoice', array('year' => $year));
        if ($query1->num_rows() > 0) { $total_amount = $query1->row()->amount; }

        $paid_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('amount_paid');
        $query2 = $this->db->get_where('invoice', array('year' => $year));
        if ($query2->num_rows() > 0) { $paid_amount = $query2->row()->amount_paid; }

        $discount_amount = 0;
        $this->db->where('status !=', '3');
        $this->db->select_sum('discount');
        $query_disc = $this->db->get_where('invoice', array('year' => $year));
        if ($query_disc->num_rows() > 0) { $discount_amount = $query_disc->row()->discount; }

        $due_amount = $total_amount - $paid_amount - $discount_amount;

        $currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;

        echo $currency . ' ' . number_format($total_amount, 0) . '>,' .
             $currency . ' ' . number_format($paid_amount, 0) . '>,' .
             $currency . ' ' . number_format($due_amount, 0) . '>,' .
             $currency . ' ' . number_format($discount_amount, 0);
    }

    /***********  The function manages religion ***********************/
    function religion($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->religion_model->createReligion();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/religion', 'refresh');
        }

        if($param1 == 'update'){
            $this->religion_model->updateReligion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/religion', 'refresh');
        }

        if($param1 == 'delete'){
            $this->religion_model->deleteReligion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/religion', 'refresh');
        }

        $page_data['page_name']     = 'religion';
        $page_data['page_title']    = get_phrase('Religion');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages category ***********************/
    function category($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->religion_model->createCategory();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/category', 'refresh');
        }

        if($param1 == 'update'){
            $this->religion_model->updateCategory($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/category', 'refresh');
        }

        if($param1 == 'delete'){
            $this->religion_model->deleteCategory($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/category', 'refresh');
        }

        $page_data['page_name']     = 'category';
        $page_data['page_title']    = get_phrase('Category');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages cast ***********************/
    function caste($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->religion_model->createCast();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/caste', 'refresh');
        }

        if($param1 == 'update'){
            $this->religion_model->updateCast($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/caste', 'refresh');
        }

        if($param1 == 'delete'){
            $this->religion_model->deleteCast($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/caste', 'refresh');
        }

        $page_data['page_name']     = 'cast';
        $page_data['page_title']    = get_phrase('Cast');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function manages mother tongue ***********************/
    function mother_tongue($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->religion_model->createMotherTongue();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/mother_tongue', 'refresh');
        }

        if($param1 == 'update'){
            $this->religion_model->updateMotherTongue($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/mother_tongue', 'refresh');
        }

        if($param1 == 'delete'){
            $this->religion_model->deleteMotherTongue($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/mother_tongue', 'refresh');
        }

        $page_data['page_name']     = 'mother_tongue';
        $page_data['page_title']    = get_phrase('Mother Tongue');
        $this->load->view('backend/index', $page_data);

    }

    /***********  AJAX: get categories by religion ***********************/
    function bank($action = '', $id = ''){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($action == 'create'){
            $data = array(
                'bank_name'           => $this->input->post('name'),
                'branch'              => $this->input->post('branch'),
                'ifsc_code'           => $this->input->post('ifsc'),
                'address'             => $this->input->post('address'),
            );
            $this->db->insert('bank', $data);
            $this->session->set_flashdata('flash_message', 'Bank added successfully');
            redirect(base_url('admin/bank'));
            return;
        }

        if($action == 'update'){
            $data = array(
                'bank_name'           => $this->input->post('name'),
                'branch'              => $this->input->post('branch'),
                'ifsc_code'           => $this->input->post('ifsc'),
                'address'             => $this->input->post('address'),
            );
            $this->db->where('bank_id', $id)->update('bank', $data);
            echo 'success';
            return;
        }

        if($action == 'delete'){
            $this->db->where('bank_id', $id)->delete('bank');
            $this->session->set_flashdata('flash_message', 'Bank deleted successfully');
            redirect(base_url('admin/bank'));
            return;
        }

        $page_data['banks'] = $this->db->order_by('bank_id', 'DESC')->get('bank')->result_array();
        $page_data['page_name'] = 'bank';
        $page_data['page_title'] = 'Manage Bank';
        $this->load->view('backend/index', $page_data);
    }

    function bank_account($action = '', $id = ''){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($action == 'create'){
            $data = array(
                'bank_id'    => $this->input->post('bank_id'),
                'account_no' => $this->input->post('acc_no'),
                'branch'     => $this->input->post('branch'),
                'ifsc_code'  => $this->input->post('ifsc'),
                'address'    => $this->input->post('address'),
                'entry_user' => $this->session->userdata('name'),
            );
            $this->db->insert('bank_account', $data);
            $this->session->set_flashdata('flash_message', 'Bank Account added successfully');
            redirect(base_url('admin/bank_account'));
            return;
        }

        if($action == 'update'){
            $data = array(
                'bank_id'    => $this->input->post('bank_id'),
                'account_no' => $this->input->post('acc_no'),
                'branch'     => $this->input->post('branch'),
                'ifsc_code'  => $this->input->post('ifsc'),
                'address'    => $this->input->post('address'),
            );
            $this->db->where('bank_account_id', $id)->update('bank_account', $data);
            echo 'success';
            return;
        }

        if($action == 'delete'){
            $this->db->where('bank_account_id', $id)->delete('bank_account');
            $this->session->set_flashdata('flash_message', 'Bank Account deleted successfully');
            redirect(base_url('admin/bank_account'));
            return;
        }

        $page_data['bank_accounts'] = $this->db->select('ba.*, b.bank_name')
            ->from('bank_account ba')
            ->join('bank b', 'b.bank_id = ba.bank_id')
            ->order_by('ba.bank_account_id', 'DESC')
            ->get()
            ->result_array();
        $page_data['banks'] = $this->db->order_by('bank_name', 'ASC')->get('bank')->result_array();
        $page_data['page_name'] = 'bank_account';
        $page_data['page_title'] = 'Manage Bank Account';
        $this->load->view('backend/index', $page_data);
    }

    function get_religion_category($re_id = ''){
        if(empty($re_id)) $re_id = $this->input->post('re_id');
        $categories = $this->religion_model->getCategoryByReligion($re_id);
        echo '<option value="">Select Category</option>';
        foreach($categories as $cat){
            echo '<option value="'.$cat['category_id'].'">'.$cat['cat_name'].'</option>';
        }
    }

    /***********  AJAX: get casts by category ***********************/
    function get_category_cast($cat_id = ''){
        if(empty($cat_id)) $cat_id = $this->input->post('cat_id');
        $casts = $this->db->get_where('cast', array('cat_id' => $cat_id))->result_array();
        echo '<option value="">Select</option>';
        foreach($casts as $row){
            echo '<option value="'.$row['cast_id'].'">'.html_escape($row['cast_name']).'</option>';
        }
    }

    /***********  AJAX: check GRN uniqueness ***********************/
    function checkforgrn($grn_no = ''){
        if(empty($grn_no)) return;
        $count_student = $this->db->get_where('student', array('gen_reg_no' => $grn_no))->num_rows();
        $count_pre = $this->db->get_where('pre_student', array('gen_reg_no' => $grn_no))->num_rows();
        if($count_student > 0 || $count_pre > 0){
            echo '<span style="color:red;">GRN already exists.</span>';
        } else {
            echo '<span style="color:green;">GRN available.</span>';
        }
    }

    function dashboard_counter_daywaise($from = '', $to = '', $year = '') {
        if ($this->session->userdata('admin_login') != 1) {
            echo '0>,0>,0>,0';
            return;
        }

        $from_escaped = $this->db->escape($from);
        $to_escaped   = $this->db->escape($to);
        $from_ts      = !empty($from) ? strtotime($from) : 0;
        $to_ts        = !empty($to) ? strtotime($to) + 86399 : 0;

        $birthday_count = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->where('DAYOFYEAR(birthday) >= DAYOFYEAR(' . $from_escaped . ')');
            $this->db->where('DAYOFYEAR(birthday) <= DAYOFYEAR(' . $to_escaped . ')');
        }
        $birthday_count = $this->db->count_all_results('student');

        $student_count = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->where('ad_date >=', $from);
            $this->db->where('ad_date <=', $to);
            $this->db->where('status !=', 3);
        }
        $student_count = $this->db->count_all_results('student');

        $expense_amount = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->select_sum('amount');
            $this->db->where('payment_type', 'expense');
            $this->db->where('timestamp >=', $from_ts);
            $this->db->where('timestamp <=', $to_ts);
            $query3 = $this->db->get('payment');
            if ($query3->num_rows() > 0) { $expense_amount = $query3->row()->amount; }
        }

        $today_collection = 0;
        if (!empty($from) && !empty($to)) {
            $this->db->select_sum('amount');
            $this->db->where('payment_type', 'income');
            if (!empty($year)) $this->db->where('year', $year);
            $this->db->where('timestamp >=', $from_ts);
            $this->db->where('timestamp <=', $to_ts);
            $query4 = $this->db->get('payment');
            if ($query4->num_rows() > 0) { $today_collection = $query4->row()->amount; }
        }

        $currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;

        echo $birthday_count . '>,' .
             $student_count . '>,' .
             $currency . ' ' . number_format($expense_amount, 0) . '>,' .
             $currency . ' ' . number_format($today_collection, 0);
    }

    /***********  The function manages previous school ***********************/
    function previous_school($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->religion_model->createPreviousSchool();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/previous_school', 'refresh');
        }

        if($param1 == 'update'){
            $this->religion_model->updatePreviousSchool($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/previous_school', 'refresh');
        }

        if($param1 == 'delete'){
            $this->religion_model->deletePreviousSchool($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/previous_school', 'refresh');
        }

        $page_data['page_name']     = 'previous_school';
        $page_data['page_title']    = get_phrase('Manage Previous School');
        $this->load->view('backend/index', $page_data);

    }

    /*********** Academy Management ***********/
    function academy($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
            $this->academy_model->createAcademy();
            $this->session->set_flashdata('flash_message', get_phrase('Academy added successfully'));
            redirect(base_url(). 'admin/academy', 'refresh');
        }

        if($param1 == 'status'){
            $this->academy_model->changeStatus($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Status updated successfully'));
            redirect(base_url(). 'admin/academy', 'refresh');
        }

        if($param1 == 'delete'){
            $this->academy_model->deleteAcademy($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Academy deleted successfully'));
            redirect(base_url(). 'admin/academy', 'refresh');
        }

        $page_data['page_name']     = 'academy';
        $page_data['page_title']    = get_phrase('Manage Academy');
        $this->load->view('backend/index', $page_data);
    }

    function view_academy($id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $id = intval($id);
        $academy = $this->db->get_where('academy', array('academy_id' => $id))->row_array();
        if(empty($academy)){
            $this->session->set_flashdata('flash_message', 'Academy not found');
            redirect(base_url(). 'admin/academy', 'refresh');
        }

        $page_data['academy'] = $academy;

        $all_classes = $this->db->select('class_id, name, name_numeric')->order_by('sort_order', 'asc')->get('class')->result_array();
        $students = $this->db->get_where('student', array('academy_id' => $id))->result_array();
        $filtered = array();
        foreach($students as $s){
            if($s['status'] == 2) continue;
            $cid = intval($s['class_id']);
            if(!isset($filtered[$cid])) $filtered[$cid] = array('total'=>0,'male'=>0,'female'=>0);
            $filtered[$cid]['total']++;
            if(strtolower($s['sex']) == 'male') $filtered[$cid]['male']++;
            if(strtolower($s['sex']) == 'female') $filtered[$cid]['female']++;
        }
        $class_stats = array();
        foreach($all_classes as $cls){
            $cid = intval($cls['class_id']);
            $class_stats[] = array(
                'class_name' => $cls['name'],
                'total' => isset($filtered[$cid]) ? $filtered[$cid]['total'] : 0,
                'male' => isset($filtered[$cid]) ? $filtered[$cid]['male'] : 0,
                'female' => isset($filtered[$cid]) ? $filtered[$cid]['female'] : 0,
            );
        }
        $page_data['class_stats'] = $class_stats;

        $total_students = 0;
        foreach($filtered as $f) $total_students += $f['total'];
        $page_data['total_students'] = $total_students;

        $page_data['page_name'] = 'view_academy';
        $page_data['page_title'] = 'View Academy';
        $this->load->view('backend/index', $page_data);
    }

    function board($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
            $this->board_model->createBoard();
            $this->session->set_flashdata('flash_message', get_phrase('Board added successfully'));
            redirect(base_url(). 'admin/board', 'refresh');
        }

        if($param1 == 'update'){
            $this->board_model->updateBoard($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Board updated successfully'));
            redirect(base_url(). 'admin/board', 'refresh');
        }

        if($param1 == 'delete'){
            $this->board_model->deleteBoard($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Board deleted successfully'));
            redirect(base_url(). 'admin/board', 'refresh');
        }

        $page_data['page_name']     = 'board';
        $page_data['page_title']    = get_phrase('Manage Board');
        $this->load->view('backend/index', $page_data);
    }

    function group($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'create'){
            $this->group_model->createGroup();
            $this->session->set_flashdata('flash_message', get_phrase('Group added successfully'));
            redirect(base_url(). 'admin/group', 'refresh');
        }

        if($param1 == 'update'){
            $this->group_model->updateGroup($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Group updated successfully'));
            redirect(base_url(). 'admin/group', 'refresh');
        }

        if($param1 == 'delete'){
            $this->group_model->deleteGroup($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Group deleted successfully'));
            redirect(base_url(). 'admin/group', 'refresh');
        }

        $page_data['page_name']     = 'group';
        $page_data['page_title']    = get_phrase('Manage Group');
        $this->load->view('backend/index', $page_data);
    }

    function academy_counter($year = ''){
        if(empty($year)) $year = date('Y').'-'.(date('Y')+1);

        $start_year = substr($year, 0, 4);
        $end_year = $start_year + 1;
        $ad_year = $start_year.'-'.$end_year;
        $academies = $this->academy_model->getAllAcademy();

        $html = '';
        foreach($academies as $academy){
            $student_count = $this->db->where('academy_id', $academy['academy_id'])->where('ad_year', $ad_year)->count_all_results('student');
            $html .= '<div class="col-md-4 col-sm-6">';
            $html .= '<div class="white-box">';
            $html .= '<div class="r-icon-stats">';
            $html .= '<i class="fa fa-home bg-megna"></i>';
            $html .= '<div class="bodystate">';
            $html .= '<a style="cursor:pointer;">';
            $html .= '<h4 class="totalcnt" id="'.$academy['academy_id'].'">'.$student_count.'</h4>';
            $html .= '</a>';
            $html .= '<span>'.html_escape($academy['academy_name']).'</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        echo $html;
    }

    function academyqrcodeprintFn(){
        $academy_ids = $this->input->post('academy_ids');
        $ids_array = explode(',', $academy_ids);

        foreach($ids_array as $id){
            $id = trim($id);
            if(!empty($id)){
                $this->generateAcademyQrCode($id);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('QR codes generated successfully'));
        redirect(base_url(). 'admin/academy', 'refresh');
    }

    function generateAcademyQrCode($academy_id){
        $academy = $this->academy_model->getAcademyById($academy_id);
        if(!$academy) return false;

        $upload_path = 'uploads/academy_qr_code/';
        if(!is_dir($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        $filename = 'div_'.md5(uniqid()).'.png';
        $filepath = $upload_path.$filename;
        $filename_only = str_replace('.png', '', $filename);

        $qr_text = base_url().'pre_student/admission_form/'.$filename_only;

        require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
        QRcode::png($qr_text, $filepath, QR_ECLEVEL_L, 6, 2);

        $this->db->where('academy_id', $academy_id);
        $this->db->update('academy', array('qr_code' => $filename));

        return $filepath;
    }

    function pre_student_information($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($param1 == 'approve'){
            $pre_student = $this->db->get_where('pre_student', array('pre_student_id' => $param2))->row_array();
            if($pre_student){
                if(empty(trim($pre_student['gen_reg_no']))){
                    $this->session->set_flashdata('flash_message', get_phrase('Cannot approve: General Register Number is mandatory. Please update the student first.'));
                    redirect(base_url(). 'admin/pre_student_information', 'refresh');
                    return;
                }
                $existing = $this->db->get_where('student', array('uid' => $pre_student['uid'], 'ad_year' => $pre_student['ad_year'], 'class_id' => $pre_student['class_id']))->row_array();
                if($existing){
                    $this->session->set_flashdata('flash_message', get_phrase('Student with this UID already exists in this class (Student ID: '.$existing['student_id'].')'));
                    redirect(base_url(). 'admin/pre_student_information', 'refresh');
                    return;
                }

                $session = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
                $student_data = array(
                    'name'                => $pre_student['name'],
                    'father_name'         => $pre_student['father_name'],
                    'mother_name'         => $pre_student['mother_name'],
                    'phone'               => $pre_student['phone'],
                    'email'               => '',
                    'class_id'            => $pre_student['class_id'],
                    'ad_class_id'         => $pre_student['ad_class_id'],
                    'section_id'          => $pre_student['section_id'],
                    'password'            => sha1('123456'),
                    'session'             => $session,
                    'sex'                 => $pre_student['sex'],
                    'birthday'            => $pre_student['birthday'],
                    'age'                 => $pre_student['birthday'],
                    'm_tongue'            => $pre_student['mt_id'],
                    'religion'            => $pre_student['re_id'],
                    'blood_group'         => $pre_student['blood_gp'],
                    'address'             => $pre_student['address'],
                    'village'             => $pre_student['village'],
                    'tal'                 => $pre_student['tal'],
                    'dist'                => $pre_student['dist'],
                    'nationality'         => $pre_student['nationality'],
                    'place_birth'         => $pre_student['birth_place'],
                    'ps_attended'         => $pre_student['ps_id'],
                    'login_status'        => '1',
                    'student_category_id' => $pre_student['cat_id'],
                    're_id'               => $pre_student['re_id'],
                    'cat_id'              => $pre_student['cat_id'],
                    'cast_id'             => $pre_student['cast_id'],
                    'board_id'            => $pre_student['board_id'],
                    'academy_id'          => $pre_student['academy_id'],
                    'group_id'            => $pre_student['group_id'],
                    'uid'                 => $pre_student['uid'],
                    'gen_reg_no'          => $pre_student['gen_reg_no'],
                    'parent_phone'        => $pre_student['parent_phone'],
                    'ad_type'             => $pre_student['ad_type'],
                    'ad_year'             => $pre_student['ad_year'],
                    'student_no'          => $pre_student['student_no'],
                    'status'              => 0,
                    'photo'               => $pre_student['userfile'],
                    'ad_date'             => date('Y-m-d'),
                    'entry_user'          => 'Administrator',
                    'roll'                => substr(md5(uniqid(rand(), true)), 0, 7),
                    'leaving_certificate' => $pre_student['leaving_certificate'],
                    'marksheet'           => $pre_student['marksheet'],
                    'aadhar_card_student' => $pre_student['aadhar_card_student'],
                    'aadhar_card_parent'  => $pre_student['aadhar_card_parent'],
                );

                $this->db->insert('student', $student_data);
                $student_id = $this->db->insert_id();

                $upload_src = 'uploads/pre_student/';
                $doc_dst = 'uploads/std_document/';
                if (!is_dir($doc_dst)) mkdir($doc_dst, 0777, true);

                $doc_map = array(
                    'leaving_certificate' => 'Leaving Certificate',
                    'marksheet'           => 'Marksheet',
                    'aadhar_card_student' => 'Aadhar Card (Student)',
                    'aadhar_card_parent'  => 'Aadhar Card (Parent)',
                    'migration_certificate'=> 'Migration Certificate',
                );
                foreach ($doc_map as $field => $label) {
                    if (!empty($pre_student[$field]) && file_exists($upload_src . $pre_student[$field])) {
                        copy($upload_src . $pre_student[$field], $doc_dst . $pre_student[$field]);
                        $this->db->insert('student_documents', array(
                            'student_id'      => $student_id,
                            'document_type'   => $label,
                            'document_file'   => $pre_student[$field],
                            'remarks'         => '',
                            'entry_user'      => 'Student Upload',
                            'created_at'      => date('Y-m-d H:i:s'),
                        ));
                    }
                }

                if (!empty($pre_student['userfile']) && file_exists($upload_src . $pre_student['userfile'])) {
                    $student_image_dir = 'uploads/student_image/';
                    if (!is_dir($student_image_dir)) mkdir($student_image_dir, 0777, true);
                    copy($upload_src . $pre_student['userfile'], $student_image_dir . $pre_student['userfile']);
                    copy($upload_src . $pre_student['userfile'], $doc_dst . $pre_student['userfile']);
                    $this->db->insert('student_documents', array(
                        'student_id'      => $student_id,
                        'document_type'   => 'Student Photo',
                        'document_file'   => $pre_student['userfile'],
                        'remarks'         => '',
                        'entry_user'      => 'Student Upload',
                        'created_at'      => date('Y-m-d H:i:s'),
                    ));
                }

                $update_data = array('status' => 'approved');
                $this->db->where('pre_student_id', $param2);
                $this->db->update('pre_student', $update_data);

                $this->session->set_flashdata('flash_message', get_phrase('Student approved and added successfully. Student ID: '.$student_id));
            }
            redirect(base_url(). 'admin/pre_student_information', 'refresh');
        }

        if($param1 == 'reject'){
            $this->db->where('pre_student_id', $param2);
            $this->db->update('pre_student', array('status' => 'rejected'));
            $this->session->set_flashdata('flash_message', get_phrase('Application rejected'));
            redirect(base_url(). 'admin/pre_student_information', 'refresh');
        }

        if($param1 == 'delete'){
            $this->db->where('pre_student_id', $param2);
            $this->db->delete('pre_student');
            $this->session->set_flashdata('flash_message', get_phrase('Record deleted'));
            redirect(base_url(). 'admin/pre_student_information', 'refresh');
        }

        $page_data['page_name']     = 'pre_student_information';
        $page_data['page_title']    = get_phrase('Pending Admission');
        $this->load->view('backend/index', $page_data);
    }

    function prestudentList(){
        if ($this->session->userdata('admin_login') != 1) { echo json_encode(array('data'=>[])); return; }
        $this->db->reset_query();
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $this->db->select('pre_student.*, class.name as class_name, section.name as section_name,
            board.board_name, academy.academy_name, religion.religion_name,
            category.cat_name, cast.cast_name, student_group.group_name');
        $this->db->from('pre_student');
        $this->db->join('class', 'class.class_id = pre_student.class_id', 'left');
        $this->db->join('section', 'section.section_id = pre_student.section_id', 'left');
        $this->db->join('board', 'board.board_id = pre_student.board_id', 'left');
        $this->db->join('academy', 'academy.academy_id = pre_student.academy_id', 'left');
        $this->db->join('religion', 'religion.religion_id = pre_student.re_id', 'left');
        $this->db->join('category', 'category.category_id = pre_student.cat_id', 'left');
        $this->db->join('cast', 'cast.cast_id = pre_student.cast_id', 'left');
        $this->db->join('student_group', 'student_group.group_id = pre_student.group_id', 'left');

        $class_id = $this->input->post('class_id');
        $board_id = $this->input->post('board_id');
        $group_id = $this->input->post('group_id');
        $academy_id = $this->input->post('academy_id');
        $ad_type = $this->input->post('ad_type');
        $year = $this->input->post('year');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $status = $this->input->post('status');

        if(!empty($class_id)) $this->db->where('pre_student.class_id', $class_id);
        if(!empty($board_id)) $this->db->where('pre_student.board_id', $board_id);
        if(!empty($group_id)) $this->db->where('pre_student.group_id', $group_id);
        if(!empty($academy_id)) $this->db->where('pre_student.academy_id', $academy_id);
        if(!empty($ad_type)) $this->db->where('pre_student.ad_type', $ad_type);
        if(!empty($year)) $this->db->where('pre_student.ad_year', $year);
        if(!empty($status)) $this->db->where('pre_student.status', $status);
        if(!empty($from)) $this->db->where('pre_student.ad_date >=', $from);
        if(!empty($to)) $this->db->where('pre_student.ad_date <=', $to);

        $this->db->order_by('pre_student.pre_student_id', 'desc');

        $total_records = $this->db->count_all_results('', false);

        if($length != -1){
            $this->db->limit($length, $start);
        }
        $query = $this->db->get();
        $data = $query->result_array();

        $response = array();
        $response['draw'] = $draw;
        $response['recordsTotal'] = $total_records;
        $response['recordsFiltered'] = $total_records;
        $response['data'] = array();

        foreach($data as $row){
            $photo = !empty($row['userfile']) ? '<img src="'.base_url().'uploads/pre_student/'.$row['userfile'].'" width="30">' : '<img src="'.base_url().'uploads/default_avatar.jpg" width="30">';

            if($row['status'] == 'approved'){
                $status_badge = '<span class="label label-success">confirmed</span>';
            } elseif($row['status'] == 'pending'){
                $status_badge = '<span class="label label-warning">pending</span>';
            } else {
                $status_badge = '<span class="label label-danger">'.$row['status'].'</span>';
            }

            $actions = '';
            if (has_action('students', 'pending_admission', 'view')) {
                $actions .= '<a href="'.base_url().'admin/view_pre_student/'.$row['pre_student_id'].'" target="_blank"><button type="button" class="btn btn-info btn-rounded btn-sm">View <i class="fa fa-arrow-circle-right"></i></button></a> ';
            }
            if (has_action('students', 'pending_admission', 'delete')) {
                $actions .= '<a><button type="button" onclick=confirm_modal("'.base_url().'admin/pre_student_information/delete/'.$row['pre_student_id'].'") class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></a>';
            }

            if($row['status'] == 'pending'){
                if (has_action('students', 'pending_admission', 'view')) {
                    $actions .= ' <a><button type="button" onclick=approve_modal("'.base_url().'admin/pre_student_information/approve/'.$row['pre_student_id'].'") class="btn btn-success btn-circle btn-xs" title="Approve"><i class="fa fa-check"></i></button></a>';
                    $actions .= ' <a><button type="button" onclick=reject_modal("'.base_url().'admin/pre_student_information/reject/'.$row['pre_student_id'].'") class="btn btn-warning btn-circle btn-xs" title="Reject"><i class="fa fa-ban"></i></button></a>';
                }
            }

            $response['data'][] = array(
                '<input type="checkbox" class="selectRow" value="'.$row['pre_student_id'].'">&nbsp;&nbsp;'.$row['pre_student_id'],
                $actions,
                date('d-m-Y', strtotime($row['ad_date'])),
                $status_badge,
                $photo,
                $row['ad_year'],
                '<span style=>'.$row['name'].'</span>',
                $row['class_name'],
                $row['section_name'],
                $row['sex'],
                $row['religion_name'],
                $row['cat_name'],
                $row['cast_name'],
                $row['uid'],
                $row['gen_reg_no'] ? $row['gen_reg_no'] : '<span style="color:#e74c3c;font-weight:bold;">Not Set</span>',
                $row['phone'],
                $row['parent_phone'],
                $row['blood_gp'],
                $row['village'],
                $row['tal'],
                $row['dist'],
                $row['birthday'],
                $row['ad_type'],
                $row['father_name'],
                $row['mother_name'],
                $row['group_name']
            );
        }

        echo json_encode($response);
    }

    function view_pre_student($id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $pre_student = $this->db->select('pre_student.*, class.name as class_name, section.name as section_name')
            ->join('class', 'class.class_id = pre_student.class_id', 'left')
            ->join('section', 'section.section_id = pre_student.section_id', 'left')
            ->get_where('pre_student', array('pre_student_id' => $id))->row_array();

        if(empty($pre_student)){
            $this->session->set_flashdata('flash_message', 'Student not found');
            redirect(base_url(). 'admin/pre_student_information', 'refresh');
        }

        $page_data['pre_student'] = $pre_student;
        $page_data['academies'] = $this->db->get('academy')->result_array();
        $page_data['boards'] = $this->db->get('board')->result_array();
        $page_data['religions'] = $this->db->get('religion')->result_array();
        $page_data['categories'] = $this->db->get('category')->result_array();
        $page_data['casts'] = !empty($pre_student['cat_id']) ? $this->db->get_where('cast', array('cat_id' => $pre_student['cat_id']))->result_array() : $this->db->get('cast')->result_array();
        $page_data['mother_tongues'] = $this->db->get('mother_tongue')->result_array();
        $page_data['previous_schools'] = $this->db->get('previous_school')->result_array();
        $page_data['classes'] = $this->db->order_by('sort_order', 'asc')->get('class')->result_array();
        $page_data['sections'] = !empty($pre_student['section_id']) ? $this->db->get_where('section', array('section_id' => $pre_student['section_id']))->result_array() : $this->db->get('section')->result_array();
        $page_data['student_groups'] = $this->db->get('student_group')->result_array();
        $page_data['documents'] = array();

        $this->db->select('student_promotion_history.*, old_cls.name as old_class_name, new_cls.name as new_class_name');
        $this->db->join('class as old_cls', 'old_cls.class_id = student_promotion_history.old_class_id', 'left');
        $this->db->join('class as new_cls', 'new_cls.class_id = student_promotion_history.new_class_id', 'left');
        $this->db->where('student_promotion_history.student_id', $id);
        $this->db->order_by('student_promotion_history.id', 'desc');
        $page_data['promotion_history'] = $this->db->get('student_promotion_history')->result_array();

        $page_data['page_name'] = 'view_pre_student';
        $page_data['page_title'] = 'View Pending Student - ' . $pre_student['name'];
        $this->load->view('backend/index', $page_data);
    }

    function view_pre_student_update($id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $data = array(
            'name'                => html_escape($this->input->post('name')),
            'father_name'         => html_escape($this->input->post('father_name')),
            'mother_name'         => html_escape($this->input->post('mother_name')),
            'parent_phone'        => html_escape($this->input->post('parent_phone')),
            'phone'               => html_escape($this->input->post('phone')),
            'sex'                 => html_escape($this->input->post('sex')),
            'birthday'            => html_escape($this->input->post('birthday')),
            're_id'               => html_escape($this->input->post('re_id')),
            'cat_id'              => html_escape($this->input->post('cat_id')),
            'cast_id'             => html_escape($this->input->post('cast_id')),
            'nationality'         => html_escape($this->input->post('nationality')),
            'birth_place'         => html_escape($this->input->post('birth_place')),
            'blood_gp'            => html_escape($this->input->post('blood_gp')),
            'mt_id'               => html_escape($this->input->post('mt_id')),
            'address'             => html_escape($this->input->post('address')),
            'uid'                 => html_escape($this->input->post('uid')),
            'parent_uid'          => html_escape($this->input->post('parent_uid')),
            'ad_type'             => html_escape($this->input->post('ad_type')),
            'ad_year'             => html_escape($this->input->post('ad_year')),
            'ad_date'             => html_escape($this->input->post('ad_date')),
            'gen_reg_no'          => html_escape($this->input->post('gen_reg_no')),
            'student_no'          => html_escape($this->input->post('student_no')),
            'academy_id'          => html_escape($this->input->post('academy_id')),
            'board_id'            => html_escape($this->input->post('board_id')),
            'group_id'            => html_escape($this->input->post('group_id')),
            'class_id'            => html_escape($this->input->post('class_id')),
            'ad_class_id'         => html_escape($this->input->post('ad_class_id')),
            'section_id'          => html_escape($this->input->post('section_id')),
            'ps_id'               => html_escape($this->input->post('ps_id')),
            'status'              => html_escape($this->input->post('status')),
        );

        $this->db->where('pre_student_id', $id);
        $this->db->update('pre_student', $data);

        if(!empty($_FILES['userfile']['tmp_name'])){
            $upload_path = 'uploads/pre_student/';
            if(!is_dir($upload_path)) mkdir($upload_path, 0777, true);
            $filename = 'pre_' . $id . '_' . time() . '.jpg';
            move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path . $filename);
            $this->db->where('pre_student_id', $id);
            $this->db->update('pre_student', array('userfile' => $filename));
        }

        $status = $this->input->post('status');
        if($status == 'approved'){
            $pre_student = $this->db->get_where('pre_student', array('pre_student_id' => $id))->row_array();
            if(!empty(trim($pre_student['gen_reg_no']))){
                $this->_approve_pre_student($id);
                $this->session->set_flashdata('flash_message', get_phrase('Student approved and added to student list successfully'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('General Register Number is required for approval. Please enter it and try again.'));
            }
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('Pre-student updated successfully'));
        }

        redirect(base_url(). 'admin/view_pre_student/' . $id, 'refresh');
    }

    private function _approve_pre_student($pre_student_id){
        $pre_student = $this->db->get_where('pre_student', array('pre_student_id' => $pre_student_id))->row_array();
        if(!$pre_student) return;

        $existing = $this->db->get_where('student', array('uid' => $pre_student['uid'], 'ad_year' => $pre_student['ad_year'], 'class_id' => $pre_student['class_id']))->row_array();
        if($existing) return;

        $session = $this->db->get_where('settings', array('type' => 'session'))->row();
        $session_name = $session ? $session->description : date('Y').'-'.(date('Y')+1);
        $entry_user = $this->session->userdata('name') ? $this->session->userdata('name') : 'Administrator';

        $student_data = array(
            'name'                => $pre_student['name'],
            'father_name'         => $pre_student['father_name'],
            'mother_name'         => $pre_student['mother_name'],
            'phone'               => $pre_student['phone'],
            'email'               => '',
            'class_id'            => $pre_student['class_id'],
            'ad_class_id'         => $pre_student['ad_class_id'],
            'section_id'          => $pre_student['section_id'],
            'password'            => sha1('123456'),
            'session'             => $session_name,
            'sex'                 => $pre_student['sex'],
            'birthday'            => $pre_student['birthday'],
            'age'                 => $pre_student['birthday'],
            'm_tongue'            => $pre_student['mt_id'],
            'religion'            => $pre_student['re_id'],
            'blood_group'         => $pre_student['blood_gp'],
            'address'             => $pre_student['address'],
            'village'             => $pre_student['village'],
            'tal'                 => $pre_student['tal'],
            'dist'                => $pre_student['dist'],
            'nationality'         => $pre_student['nationality'],
            'place_birth'         => $pre_student['birth_place'],
            'ps_attended'         => $pre_student['ps_id'],
            'login_status'        => '1',
            'student_category_id' => $pre_student['cat_id'],
            're_id'               => $pre_student['re_id'],
            'cat_id'              => $pre_student['cat_id'],
            'cast_id'             => $pre_student['cast_id'],
            'board_id'            => $pre_student['board_id'],
            'academy_id'          => $pre_student['academy_id'],
            'group_id'            => $pre_student['group_id'],
            'uid'                 => $pre_student['uid'],
            'gen_reg_no'          => $pre_student['gen_reg_no'],
            'parent_phone'        => $pre_student['parent_phone'],
            'ad_type'             => $pre_student['ad_type'],
            'ad_year'             => $pre_student['ad_year'],
            'student_no'          => $pre_student['student_no'],
            'status'              => 0,
            'photo'               => $pre_student['userfile'],
            'ad_date'             => date('Y-m-d'),
            'entry_user'          => $entry_user,
            'roll'                => substr(md5(uniqid(rand(), true)), 0, 7),
            'leaving_certificate' => $pre_student['leaving_certificate'],
            'marksheet'           => $pre_student['marksheet'],
            'aadhar_card_student' => $pre_student['aadhar_card_student'],
            'aadhar_card_parent'  => $pre_student['aadhar_card_parent'],
        );

        $this->db->insert('student', $student_data);
        $student_id = $this->db->insert_id();

        $upload_src = 'uploads/pre_student/';
        $doc_dst = 'uploads/std_document/';
        if (!is_dir($doc_dst)) mkdir($doc_dst, 0777, true);

        $doc_map = array(
            'leaving_certificate' => 'Leaving Certificate',
            'marksheet'           => 'Marksheet',
            'aadhar_card_student' => 'Aadhar Card (Student)',
            'aadhar_card_parent'  => 'Aadhar Card (Parent)',
            'migration_certificate'=> 'Migration Certificate',
        );
        foreach ($doc_map as $field => $label) {
            if (!empty($pre_student[$field]) && file_exists($upload_src . $pre_student[$field])) {
                copy($upload_src . $pre_student[$field], $doc_dst . $pre_student[$field]);
                $this->db->insert('student_documents', array(
                    'student_id'      => $student_id,
                    'document_type'   => $label,
                    'document_file'   => $pre_student[$field],
                    'remarks'         => '',
                    'entry_user'      => 'Student Upload',
                    'created_at'      => date('Y-m-d H:i:s'),
                ));
            }
        }

        if (!empty($pre_student['userfile']) && file_exists($upload_src . $pre_student['userfile'])) {
            $student_image_dir = 'uploads/student_image/';
            if (!is_dir($student_image_dir)) mkdir($student_image_dir, 0777, true);
            copy($upload_src . $pre_student['userfile'], $student_image_dir . $pre_student['userfile']);
            copy($upload_src . $pre_student['userfile'], $doc_dst . $pre_student['userfile']);
            $this->db->insert('student_documents', array(
                'student_id'      => $student_id,
                'document_type'   => 'Student Photo',
                'document_file'   => $pre_student['userfile'],
                'remarks'         => '',
                'entry_user'      => 'Student Upload',
                'created_at'      => date('Y-m-d H:i:s'),
            ));
        }
    }

    function student_information(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name']     = 'student_information';
        $page_data['page_title']    = get_phrase('Students');
        $page_data['class_id']      = $this->input->get('class_id');
        $page_data['from']          = $this->input->get('from');
        $page_data['to']            = $this->input->get('to');
        $this->load->view('backend/index', $page_data);
    }

    function delete_student($student_id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $this->db->where('student_id', $student_id);
        $this->db->delete('student');
        $this->session->set_flashdata('flash_message', get_phrase('Student deleted successfully'));
        redirect(base_url(). 'admin/student_information', 'refresh');
    }

    function studentList(){
        if ($this->session->userdata('admin_login') != 1) { echo json_encode(array('data'=>[])); return; }
        $this->db->reset_query();
        $columns = array(0=>'student_id',1=>'student_id',2=>'ad_date',3=>'qr_code',4=>'photo',5=>'ad_year',6=>'student_no',7=>'name',8=>'class_id',9=>'section_id',10=>'board_id',11=>'academy_id',12=>'sex',13=>'re_id',14=>'cat_id',15=>'cast_id',16=>'uid',17=>'phone',18=>'parent_phone',19=>'blood_group',20=>'address',21=>'birthday',22=>'ad_type',23=>'father_name',24=>'mother_name',25=>'parent_uid',26=>'group_id',27=>'entry_user',28=>'student_id');

        $this->db->select('student.*, class.name as class_name, section.name as section_name, board.board_name, academy.academy_name, religion.religion_name, category.cat_name, cast.cast_name, student_group.group_name');
        $this->db->join('class', 'class.class_id = student.class_id', 'left');
        $this->db->join('section', 'section.section_id = student.section_id', 'left');
        $this->db->join('board', 'board.board_id = student.board_id', 'left');
        $this->db->join('academy', 'academy.academy_id = student.academy_id', 'left');
        $this->db->join('religion', 'religion.religion_id = student.re_id', 'left');
        $this->db->join('category', 'category.category_id = student.cat_id', 'left');
        $this->db->join('cast', 'cast.cast_id = student.cast_id', 'left');
        $this->db->join('student_group', 'student_group.group_id = student.group_id', 'left');

        $this->db->from('student');

        $search_value = $this->input->post('search');
        if(!empty($search_value['value'])){
            $search = $search_value['value'];
            $this->db->group_start();
            $this->db->like('student.name', $search);
            $this->db->or_like('student.father_name', $search);
            $this->db->or_like('student.uid', $search);
            $this->db->or_like('student.student_no', $search);
            $this->db->or_like('student.phone', $search);
            $this->db->group_end();
        }

        $class_id = $this->input->post('class_id');
        if(!empty($class_id)) $this->db->where('student.class_id', $class_id);

        $board_id = $this->input->post('board_id');
        if(!empty($board_id)) $this->db->where('student.board_id', $board_id);

        $group_id = $this->input->post('group_id');
        if(!empty($group_id)) $this->db->where('student.group_id', $group_id);

        $academy_id = $this->input->post('academy_id');
        if(!empty($academy_id)) $this->db->where('student.academy_id', $academy_id);

        $ad_type = $this->input->post('ad_type');
        if(!empty($ad_type)) $this->db->where('student.ad_type', $ad_type);

        $status = $this->input->post('status');
        if(!empty($status) && $status != '') $this->db->where('student.status', $status);

        $year = $this->input->post('year');
        if(!empty($year)) $this->db->where('student.ad_year', $year);

        $from = $this->input->post('from');
        $to = $this->input->post('to');
        if(!empty($from)) $this->db->where('student.ad_date >=', $from);
        if(!empty($to)) $this->db->where('student.ad_date <=', $to);

        $this->db->where('student.status !=', 3);

        $total_records = $this->db->count_all_results('', false);

        $this->db->order_by('student.student_id', 'desc');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        if(!empty($length) && $length != -1){
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        $students = $query->result_array();

        $student_ids = array_column($students, 'student_id');
        $docs_by_student = array();
        if (!empty($student_ids)) {
            $this->db->where_in('student_id', $student_ids);
            $all_docs = $this->db->get('student_documents')->result_array();
            foreach ($all_docs as $doc) {
                $docs_by_student[$doc['student_id']][] = $doc;
            }
        }

        $data = array();
        $i = $start + 1;
        foreach($students as $row){
            $photo = !empty($row['photo']) ? '<img src="'.base_url().'uploads/student_image/'.$row['photo'].'" width="30" height="30" class="img-circle">' : '<img src="'.base_url().'uploads/default.png" width="30" height="30" class="img-circle">';

            $qr = '';
            if(!empty($row['qr_code']) && file_exists('uploads/student_qr_code/'.$row['qr_code'])){
                $qr = '<a href="'.base_url().'uploads/student_qr_code/'.$row['qr_code'].'" target="_blank"><img src="'.base_url().'uploads/student_qr_code/'.$row['qr_code'].'" width="30"></a>';
            }

            $ad_type_label = ($row['ad_type'] == 2) ? 'RTE' : 'Regular';
            $status_label = '';
            if($row['status'] == 0) $status_label = '<span class="label label-success">Active</span>';
            elseif($row['status'] == 1) $status_label = '<span class="label label-warning">Inactive</span>';
            elseif($row['status'] == 2) $status_label = '<span class="label label-danger">Out Of School</span>';

            $reg_no = !empty($row['gen_reg_no']) ? $row['gen_reg_no'] : '<span style="color:#e74c3c;font-weight:bold;">Not Set</span>';
            $session_val = !empty($row['ad_year']) ? $row['ad_year'] : '';

            $row_data = array();
            $row_data[] = '<input type="checkbox" name="student_ids[]" class="selectRow" value="'.$row['student_id'].'" />&nbsp;'.$row['student_id'];
            $student_actions = '';
            if (has_action('students', 'student_list', 'view')) {
                $student_actions .= '<a href="'.base_url().'admin/view_student/'.$row['student_id'].'" title="View Student" class="btn btn-success btn-rounded btn-sm" style="color:#fff"><i class="fa fa-eye"></i> View</a> ';
            }
            if (has_action('students', 'student_list', 'print_form')) {
                $student_actions .= '<a href="'.base_url().'admin/print_student_form/'.$row['student_id'].'" target="_blank" title="Print Form" class="btn btn-warning btn-rounded btn-sm" style="color:#fff"><i class="fa fa-print"></i> Print Form</a> ';
            }
            if (has_action('students', 'student_list', 'delete')) {
                $student_actions .= '<a href="#" onclick="confirm_modal(\''.base_url().'admin/delete_student/'.$row['student_id'].'\');" title="Delete Student" class="btn btn-danger btn-rounded btn-sm" style="color:#fff"><i class="fa fa-times"></i> Delete</a>';
            }
            $row_data[] = $student_actions;
            $row_data[] = $row['ad_date'];
            $row_data[] = $qr;
            $row_data[] = $photo;
            $row_data[] = $session_val;
            $row_data[] = $reg_no;
            $name_style = ($row['status'] == 1) ? ' style="color:#ff0000;"' : (($row['status'] == 2) ? ' style="color:#d4a017;"' : '');
            $row_data[] = '<span'.$name_style.'>'.$row['name'].'</span>';
            $row_data[] = $row['class_name'];
            $row_data[] = $row['section_name'];
            $row_data[] = $row['board_name'];
            $row_data[] = $row['academy_name'];
            $row_data[] = $row['sex'];
            $row_data[] = $row['religion_name'];
            $row_data[] = $row['cat_name'];
            $row_data[] = $row['cast_name'];
            $row_data[] = $row['uid'];
            $row_data[] = $row['phone'];
            $row_data[] = $row['parent_phone'];
            $row_data[] = $row['blood_group'];
            $row_data[] = $row['address'];
            $row_data[] = $row['birthday'];
            $row_data[] = $ad_type_label;
            $row_data[] = $row['father_name'];
            $row_data[] = $row['mother_name'];
            $row_data[] = $row['parent_uid'];
            $row_data[] = $row['group_name'];
            $row_data[] = $row['entry_user'];

            $docs = isset($docs_by_student[$row['student_id']]) ? $docs_by_student[$row['student_id']] : array();
            $doc_html = '';
            if(!empty($docs)){
                $doc_count = count($docs);
                $doc_html .= '<div style="max-height:38px;overflow:hidden;display:flex;flex-wrap:wrap;gap:3px;align-items:center;" title="'.$doc_count.' document(s)">';
                foreach($docs as $doc){
                    $file_url = base_url().'uploads/std_document/'.$doc['document_file'];
                    $ext = strtolower(pathinfo($doc['document_file'], PATHINFO_EXTENSION));
                    $is_image = in_array($ext, array('jpg','jpeg','png','gif','bmp','webp'));
                    if($is_image){
                        $doc_html .= '<a href="javascript:void(0);" onclick="previewDocument(\''.$file_url.'\', \''.$ext.'\', \''.html_escape(addslashes($doc['document_type'])).'\', \''.html_escape(addslashes($doc['remarks'])).'\')" title="'.html_escape($doc['document_type']).'"><img src="'.$file_url.'" alt="'.html_escape($doc['document_type']).'" style="width:32px;height:32px;object-fit:cover;border-radius:3px;border:1px solid #ddd;cursor:pointer;" onerror="this.style.display=\'none\'"></a>';
                    } else {
                        $doc_html .= '<a href="'.$file_url.'" target="_blank" title="'.html_escape($doc['document_type']).'"><i class="fa fa-file-o" style="font-size:16px;color:#3498db;"></i></a> ';
                    }
                }
                $doc_html .= '<span class="label label-info" style="font-size:9px;margin-left:2px;">'.$doc_count.'</span>';
                $doc_html .= '</div>';
            } else {
                $doc_html = '<span class="text-muted" style="font-size:11px;">No docs</span>';
            }
            $row_data[] = $doc_html;

            $data[] = $row_data;
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($total_records),
            "recordsFiltered" => intval($total_records),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function qrcodeprintFn(){
        $std_ids = $this->input->post('std_ids');
        $ids_array = explode(',', $std_ids);

        $upload_path = 'uploads/student_qr_code/';
        if(!is_dir($upload_path)) mkdir($upload_path, 0777, true);

        require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');

        foreach($ids_array as $id){
            $id = trim($id);
            if(empty($id)) continue;

            $student = $this->db->get_where('student', array('student_id' => $id))->row_array();
            if(!$student) continue;

            $filename = 'std_'.md5(uniqid()).'.png';
            $filepath = $upload_path.$filename;

            $qr_text = base_url().'student/profile/'.$id;
            QRcode::png($qr_text, $filepath, QR_ECLEVEL_L, 6, 2);

            $this->db->where('student_id', $id);
            $this->db->update('student', array('qr_code' => $filename));
        }

        $this->session->set_flashdata('flash_message', get_phrase('QR codes generated successfully'));
        redirect(base_url(). 'admin/student_information', 'refresh');
    }

    function view_student($id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student = $this->db->select('student.*, class.name as class_name, ad_class.name as ad_class_name, section.name as section_name, board.board_name, academy.academy_name, religion.religion_name, category.cat_name, cast.cast_name, student_group.group_name')
            ->join('class', 'class.class_id = student.class_id', 'left')
            ->join('class as ad_class', 'ad_class.class_id = student.ad_class_id', 'left')
            ->join('section', 'section.section_id = student.section_id', 'left')
            ->join('board', 'board.board_id = student.board_id', 'left')
            ->join('academy', 'academy.academy_id = student.academy_id', 'left')
            ->join('religion', 'religion.religion_id = student.re_id', 'left')
            ->join('category', 'category.category_id = student.cat_id', 'left')
            ->join('cast', 'cast.cast_id = student.cast_id', 'left')
            ->join('student_group', 'student_group.group_id = student.group_id', 'left')
            ->get_where('student', array('student_id' => $id))->row_array();

        if(empty($student)){
            $this->session->set_flashdata('flash_message', 'Student not found');
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        $page_data['student'] = $student;
        $page_data['academies'] = $this->db->get('academy')->result_array();
        $page_data['boards'] = $this->db->get('board')->result_array();
        $page_data['religions'] = $this->db->get('religion')->result_array();
        $page_data['categories'] = $this->db->get('category')->result_array();
        $page_data['casts'] = $this->db->get_where('cast', array('cat_id' => $student['cat_id']))->result_array();
        $page_data['mother_tongues'] = $this->db->get('mother_tongue')->result_array();
        $page_data['previous_schools'] = $this->db->get('previous_school')->result_array();
        $page_data['classes'] = $this->db->order_by('sort_order', 'asc')->get('class')->result_array();
        $page_data['sections'] = $this->db->get_where('section', array('class_id' => $student['class_id']))->result_array();
        $page_data['student_groups'] = $this->db->get('student_group')->result_array();
        $page_data['banks'] = $this->db->get('bank')->result_array();
        $page_data['documents'] = $this->db->order_by('id', 'desc')->where('student_id', $id)->where_in('document_type', array('Leaving Certificate', 'Bonafide Certificate', 'Form-15A', 'Covering Letter', 'Character Certificate', 'ID Card'))->get('student_documents')->result_array();
        $page_data['student_documents'] = $this->db->order_by('id', 'desc')->where('student_id', $id)->where('document_file !=', '')->get('student_documents')->result_array();

        $this->db->select('student_promotion_history.*, old_cls.name as old_class_name, new_cls.name as new_class_name');
        $this->db->join('class as old_cls', 'old_cls.class_id = student_promotion_history.old_class_id', 'left');
        $this->db->join('class as new_cls', 'new_cls.class_id = student_promotion_history.new_class_id', 'left');
        $this->db->where('student_promotion_history.student_id', $id);
        $this->db->order_by('student_promotion_history.id', 'desc');
        $page_data['promotion_history'] = $this->db->get('student_promotion_history')->result_array();

        $page_data['page_name'] = 'view_student';
        $page_data['page_title'] = 'View Student';
        $this->load->view('backend/index', $page_data);
    }

    function view_student_update($id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $data = array(
            'ad_year'             => html_escape($this->input->post('ad_year')),
            'ad_type'             => html_escape($this->input->post('ad_type')),
            'academy_id'          => html_escape($this->input->post('academy_id')),
            'ad_date'             => html_escape($this->input->post('ad_date')),
            'gen_reg_no'          => html_escape($this->input->post('gen_reg_no')),
            'board_id'            => html_escape($this->input->post('board_id')),
            'student_no'          => html_escape($this->input->post('student_no')),
            'uid'                 => html_escape($this->input->post('uid')),
            'ad_remarks'          => html_escape($this->input->post('ad_remarks')),
            'leaving_date'        => html_escape($this->input->post('leaving_date')),
            'leaving_reason'      => html_escape($this->input->post('leaving_reason')),
            'remarks'             => $this->input->post('remarks'),
            'name'                => html_escape($this->input->post('name')),
            'father_name'         => html_escape($this->input->post('father_name')),
            'mother_name'         => html_escape($this->input->post('mother_name')),
            'parent_phone'        => html_escape($this->input->post('parent_phone')),
            'sex'                 => html_escape($this->input->post('sex')),
            'birthday'            => html_escape($this->input->post('birthday')),
            're_id'               => html_escape($this->input->post('re_id')),
            'parent_uid'          => html_escape($this->input->post('parent_uid')),
            'bank_id'             => html_escape($this->input->post('bank_id')),
            'father_profession'   => html_escape($this->input->post('father_profession')),
            'mother_profession'   => html_escape($this->input->post('mother_profession')),
            'phone'               => html_escape($this->input->post('phone')),
            'nationality'         => html_escape($this->input->post('nationality')),
            'place_birth'         => html_escape($this->input->post('birth_place')),
            'cat_id'              => html_escape($this->input->post('cat_id')),
            'account_number'      => html_escape($this->input->post('account_number')),
            'father_edu_id'       => html_escape($this->input->post('father_edu_id')),
            'mother_edu_id'       => html_escape($this->input->post('mother_edu_id')),
            'blood_group'         => html_escape($this->input->post('blood_gp')),
            'm_tongue'            => html_escape($this->input->post('mt_id')),
            'address'             => html_escape($this->input->post('address')),
            'cast_id'             => html_escape($this->input->post('cast_id')),
            'residential'         => html_escape($this->input->post('residential')),
            'ps_attended'         => html_escape($this->input->post('ps_id')),
            'group_id'            => html_escape($this->input->post('group_id')),
            'class_id'            => html_escape($this->input->post('class_id')),
            'ad_class_id'         => html_escape($this->input->post('ad_class_id')),
            'section_id'          => html_escape($this->input->post('section_id')),
            'status'              => html_escape($this->input->post('status')),
        );

        $password = $this->input->post('password');
        if(!empty($password)){
            $data['password'] = sha1($password);
        }

        $this->db->where('student_id', $id);
        $this->db->update('student', $data);

        // Handle photo upload
        if(!empty($_FILES['userfile']['tmp_name'])){
            $upload_path = 'uploads/student_image/';
            if(!is_dir($upload_path)) mkdir($upload_path, 0777, true);
            $new_photo = $id . '_' . time() . '.jpg';
            move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_path . $new_photo);
            $old_photo = $this->db->get_where('student', array('student_id' => $id))->row()->photo;
            if(!empty($old_photo) && $old_photo != $new_photo && file_exists($upload_path . $old_photo)){
                @unlink($upload_path . $old_photo);
            }
            $this->db->where('student_id', $id);
            $this->db->update('student', array('photo' => $new_photo));
        }

        $this->session->set_flashdata('flash_message', get_phrase('Student updated successfully'));
        redirect(base_url(). 'admin/view_student/' . $id, 'refresh');
    }

    function get_class_sections($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        $output = '<option value="">Select</option>';
        foreach($sections as $sec){
            $output .= '<option value="'.$sec['section_id'].'">'.html_escape($sec['name']).'</option>';
        }
        echo $output;
    }

    function print_student_form($id){
        $student = $this->db->select('student.*, class.name as class_name, section.name as section_name, board.board_name, academy.academy_name, religion.religion_name, category.cat_name, cast.cast_name, student_group.group_name')
            ->join('class', 'class.class_id = student.class_id', 'left')
            ->join('section', 'section.section_id = student.section_id', 'left')
            ->join('board', 'board.board_id = student.board_id', 'left')
            ->join('academy', 'academy.academy_id = student.academy_id', 'left')
            ->join('religion', 'religion.religion_id = student.re_id', 'left')
            ->join('category', 'category.category_id = student.cat_id', 'left')
            ->join('cast', 'cast.cast_id = student.cast_id', 'left')
            ->join('student_group', 'student_group.group_id = student.group_id', 'left')
            ->get_where('student', array('student_id' => $id))->row_array();

        if(empty($student)){
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        $page_data['student'] = $student;
        $this->load->view('backend/admin/print_student_form', $page_data);
    }

    function view_student_add_document(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student_id = $this->input->post('student_id');
        $document_type = html_escape($this->input->post('document_type'));
        $remarks = html_escape($this->input->post('remarks'));
        $entry_user = $this->session->userdata('name') ? $this->session->userdata('name') : 'Administrator';

        $document_file = '';
        if(!empty($_FILES['document_file']['name'])){
            $config['upload_path'] = FCPATH . 'uploads/std_document/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('document_file')){
                $upload_data = $this->upload->data();
                $document_file = $upload_data['file_name'];
            }
        }

        $data = array(
            'student_id'     => $student_id,
            'document_type'  => $document_type,
            'document_file'  => $document_file,
            'remarks'        => $remarks,
            'entry_user'     => $entry_user,
            'created_at'     => date('Y-m-d H:i:s'),
        );

        $this->db->insert('student_documents', $data);

        $this->session->set_flashdata('flash_message', 'Document added successfully');
        redirect(base_url(). 'admin/view_student/' . $student_id, 'refresh');
    }

    function view_student_update_document(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $doc_id = $this->input->post('doc_id');
        $student_id = $this->input->post('student_id');
        $name = $this->session->userdata('name');

        $update_data = array(
            'document_type' => $this->input->post('document_type'),
            'remarks' => $this->input->post('remarks'),
            'entry_user' => !empty($name) ? $name : 'Administrator',
            'updated_at' => date('Y-m-d H:i:s'),
        );

        if(!empty($_FILES['document_file']['name'])){
            $config['upload_path'] = FCPATH . 'uploads/std_document/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('document_file')){
                $upload_data = $this->upload->data();
                $new_file = $upload_data['file_name'];

                $old_doc = $this->db->get_where('student_documents', array('id' => $doc_id))->row_array();
                if(!empty($old_doc['document_file'])){
                    $old_path = FCPATH . 'uploads/std_document/' . $old_doc['document_file'];
                    if(file_exists($old_path)) unlink($old_path);
                }

                $update_data['document_file'] = $new_file;
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('flash_message', 'File upload failed: ' . $error);
                redirect(base_url(). 'admin/view_student/' . $student_id, 'refresh');
                return;
            }
        }

        $this->db->where('id', $doc_id);
        $this->db->update('student_documents', $update_data);

        $this->session->set_flashdata('flash_message', 'Document updated successfully');
        redirect(base_url(). 'admin/view_student/' . $student_id, 'refresh');
    }

    function view_student_delete_document($doc_id, $student_id){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $doc = $this->db->get_where('student_documents', array('id' => $doc_id))->row_array();
        if(!empty($doc['document_file'])){
            $file_path = FCPATH . 'uploads/std_document/' . $doc['document_file'];
            if(file_exists($file_path)) unlink($file_path);
        }

        $this->db->where('id', $doc_id);
        $this->db->delete('student_documents');

        $this->session->set_flashdata('flash_message', 'Document deleted successfully');
        redirect(base_url(). 'admin/view_student/' . $student_id, 'refresh');
    }

    function print_student_document($student_id = 0, $doc_code = ''){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        if(empty($student)) redirect(base_url(), 'refresh');

        $class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
        $student['class_name'] = !empty($class) ? $class['name'] : '';

        $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row_array();
        $student['section_name'] = !empty($section) ? $section['name'] : '';

        $doc_type_map = array(
            'stdlc' => 'Leaving Certificate',
        );
        $doc_name = isset($doc_type_map[$doc_code]) ? $doc_type_map[$doc_code] : $doc_code;

        $name = $this->session->userdata('name');
        $entry_user = !empty($name) ? $name : 'Administrator';

        $next_sr = $this->db->select_max('sr_no')->where('sr_no >', 0)->get('student_documents')->row()->sr_no;
        $next_sr = max(intval($next_sr), 0) + 1;

        $charges = $this->input->get('remark') ? $this->input->get('charges') : '0 Rs';
        $fee_remark = $this->input->get('remark') ? $this->input->get('remark') : '';

        $insert_data = array(
            'student_id' => $student_id,
            'document_type' => $doc_name,
            'remarks' => $fee_remark,
            'document_file' => '',
            'document_version' => '',
            'document_charges' => $charges,
            'fee_remark' => $fee_remark,
            'sr_no' => $next_sr,
            'entry_user' => $entry_user,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('student_documents', $insert_data);

        if($doc_code == 'stdlc'){
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('status' => 1));
            $student['status'] = 1;
        }

        $system_name_row = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($system_name_row) ? $system_name_row->description : 'Acharya English Medium School';

        $page_data = array();
        $page_data['student'] = $student;
        $page_data['system_name'] = $system_name;
        $page_data['doc_type'] = $doc_code;
        $page_data['doc_name'] = $doc_name;
        $this->load->view('backend/admin/print_document', $page_data);
    }

    function student_transfer_modal(){
        if ($this->session->userdata('admin_login') != 1) return;
        $student_ids = $this->input->post('student_ids');
        $page_data['param2'] = $student_ids;
        $this->load->view('backend/admin/modal_student_transfer.php', $page_data);
    }

    function student_transfer(){
        if ($this->session->userdata('admin_login') != 1) {
            echo json_encode(array('status' => 'error', 'message' => 'Unauthorized'));
            return;
        }

        $student_ids = $this->input->post('student_ids');
        $new_class_id = $this->input->post('new_class_id');
        $new_section_id = $this->input->post('new_section_id');
        $session = $this->input->post('session');

        if(empty($student_ids) || empty($new_class_id) || empty($new_section_id)){
            echo json_encode(array('status' => 'error', 'message' => 'Please select students, standard and section.'));
            return;
        }

        $ids_array = explode(',', $student_ids);
        $count = 0;
        $admin_name = $this->session->userdata('name');
        if(empty($admin_name)) $admin_name = $this->session->userdata('email');
        if(empty($admin_name)) $admin_name = 'Admin';

        $this->db->trans_start();

        foreach($ids_array as $sid){
            $sid = trim($sid);
            if(empty($sid)) continue;

            $student = $this->db->get_where('student', array('student_id' => $sid))->row_array();
            if(!$student) continue;

            $old_class_id = $student['class_id'];
            $old_section_id = $student['section_id'];

            $update_data = array(
                'class_id'   => $new_class_id,
                'section_id' => $new_section_id,
            );
            if(!empty($session)){
                $update_data['ad_year'] = $session;
            }

            $this->db->where('student_id', $sid);
            $this->db->update('student', $update_data);

            $this->db->insert('student_promotion_history', array(
                'student_id'     => $sid,
                'student_name'   => $student['name'],
                'old_class_id'   => $old_class_id,
                'old_section_id' => $old_section_id,
                'new_class_id'   => $new_class_id,
                'new_section_id' => $new_section_id,
                'session'        => $session,
                'promoted_by'    => $admin_name,
                'promoted_at'    => date('Y-m-d H:i:s'),
            ));

            $this->db->insert('audit_log', array(
                'action'       => 'STUDENT_PROMOTED',
                'description'  => 'Student ' . $student['name'] . ' (' . $sid . ') promoted',
                'entity_type'  => 'student',
                'entity_id'    => $sid,
                'old_value'    => json_encode(array('class_id' => $old_class_id, 'section_id' => $old_section_id)),
                'new_value'    => json_encode(array('class_id' => $new_class_id, 'section_id' => $new_section_id, 'session' => $session)),
                'user_name'    => $admin_name,
                'created_at'   => date('Y-m-d H:i:s'),
            ));

            $count++;
        }

        $this->db->trans_complete();

        echo json_encode(array(
            'status'  => 'ok',
            'message' => $count . ' student(s) promoted successfully.',
        ));
    }

    function promotion_history(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'promotion_history';
        $page_data['page_title'] = get_phrase('Promotion History');
        $this->load->view('backend/index', $page_data);
    }

    function promotion_history_list(){
        if ($this->session->userdata('admin_login') != 1) { echo json_encode(array('data' => array())); return; }

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $this->db->select('student_promotion_history.*, old_cls.name as old_class_name, old_sec.name as old_section_name, new_cls.name as new_class_name, new_sec.name as new_section_name');
        $this->db->join('class as old_cls', 'old_cls.class_id = student_promotion_history.old_class_id', 'left');
        $this->db->join('section as old_sec', 'old_sec.section_id = student_promotion_history.old_section_id', 'left');
        $this->db->join('class as new_cls', 'new_cls.class_id = student_promotion_history.new_class_id', 'left');
        $this->db->join('section as new_sec', 'new_sec.section_id = student_promotion_history.new_section_id', 'left');
        $this->db->from('student_promotion_history');

        $total_records = $this->db->count_all_results('', false);

        $this->db->order_by('student_promotion_history.id', 'desc');
        if(!empty($length) && $length != -1){
            $this->db->limit($length, $start);
        }
        $query = $this->db->get();
        $rows = $query->result_array();

        $data = array();
        foreach($rows as $row){
            $data[] = array(
                $row['id'],
                $row['student_id'],
                $row['student_name'],
                $row['old_class_name'],
                $row['old_section_name'],
                $row['new_class_name'],
                $row['new_section_name'],
                $row['session'] ? $row['session'] : '-',
                $row['promoted_by'],
                date('d-m-Y H:i', strtotime($row['promoted_at'])),
            );
        }

        echo json_encode(array(
            "draw"            => $draw,
            "recordsTotal"    => intval($total_records),
            "recordsFiltered" => intval($total_records),
            "data"            => $data,
        ));
    }

    function pending_fees(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'pending_fees';
        $page_data['page_title'] = 'Fees Report';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $page_data['academies'] = $this->db->order_by('academy_id', 'ASC')->get('academy')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function fees_report(){
        redirect(base_url().'admin/pending_fees', 'refresh');
    }

    function fees_discount_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'fees_discount';
        $page_data['page_title'] = 'Fees Discount Report';
        $this->load->view('backend/index', $page_data);
    }

    function fees_notice_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'fees_notice';
        $page_data['page_title'] = 'Fees Notice Report';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function standard_division_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'standard_division_report';
        $page_data['page_title'] = 'Standard & Division Report';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function leaving_certificate_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'leaving_certificate_report';
        $page_data['page_title'] = 'Leaving Certificate Report';
        $this->load->view('backend/index', $page_data);
    }

    function religion_category_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'religion_category_report';
        $page_data['page_title'] = 'Religion Category Report';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $religions = $this->db->order_by('religion_name', 'ASC')->get('religion')->result_array();
        $page_data['religions'] = $religions;
        $page_data['categories'] = $this->db->order_by('cat_name', 'ASC')->get('category')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function gender_wise_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'gender_wise_report';
        $page_data['page_title'] = 'Gender Wise Student List';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function uid_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'uid_report';
        $page_data['page_title'] = 'Student UID List';
        $page_data['classes'] = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function student_count_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'student_count_report';
        $page_data['page_title'] = 'Student Count Report';
        $this->load->view('backend/index', $page_data);
    }

    function org_details(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = 'Organization Information';
        $this->load->view('backend/index', $page_data);
    }

    function org_documents($action = ''){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($action == 'insert'){
            $title = $this->input->post('title');
            if(!empty($_FILES['document_file']['name'])){
                $config['upload_path'] = FCPATH . 'uploads/sys_documents/';
                $config['allowed_types'] = '*';
                $config['max_size'] = 0;
                $config['file_name'] = rand(1000000000, 9999999999) . $_FILES['document_file']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('document_file')){
                    $file_data = $this->upload->data();
                    $data = array(
                        'title' => $title,
                        'file_name' => $file_data['file_name'],
                        'entry_user' => $this->session->userdata('name'),
                    );
                    $this->db->insert('sys_documents', $data);
                    $this->session->set_flashdata('flash_message', 'Document uploaded successfully');
                } else {
                    $this->session->set_flashdata('error_message', $this->upload->display_errors());
                }
            }
            redirect(base_url('admin/org_documents'));
            return;
        }

        if($action == 'delete'){
            $doc_ids = $this->input->post('doc_ids');
            if(!empty($doc_ids)){
                $ids = explode(',', $doc_ids);
                foreach($ids as $id){
                    $doc = $this->db->get_where('sys_documents', array('doc_id' => intval($id)))->row_array();
                    if(!empty($doc)){
                        $file_path = 'uploads/sys_documents/' . $doc['file_name'];
                        if(file_exists($file_path)){
                            unlink($file_path);
                        }
                        $this->db->where('doc_id', intval($id))->delete('sys_documents');
                    }
                }
            }
            echo 'success';
            return;
        }

        $page_data['documents'] = $this->db->order_by('created_at', 'DESC')->get('sys_documents')->result_array();
        $page_data['page_name'] = 'org_documents';
        $page_data['page_title'] = 'Organization Documents';
        $this->load->view('backend/index', $page_data);
    }

    function get_class_section_fees($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        if(empty($sections)){
            echo '<option value="">No divisions found</option>';
            return;
        }
        echo '<option value="">Select Division</option>';
        foreach($sections as $section){
            echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
        }
    }

    function journal_voucher($action = '', $id = ''){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        if($action == 'create'){
            $config['upload_path'] = FCPATH . 'uploads/journal_voucher/';
            $config['allowed_types'] = '*';
            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, true);
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $bill_file = '';
            if($this->upload->do_upload('billfile')){
                $bill_data = $this->upload->data();
                $bill_file = $bill_data['file_name'];
            }

            $data = array(
                'voucher_no'          => $this->input->post('voucher_no'),
                'expense_category_id' => $this->input->post('expense_category_id'),
                'date'                => $this->input->post('timestamp'),
                'total_amount'        => $this->input->post('total_amount'),
                'narration'           => $this->input->post('description'),
                'financial_year'      => $this->input->post('financial_year'),
                'bank_id'             => $this->input->post('bank_id'),
                'transaction_type'    => $this->input->post('transaction_type'),
                'client_id'           => $this->input->post('client_id'),
                'client_name'         => $this->input->post('client_name'),
                'bill_file'           => $bill_file,
                'entry_user'          => $this->session->userdata('name'),
            );
            $this->db->insert('journal_voucher', $data);
            $this->session->set_flashdata('flash_message', 'Journal Voucher added successfully');
            redirect(base_url('admin/journal_voucher'));
            return;
        }

        if($action == 'update'){
            $config['upload_path'] = FCPATH . 'uploads/journal_voucher/';
            $config['allowed_types'] = '*';
            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, true);
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $bill_file = $this->input->post('existing_bill');
            if($this->upload->do_upload('billfile')){
                $bill_data = $this->upload->data();
                $bill_file = $bill_data['file_name'];
                $old = $this->input->post('existing_bill');
                if(!empty($old) && file_exists(FCPATH . 'uploads/journal_voucher/' . $old)){
                    unlink(FCPATH . 'uploads/journal_voucher/' . $old);
                }
            }

            $data = array(
                'expense_category_id' => $this->input->post('expense_category_id'),
                'date'                => $this->input->post('timestamp'),
                'total_amount'        => $this->input->post('total_amount'),
                'narration'           => $this->input->post('description'),
                'financial_year'      => $this->input->post('financial_year'),
                'bank_id'             => $this->input->post('bank_id'),
                'transaction_type'    => $this->input->post('transaction_type'),
                'client_id'           => $this->input->post('client_id'),
                'client_name'         => $this->input->post('client_name'),
                'bill_file'           => $bill_file,
            );
            $this->db->where('journal_voucher_id', $id)->update('journal_voucher', $data);
            $this->session->set_flashdata('flash_message', 'Journal Voucher updated successfully');
            redirect(base_url('admin/journal_voucher'));
            return;
        }

        if($action == 'delete'){
            $row = $this->db->get_where('journal_voucher', array('journal_voucher_id' => $id))->row_array();
            if(!empty($row['bill_file']) && file_exists(FCPATH . 'uploads/journal_voucher/' . $row['bill_file'])){
                unlink(FCPATH . 'uploads/journal_voucher/' . $row['bill_file']);
            }
            $this->db->where('journal_voucher_id', $id)->delete('journal_voucher');
            $this->session->set_flashdata('flash_message', 'Journal Voucher deleted successfully');
            redirect(base_url('admin/journal_voucher'));
            return;
        }

        $next_voucher = $this->db->count_all('journal_voucher') + 1;
        $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
        $page_data['next_voucher_no'] = $next_voucher . '/' . $running_year;
        $page_data['running_year'] = $running_year;

        $years = array();
        $yrows = $this->db->query("SELECT DISTINCT year FROM payment WHERE year IS NOT NULL AND year <> ''")->result_array();
        foreach($yrows as $yr){ $years[$yr['year']] = $yr['year']; }
        $yrows2 = $this->db->query("SELECT DISTINCT financial_year FROM journal_voucher WHERE financial_year IS NOT NULL AND financial_year <> ''")->result_array();
        foreach($yrows2 as $yr){ $years[$yr['financial_year']] = $yr['financial_year']; }
        $years[$running_year] = $running_year;
        krsort($years);
        $page_data['years'] = array_keys($years);
        $page_data['vouchers'] = $this->db->order_by('journal_voucher_id', 'DESC')->get('journal_voucher')->result_array();
        $page_data['expense_categories'] = $this->db->order_by('name', 'ASC')->get('expense_category')->result_array();
        $page_data['banks'] = $this->db->order_by('bank_name', 'ASC')->get('bank')->result_array();
        $page_data['clients'] = $this->db->order_by('name', 'ASC')->get('client')->result_array();
        $page_data['page_name'] = 'journal_voucher';
        $page_data['page_title'] = 'Journal Voucher';
        $this->load->view('backend/index', $page_data);
    }

    function journal_voucher_print($id = ''){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        if(!$id) show_404();

        $row = $this->db->get_where('journal_voucher', array('journal_voucher_id' => $id))->row_array();
        if(!$row) show_404();

        $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($settings_name) ? $settings_name->description : 'School';
        $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
        $school_phone = !empty($phone_row) ? $phone_row->description : '';

        $client = $this->db->get_where('client', array('client_id' => $row['client_id']))->row_array();
        $category = $this->db->get_where('expense_category', array('expense_category_id' => $row['expense_category_id']))->row_array();
        $bank = $this->db->get_where('bank', array('bank_id' => $row['bank_id']))->row_array();

        $page_data = array(
            'row'          => $row,
            'client'       => !empty($client) ? $client : array(),
            'category'     => !empty($category) ? $category : array(),
            'bank'         => !empty($bank) ? $bank : array(),
            'system_name'  => $system_name,
            'school_phone' => $school_phone,
        );
        $this->load->view('backend/admin/print_journal_voucher', $page_data);
    }

    function journal_voucher_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'journal_voucher_report';
        $page_data['page_title'] = 'Journal Voucher Report';
        $page_data['clients'] = $this->db->order_by('name', 'ASC')->get('client')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function daily_expense(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $years = array();
        $yrows = $this->db->query("SELECT DISTINCT year FROM payment WHERE year IS NOT NULL AND year <> ''")->result_array();
        foreach($yrows as $yr){ $years[$yr['year']] = $yr['year']; }
        $yrows2 = $this->db->query("SELECT DISTINCT financial_year FROM journal_voucher WHERE financial_year IS NOT NULL AND financial_year <> ''")->result_array();
        foreach($yrows2 as $yr){ $years[$yr['financial_year']] = $yr['financial_year']; }
        $years[$running_year] = $running_year;
        krsort($years);

        $page_data['years'] = array_keys($years);
        $page_data['running_year'] = $running_year;
        $page_data['expense_categories'] = $this->db->order_by('name', 'ASC')->get('expense_category')->result_array();
        $page_data['page_name'] = 'daily_expense';
        $page_data['page_title'] = 'Daily Expense';
        $this->load->view('backend/index', $page_data);
    }

    function daily_cashbook(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $years = array();
        $yrows = $this->db->query("SELECT DISTINCT year FROM payment WHERE year IS NOT NULL AND year <> ''")->result_array();
        foreach($yrows as $yr){ $years[$yr['year']] = $yr['year']; }
        $yrows2 = $this->db->query("SELECT DISTINCT financial_year FROM journal_voucher WHERE financial_year IS NOT NULL AND financial_year <> ''")->result_array();
        foreach($yrows2 as $yr){ $years[$yr['financial_year']] = $yr['financial_year']; }
        $years[$running_year] = $running_year;
        krsort($years);

        $page_data['years'] = array_keys($years);
        $page_data['running_year'] = $running_year;
        $page_data['page_name'] = 'daily_cashbook';
        $page_data['page_title'] = 'Daily Cashbook';
        $this->load->view('backend/index', $page_data);
    }

    function bank_statement_report(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $years = array();
        $yrows = $this->db->query("SELECT DISTINCT year FROM payment WHERE year IS NOT NULL AND year <> ''")->result_array();
        foreach($yrows as $yr){ $years[$yr['year']] = $yr['year']; }
        $years[$running_year] = $running_year;
        krsort($years);

        $page_data['years'] = array_keys($years);
        $page_data['running_year'] = $running_year;
        $page_data['banks'] = $this->db->order_by('bank_name', 'ASC')->get('bank')->result_array();
        $page_data['page_name'] = 'bank_statement_report';
        $page_data['page_title'] = 'Bank Statement';
        $this->load->view('backend/index', $page_data);
    }

    function cashbook(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'cashbook';
        $page_data['page_title'] = 'Cashbook';
        $page_data['banks'] = $this->db->get('bank')->result_array();
        $page_data['expense_categories'] = $this->db->get('expense_category')->result_array();
        $page_data['admins'] = $this->db->order_by('name', 'ASC')->get('admin')->result_array();
        $page_data['years'] = $this->db->query("SELECT DISTINCT year FROM payment ORDER BY year DESC")->result_array();
        $session_year = $this->db->get_where('settings', array('type' => 'session'))->row();
        $page_data['session_year'] = $session_year ? $session_year->description : '';
        $page_data['expcat_id']     = $this->input->get('expcat_id');
        $page_data['income_type']   = $this->input->get('income_type');
        $page_data['from']          = $this->input->get('from');
        $page_data['to']            = $this->input->get('to');
        $this->load->view('backend/index', $page_data);
    }

    function cashbookList(){
        if(!$this->session->userdata('admin_login')){
            echo json_encode(array('draw'=>1,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>array()));
            return;
        }

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $expcat_id = $this->input->post('expcat_id');
        $income_type = $this->input->post('income_type');
        $admin_id = $this->input->post('admin_id');
        $year = $this->input->post('year');
        $from = $this->input->post('from');
        $to = $this->input->post('to');

        $total_records = $this->db->query("SELECT COUNT(*) as cnt FROM payment")->row()->cnt;

        $where = "1=1";
        if(!empty($income_type)){
            $ptype = ($income_type == 'credit') ? 'income' : 'expense';
            $where .= " AND payment.payment_type='" . $ptype . "'";
        }
        if(!empty($expcat_id)){
            $where .= " AND payment.expense_category_id='" . intval($expcat_id) . "'";
        }
        if(!empty($year)){
            $where .= " AND payment.year='" . $this->db->escape_str($year) . "'";
        }
        if(!empty($from)){
            $where .= " AND payment.timestamp >= " . intval(strtotime($from));
        }
        if(!empty($to)){
            $where .= " AND payment.timestamp <= " . intval(strtotime($to) + 86399);
        }
        if(!empty($admin_id)){
            $admin = $this->db->get_where('admin', array('admin_id' => $admin_id))->row_array();
            if($admin){
                $where .= " AND payment.entry_user='" . $this->db->escape_str($admin['name']) . "'";
            }
        }

        $search = $this->input->post('search');
        $search_value = isset($search['value']) ? trim($search['value']) : '';
        if(!empty($search_value)){
            $s = $this->db->escape_like_str($search_value);
            $where .= " AND (CAST(payment.payment_id AS CHAR) LIKE '%" . $s . "%'
                OR payment.receipt_no LIKE '%" . $s . "%'
                OR CONCAT(payment.payment_id, '-', YEAR(FROM_UNIXTIME(payment.timestamp))) LIKE '%" . $s . "%'
                OR payment.description LIKE '%" . $s . "%'
                OR payment.title LIKE '%" . $s . "%'
                OR payment.person_org_name LIKE '%" . $s . "%'
                OR payment.entry_user LIKE '%" . $s . "%'
                OR CAST(payment.amount AS CHAR) LIKE '%" . $s . "%'
                OR REPLACE(FORMAT(payment.amount, 0), ',', '') LIKE '%" . $s . "%'
                OR student.name LIKE '%" . $s . "%'
                OR expense_category.name LIKE '%" . $s . "%'
                OR CASE payment.method WHEN '1' THEN 'by bank' WHEN '2' THEN 'by cash' WHEN '3' THEN 'by cheque' ELSE payment.method END LIKE '%" . $s . "%')";
        }

        $filtered_result = $this->db->query("SELECT COUNT(*) as cnt FROM payment
            LEFT JOIN student ON student.student_id = payment.student_id
            LEFT JOIN expense_category ON expense_category.expense_category_id = payment.expense_category_id
            WHERE $where");
        $filtered_records = $filtered_result->row()->cnt;

        $sql = "SELECT payment.*, student.name as student_name, expense_category.name as category_name, bank.bank_name
                FROM payment
                LEFT JOIN student ON student.student_id = payment.student_id
                LEFT JOIN expense_category ON expense_category.expense_category_id = payment.expense_category_id
                LEFT JOIN bank ON bank.bank_id = payment.bank_id
                WHERE $where
                ORDER BY payment.payment_id DESC
                LIMIT " . intval($length) . " OFFSET " . intval($start);
        $payments = $this->db->query($sql)->result_array();

        $data = array();
        foreach($payments as $row){
            $is_credit = ($row['payment_type'] == 'income');

            if($is_credit){
                $income_type_label = 'credit';
                $category = 'School Fee';
            }else{
                $income_type_label = 'debit';
                $category = !empty($row['category_name']) ? $row['category_name'] : '-';
            }

            if($row['method'] == '1') $method = 'by bank';
            elseif($row['method'] == '2') $method = 'by cash';
            elseif($row['method'] == '3') $method = 'by cheque';
            else $method = $row['method'];

            $receipt_no = !empty($row['receipt_no']) ? $row['receipt_no'] : ($is_credit ? $row['payment_id'] . '-' . date('Y', $row['timestamp']) : '-');

            if($is_credit){
                $person_name = !empty($row['student_name']) ? $row['student_name'] : $row['person_org_name'];
            }else{
                $person_name = !empty($row['person_org_name']) ? $row['person_org_name'] : $row['title'];
            }
            $person_name = !empty($person_name) ? $person_name : '-';

            $bank_name = !empty($row['bank_name']) ? $row['bank_name'] : 'Cash';
            $entry_user = !empty($row['entry_user']) ? $row['entry_user'] : '-';

            $action = '';
            if (has_action('accounts', 'cashbook', 'edit')) {
                $action .= '<button type="button" onclick="showAjaxModal(\''.base_url().'modal/popup/edit_cashbook/'.$row['payment_id'].'\')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button> ';
            }
            if (has_action('accounts', 'cashbook', 'delete')) {
                $action .= '<button type="button" onclick="confirm_modal(\''.base_url().'expense/cashbook/delete/'.$row['payment_id'].'\')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button>';
            }

            $data[] = array(
                $row['payment_id'],
                $action,
                date('d-m-Y', $row['timestamp']),
                $receipt_no,
                $income_type_label,
                $category,
                $method,
                number_format($row['amount']),
                $row['description'],
                $person_name,
                $bank_name,
                $entry_user
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $filtered_records,
            "data" => $data
        );
        echo json_encode($output);
    }

    function dailyreport(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $admin_id = intval($this->input->post('admin_id'));
        if($admin_id == 0 && $this->input->get('admin_id') !== null){
            $admin_id = intval($this->input->get('admin_id'));
        }

        $from = $this->input->post('from');
        $to = $this->input->post('to');
        if(empty($from)) $from = $this->input->get('from');
        if(empty($to)) $to = $this->input->get('to');

        if(empty($from)) $from = date('Y-m-d');
        if(empty($to)) $to = date('Y-m-d');

        $selected_admin = 'All User';
        $admin_name = '';
        if($admin_id != 0){
            $admin = $this->db->get_where('admin', array('admin_id' => $admin_id))->row_array();
            if(!empty($admin)){
                $admin_name = $admin['name'];
                $selected_admin = $admin['name'];
            }
        }

        $from_ts = strtotime($from . ' 00:00:00');
        $to_ts = strtotime($to . ' 23:59:59');

        $income_where = "payment.payment_type='income' AND payment.timestamp >= " . $from_ts . " AND payment.timestamp <= " . $to_ts;
        if(!empty($admin_name)){
            $income_where .= " AND payment.entry_user='" . $this->db->escape_str($admin_name) . "'";
        }
        $income_rows = $this->db->query("SELECT payment.*, student.name as student_name, class.name as class_name
            FROM payment
            LEFT JOIN student ON student.student_id = payment.student_id
            LEFT JOIN class ON class.class_id = student.class_id
            WHERE " . $income_where . " ORDER BY payment.timestamp ASC, payment.payment_id ASC")->result_array();
        $income_total = 0;
        foreach($income_rows as $key => $row){
            $income_rows[$key]['person_name'] = !empty($row['student_name']) ? $row['student_name'] : (!empty($row['person_org_name']) ? $row['person_org_name'] : $row['title']);
            $income_rows[$key]['class_name'] = !empty($row['class_name']) ? $row['class_name'] : '';
            $income_total += floatval($row['amount']);
        }

        $expense_where = "payment.payment_type='expense' AND payment.timestamp >= " . $from_ts . " AND payment.timestamp <= " . $to_ts;
        if(!empty($admin_name)){
            $expense_where .= " AND payment.entry_user='" . $this->db->escape_str($admin_name) . "'";
        }
        $expense_rows = $this->db->query("SELECT payment.*, expense_category.name as category_name
            FROM payment
            LEFT JOIN expense_category ON expense_category.expense_category_id = payment.expense_category_id
            WHERE " . $expense_where . " ORDER BY payment.timestamp ASC, payment.payment_id ASC")->result_array();
        $expense_total = 0;
        foreach($expense_rows as $key => $row){
            $expense_rows[$key]['person_name'] = !empty($row['person_org_name']) ? $row['person_org_name'] : $row['title'];
            $expense_rows[$key]['category_name'] = !empty($row['category_name']) ? $row['category_name'] : '';
            $expense_total += floatval($row['amount']);
        }

        $admission_where = "s.ad_date >= '" . $this->db->escape_str($from) . "' AND s.ad_date <= '" . $this->db->escape_str($to) . "' AND s.status != 3";
        if(!empty($admin_name)){
            $admission_where .= " AND s.entry_user='" . $this->db->escape_str($admin_name) . "'";
        }
        $admissions = $this->db->query("SELECT s.*, class.name as class_name
            FROM student s
            LEFT JOIN class ON class.class_id = s.class_id
            WHERE " . $admission_where . " ORDER BY s.ad_date ASC, s.student_id ASC")->result_array();

        $doc_type_keys = array(
            'lc'        => 'Leaving Certificate',
            'bonafide'  => 'Bonafide Certificate',
            'form15'    => 'Form-15A',
            'covering'  => 'Covering Letter',
            'character' => 'Character Certificate',
            'idcard'    => 'ID Card',
            'attendance'=> '75% Attendance',
        );
        $doc_rows = array();
        foreach($doc_type_keys as $key => $doc_type){
            $doc_where = "sd.document_type='" . $this->db->escape_str($doc_type) . "'
                AND sd.entry_user != 'Student Upload'
                AND sd.created_at >= '" . $this->db->escape_str($from) . " 00:00:00'
                AND sd.created_at <= '" . $this->db->escape_str($to) . " 23:59:59'";
            if(!empty($admin_name)){
                $doc_where .= " AND sd.entry_user='" . $this->db->escape_str($admin_name) . "'";
            }
            $doc_rows[$key] = $this->db->query("SELECT sd.*, student.name as student_name, class.name as class_name
                FROM student_documents sd
                LEFT JOIN student ON student.student_id = sd.student_id
                LEFT JOIN class ON class.class_id = student.class_id
                WHERE " . $doc_where . " ORDER BY sd.created_at ASC, sd.id ASC")->result_array();
        }

        $page_data = array(
            'from'             => $from,
            'to'               => $to,
            'selected_admin'   => $selected_admin,
            'income_rows'      => $income_rows,
            'income_total'     => $income_total,
            'expense_rows'     => $expense_rows,
            'expense_total'    => $expense_total,
            'admissions'       => $admissions,
            'lc_docs'          => $doc_rows['lc'],
            'bonafide_docs'    => $doc_rows['bonafide'],
            'form15_docs'      => $doc_rows['form15'],
            'covering_docs'    => $doc_rows['covering'],
            'character_docs'   => $doc_rows['character'],
            'idcard_docs'      => $doc_rows['idcard'],
            'attendance_docs'  => $doc_rows['attendance'],
            'page_name'        => 'daily_report',
            'page_title'       => 'Daily Report',
        );
        $this->load->view('backend/index', $page_data);
    }

    function add_client_ajax(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        if(!empty($name)){
            $data = array('name' => $name, 'address' => $address, 'phone' => $phone);
            $this->db->insert('client', $data);
            echo 'success';
        } else {
            echo 'error';
        }
    }

    function get_client_list(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $clients = $this->db->get('client')->result_array();
        $options = '<option value="">Select</option>';
        foreach($clients as $c){
            $options .= '<option value="'.$c['client_id'].'">'.$c['name'].'</option>';
        }
        echo $options;
    }

}
