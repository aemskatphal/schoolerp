<style>
    @media print {
        body * { visibility: hidden !important; }
        #payslipPrint, #payslipPrint * { visibility: visible !important; }
        #payslipPrint {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 10px !important;
            border: none !important;
        }
        .payhead { display: flex !important; align-items: center !important; margin-top: 0 !important; }
        .payhead .col-md-6 { width: 50% !important; display: inline-block !important; float: none !important; }
        .paylogo { width: 80px !important; height: auto !important; }
        .payslip .col-md-6 { width: 48% !important; display: inline-block !important; float: none !important; vertical-align: top !important; margin: 0 1% !important; }
        .payslip .panel { margin: 0 !important; border: 1px solid #ddd !important; }
        .payslip .panel-heading { padding: 6px 10px !important; }
        .payslip .panel-body { padding: 6px 10px !important; }
        .payslip .panel-title { font-size: 13px !important; margin: 0 !important; }
        .payslip .table { margin-bottom: 0 !important; font-size: 12px !important; }
        .payslip .table th, .payslip .table td { padding: 4px 8px !important; font-size: 12px !important; }
        .bill-info .col-md-6 { width: 50% !important; display: inline-block !important; float: none !important; }
        .bill-info address { font-size: 12px !important; line-height: 1.5 !important; margin: 0 !important; }
        .bill-info .h5 { font-size: 13px !important; margin: 0 0 4px 0 !important; }
        .invoice-summary { margin-top: 10px !important; }
        .invoice-summary .amounts { font-size: 13px !important; }
        .invoice-summary .amounts li { padding: 3px 0 !important; }
        .mt-lg { margin-top: 5px !important; }
        .mt-md { margin-top: 5px !important; }
        .mb-4 { margin-bottom: 4px !important; }
        #print_button, .panel-footer, .btn { display: none !important; }
        #wrapper > nav, #wrapper > div.navbar-default, .right-sidebar, .footer,
        .bg-title, .panel-info > .panel-heading, .preloader,
        #wrapper > nav:first-child { display: none !important; }
        #page-wrapper { margin: 0 !important; padding: 0 !important; min-height: auto !important; }
        .invoice header .row h4 { font-size: 14px !important; margin: 2px 0 !important; }
        .invoice header .row p { font-size: 11px !important; margin: 1px 0 !important; }
        @page { margin: 10mm; size: A4 portrait; }
    }
</style>

