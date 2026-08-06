<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_payment_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }



        function createStudentSinglePaymentFunction (){

            $student_id = html_escape($this->input->post('student_id'));
            $academic_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

            $page_data['invoice_number']    =   html_escape($this->input->post('invoice_number')) + rand(10000, 1000000);
            $page_data['student_id']        =   $student_id;
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['discount']          =   html_escape($this->input->post('discount'));
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));
            $page_data['due']               =   $page_data['amount']  - $page_data['discount'] - $page_data['amount_paid'];
            $page_data['creation_timestamp']    =   html_escape($this->input->post('creation_timestamp'));
            $page_data['payment_method']        =   html_escape($this->input->post('payment_method'));
            $page_data['status']                =   html_escape($this->input->post('status'));
            $page_data['year']                  =   $academic_year;
            $student_row = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
            $page_data['class_id']   = $student_row ? $student_row['class_id'] : 0;
            $page_data['section_id'] = $student_row ? $student_row['section_id'] : 0;
            $page_data['previous_due'] = 0;
            $page_data['amount'] = intval($page_data['amount']);
            $page_data['due'] = $page_data['amount'] - intval($page_data['discount']) - intval($page_data['amount_paid']);

            $this->db->trans_start();
            $this->db->insert('invoice', $page_data);
            $invoice_id = $this->db->insert_id();

            $page_data2['invoice_id']   =   $invoice_id;
            $page_data2['student_id']   =   $student_id;
            $page_data2['title']        =   html_escape($this->input->post('title'));
            $page_data2['description']  =   html_escape($this->input->post('description'));
            $page_data2['payment_type'] =  'income';
            $page_data2['amount']       =   html_escape($this->input->post('amount'));
            $page_data2['discount']     =   html_escape($this->input->post('discount'));
            $page_data2['previous_due'] =   0;
            $page_data2['timestamp']    =   strtotime($this->input->post('creation_timestamp'));
            $page_data2['year']         =   $academic_year;
            $page_data2['method']       =   html_escape($this->input->post('payment_method'));

            $this->db->insert('payment', $page_data2);
            $payment_id = $this->db->insert_id();

            $this->db->insert('audit_log', array(
                'action'      => 'INVOICE_CREATED',
                'description' => 'Single invoice for student ' . $student_id . ' year ' . $academic_year,
                'entity_type' => 'invoice',
                'entity_id'   => $invoice_id,
                'user_name'   => $student_row ? $student_row['name'] : '',
                'created_at'  => date('Y-m-d H:i:s'),
            ));

            if($invoice_id > 0){
                $this->carryForwardDueFunction($invoice_id);
            }

            $this->db->trans_complete();
        }

        function createStudentMassPaymentFunction(){

            $student_ids = $this->input->post('student_id');
            if(empty($student_ids)) return;

            $invoice_number = html_escape($this->input->post('invoice_number'));
            $description    = html_escape($this->input->post('description'));
            $creation_timestamp = html_escape($this->input->post('creation_timestamp'));
            $academic_year  = html_escape($this->input->post('academic_year'));

            $fee_titles = $this->input->post('productName');
            $fee_amounts = $this->input->post('total');
            $fee_template_id = intval($this->input->post('fee_template_id'));

            if(empty($fee_titles) || empty($fee_amounts)) return;

            $year_session = $this->db->get_where('settings', array('type' => 'session'))->row();
            $year = $year_session ? $year_session->description : $academic_year;

            $name = $this->session->userdata('name');
            $entry_user = !empty($name) ? $name : 'Administrator';

            $this->db->trans_start();

            foreach($student_ids as $sid){
                $existing = $this->db->get_where('invoice', array('student_id' => $sid, 'year' => $academic_year))->num_rows();
                if($existing > 0) continue;

                $total_amount = 0;
                $fee_names = array();
                foreach($fee_titles as $fi => $fhead_id){
                    $amount = intval($fee_amounts[$fi]);
                    if($amount <= 0) continue;
                    $total_amount += $amount;
                    $fee_head = $this->db->get_where('fees_head', array('fees_head_id' => $fhead_id))->row_array();
                    $fee_names[] = $fee_head ? $fee_head['title'] : 'Fee';
                }

                if($total_amount <= 0) continue;

                $inv_num = $invoice_number . rand(1000, 9999);
                $title = implode(', ', $fee_names);

                $std_row = $this->db->get_where('student', array('student_id' => $sid))->row_array();

                $page_data = array(
                    'invoice_number'       => $inv_num,
                    'student_id'           => $sid,
                    'class_id'             => $std_row ? $std_row['class_id'] : 0,
                    'section_id'           => $std_row ? $std_row['section_id'] : 0,
                    'fee_template_id'      => $fee_template_id ? $fee_template_id : null,
                    'title'                => $title,
                    'description'          => $description,
                    'amount'               => $total_amount,
                    'previous_due'         => 0,
                    'discount'             => 0,
                    'amount_paid'          => 0,
                    'due'                  => $total_amount,
                    'creation_timestamp'   => $creation_timestamp,
                    'payment_method'       => 'Cash',
                    'status'               => '2',
                    'year'                 => $academic_year,
                    'entry_user'           => $entry_user
                );
                $this->db->insert('invoice', $page_data);
                $new_invoice_id = $this->db->insert_id();

                foreach($fee_titles as $fi => $fhead_id){
                    $amount = intval($fee_amounts[$fi]);
                    if($amount <= 0) continue;
                    $this->db->insert('invoice_item', array(
                        'invoice_id'    => $new_invoice_id,
                        'fees_head_id'  => intval($fhead_id),
                        'amount'        => $amount
                    ));
                }

                if($new_invoice_id > 0){
                    $this->carryForwardDueFunction($new_invoice_id);
                }

                $this->syncAcademicHistoryLedger($sid, $academic_year);

                $this->db->insert('audit_log', array(
                    'action'      => 'INVOICE_CREATED',
                    'description' => 'Mass invoice for student ' . $sid . ' year ' . $academic_year . ' amount ' . $total_amount,
                    'entity_type' => 'invoice',
                    'entity_id'   => $new_invoice_id,
                    'user_name'   => $entry_user,
                    'created_at'  => date('Y-m-d H:i:s'),
                ));
            }

            $this->db->trans_complete();
        }


        function takeNewPaymentFromStudent($param2){
            $amount = html_escape($this->input->post('amount'));
            $student_id = html_escape($this->input->post('student_id'));
            $method = html_escape($this->input->post('method'));
            $description = html_escape($this->input->post('description'));
            $timestamp = strtotime(html_escape($this->input->post('timestamp')));
            $academic_year = html_escape($this->input->post('academic_year'));
            $bank_id = html_escape($this->input->post('bank_id'));
            $contra_entry = html_escape($this->input->post('contra_entry'));
            $receipt_no = html_escape($this->input->post('receipt_no'));

            $name = $this->session->userdata('name');
            $entry_user = !empty($name) ? $name : 'Administrator';

            $invoice_row = $this->db->get_where('invoice', array('invoice_id' => $param2))->row_array();
            $student_row = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
            $class_row = $this->db->get_where('class', array('class_id' => $student_row['class_id']))->row_array();

            $new_paid = intval($invoice_row['amount_paid']) + $amount;
            $new_due = $invoice_row['due'] - $amount;
            $balance_after = max(0, $new_due);

            $snapshot = array(
                'student_id'      => $student_id,
                'student_name'    => $student_row ? $student_row['name'] : '',
                'father_name'     => $student_row ? $student_row['father_name'] : '',
                'academic_year'   => $academic_year,
                'class_name'      => $class_row ? $class_row['name'] : '',
                'class_id'        => $student_row['class_id'],
                'section_id'      => $student_row['section_id'],
                'roll_number'     => $student_row ? $student_row['roll'] : '',
                'gr_number'       => $student_row ? $student_row['student_id'] : '',
                'admission_number' => $student_row ? $student_row['student_id'] : '',
                'invoice_id'      => $param2,
                'fee_template_id' => !empty($invoice_row['fee_template_id']) ? intval($invoice_row['fee_template_id']) : 0,
                'receipt_number'  => $receipt_no,
                'invoice_amount'  => intval($invoice_row['amount']),
                'previous_due'    => intval($invoice_row['previous_due']),
                'current_fee'     => intval($invoice_row['amount']) - intval($invoice_row['previous_due']),
                'discount'        => intval($invoice_row['discount']),
                'total_payable'   => intval($invoice_row['amount']),
                'paid_amount'     => $amount,
                'total_paid'      => $new_paid,
                'balance_after'   => $balance_after,
                'payment_method'  => $method,
                'entry_user'      => $entry_user,
                'created_at'      => date('Y-m-d H:i:s'),
            );

            $this->db->trans_start();

            $page_data = array(
                'invoice_id'    => $param2,
                'student_id'    => $student_id,
                'title'         => 'Fee Payment',
                'description'   => $description,
                'payment_type'  => 'income',
                'amount'        => $amount,
                'previous_due'  => $invoice_row['previous_due'],
                'method'        => $method,
                'timestamp'     => $timestamp,
                'year'          => $academic_year,
                'bank_id'       => $bank_id,
                'contra_entry'  => $contra_entry,
                'entry_user'    => $entry_user,
                'receipt_no'    => $receipt_no,
                'snapshot_data' => json_encode($snapshot),
            );
            $this->db->insert('payment', $page_data);
            $payment_id = $this->db->insert_id();

            $this->db->where('invoice_id', $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $amount, FALSE);
            $this->db->set('due', 'due - ' . $amount, FALSE);
            $this->db->update('invoice');

            $invoice = $this->db->get_where('invoice', array('invoice_id' => $param2))->row();
            if($invoice && $invoice->due <= 0){
                $this->db->where('invoice_id', $param2);
                $this->db->update('invoice', array('status' => '1'));
            }

            $this->syncAcademicHistoryLedger($student_id, $academic_year);

            $this->db->insert('audit_log', array(
                'action'      => 'FEE_ACCEPTED',
                'description' => 'Payment of Rs ' . $amount . ' for invoice ' . $param2 . ' student ' . $student_id,
                'entity_type' => 'payment',
                'entity_id'   => $payment_id,
                'user_name'   => $entry_user,
                'created_at'  => date('Y-m-d H:i:s'),
            ));

            $this->db->trans_complete();
        }


        function carryForwardDueFunction($invoice_id){
            $invoice_id = intval($invoice_id);
            if($invoice_id <= 0) return false;

            $invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row_array();
            if(empty($invoice)) return false;

            $year = $invoice['year'];
            $student_id = $invoice['student_id'];

            if(intval($invoice['previous_due']) > 0) return false;

            $carry_item = $this->db->where('invoice_id', $invoice_id)->where('fees_head_id', 0)->get('invoice_item')->num_rows();
            if($carry_item > 0) return false;

            $old_invoices = $this->db->where('student_id', $student_id)
                ->where('year !=', $year)
                ->where('status', '2')
                ->where('due >', 0)
                ->get('invoice')->result_array();
            if(empty($old_invoices)) return false;

            $prev_due = 0;
            foreach($old_invoices as $oi){
                $prev_due += intval($oi['due']);
            }
            if($prev_due <= 0) return false;

            $name = $this->session->userdata('name');
            $entry_user = !empty($name) ? $name : 'Administrator';

            $this->db->trans_start();

            $this->db->where('invoice_id', $invoice_id);
            $this->db->set('previous_due', 'previous_due + ' . $prev_due, FALSE);
            $this->db->set('amount', 'amount + ' . $prev_due, FALSE);
            $this->db->set('due', 'due + ' . $prev_due, FALSE);
            $this->db->update('invoice');

            $this->db->insert('invoice_item', array(
                'invoice_id'   => $invoice_id,
                'fees_head_id' => 0,
                'amount'       => $prev_due,
            ));

            $new_due = intval($invoice['due']) + $prev_due;
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', array('status' => ($new_due > 0) ? '2' : '1'));

            foreach($old_invoices as $oi){
                $this->db->where('invoice_id', $oi['invoice_id']);
                $this->db->update('invoice', array('status' => '3'));
            }

            $this->db->insert('audit_log', array(
                'action'      => 'CARRY_FORWARD_COMPLETED',
                'description' => 'Previous due Rs ' . $prev_due . ' carried forward to invoice ' . $invoice_id . ' student ' . $student_id . ' year ' . $year,
                'entity_type' => 'invoice',
                'entity_id'   => $invoice_id,
                'old_value'   => json_encode(array('previous_due' => $invoice['previous_due'])),
                'new_value'   => json_encode(array('previous_due' => intval($invoice['previous_due']) + $prev_due, 'carried_from' => array_column($old_invoices, 'invoice_id'))),
                'user_name'   => $entry_user,
                'created_at'  => date('Y-m-d H:i:s'),
            ));

            $this->syncAcademicHistoryLedger($student_id, $year);

            $this->db->trans_complete();
            return true;
        }


        function syncAcademicHistoryLedger($student_id, $academic_year){
            $student_id = intval($student_id);
            if($student_id <= 0 || empty($academic_year)) return;

            $invoice = $this->db->where('student_id', $student_id)
                ->where('year', $academic_year)
                ->order_by('invoice_id', 'DESC')
                ->limit(1)
                ->get('invoice')->row_array();
            if(empty($invoice)) return;

            $student = $this->db->get_where('student', array('student_id' => $student_id))->row_array();

            $current_fee  = intval($invoice['amount']) - intval($invoice['previous_due']);
            $total_payable = intval($invoice['amount']);
            $paid          = intval($invoice['amount_paid']);
            $balance       = intval($invoice['due']);

            $this->db->query(
                "INSERT INTO student_academic_history
                    (student_id, academic_year, class_id, section_id, roll_number, fee_template_id, current_fee, previous_due, total_payable, paid, balance, created_at, updated_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
                 ON DUPLICATE KEY UPDATE
                    class_id = VALUES(class_id),
                    section_id = VALUES(section_id),
                    roll_number = VALUES(roll_number),
                    fee_template_id = VALUES(fee_template_id),
                    current_fee = VALUES(current_fee),
                    previous_due = VALUES(previous_due),
                    total_payable = VALUES(total_payable),
                    paid = VALUES(paid),
                    balance = VALUES(balance),
                    updated_at = NOW()",
                array(
                    $student_id,
                    $academic_year,
                    !empty($student) ? $student['class_id'] : $invoice['class_id'],
                    !empty($student) ? $student['section_id'] : $invoice['section_id'],
                    !empty($student) ? $student['roll'] : null,
                    !empty($invoice['fee_template_id']) ? $invoice['fee_template_id'] : null,
                    $current_fee,
                    intval($invoice['previous_due']),
                    $total_payable,
                    $paid,
                    $balance
                )
            );
        }


        function updateStudentPaymentFunction($param2){
            $discount = intval($this->input->post('discount'));
            $total_after_tax = intval($this->input->post('total_amt'));
            $amount_paid = intval($this->input->post('paid_amt'));
            $due = $total_after_tax - $discount - $amount_paid;

            if($due <= 0){
                $status = 1;
            } else {
                $status = 2;
            }

            $old_invoice = $this->db->get_where('invoice', array('invoice_id' => $param2))->row_array();
            $old_discount = intval($old_invoice['discount']);

            $page_data = array(
                'student_id'          => html_escape($this->input->post('student_id')),
                'description'         => html_escape($this->input->post('description')),
                'amount'              => $total_after_tax,
                'discount'            => $discount,
                'amount_paid'         => $amount_paid,
                'due'                 => $due,
                'creation_timestamp'  => html_escape($this->input->post('creation_timestamp')),
                'status'              => $status
            );

            if(!empty($_FILES['dcntfile']['name'])){
                if(!is_dir(FCPATH . 'uploads/discount/')){
                    mkdir(FCPATH . 'uploads/discount/', 0777, true);
                }
                $dcntfile_name = $_FILES['dcntfile']['name'];
                $dcntfile_tmp  = $_FILES['dcntfile']['tmp_name'];
                $dcntfile_ext  = strtolower(pathinfo($dcntfile_name, PATHINFO_EXTENSION));
                $allowed_exts  = array('gif','jpg','jpeg','png','pdf','doc','docx');
                if(in_array($dcntfile_ext, $allowed_exts) && $dcntfile_tmp){
                    $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $dcntfile_name);
                    $dest_path = FCPATH . 'uploads/discount/' . $new_filename;
                    if(move_uploaded_file($dcntfile_tmp, $dest_path)){
                        $page_data['discount_file'] = $new_filename;
                    }
                }
            }

            $this->db->trans_start();
            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $page_data);

            $fee_titles = $this->input->post('productName');
            $fee_amounts = $this->input->post('total');

            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice_item');

            if(!empty($fee_titles)){
                foreach($fee_titles as $fi => $fhead_id){
                    $amt = intval($fee_amounts[$fi]);
                    if($amt <= 0) continue;
                    $this->db->insert('invoice_item', array(
                        'invoice_id'    => $param2,
                        'fees_head_id'  => intval($fhead_id),
                        'amount'        => $amt
                    ));
                }
            }

            if($discount != $old_discount){
                $payments = $this->db->get_where('payment', array('invoice_id' => $param2))->result_array();
                foreach($payments as $pmt){
                    if(!empty($pmt['snapshot_data'])){
                        $snap = json_decode($pmt['snapshot_data'], true);
                        $snap['discount'] = $discount;
                        $snap['total_payable'] = $total_after_tax;
                        $snap['balance_after'] = max(0, $due);
                        $this->db->where('payment_id', $pmt['payment_id']);
                        $this->db->update('payment', array('snapshot_data' => json_encode($snap)));
                    }
                }

                $user = $this->session->userdata('name');
                $this->db->insert('audit_log', array(
                    'action'      => 'DISCOUNT_APPLIED',
                    'description' => 'Discount changed from ' . $old_discount . ' to ' . $discount . ' for invoice ' . $param2,
                    'entity_type' => 'invoice',
                    'entity_id'   => $param2,
                    'old_value'   => json_encode(array('discount' => $old_discount)),
                    'new_value'   => json_encode(array('discount' => $discount, 'due' => $due)),
                    'user_name'   => !empty($user) ? $user : 'Administrator',
                    'created_at'  => date('Y-m-d H:i:s'),
                ));
            }

            $inv_row = $this->db->get_where('invoice', array('invoice_id' => $param2))->row_array();
            if(!empty($inv_row)){
                $this->syncAcademicHistoryLedger(intval($inv_row['student_id']), $inv_row['year']);
            }

            $this->db->trans_complete();
        }

        function deleteStudentPaymentFunction($param2){
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
        }

        function updateReceiptFunction($receipt_id, $page_data){
            $old_receipt = $this->db->get_where('payment', array('payment_id' => $receipt_id))->row_array();
            $old_amount = intval($old_receipt['amount']);
            $new_amount = intval($page_data['amount']);
            $diff = $new_amount - $old_amount;

            $update_data = array(
                'amount'      => $new_amount,
                'method'      => $page_data['method'],
                'description' => $page_data['description'],
                'timestamp'   => strtotime($page_data['timestamp']),
                'bank_id'     => $page_data['bank_id'],
                'contra_entry' => $page_data['contra_entry']
            );

            if(!empty($old_receipt['snapshot_data'])){
                $snap = json_decode($old_receipt['snapshot_data'], true);
                $snap['paid_amount'] = $new_amount;
                $snap['payment_method'] = $page_data['method'];
                $snap['total_paid'] = intval($snap['total_paid']) + $diff;
                $snap['balance_after'] = max(0, intval($snap['balance_after']) - $diff);
                $update_data['snapshot_data'] = json_encode($snap);
            }

            $this->db->trans_start();

            $this->db->where('payment_id', $receipt_id);
            $this->db->update('payment', $update_data);

            $invoice_id = $page_data['invoice_id'];
            $this->db->where('invoice_id', $invoice_id);
            $this->db->set('amount_paid', 'amount_paid + ' . $diff, FALSE);
            $this->db->set('due', 'due - ' . $diff, FALSE);
            $this->db->update('invoice');

            $inv = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
            if($inv){
                if($inv->due <= 0){
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', array('status' => '1'));
                } else {
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', array('status' => '2'));
                }
                $this->syncAcademicHistoryLedger(intval($inv->student_id), $inv->year);
            }

            $user = $this->session->userdata('name');
            $this->db->insert('audit_log', array(
                'action'      => 'RECEIPT_UPDATED',
                'description' => 'Receipt ' . $receipt_id . ' amount changed from ' . $old_amount . ' to ' . $new_amount . ' for invoice ' . $invoice_id,
                'entity_type' => 'payment',
                'entity_id'   => $receipt_id,
                'old_value'   => json_encode(array('amount' => $old_amount)),
                'new_value'   => json_encode(array('amount' => $new_amount)),
                'user_name'   => !empty($user) ? $user : 'Administrator',
                'created_at'  => date('Y-m-d H:i:s'),
            ));

            $this->db->trans_complete();
        }

}