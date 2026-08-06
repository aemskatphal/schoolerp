<div class="row">
   <?php if (has_action('students', 'group', 'create')): ?>
   <div class="col-sm-5">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Group</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <?php echo form_open(base_url().'admin/group/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
               <div class="form-group">
                  <label class="col-md-12">Name<span class="bg-require">*</span></label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" name="group_name" required>
                  </div>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;Add Group</button>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <div class="col-sm-7">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;List Groups</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th><div>#</div></th>
                        <th><div>Name</div></th>
                        <th><div>Options</div></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $counter = 1;
                     $groups = $this->group_model->getAllGroup();
                     foreach($groups as $row):
                     ?>
                     <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $row['group_name']; ?></td>
                         <td>
                            <?php if (has_action('students', 'group', 'edit')): ?>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_group/<?php echo $row['group_id']; ?>');"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-pencil"></i></button></a>
                            <?php endif; ?>
                            <?php if (has_action('students', 'group', 'delete')): ?>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/group/delete/<?php echo $row['group_id']; ?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i></button></a>
                            <?php endif; ?>
                         </td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
   if ($.fn.DataTable.isDataTable('#example23')) {
      $('#example23').DataTable().destroy();
   }
   $('#example23').DataTable({
      dom: 'Blfirtip',
      paging: true,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      aaSorting: [[0, 'asc']]
   });
});
</script>