<section class="panel">
<div class="panel-body" style="padding:10px;">
    <div class="invoice" id="payslipPrint" style="background:#fff; padding:15px;">
        <header class="clearfix">
            <div class="row payhead">
                <div class="col-md-6">
                    <?php
                        $logo = 'uploads/student_image/logo.png';
                        if(file_exists(FCPATH.'uploads/logo.png')) $logo = 'uploads/logo.png';
                    ?>
                    <img src="<?php echo base_url($logo);?>" class="paylogo" alt="img" style="max-width:100px; height:auto;"/>
                </div>
                <div class="col-md-6 text-right">
                    <?php
                        $payslip_no = str_pad($payslip->payment->salary_payment_id, 5, '0', STR_PAD_LEFT);
                        $pay_date = date('d-M-Y', strtotime($payslip->payment->payment_date));
                        $salary_month = date('F Y', strtotime($payslip->payment->month_year));
                    ?>
                    <h4 style="font-size:16px; margin:0 0 3px 0;"><?php echo get_phrase('Payslip No');?> #<?php echo $payslip_no;?></h4>
                    <p style="font-size:12px; margin:1px 0;">
                        <strong><?php echo get_phrase('Date');?> :</strong> <?php echo $pay_date;?>
                    </p>
                    <p style="font-size:12px; margin:1px 0;">
                        <strong><?php echo get_phrase('Salary Month');?> :</strong> <?php echo $salary_month;?>
                    </p>
                </div>
            </div>
        </header>

        <div class="bill-info" style="margin-top:10px;">
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size:13px; margin:0 0 3px 0;"><strong><?php echo get_phrase('To');?> :</strong></p>
                    <address style="font-size:12px; line-height:1.6;">
                        <strong><?php echo $payslip->teacher->name;?></strong><br>
                        <?php echo get_phrase('Department');?> : <?php echo $payslip->department ? $payslip->department->name : '-';?><br>
                        <?php echo get_phrase('Designation');?> : <?php echo $payslip->designation ? $payslip->designation->name : '-';?><br>
                        <?php echo get_phrase('Mobile No');?> : <?php echo $payslip->teacher->phone;?>
                    </address>
                </div>
                <div class="col-md-6 text-right">
                    <p style="font-size:13px; margin:0 0 3px 0;"><strong><?php echo get_phrase('From');?> :</strong></p>
                    <address style="font-size:12px; line-height:1.6;">
                        <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?><br/>
                        <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?>
                    </address>
                </div>
            </div>
        </div>

        <div class="row payslip" style="margin-top:10px;">
            <div class="col-md-6">
                <section class="panel" style="margin-bottom:0;">
                    <div class="panel-heading" style="background:#00c292; color:#fff; padding:6px 10px;">
                        <h4 class="panel-title" style="font-size:13px; margin:0; color:#fff;"><?php echo get_phrase('Allowances');?></h4>
                    </div>
                    <div class="panel-body" style="padding:6px 10px;">
                        <table class="table" style="margin-bottom:0; font-size:12px;">
                            <thead>
                                <tr>
                                    <th style="padding:4px 8px; font-size:12px;"><?php echo get_phrase('Name');?></th>
                                    <th class="text-right" style="padding:4px 8px; font-size:12px;"><?php echo get_phrase('Amount');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($payslip->allowances)): foreach($payslip->allowances as $allow):?>
                                <tr>
                                    <td style="padding:4px 8px; font-size:12px;"><?php echo $allow['name'];?></td>
                                    <td class="text-right" style="padding:4px 8px; font-size:12px;"><?php echo number_format($allow['amount'], 0);?></td>
                                </tr>
                                <?php endforeach; endif;?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="col-md-6">
                <section class="panel" style="margin-bottom:0;">
                    <div class="panel-heading" style="background:#e74c3c; color:#fff; padding:6px 10px;">
                        <h4 class="panel-title" style="font-size:13px; margin:0; color:#fff;"><?php echo get_phrase('Deductions');?></h4>
                    </div>
                    <div class="panel-body" style="padding:6px 10px;">
                        <table class="table" style="margin-bottom:0; font-size:12px;">
                            <thead>
                                <tr>
                                    <th style="padding:4px 8px; font-size:12px;"><?php echo get_phrase('Name');?></th>
                                    <th class="text-right" style="padding:4px 8px; font-size:12px;"><?php echo get_phrase('Amount');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($payslip->deductions)): foreach($payslip->deductions as $ded):?>
                                <tr>
                                    <td style="padding:4px 8px; font-size:12px;"><?php echo $ded['deduction_name'];?></td>
                                    <td class="text-right" style="padding:4px 8px; font-size:12px;"><?php echo number_format($ded['deduction_amount'], 0);?></td>
                                </tr>
                                <?php endforeach; endif;?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

        <?php
            $total_allow = $payslip->payment->amount;
            $total_deduct = $payslip->payment->advance_deduction;
            $net_salary = $payslip->payment->net_payable;
        ?>
        <div class="invoice-summary text-right" style="margin-top:10px;">
            <div class="row">
                <div class="col-md-5 offset-md-7">
                    <ul class="amounts" style="list-style:none; padding:0; font-size:13px;">
                        <li style="padding:2px 0;"><strong><?php echo get_phrase('Total Allowance');?> :</strong> <?php echo number_format($total_allow, 0);?></li>
                        <li style="padding:2px 0;"><strong><?php echo get_phrase('Total Deduction');?> :</strong> <?php echo number_format($total_deduct, 0);?></li>
                        <li style="padding:4px 0; border-top:2px solid #333; font-size:14px;">
                            <strong><?php echo get_phrase('Net Pay');?> :</strong>
                            <strong><?php echo number_format($net_salary, 0);?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="margin-top:20px; font-size:12px; display:flex; justify-content:space-between;">
            <div style="text-align:center; width:30%;">
                <br><br>
                <div style="border-top:1px solid #333; padding-top:3px;">Prepared By</div>
            </div>
            <div style="text-align:center; width:30%;">
                <br><br>
                <div style="border-top:1px solid #333; padding-top:3px;">Accountant</div>
            </div>
            <div style="text-align:center; width:30%;">
                <br><br>
                <div style="border-top:1px solid #333; padding-top:3px;">Principal</div>
            </div>
        </div>
    </div>
</div>
<footer class="panel-footer">
    <div class="text-right mr-lg">
        <a href="javascript:void(0);" id="print_button" class="btn btn-info btn-rounded btn-sm" style="color:#fff;">
            <i class="fa fa-print"></i> <?php echo get_phrase('Print Payslip');?>
        </a>
        <a href="<?php echo base_url('payroll/salary_statement');?>" class="btn btn-default btn-rounded btn-sm">
            <i class="fa fa-arrow-left"></i> <?php echo get_phrase('Back');?>
        </a>
    </div>
</footer>
</section>

<script>
    $("#print_button").click(function(){
        $("#payslipPrint").printArea();
    });
</script>
