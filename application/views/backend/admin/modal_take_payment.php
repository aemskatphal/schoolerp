<?php $invoices = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
        foreach ($invoices as $key => $row):
        $banks = $this->db->get('bank')->result_array();
?>
<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_invoices');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>#</td>
                			<td><?php echo get_phrase('amount');?></td>
                			<td><?php echo get_phrase('method');?></td>
                			<td><?php echo get_phrase('date');?></td>
                		</tr>
                	</thead>
                	<tbody>
        <?php $counter = 1; $payments = $this->db->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array(); 
                foreach ($payments as $key => $payment):?>
                		<tr>
                            <td><?php echo $counter++;?></td>
                			<td><?php echo $payment['amount'];?></td>
                			<td>
                             <?php if($payment['method'] == '1'):?>
                            <?php echo 'Online';?>
                             <?php endif;?>
                             <?php if($payment['method'] == '2'):?>
                            <?php echo 'Cash';?>
                             <?php endif;?>
                             <?php if($payment['method'] == '3'):?>
                            <?php echo 'Cheque';?>
                             <?php endif;?>
                            </td>
                			<td><?php echo date('d M, Y', $payment['timestamp']);?></td>
                			
                		</tr>
                <?php endforeach;?>
                	
                	</tbody>
                </table>
                	</div>
            </div>
        </div>
    </div>
</div>

  <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('accept_payment');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
<?php echo form_open(base_url() . 'admin/student_payment/take_payment/'.$row['invoice_id'], array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

				<div class="form-group"> 
					 <label class="col-sm-12">Total Amount<span class="bg-require">*</span></label>        
					 <div class="col-sm-12">
		                    <input type="text" class="form-control" value="<?php echo $row['amount'];?>" readonly>
		                    <input type="hidden" name="academic_year" value="<?php echo $row['year'];?>">
		                </div>
		            </div>

		           <div class="form-group"> 
					 <label class="col-sm-12">Paid Amount<span class="bg-require">*</span></label>        
					 <div class="col-sm-12">
		                    <input type="text" class="form-control" name="amount_paid" value="<?php echo $row['amount_paid'];?>" readonly>
		                </div>
		            </div>

		            <div class="form-group"> 
					 <label class="col-sm-12">Remaining Balance<span class="bg-require">*</span></label>        
					 <div class="col-sm-12">
		                    <input type="text" class="form-control" value="<?php echo $row['due'];?>" readonly>
		                </div>
		            </div>

		           <div class="form-group"> 
					 <label class="col-sm-12">Amount You Want To Pay Now<span class="bg-require">*</span></label>        
					 <div class="col-sm-12">
		                    <input type="number" class="form-control" name="amount" value="" placeholder="Enter Payment Amount" required>
		                </div>
		            </div>

		           <div class="form-group"> 
					 <label class="col-sm-12">Method<span class="bg-require">*</span></label>        
					 <div class="col-sm-12">
                            <select name="method" class="form-control" style="width:100%" required>
                                <option value="">Payment Method</option>
                                <option value="1">Online</option>
                                <option value="2">Cash</option>
                                <option value="3">Cheque</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Bank Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                           <select name="bank_id" class="form-control select2" required>
                              <option value="">Select</option>
                              <?php foreach($banks as $bank): ?>
                              <option value="<?php echo $bank['bank_id'];?>"><?php echo $bank['bank_name'];?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Contra Entry<span class="bg-require">*</span></label>
                        <div class="col-md-12">
                           <div class="form-control">
                              <input type="radio" class="dsize" name="contra_entry" value="1" required>&nbsp;<span class="crview">Yes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" class="dsize" name="contra_entry" value="0" required>&nbsp;<span class="drview">No</span>
                           </div>
                        </div>
                    </div>

                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>">
                    <input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">
                    <input type="hidden" name="title" value="<?php echo $row['title'];?>">

                    <div class="form-group">
                        <label class="col-md-12">Description<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>

		            <div class="form-group">
		                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Accept Payment</button>
		            </div>

				<?php echo form_close();?>
			</div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
