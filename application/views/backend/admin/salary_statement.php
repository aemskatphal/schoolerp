<div class="row">
   <div class="col-md-12">
      <div class="panel panel-info">
       <div class="panel-heading"> <i class="fa fa-filter"></i>&nbsp;&nbsp;<i><?php echo get_phrase('Filter');?></i></div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
          <?php echo form_open(base_url() . 'payroll/salary_statement', array('class' => 'validate'));?>
            <div class="panel-body">
              <div class="row">
                 <div class="col-md-3">
                    <input type="text" class="form-control date-month-picker" name="month_year_from" value="<?php echo $month_year_from;?>" required>
                 </div>
                 <div class="col-md-3">
                    <input type="text" class="form-control date-month-picker" name="month_year_to" value="<?php echo $month_year_to;?>" required>
                 </div>
                 <div class="col-md-2">
                  <button type="submit" name="searchstm" value="1" class="form-control btn btn-default btn-block"><i class="fa fa-filter"></i> <?php echo get_phrase('Filter');?></button>
                 </div>
                </div>
            </div>
          </form>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table id="salarypayment" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th><?php echo get_phrase('Designation');?></th>
                        <th><?php echo get_phrase('Review By');?></th>
                        <th><?php echo get_phrase('Salary');?></th>
                        <th><?php echo get_phrase('Deduction (-)');?></th>
                        <th><?php echo get_phrase('Net Salary');?></th>
                        <th><?php echo get_phrase('Benef Account No');?></th>
                        <th><?php echo get_phrase('Ben Name');?></th>
                        <th><?php echo get_phrase('Ben Address');?></th>
                        <th><?php echo get_phrase('Bank Name');?></th>
                        <th><?php echo get_phrase('Branch');?></th>
                        <th><?php echo get_phrase('Ifsc Code');?></th>
                        <th><?php echo get_phrase('Type Of Account');?></th>
                        <th><?php echo get_phrase('City');?></th>
                        <th><?php echo get_phrase('Sender Name');?></th>
                        <th><?php echo get_phrase('Mobile No');?></th>
                        <th><?php echo get_phrase('Entry User');?></th>
                     </tr>
                    </thead>
                 	<tbody>
                    <?php $count = 1; $total_salary = 0; $total_deduction = 0; $total_net = 0; foreach($statement as $row):?>
                     <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['designation_name'];?></td>
                        <td>
                           <?php if($row['review_status'] == 1):?>
                              <span class="label label-success"><?php echo get_phrase('Reviewed');?></span>
                           <?php else:?>
                              <a href="<?php echo base_url('payroll/review/'.$row['salary_payment_id']);?>" class="btn btn-warning btn-xs btn-rounded" onclick="return confirm('<?php echo get_phrase('Mark this salary as reviewed?');?>');"><i class="fa fa-check"></i> <?php echo get_phrase('Mark as Review');?></a>
                           <?php endif;?>
                        </td>
                        <td><?php echo number_format($row['salary'], 0);?></td>
                        <td><?php echo number_format($row['deduction'], 0);?></td>
                        <td><?php echo number_format($row['net_payable'], 0);?></td>
                        <td><?php echo $row['account_number'];?></td>
                        <td><a href="<?php echo base_url('payroll/view_payslip/'.$row['salary_payment_id']);?>" target="_blank"><?php echo $row['account_holder_name'];?></a></td>
                        <td><?php echo $row['city'];?></td>
                        <td><?php echo $row['bank_name_col'];?></td>
                        <td><?php echo $row['branch'];?></td>
                        <td><?php echo $row['ifsc_code'];?></td>
                        <td><?php echo $row['account_type'];?></td>
                        <td><?php echo $row['city'];?></td>
                        <td><?php echo $row['entry_user'];?></td>
                        <td><?php echo $row['mobile_no'];?></td>
                        <td><?php echo $row['entry_user'];?></td>
                     </tr>
                     <?php $total_salary += $row['salary']; $total_deduction += $row['deduction']; $total_net += $row['net_payable'];?>
                    <?php endforeach;?>
                 	</tbody>
					<tfoot>
						<tr>
							<th colspan="3"><?php echo get_phrase('Total');?></th>
							<th><?php echo number_format($total_salary, 0);?></th>
							<th><?php echo number_format($total_deduction, 0);?></th>
							<th><?php echo number_format($total_net, 0);?></th>
							<th colspan="11"></th>
						</tr>
					</tfoot>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.date-month-picker').datepicker({
      format: 'yyyy-mm',
      startView: "months",
      minViewMode: "months",
      autoclose: true,
      todayHighlight: true,
      orientation: "bottom left"
    });

    $('#salarypayment').DataTable({
      dom: 'Blfirtip',
      paging: true,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      aaSorting: [[0, 'asc']]
    });
});
</script>
