<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');					//Load library for session
    }


    function studentPaymentReport ($param1 = null, $param2 = null, $param3 = null){

    $page_data['page_name']     = 'studentPaymentReport';
    $page_data['page_title']    = get_phrase('Payment Report');
    $this->load->view('backend/index', $page_data);

    }


    function classAttendanceReport($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
        
        if ($_POST) {
            redirect(base_url() . 'admin/classAttendanceReport/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
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




    /***********  The function below manages school marks ***********************/
    function examMarkReport ($exam_id = null, $class_id = null, $student_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                redirect(base_url(). 'report/examMarkReport/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'report/examMarkReport', 'refresh');
            }
        }
    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'examMarkReport';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
}
/***********  The function that manages school marks ends here ***********************/


function view($doc_type = '', $action = '', $student_id = 0, $extra = ''){

        if($doc_type == 'StudentpaymentReceipt'){
            $invoice_id = $action;
            $payment_id = $student_id;

            $payment = $this->db->get_where('payment', array('payment_id' => $payment_id))->row_array();
            if(empty($payment)) redirect(base_url(), 'refresh');

            $prev_payment = $this->db->where('student_id', $payment['student_id'])->where('payment_id <', $payment['payment_id'])->order_by('payment_id', 'DESC')->limit(1)->get('payment')->row_array();
            $last_paid_amount = !empty($prev_payment) ? intval($prev_payment['amount']) : 0;

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $receipt_no = $payment['payment_id'] . '-' . date('Y', $payment['timestamp']);
            $receipt_date = date('d/m/Y', $payment['timestamp']);

            $pr_user = $this->session->userdata('name');
            $this->db->insert('audit_log', array(
                'action'      => 'RECEIPT_PRINTED',
                'description' => 'Receipt ' . $receipt_no . ' printed for payment ' . $payment_id,
                'entity_type' => 'payment',
                'entity_id'   => $payment_id,
                'user_name'   => !empty($pr_user) ? $pr_user : 'System',
                'created_at'  => date('Y-m-d H:i:s'),
            ));

            if(!empty($payment['snapshot_data'])){
                $snapshot = json_decode($payment['snapshot_data'], true);
                if(!empty($snapshot['receipt_number'])){
                    $receipt_no = $snapshot['receipt_number'];
                }
                if(!empty($snapshot['created_at'])){
                    $receipt_date = date('d/m/Y', strtotime($snapshot['created_at']));
                }
                $section_name = '';
                if(!empty($snapshot['section_id'])){
                    $sec = $this->db->get_where('section', array('section_id' => $snapshot['section_id']))->row_array();
                    $section_name = !empty($sec) ? $sec['name'] : '';
                }
                $page_data = array(
                    'payment'      => $payment,
                    'snapshot'     => $snapshot,
                    'section_name' => $section_name,
                    'student'      => array(
                        'name'         => $snapshot['student_name'],
                        'class_name'   => $snapshot['class_name'],
                        'class_id'     => $snapshot['class_id'],
                        'section_id'   => $snapshot['section_id'],
                        'student_id'   => $snapshot['student_id'],
                    ),
                    'fee_items'    => $this->db->where('invoice_id', $payment['invoice_id'])->get('invoice_item')->result_array(),
                    'total_fees'   => $snapshot['total_payable'],
                    'total_paid'   => $snapshot['total_paid'],
                    'total_due'    => $snapshot['balance_after'],
                    'last_paid_amount' => $last_paid_amount,
                    'system_name'      => $system_name,
                    'school_phone'     => $school_phone,
                    'receipt_no'       => $receipt_no,
                    'receipt_date'     => $receipt_date,
                );
                $this->load->view('backend/admin/print_receipt', $page_data);
                return;
            }

            $student = $this->db->get_where('student', array('student_id' => $payment['student_id']))->row_array();
            if(empty($student)) redirect(base_url(), 'refresh');

            $class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
            $student['class_name'] = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row_array();
            $student['section_name'] = !empty($section) ? $section['name'] : '';

            $all_invoices = $this->db->where('student_id', $student['student_id'])->where('status !=', '3')->order_by('creation_timestamp', 'asc')->get('invoice')->result_array();

            $total_fees = 0;
            $total_discount = 0;
            $total_paid = 0;
            $total_due = 0;
            foreach($all_invoices as $inv){
                $total_fees += $inv['amount'];
                $total_discount += $inv['discount'];
                $total_paid += $inv['amount_paid'];
                $total_due += $inv['due'];
            }

            $page_data = array(
                'payment' => $payment,
                'student' => $student,
                'invoices' => $all_invoices,
                'fee_items' => $this->db->where('invoice_id', $payment['invoice_id'])->get('invoice_item')->result_array(),
                'total_fees' => $total_fees,
                'total_paid' => $total_paid,
                'total_due' => $total_due,
                'last_paid_amount' => $last_paid_amount,
                'system_name' => $system_name,
                'school_phone' => $school_phone,
                'receipt_no' => $receipt_no,
                'receipt_date' => $receipt_date,
            );
            $this->load->view('backend/admin/print_receipt', $page_data);
            return;
        }

        if($doc_type == 'pendingfees'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;

            $academy_id = isset($_GET['academy_id']) ? $_GET['academy_id'] : 'all';
            $status = isset($_GET['status']) ? $_GET['status'] : 'all';

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section_name = '';
            if(!empty($section_id)){
                $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
                $section_name = !empty($section) ? $section['name'] : '';
            }

            $academy_name = '';
            if(!empty($academy_id) && $academy_id != 'all'){
                $academy = $this->db->get_where('academy', array('academy_id' => $academy_id))->row_array();
                $academy_name = !empty($academy) ? $academy['academy_name'] : '';
            }

            $status_label = '';
            $status_options = array('0' => 'Active', '1' => 'Inactive', '2' => 'Out Of School');
            if(!empty($status) && $status != 'all'){
                $status_label = isset($status_options[$status]) ? $status_options[$status] : '';
            }

            // Get all students with unpaid/partial invoices for the selected year
            $query = "SELECT s.student_id, s.name, s.phone, s.class_id, s.section_id, s.status, s.gen_reg_no,
                        (SELECT MAX(p2.timestamp) FROM payment p2 WHERE p2.student_id = s.student_id AND p2.year = '".$this->db->escape_str($ad_year)."') as last_paid_date,
                        IFNULL(SUM(i.previous_due), 0) as pending_fees,
                        IFNULL(SUM(i.amount), 0) as total_fees,
                        IFNULL(SUM(i.amount_paid), 0) as paid_fees,
                        IFNULL(SUM(i.due), 0) as total_due
                      FROM student s
                      INNER JOIN invoice i ON i.student_id = s.student_id
                      WHERE i.year = '".$this->db->escape_str($ad_year)."'
                       AND i.status NOT IN (1, 3)";

            // Filter by class_id - handle text type
            if(!empty($class_id)){
                $query .= " AND (s.class_id = '".$this->db->escape_str($class_id)."' OR s.class_id = ".intval($class_id).")";
            }

            if(!empty($section_id)){
                $query .= " AND (s.section_id = '".$this->db->escape_str($section_id)."' OR s.section_id = ".intval($section_id).")";
            }

            if(!empty($academy_id) && $academy_id != 'all'){
                $query .= " AND s.academy_id = ".$this->db->escape_str($academy_id);
            }

            if(!empty($status) && $status != 'all'){
                $query .= " AND s.status = ".intval($status);
            }

            $query .= " GROUP BY s.student_id ORDER BY s.class_id ASC, s.name ASC";

            $students = $this->db->query($query)->result_array();

            // Enrich with class/section names
            $status_map = array('0' => 'Active', '1' => 'Inactive', '2' => 'Out Of School');
            foreach($students as &$std){
                $cls = $this->db->get_where('class', array('class_id' => $std['class_id']))->row_array();
                $std['class_name'] = !empty($cls) ? $cls['name'] : '';
                $sec = $this->db->get_where('section', array('section_id' => $std['section_id']))->row_array();
                $std['section_name'] = !empty($sec) ? $sec['name'] : '';
                $std['status_label'] = isset($status_map[$std['status']]) ? $status_map[$std['status']] : '';
                $std['last_paid'] = !empty($std['last_paid_date']) ? date('d-m-Y', $std['last_paid_date']) : '-';
                $std['current_fees'] = intval($std['total_fees']) - intval($std['pending_fees']);
            }

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $page_data = array(
                'students' => $students,
                'ad_year' => $ad_year,
                'class_name' => $class_name,
                'section_name' => $section_name,
                'academy_name' => $academy_name,
                'status' => $status,
                'status_label' => $status_label,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_pending_fees', $page_data);
            return;
        }

        if($doc_type == 'pendingfeesnotice'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;
            $notice_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
            $section_name = !empty($section) ? $section['name'] : '';

            $query = "SELECT s.student_id, s.name, s.class_id, s.section_id,
                        IFNULL(SUM(i.amount), 0) as total_fees,
                        IFNULL(SUM(i.amount_paid), 0) as total_paid,
                        IFNULL(SUM(i.due), 0) as total_due
                      FROM student s
                      INNER JOIN invoice i ON i.student_id = s.student_id
                      WHERE i.year = '".$this->db->escape_str($ad_year)."'
                       AND i.status NOT IN (1, 3)
                       AND (s.class_id = '".$this->db->escape_str($class_id)."' OR s.class_id = ".intval($class_id).")
                       AND (s.section_id = '".$this->db->escape_str($section_id)."' OR s.section_id = ".intval($section_id).")
                      GROUP BY s.student_id
                      HAVING total_due > 0
                      ORDER BY s.name ASC";

            $students = $this->db->query($query)->result_array();

            foreach($students as &$std){
                $std['class_name'] = $class_name;
                $std['section_name'] = $section_name;
            }

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $page_data = array(
                'students' => $students,
                'ad_year' => $ad_year,
                'notice_date' => $notice_date,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_fees_notice', $page_data);
            return;
        }

        if($doc_type == 'academy_fees_report'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $academies = $this->db->get('academy')->result_array();
            $academy_data = array();

            foreach($academies as $acd){
                $query = "SELECT 
                            (SELECT COUNT(DISTINCT s2.student_id) FROM student s2
                             INNER JOIN invoice i2 ON i2.student_id = s2.student_id
                             WHERE i2.year = '".$this->db->escape_str($ad_year)."'
                             AND s2.academy_id = ".intval($acd['academy_id']).") as total_students,
                            IFNULL((SELECT SUM(i2.amount) FROM student s2
                             INNER JOIN invoice i2 ON i2.student_id = s2.student_id
                             WHERE i2.year = '".$this->db->escape_str($ad_year)."'
                             AND s2.academy_id = ".intval($acd['academy_id'])."), 0) as total_fees,
                            IFNULL((SELECT SUM(i2.discount) FROM student s2
                             INNER JOIN invoice i2 ON i2.student_id = s2.student_id
                             WHERE i2.year = '".$this->db->escape_str($ad_year)."'
                             AND s2.academy_id = ".intval($acd['academy_id'])."), 0) as total_discount,
                            IFNULL((SELECT SUM(p2.amount) FROM payment p2
                             INNER JOIN student s2 ON s2.student_id = p2.student_id
                             WHERE p2.year = '".$this->db->escape_str($ad_year)."'
                             AND p2.method = '1'
                             AND s2.academy_id = ".intval($acd['academy_id'])."), 0) as online_paid,
                            IFNULL((SELECT SUM(p2.amount) FROM payment p2
                             INNER JOIN student s2 ON s2.student_id = p2.student_id
                             WHERE p2.year = '".$this->db->escape_str($ad_year)."'
                             AND p2.method = '2'
                             AND s2.academy_id = ".intval($acd['academy_id'])."), 0) as cash_paid,
                            IFNULL((SELECT SUM(i2.due) FROM student s2
                             INNER JOIN invoice i2 ON i2.student_id = s2.student_id
                             WHERE i2.year = '".$this->db->escape_str($ad_year)."'
                             AND s2.academy_id = ".intval($acd['academy_id'])."), 0) as total_due";

                $row = $this->db->query($query)->row_array();
                if(!empty($row) && intval($row['total_students']) > 0){
                    $row['academy_name'] = $acd['academy_name'];
                    $academy_data[] = $row;
                }
            }

            $page_data = array(
                'academy_data' => $academy_data,
                'ad_year' => $ad_year,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_academy_fees_report', $page_data);
            return;
        }

        if($doc_type == 'fees_discount'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;

            $query = "SELECT i.*, s.name as student_name, s.gen_reg_no, c.name as class_name
                      FROM invoice i
                      INNER JOIN student s ON s.student_id = i.student_id
                      LEFT JOIN class c ON c.class_id = s.class_id
                      WHERE i.year = '".$this->db->escape_str($ad_year)."'
                      AND i.discount > 0
                      ORDER BY s.name ASC, i.creation_timestamp ASC";

            $invoices = $this->db->query($query)->result_array();

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $page_data = array(
                'invoices' => $invoices,
                'ad_year' => $ad_year,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_fees_discount', $page_data);
            return;
        }

        if($doc_type == 'StudentEduClassDiv'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;

            $academy_id = isset($_GET['academy_id']) ? $_GET['academy_id'] : 'all';
            $status = isset($_GET['status']) ? $_GET['status'] : 'all';

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
            $section_name = !empty($section) ? $section['name'] : '';

            $academy_name = '';
            if(!empty($academy_id) && $academy_id != 'all'){
                $acd = $this->db->get_where('academy', array('academy_id' => $academy_id))->row_array();
                $academy_name = !empty($acd) ? $acd['academy_name'] : '';
            }

            $status_label = '';
            $status_map = array('0' => 'Active', '1' => 'Inactive', '2' => 'Out Of School');
            if(!empty($status) && $status != 'all'){
                $status_label = isset($status_map[$status]) ? $status_map[$status] : '';
            }

            $query = "SELECT s.*, c.name as class_name, sec.name as section_name
                      FROM student s
                      LEFT JOIN class c ON c.class_id = s.class_id
                      LEFT JOIN section sec ON sec.section_id = s.section_id
                      WHERE (s.class_id = '".$this->db->escape_str($class_id)."' OR s.class_id = ".intval($class_id).")
                      AND (s.section_id = '".$this->db->escape_str($section_id)."' OR s.section_id = ".intval($section_id).")";

            if(!empty($ad_year)){
                $query .= " AND s.ad_year = '".$this->db->escape_str($ad_year)."'";
            }

            if(!empty($academy_id) && $academy_id != 'all'){
                $query .= " AND s.academy_id = ".intval($academy_id);
            }

            if(!empty($status) && $status != 'all'){
                $query .= " AND s.status = ".intval($status);
            }

            $query .= " ORDER BY s.name ASC";

            $students = $this->db->query($query)->result_array();

            $page_data = array(
                'students' => $students,
                'ad_year' => $ad_year,
                'class_name' => $class_name,
                'section_name' => $section_name,
                'academy_name' => $academy_name,
                'status_label' => $status_label,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_standard_division_report', $page_data);
            return;
        }

        if($doc_type == 'lcReport'){
            $from_date = $action;
            $to_date = $student_id;

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $doc_ids = $this->db->select('student_id')
                ->where('document_type', 'Leaving Certificate')
                ->where('created_at >=', $from_date . ' 00:00:00')
                ->where('created_at <=', $to_date . ' 23:59:59')
                ->order_by('created_at', 'ASC')
                ->get('student_documents')->result_array();

            $student_ids = array();
            foreach($doc_ids as $d){
                $student_ids[] = $d['student_id'];
            }

            $students = array();
            if(!empty($student_ids)){
                $this->db->select('student.*, class.name as class_name');
                $this->db->join('class', 'class.class_id = student.class_id', 'left');
                $students = $this->db->where_in('student.student_id', $student_ids)->get('student')->result_array();
            }

            $page_data = array(
                'students'    => $students,
                'from_date'   => $from_date,
                'to_date'     => $to_date,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_leaving_certificate_report', $page_data);
            return;
        }

        if($doc_type == 'studentcatcntreport'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
            $categories = $this->db->order_by('category_id', 'ASC')->get('category')->result_array();
            $sections = $this->db->order_by('name', 'ASC')->get('section')->result_array();

            $query = "SELECT s.class_id, s.section_id, s.cat_id, s.sex, COUNT(*) as cnt
                      FROM student s
                      WHERE s.ad_year = '".$this->db->escape_str($ad_year)."'
                      GROUP BY s.class_id, s.section_id, s.cat_id, s.sex
                      ORDER BY s.class_id, s.section_id, s.cat_id";

            $counts = $this->db->query($query)->result_array();

            $data = array();
            foreach($counts as $row){
                $cid = $row['class_id'];
                $sid = $row['section_id'];
                $cat = !empty($row['cat_id']) ? $row['cat_id'] : '0';
                $sex = $row['sex'];
                $cnt = $row['cnt'];
                $data[$cid][$sid][$cat][$sex] = $cnt;
            }

            $page_data = array(
                'classes'    => $classes,
                'sections'   => $sections,
                'categories' => $categories,
                'data'       => $data,
                'ad_year'    => $ad_year,
                'system_name' => $system_name,
            );
            $this->load->view('backend/admin/print_student_count_report', $page_data);
            return;
        }

        if($doc_type == 'journalvoucherreport'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $from_date = $action;
            $to_date = $student_id;
            $client_id = isset($_GET['client_id']) ? $_GET['client_id'] : '';

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $client_name = '';
            if(!empty($client_id)){
                $cl = $this->db->get_where('client', array('client_id' => $client_id))->row_array();
                $client_name = !empty($cl) ? $cl['name'] : '';
                $client_address = !empty($cl['address']) ? $cl['address'] : '';
            }

            $this->db->where('date >=', $from_date);
            $this->db->where('date <=', $to_date);
            if(!empty($client_id)){
                $this->db->where('client_id', $client_id);
            }
            $this->db->order_by('date', 'ASC');
            $this->db->order_by('voucher_no', 'ASC');
            $vouchers = $this->db->get('journal_voucher')->result_array();

            $total_amount = 0;
            foreach($vouchers as &$v){
                $v['party_name'] = '';
                if(!empty($v['client_id'])){
                    $cl = $this->db->get_where('client', array('client_id' => $v['client_id']))->row_array();
                    $v['party_name'] = !empty($cl) ? $cl['name'] : '';
                }
                $total_amount += intval($v['total_amount']);
            }

            $page_data = array(
                'vouchers'       => $vouchers,
                'from_date'      => $from_date,
                'to_date'        => $to_date,
                'system_name'    => $system_name,
                'school_phone'   => $school_phone,
                'client_id'      => $client_id,
                'client_name'    => $client_name,
                'client_address' => isset($client_address) ? $client_address : '',
                'total_amount'   => $total_amount,
            );
            $this->load->view('backend/admin/print_journal_voucher_report', $page_data);
            return;
        }

        if($doc_type == 'expense_category_report'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $fin_year = $this->uri->segment(4);
            $exp_cat = $this->uri->segment(5);
            $from_date = $this->uri->segment(6);
            $to_date = $this->uri->segment(7);

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $category_name = 'All';
            if(!empty($exp_cat) && $exp_cat != '-1'){
                $cat = $this->db->get_where('expense_category', array('expense_category_id' => $exp_cat))->row_array();
                $category_name = !empty($cat) ? $cat['name'] : 'All';
            }

            $this->db->select('jv.*, ec.name as category_name');
            $this->db->from('journal_voucher jv');
            $this->db->join('expense_category ec', 'ec.expense_category_id = jv.expense_category_id', 'left');
            if(!empty($fin_year)){
                $this->db->where('jv.financial_year', $fin_year);
            }
            if(!empty($exp_cat) && $exp_cat != '-1'){
                $this->db->where('jv.expense_category_id', $exp_cat);
            }
            $this->db->where('jv.date >=', $from_date);
            $this->db->where('jv.date <=', $to_date);
            $this->db->order_by('jv.expense_category_id', 'ASC');
            $this->db->order_by('jv.date', 'ASC');
            $vouchers = $this->db->get()->result_array();

            $grouped = array();
            $grand_bank = 0;
            $grand_cash = 0;
            foreach($vouchers as $v){
                $cat_id = $v['expense_category_id'];
                if(!isset($grouped[$cat_id])){
                    $grouped[$cat_id] = array(
                        'name' => !empty($v['category_name']) ? $v['category_name'] : 'Others',
                        'rows' => array(),
                        'bank' => 0,
                        'cash' => 0,
                    );
                }

                $name = !empty($v['client_name']) ? $v['client_name'] : '';
                if(empty($name) && !empty($v['client_id'])){
                    $cl = $this->db->get_where('client', array('client_id' => $v['client_id']))->row_array();
                    $name = !empty($cl) ? $cl['name'] : '';
                }

                $bank = 0;
                $cash = 0;
                if(intval($v['transaction_type']) == 2){
                    $cash = floatval($v['total_amount']);
                }else{
                    $bank = floatval($v['total_amount']);
                }

                $grouped[$cat_id]['rows'][] = array(
                    'date'       => $v['date'],
                    'name'       => $name,
                    'particular' => !empty($v['narration']) ? $v['narration'] : '-',
                    'receipt_no' => $v['voucher_no'],
                    'bank'       => $bank,
                    'cash'       => $cash,
                );
                $grouped[$cat_id]['bank'] += $bank;
                $grouped[$cat_id]['cash'] += $cash;
                $grand_bank += $bank;
                $grand_cash += $cash;
            }

            $page_data = array(
                'grouped'      => $grouped,
                'fin_year'     => $fin_year,
                'category_id'  => $exp_cat,
                'category_name'=> $category_name,
                'from_date'    => $from_date,
                'to_date'      => $to_date,
                'total_bank'   => $grand_bank,
                'total_cash'   => $grand_cash,
                'system_name'  => $system_name,
                'school_phone' => $school_phone,
            );
            $this->load->view('backend/admin/print_expense_category_report', $page_data);
            return;
        }

        if($doc_type == 'cashbook'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $from_date = $action;
            $to_date = $student_id;

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $from_timestamp = strtotime($from_date);
            $to_timestamp = strtotime($to_date) + 86399;

            $opening_income = $this->db->query("SELECT IFNULL(SUM(CAST(amount AS DECIMAL(12,2))), 0) as total FROM payment WHERE payment_type='income' AND timestamp < $from_timestamp")->row()->total;
            $opening_expense = $this->db->query("SELECT IFNULL(SUM(CAST(amount AS DECIMAL(12,2))), 0) as total FROM payment WHERE payment_type='expense' AND timestamp < $from_timestamp")->row()->total;
            $opening_balance = round(floatval($opening_income) - floatval($opening_expense), 2);

            $sql = "SELECT p.*,
                        CASE WHEN p.payment_type='income' THEN CAST(p.amount AS DECIMAL(12,2)) ELSE 0 END as credit,
                        CASE WHEN p.payment_type='expense' THEN CAST(p.amount AS DECIMAL(12,2)) ELSE 0 END as debit,
                        s.name as student_name,
                        ec.name as expense_category_name
                    FROM payment p
                    LEFT JOIN student s ON s.student_id = p.student_id
                    LEFT JOIN expense_category ec ON ec.expense_category_id = p.expense_category_id
                    WHERE p.timestamp >= $from_timestamp AND p.timestamp <= $to_timestamp
                    ORDER BY p.timestamp ASC, p.payment_id ASC";

            $transactions = $this->db->query($sql)->result_array();

            $running_balance = $opening_balance;
            $total_debit = 0;
            $total_credit = 0;
            foreach($transactions as &$t){
                $t['debit'] = floatval($t['debit']);
                $t['credit'] = floatval($t['credit']);
                $running_balance = round($running_balance + $t['credit'] - $t['debit'], 2);
                $t['balance'] = $running_balance;
                $total_debit += $t['debit'];
                $total_credit += $t['credit'];
            }

            $page_data = array(
                'transactions'    => $transactions,
                'from_date'       => $from_date,
                'to_date'         => $to_date,
                'opening_balance' => $opening_balance,
                'total_debit'     => $total_debit,
                'total_credit'    => $total_credit,
                'closing_balance' => $running_balance,
                'system_name'     => $system_name,
                'school_phone'    => $school_phone,
            );
            $this->load->view('backend/admin/print_cashbook', $page_data);
            return;
        }

        if($doc_type == 'daily_cashbook_report'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $fin_year = $this->uri->segment(4);
            $from_date = $this->uri->segment(5);
            $to_date = $this->uri->segment(6);

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $from_timestamp = strtotime($from_date);
            $to_timestamp = strtotime($to_date) + 86399;

            $excluded_category = 10; // Bank Account Deposite

            $opening_row = $this->db->query("SELECT
                        IFNULL(SUM(CASE WHEN payment_type='income' AND (method IS NULL OR method='' OR method='2') THEN CAST(amount AS DECIMAL(12,2)) ELSE 0 END), 0) as income_cash,
                        IFNULL(SUM(CASE WHEN payment_type='expense' AND (method IS NULL OR method='' OR method='2') AND CAST(expense_category_id AS UNSIGNED) <> $excluded_category THEN CAST(amount AS DECIMAL(12,2)) ELSE 0 END), 0) as expense_cash,
                        IFNULL(SUM(CASE WHEN payment_type='income' AND method IN ('1','3') THEN CAST(amount AS DECIMAL(12,2)) ELSE 0 END), 0) as income_bank,
                        IFNULL(SUM(CASE WHEN payment_type='expense' AND method IN ('1','3') AND CAST(expense_category_id AS UNSIGNED) <> $excluded_category THEN CAST(amount AS DECIMAL(12,2)) ELSE 0 END), 0) as expense_bank,
                        IFNULL(SUM(CASE WHEN payment_type='expense' AND CAST(expense_category_id AS UNSIGNED) = $excluded_category THEN CAST(amount AS DECIMAL(12,2)) ELSE 0 END), 0) as deposit_amt
                    FROM payment WHERE timestamp < $from_timestamp")->row();

            $opening_cash = round(floatval($opening_row->income_cash) - floatval($opening_row->expense_cash) - floatval($opening_row->deposit_amt), 2);
            $opening_bank = round(floatval($opening_row->income_bank) - floatval($opening_row->expense_bank) + floatval($opening_row->deposit_amt), 2);

            $sql = "SELECT p.*,
                        s.name as student_name,
                        ec.name as expense_category_name
                    FROM payment p
                    LEFT JOIN student s ON s.student_id = p.student_id
                    LEFT JOIN expense_category ec ON ec.expense_category_id = p.expense_category_id
                    WHERE p.timestamp >= $from_timestamp AND p.timestamp <= $to_timestamp
                    ORDER BY p.timestamp ASC, p.payment_id ASC";

            $transactions = $this->db->query($sql)->result_array();

            $daily = array();
            $running_cash = $opening_cash;
            $running_bank = $opening_bank;

            foreach($transactions as $t){
                $day = date('Y-m-d', $t['timestamp']);
                if(!isset($daily[$day])){
                    $daily[$day] = array(
                        'date'         => date('d/m/Y', $t['timestamp']),
                        'opening_cash' => $running_cash,
                        'opening_bank' => $running_bank,
                        'credit_rows'  => array(),
                        'debit_rows'   => array(),
                        'credit_bank'  => 0,
                        'credit_cash'  => 0,
                        'debit_bank'   => 0,
                        'debit_cash'   => 0,
                        'deposit_cash' => 0,
                    );
                }

                $is_deposit = ($t['payment_type'] == 'expense' && intval($t['expense_category_id']) == $excluded_category);

                if($is_deposit){
                    $dep_amt = floatval($t['amount']);
                    $daily[$day]['deposit_cash'] += $dep_amt;
                    $running_cash -= $dep_amt;
                    $running_bank += $dep_amt;
                    continue;
                }

                $is_cash = (!isset($t['method']) || $t['method'] === null || $t['method'] === '' || $t['method'] === '2');
                $bank_amt = $is_cash ? 0 : floatval($t['amount']);
                $cash_amt = $is_cash ? floatval($t['amount']) : 0;

                if($t['payment_type'] == 'income'){
                    $particular = !empty($t['student_name']) ? $t['student_name'] : 'Fee Receipt';
                    $ref = !empty($t['receipt_no']) ? $t['receipt_no'] : $t['payment_id'] . '-' . date('Y', $t['timestamp']);
                    $daily[$day]['credit_rows'][] = array(
                        'date'  => date('d/m/Y', $t['timestamp']),
                        'particular' => $particular,
                        'ref'   => $ref,
                        'bank'  => $bank_amt,
                        'cash'  => $cash_amt,
                        'total' => $bank_amt + $cash_amt,
                    );
                    $daily[$day]['credit_bank'] += $bank_amt;
                    $daily[$day]['credit_cash'] += $cash_amt;
                    $running_cash += $cash_amt;
                    $running_bank += $bank_amt;
                } else {
                    $particular = !empty($t['person_org_name']) ? $t['person_org_name'] : (!empty($t['title']) ? $t['title'] : 'Expense');
                    $daily[$day]['debit_rows'][] = array(
                        'date'  => date('d/m/Y', $t['timestamp']),
                        'particular' => $particular,
                        'ref'   => $t['payment_id'],
                        'bank'  => $bank_amt,
                        'cash'  => $cash_amt,
                        'total' => $bank_amt + $cash_amt,
                    );
                    $daily[$day]['debit_bank'] += $bank_amt;
                    $daily[$day]['debit_cash'] += $cash_amt;
                    $running_cash -= $cash_amt;
                    $running_bank -= $bank_amt;
                }
            }

            foreach($daily as $day => $d){
                $daily[$day]['credit_total'] = $d['credit_bank'] + $d['credit_cash'];
                $daily[$day]['debit_total']  = $d['debit_bank'] + $d['debit_cash'];
                $daily[$day]['opening_total'] = $d['opening_cash'] + $d['opening_bank'];
                $daily[$day]['closing_cash']  = round($d['opening_cash'] + $d['credit_cash'] - $d['debit_cash'] - $d['deposit_cash'], 2);
                $daily[$day]['closing_bank']  = round($d['opening_bank'] + $d['credit_bank'] - $d['debit_bank'] + $d['deposit_cash'], 2);
                $daily[$day]['closing_total'] = $daily[$day]['closing_cash'] + $daily[$day]['closing_bank'];
            }

            $page_data = array(
                'daily'        => $daily,
                'from_date'    => $from_date,
                'to_date'      => $to_date,
                'system_name'  => $system_name,
                'school_phone' => $school_phone,
            );
            $this->load->view('backend/admin/print_daily_cashbook', $page_data);
            return;
        }

        if($doc_type == 'bank_statement_report'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $fin_year = $this->uri->segment(4);
            $bank_id = $this->uri->segment(5);
            $from_date = $this->uri->segment(6);
            $to_date = $this->uri->segment(7);

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $phone_row = $this->db->get_where('settings', array('type' => 'phone'))->row();
            $school_phone = !empty($phone_row) ? $phone_row->description : '';

            $bank = $this->db->get_where('bank', array('bank_id' => intval($bank_id)))->row_array();
            if(empty($bank)) redirect(base_url(), 'refresh');

            $from_timestamp = strtotime($from_date);
            $to_timestamp = strtotime($to_date) + 86399;

            $opening_income = $this->db->query("SELECT IFNULL(SUM(CAST(amount AS DECIMAL(12,2))), 0) as total FROM payment WHERE payment_type='income' AND bank_id=" . intval($bank_id) . " AND timestamp < $from_timestamp AND CAST(expense_category_id AS UNSIGNED) <> 10")->row()->total;
            $opening_expense = $this->db->query("SELECT IFNULL(SUM(CAST(amount AS DECIMAL(12,2))), 0) as total FROM payment WHERE payment_type='expense' AND bank_id=" . intval($bank_id) . " AND timestamp < $from_timestamp AND CAST(expense_category_id AS UNSIGNED) <> 10")->row()->total;
            $opening_balance = round(floatval($opening_income) - floatval($opening_expense), 2);

            $sql = "SELECT p.*,
                        CASE WHEN p.payment_type='income' THEN CAST(p.amount AS DECIMAL(12,2)) ELSE 0 END as credit,
                        CASE WHEN p.payment_type='expense' THEN CAST(p.amount AS DECIMAL(12,2)) ELSE 0 END as debit,
                        s.name as student_name,
                        ec.name as expense_category_name
                    FROM payment p
                    LEFT JOIN student s ON s.student_id = p.student_id
                    LEFT JOIN expense_category ec ON ec.expense_category_id = p.expense_category_id
                    WHERE p.bank_id=" . intval($bank_id) . "
                      AND p.timestamp >= $from_timestamp AND p.timestamp <= $to_timestamp
                    ORDER BY p.timestamp ASC, p.payment_id ASC";

            $transactions = $this->db->query($sql)->result_array();

            $running_balance = $opening_balance;
            $total_debit = 0;
            $total_credit = 0;
            foreach($transactions as &$t){
                $t['debit'] = floatval($t['debit']);
                $t['credit'] = floatval($t['credit']);
                $t['is_deposit'] = ($t['payment_type'] == 'expense' && intval($t['expense_category_id']) == 10);
                if($t['is_deposit']){
                    $t['balance'] = 0;
                } else {
                    $running_balance = round($running_balance + $t['credit'] - $t['debit'], 2);
                    $t['balance'] = $running_balance;
                    $total_debit += $t['debit'];
                    $total_credit += $t['credit'];
                }
            }

            $page_data = array(
                'transactions'    => $transactions,
                'bank'            => $bank,
                'from_date'       => $from_date,
                'to_date'         => $to_date,
                'opening_balance' => $opening_balance,
                'total_debit'     => $total_debit,
                'total_credit'    => $total_credit,
                'closing_balance' => $running_balance,
                'system_name'     => $system_name,
                'school_phone'    => $school_phone,
            );
            $this->load->view('backend/admin/print_bank_statement', $page_data);
            return;
        }

        if($doc_type == 'StudentEduClassDivUid'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
            $section_name = !empty($section) ? $section['name'] : '';

            $query = "SELECT s.*, c.name as class_name, sec.name as section_name
                      FROM student s
                      LEFT JOIN class c ON c.class_id = s.class_id
                      LEFT JOIN section sec ON sec.section_id = s.section_id
                      WHERE s.class_id = ".intval($class_id)."
                      AND s.section_id = ".intval($section_id)."
                      AND s.ad_year = '".$this->db->escape_str($ad_year)."'
                      ORDER BY s.name ASC";

            $students = $this->db->query($query)->result_array();

            $page_data = array(
                'students'     => $students,
                'ad_year'      => $ad_year,
                'class_name'   => $class_name,
                'section_name' => $section_name,
                'system_name'  => $system_name,
            );
            $this->load->view('backend/admin/print_uid_report', $page_data);
            return;
        }

        if($doc_type == 'StudentEduClassDivGen'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;
            $sex = isset($_GET['sex']) ? $_GET['sex'] : '';

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
            $section_name = !empty($section) ? $section['name'] : '';

            $query = "SELECT s.*, c.name as class_name, sec.name as section_name
                      FROM student s
                      LEFT JOIN class c ON c.class_id = s.class_id
                      LEFT JOIN section sec ON sec.section_id = s.section_id
                      WHERE s.class_id = ".intval($class_id)."
                      AND s.section_id = ".intval($section_id)."
                      AND s.ad_year = '".$this->db->escape_str($ad_year)."'";

            if(!empty($sex)){
                $query .= " AND s.sex = '".$this->db->escape_str($sex)."'";
            }

            $query .= " ORDER BY s.name ASC";

            $students = $this->db->query($query)->result_array();

            $page_data = array(
                'students'     => $students,
                'ad_year'      => $ad_year,
                'class_name'   => $class_name,
                'section_name' => $section_name,
                'system_name'  => $system_name,
            );
            $this->load->view('backend/admin/print_gender_wise_report', $page_data);
            return;
        }

        if($doc_type == 'StudentEduClassDivrelcatcast'){
            if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

            $ad_year = $action;
            $class_id = $student_id;
            $section_id = $extra;

            $re_id = isset($_GET['re_id']) ? $_GET['re_id'] : '0';
            $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '0';
            $cast_id = isset($_GET['cast_id']) ? $_GET['cast_id'] : '0';

            $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
            $system_name = !empty($settings_name) ? $settings_name->description : 'School';

            $class = $this->db->get_where('class', array('class_id' => $class_id))->row_array();
            $class_name = !empty($class) ? $class['name'] : '';

            $section = $this->db->get_where('section', array('section_id' => $section_id))->row_array();
            $section_name = !empty($section) ? $section['name'] : '';

            $query = "SELECT s.*, c.name as class_name, sec.name as section_name,
                      r.religion_name, cat.cat_name, cs.cast_name
                      FROM student s
                      LEFT JOIN class c ON c.class_id = s.class_id
                      LEFT JOIN section sec ON sec.section_id = s.section_id
                      LEFT JOIN religion r ON r.religion_id = s.re_id
                      LEFT JOIN category cat ON cat.category_id = s.cat_id
                      LEFT JOIN cast cs ON cs.cast_id = s.cast_id
                      WHERE s.class_id = ".intval($class_id)."
                      AND s.section_id = ".intval($section_id)."
                      AND s.ad_year = '".$this->db->escape_str($ad_year)."'";

            if(!empty($re_id) && $re_id != '0'){
                $query .= " AND s.re_id = ".intval($re_id);
            }

            if(!empty($cat_id) && $cat_id != '0'){
                $query .= " AND s.cat_id = ".intval($cat_id);
            }

            if(!empty($cast_id) && $cast_id != '0'){
                $query .= " AND s.cast_id = ".intval($cast_id);
            }

            $query .= " ORDER BY s.name ASC";

            $students = $this->db->query($query)->result_array();

            $page_data = array(
                'students'     => $students,
                'ad_year'      => $ad_year,
                'class_name'   => $class_name,
                'section_name' => $section_name,
                'system_name'  => $system_name,
            );
            $this->load->view('backend/admin/print_religion_category_report', $page_data);
            return;
        }

        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        if(empty($student)) redirect(base_url(), 'refresh');

        $class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
        $student['class_name'] = !empty($class) ? $class['name'] : '';

        $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row_array();
        $student['section_name'] = !empty($section) ? $section['name'] : '';

        $doc_type_names = array(
            'StudentBonafide' => 'Bonafide Certificate',
            'StudentLetter' => 'Form-15A',
            'CoveringLetter' => 'Covering Letter',
            'CharacterCertificate' => 'Character Certificate',
            'LeavingCertificate' => 'Leaving Certificate',
            'Attendance75' => '75% Attendance',
            'studentIdCard' => 'ID Card',
        );

        $doc_name = isset($doc_type_names[$doc_type]) ? $doc_type_names[$doc_type] : $doc_type;
        $name = $this->session->userdata('name');
        $entry_user = !empty($name) ? $name : 'Administrator';

        $next_sr = $this->db->select_max('sr_no')->where('sr_no >', 0)->get('student_documents')->row()->sr_no;
        $next_sr = max(intval($next_sr), 0) + 1;

        $last_doc_id = 0;
        if($action == 'insert'){
            $insert_data = array(
                'student_id' => $student_id,
                'document_type' => $doc_name,
                'remarks' => '',
                'document_file' => '',
                'document_version' => '',
                'document_charges' => '0 Rs',
                'fee_remark' => '',
                'sr_no' => $next_sr,
                'entry_user' => $entry_user,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('student_documents', $insert_data);
            $last_doc_id = $this->db->insert_id();
        }

        $system_name_row = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($system_name_row) ? $system_name_row->description : 'Acharya English Medium School';

        if($doc_type == 'StudentBonafide'){

            $religion = $this->db->get_where('religion', array('religion_id' => $student['re_id']))->row_array();
            $student['religion_name'] = !empty($religion) ? $religion['religion_name'] : '';
            $cast = $this->db->get_where('cast', array('cast_id' => $student['cast_id']))->row_array();
            $student['cast_name'] = !empty($cast) ? $cast['cast_name'] : '';

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
                $qr_path = 'uploads/student_qr_code/';
                if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
                require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
                $qr_file = 'std_'.md5(uniqid()).'.png';
                QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('qr_code' => $qr_file));
                $student['qr_code'] = $qr_file;
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['print_date'] = date('d-m-Y');
            $page_data['dob_words'] = (!empty($student['birthday']) && $student['birthday'] != '0000-00-00') ? $this->dateInWords($student['birthday']) : '';
            $this->load->view('backend/admin/print_bonafide', $page_data);
            return;
        }

        if($doc_type == 'StudentLetter'){

            $religion = $this->db->get_where('religion', array('religion_id' => $student['re_id']))->row_array();
            $student['religion_name'] = !empty($religion) ? $religion['religion_name'] : '';
            $cast = $this->db->get_where('cast', array('cast_id' => $student['cast_id']))->row_array();
            $student['cast_name'] = !empty($cast) ? $cast['cast_name'] : '';

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
                $qr_path = 'uploads/student_qr_code/';
                if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
                require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
                $qr_file = 'std_'.md5(uniqid()).'.png';
                QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('qr_code' => $qr_file));
                $student['qr_code'] = $qr_file;
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['print_date'] = date('d-m-Y');
            $this->load->view('backend/admin/print_form15a', $page_data);
            return;
        }

        if($doc_type == 'CoveringLetter'){

            $religion = $this->db->get_where('religion', array('religion_id' => $student['re_id']))->row_array();
            $student['religion_name'] = !empty($religion) ? $religion['religion_name'] : '';
            $cast = $this->db->get_where('cast', array('cast_id' => $student['cast_id']))->row_array();
            $student['cast_name'] = !empty($cast) ? $cast['cast_name'] : '';

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
                $qr_path = 'uploads/student_qr_code/';
                if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
                require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
                $qr_file = 'std_'.md5(uniqid()).'.png';
                QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('qr_code' => $qr_file));
                $student['qr_code'] = $qr_file;
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['print_date'] = date('d-m-Y');
            $this->load->view('backend/admin/print_covering_letter', $page_data);
            return;
        }

        if($doc_type == 'CharacterCertificate'){

            $religion = $this->db->get_where('religion', array('religion_id' => $student['re_id']))->row_array();
            $student['religion_name'] = !empty($religion) ? $religion['religion_name'] : '';
            $cast = $this->db->get_where('cast', array('cast_id' => $student['cast_id']))->row_array();
            $student['cast_name'] = !empty($cast) ? $cast['cast_name'] : '';

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
                $qr_path = 'uploads/student_qr_code/';
                if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
                require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
                $qr_file = 'std_'.md5(uniqid()).'.png';
                QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('qr_code' => $qr_file));
                $student['qr_code'] = $qr_file;
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['print_date'] = date('d-m-Y');
            $this->load->view('backend/admin/print_character_certificate', $page_data);
            return;
        }

        if($doc_type == 'LeavingCertificate'){

            if($action == 'insert'){
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('status' => 1));
            }

            $student = $this->_prepare_lc_data($student_id, false);

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['lc_date'] = $student['lc_date'];
            $page_data['print_date'] = date('d-m-Y');
            $page_data['dob_words'] = $student['dob_words'];
            $this->load->view('backend/admin/print_leaving_certificate', $page_data);
            return;
        }

        if($doc_type == 'studentIdCard'){

            $student = $this->_prepare_id_card_data($student_id);

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['print_date'] = date('d-m-Y');
            $this->load->view('backend/admin/print_student_id_card', $page_data);
            return;
        }

        if($doc_type == 'Attendance75'){

            $inserted_doc = array();
            if(!empty($last_doc_id)){
                $inserted_doc = $this->db->get_where('student_documents', array('id' => $last_doc_id))->row_array();
            }

            $cur_class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
            $prev_class = array();
            if(!empty($cur_class)){
                $prev_class = $this->db->where('sort_order <', $cur_class['sort_order'])->order_by('sort_order', 'desc')->get('class', 1)->row_array();
            }
            $student['prev_class_name'] = !empty($prev_class) ? $prev_class['name'] : $student['class_name'];

            $ad_year = !empty($student['ad_year']) ? $student['ad_year'] : '';
            $prev_year = '';
            if(preg_match('/^(\d{4})-(\d{4})$/', $ad_year, $m)){
                $prev_year = ($m[1] - 1).'-'.($m[2] - 1);
            }
            $student['prev_year'] = $prev_year;

            $att_percent = rand(75, 92);

            if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
                $qr_path = 'uploads/student_qr_code/';
                if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
                require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
                $qr_file = 'std_'.md5(uniqid()).'.png';
                QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
                $this->db->where('student_id', $student_id);
                $this->db->update('student', array('qr_code' => $qr_file));
                $student['qr_code'] = $qr_file;
            }

            $page_data = array();
            $page_data['student'] = $student;
            $page_data['system_name'] = $system_name;
            $page_data['doc_type'] = $doc_type;
            $page_data['doc_name'] = $doc_name;
            $page_data['document'] = $inserted_doc;
            $page_data['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
            $page_data['print_date'] = date('d-m-Y');
            $page_data['att_percent'] = $att_percent;
            $this->load->view('backend/admin/print_attendance_75', $page_data);
            return;
        }

        $page_data = array();
        $page_data['student'] = $student;
        $page_data['system_name'] = $system_name;
        $page_data['doc_type'] = $doc_type;
        $page_data['doc_name'] = $doc_name;
        $this->load->view('backend/admin/print_document', $page_data);
    }

    function MultipalStudentLC(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student_ids = $this->_bulk_ids('student_ids');
        if(empty($student_ids)) redirect(base_url(), 'refresh');

        $students = array();
        foreach($student_ids as $sid){
            $data = $this->_prepare_lc_data($sid, true);
            if(!empty($data)) $students[] = $data;
        }
        if(empty($students)) redirect(base_url(), 'refresh');

        $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($settings_name) ? $settings_name->description : 'Acharya English Medium School';

        $page_data = array(
            'students'    => $students,
            'system_name' => $system_name,
        );
        $this->load->view('backend/admin/print_multiple_leaving_certificate', $page_data);
    }

    function MultipalstudentIdCard(){
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student_ids = $this->_bulk_ids('student_ids');
        if(empty($student_ids)) redirect(base_url(), 'refresh');

        $students = array();
        foreach($student_ids as $sid){
            $data = $this->_prepare_id_card_data($sid);
            if(!empty($data)) $students[] = $data;
        }
        if(empty($students)) redirect(base_url(), 'refresh');

        $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($settings_name) ? $settings_name->description : 'Acharya English Medium School';

        $page_data = array(
            'students'    => $students,
            'system_name' => $system_name,
        );
        $this->load->view('backend/admin/print_multiple_student_id_card', $page_data);
    }

    private function _bulk_ids($field){
        $ids = $this->input->post($field);
        if(is_array($ids)){
            $ids = array_values(array_filter(array_map('trim', $ids)));
        } else {
            $ids = array_values(array_filter(array_map('trim', explode(',', (string)$ids))));
        }
        $out = array();
        foreach($ids as $id){
            if(is_numeric($id)) $out[] = intval($id);
        }
        return array_unique($out);
    }

    private function _prepare_lc_data($student_id, $record = true){
        $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        if(empty($student)) return array();

        $class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
        $student['class_name'] = !empty($class) ? $class['name'] : '';
        $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row_array();
        $student['section_name'] = !empty($section) ? $section['name'] : '';

        $student['birth_place'] = !empty($student['place_birth']) ? $student['place_birth'] : $student['birth_place'];

        $religion = $this->db->get_where('religion', array('religion_id' => $student['re_id']))->row_array();
        $student['religion_name'] = !empty($religion) ? $religion['religion_name'] : '';
        $cast = $this->db->get_where('cast', array('cast_id' => $student['cast_id']))->row_array();
        $student['cast_name'] = !empty($cast) ? $cast['cast_name'] : '';
        $cat = $this->db->get_where('student_category', array('student_category_id' => $student['cat_id']))->row_array();
        $student['category_name'] = !empty($cat) ? $cat['name'] : '';
        $mt = $this->db->get_where('mother_tongue', array('mother_tongue_id' => $student['m_tongue']))->row_array();
        $student['mother_tongue_name'] = !empty($mt) ? $mt['mother_tongue_name'] : '';
        $ps = $this->db->get_where('previous_school', array('previous_school_id' => $student['ps_attended']))->row_array();
        $student['prev_school_name'] = !empty($ps) ? $ps['name'] : '';
        $ad_class = $this->db->get_where('class', array('class_id' => $student['ad_class_id']))->row_array();
        $student['ad_class_name'] = !empty($ad_class) ? $ad_class['name'] : '';

        $inserted_doc = array();
        if($record){
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('status' => 1));

            $next_sr = $this->db->select_max('sr_no')->where('sr_no >', 0)->get('student_documents')->row()->sr_no;
            $next_sr = max(intval($next_sr), 0) + 1;
            $name = $this->session->userdata('name');
            $entry_user = !empty($name) ? $name : 'Administrator';

            $insert_data = array(
                'student_id'       => $student_id,
                'document_type'    => 'Leaving Certificate',
                'remarks'          => '',
                'document_file'    => '',
                'document_version' => '',
                'document_charges' => '0 Rs',
                'fee_remark'       => '',
                'sr_no'            => $next_sr,
                'entry_user'       => $entry_user,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            );
            $this->db->insert('student_documents', $insert_data);
            $inserted_doc = $this->db->get_where('student_documents', array('id' => $this->db->insert_id()))->row_array();
        }

        if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
            $qr_path = 'uploads/student_qr_code/';
            if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
            require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
            $qr_file = 'std_'.md5(uniqid()).'.png';
            QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('qr_code' => $qr_file));
            $student['qr_code'] = $qr_file;
        }

        $std = $student['class_name'];
        $std_lower = strtolower($std);
        if(strpos($std_lower, '11') !== false){
            $std = '11th Science';
        } elseif(strpos($std_lower, '12') !== false){
            $std = '12th Science';
        }
        $student['std_studying'] = $std;

        $student['cert_no'] = !empty($inserted_doc['sr_no']) ? $inserted_doc['sr_no'] : '';
        $student['lc_date'] = date('d-m-Y');
        $student['dob_words'] = (!empty($student['birthday']) && $student['birthday'] != '0000-00-00') ? $this->dateInWords($student['birthday']) : '';
        $student['document'] = $inserted_doc;

        return $student;
    }

    private function _prepare_id_card_data($student_id){
        $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        if(empty($student)) return array();

        $class = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
        $student['class_name'] = !empty($class) ? $class['name'] : '';
        $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row_array();
        $student['section_name'] = !empty($section) ? $section['name'] : '';

        if(empty($student['qr_code']) || !file_exists('uploads/student_qr_code/'.$student['qr_code'])){
            $qr_path = 'uploads/student_qr_code/';
            if(!is_dir($qr_path)) mkdir($qr_path, 0777, true);
            require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
            $qr_file = 'std_'.md5(uniqid()).'.png';
            QRcode::png(base_url().'student/profile/'.$student_id, $qr_path.$qr_file, QR_ECLEVEL_L, 6, 2);
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('qr_code' => $qr_file));
            $student['qr_code'] = $qr_file;
        }

        return $student;
    }

    function jvoucherprint($advance_salary_id = null){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        if(!$advance_salary_id) show_404();

        $row = $this->db->get_where('advance_salary', array('advance_salary_id' => $advance_salary_id))->row();
        if(!$row) show_404();

        $staff = $this->db->get_where('teacher', array('teacher_id' => $row->staff_id))->row();
        $category = $this->db->get_where('expense_category', array('expense_category_id' => $row->expense_category_id))->row();
        $bank = $this->db->get_where('bank', array('bank_id' => $row->bank_id))->row();
        $system = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = $system ? $system->description : 'School';

        $data = array(
            'row' => $row,
            'staff' => $staff,
            'category' => $category,
            'bank' => $bank,
            'system_name' => $system_name,
        );
        $this->load->view('backend/admin/print_voucher', $data);
    }

    function std_birthday_banner(){
        if($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

        $student_ids = $this->input->post('student_id');
        if(empty($student_ids)){
            redirect(base_url(), 'refresh');
        }

        $students = array();
        foreach($student_ids as $sid){
            $this->db->select('s.*, c.name as class_name');
            $this->db->from('student s');
            $this->db->join('class c', 'c.class_id = s.class_id', 'left');
            $this->db->where('s.student_id', intval($sid));
            $std = $this->db->get()->row_array();
            if(!empty($std)){
                $std['birthday_display'] = '';
                if(!empty($std['birthday']) && $std['birthday'] != '0000-00-00'){
                    $std['birthday_display'] = date('d M', strtotime($std['birthday']));
                }
                $students[] = $std;
            }
        }

        if(empty($students)){
            redirect(base_url(), 'refresh');
        }

        $settings_name = $this->db->get_where('settings', array('type' => 'system_name'))->row();
        $system_name = !empty($settings_name) ? $settings_name->description : 'School';

        $page_data = array(
            'students'    => $students,
            'system_name' => $system_name,
        );
        $this->load->view('backend/admin/print_birthday_banner', $page_data);
    }

    private function numberToWords($num){
        $num = intval($num);
        $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen');
        $tens = array('', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety');
        if($num < 20) return $ones[$num];
        if($num < 100) return $tens[intval($num/10)].(($num%10) ? '-'.$ones[$num%10] : '');
        if($num < 1000) return $ones[intval($num/100)].' Hundred'.(($num%100) ? ' '.$this->numberToWords($num%100) : '');
        if($num < 1000000) return $this->numberToWords(intval($num/1000)).' Thousand'.(($num%1000) ? ' '.$this->numberToWords($num%1000) : '');
        if($num < 1000000000) return $this->numberToWords(intval($num/1000000)).' Million'.(($num%1000000) ? ' '.$this->numberToWords($num%1000000) : '');
        return $this->numberToWords(intval($num/1000000000)).' Billion'.(($num%1000000000) ? ' '.$this->numberToWords($num%1000000000) : '');
    }

    function dateInWords($dateStr){
        $ts = strtotime($dateStr);
        if(!$ts) return '';
        return $this->numberToWords(intval(date('d', $ts))).'-'.date('F', $ts).'-'.$this->numberToWords(intval(date('Y', $ts)));
    }

}
