<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"><i class="fa fa-history"></i>&nbsp;&nbsp;<i>Promotion History</i></div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table id="tblPromotionHistory" class="display nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th><div>#</div></th>
                        <th><div>Student ID</div></th>
                        <th><div>Student Name</div></th>
                        <th><div>From Standard</div></th>
                        <th><div>From Section</div></th>
                        <th><div>To Standard</div></th>
                        <th><div>To Section</div></th>
                        <th><div>Session</div></th>
                        <th><div>Promoted By</div></th>
                        <th><div>Date</div></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
$(document).ready(function(){
    if($('#tblPromotionHistory').length > 0 && !$.fn.DataTable.isDataTable('#tblPromotionHistory')){
        $('#tblPromotionHistory').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            dom: 'Blfirtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            aaSorting: [[0, 'desc']],
            'ajax': {
                'url': '<?php echo base_url(); ?>admin/promotion_history_list',
                'data': function(data){}
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
            }]
        });
    }
});
</script>
