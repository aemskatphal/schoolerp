<div class="col-sm-4 offset-sm-4">
   <div class="panel panel-info">
      <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;Fees Discount Report</div>
      <div class="panel-wrapper collapse in" aria-expanded="true">
         <div class="panel-body table-responsive">
              <div class="form-group mb-2">
              <label class="col-md-12" for="example-text">Academic Year</label>
               <div class="col-sm-12">
                  <select name="running_session" class="form-control select2" id="academic_year">
                     <option value="">Select Academic Year</option>
                     <?php
                     $current_year = date('Y');
                     for($y = $current_year - 5; $y <= $current_year + 5; $y++){
                         $val = $y.'-'.($y+1);
                         $sel = ($val == $current_year.'-'.($current_year+1)) ? 'selected' : '';
                         echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
                     }
                     ?>
                  </select>
               </div>
              </div>
             <a target="_blank" class="btn btn-success btn-sm btn-rounded btn-block preport" style="color:white" id="findpnt"> <i class="fa fa-print"></i> Print</a>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
    $('#findpnt').on('click', function() {
          var academic_year = $('#academic_year').val();
          if (academic_year  == "" ) {
              $.toast({
               text: 'Please select year',
               position: 'top-right',
               loaderBg: '#f56954',
               icon: 'warning',
               hideAfter: 3500,
               stack: 6
           });
               return false;
           }
          var uri = '<?php echo base_url();?>report/view/fees_discount/' + academic_year;
          $(".preport").prop("href", uri);
   });
});
</script>