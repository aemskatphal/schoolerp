<div class="row">
   <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Salary Payment List');?></div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
          <?php echo form_open(base_url() . 'payroll/salary_payment', array('class' => 'validate'));?>
            <div class="panel-body">
              <div class="row">
                 <div class="col-md-3">
                    <input type="text" class="form-control date-month-picker" name="month_year" value="<?php echo $month_year;?>" required> 
                 </div>
                 <div class="col-md-2">
                  <button type="submit" name="search" value="1" class="form-control btn btn-default btn-block"><i class="fa fa-filter"></i> <?php echo get_phrase('Filter');?></button>
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
                        <th width="80"><div>#</div></th>
                        <th><div><?php echo get_phrase('Photo');?></div></th>
                        <th><div><?php echo get_phrase('Actions');?></div></th>
                        <th><div><?php echo get_phrase('Status');?></div></th>
                        <th><div><?php echo get_phrase('Name');?></div></th>
                        <th><div><?php echo get_phrase('Salary');?></div></th>
                        <th><div><?php echo get_phrase('Department');?></div></th>
                        <th><div><?php echo get_phrase('Mobile');?></div></th>
                        <th><div><?php echo get_phrase('Gender');?></div></th>
                        <th><div><?php echo get_phrase('Action Date');?></div></th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1; foreach($salary_list as $row): 
                      $month = date('m', strtotime($month_year));
                      $year = date('Y', strtotime($month_year));
                      $is_paid = ($row['payment_status'] == 1);
                    ?>
                     <tr>
                        <td><?php echo $count++;?></td>
                        <td>
                          <?php 
                            $photo = 'uploads/user.jpg';
                            if(!empty($row['file_name'])){
                              $photo = 'uploads/teacher_image/' . $row['file_name'];
                            } elseif(file_exists('uploads/teacher_image/' . $row['teacher_id'] . '.jpg')){
                              $photo = 'uploads/teacher_image/' . $row['teacher_id'] . '.jpg';
                            }
                          ?>
                          <img src="<?php echo base_url($photo);?>" width="30">
                        </td>
                        <td class="min-w-c">
                          <?php if(!$is_paid):?>
                            <a target="_blank" href="<?php echo base_url('payroll/create/'.$row['teacher_id'].'/'.$month.'/'.$year);?>" class="btn btn-inverse btn-sm btn-rounded text-white"><i class="fa fa-credit-card"></i> <?php echo get_phrase('Pay Now');?></a>
                          <?php else:?>
                            <a target="_blank" href="<?php echo base_url('payroll/create/'.$row['teacher_id'].'/'.$month.'/'.$year);?>" class="btn btn-success btn-sm btn-rounded text-white"><i class="fa fa-check"></i> <?php echo get_phrase('Paid');?></a>
                          <?php endif;?>
                        </td>
                        <td>
                          <?php if($is_paid):?>
                            <span class='label label-success'><?php echo get_phrase('Salary Paid');?></span>
                          <?php else:?>
                            <span class='label label-info'><?php echo get_phrase('Salary Unpaid');?></span>
                          <?php endif;?>
                        </td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['joining_salary'];?></td>
                        <td><?php echo $row['department_name'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['sex'];?></td>
                        <td><?php echo $is_paid ? date('d M Y', strtotime($row['payment_date'])) : '-';?></td>
                     </tr>
                    <?php endforeach;?>
                  </tbody>
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
      paging: false,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      aaSorting: [[0, 'asc']]
    });
});
</script>
