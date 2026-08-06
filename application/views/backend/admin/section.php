<div class="row">
   <?php if (has_action('students', 'division', 'create')): ?>
   <div class="col-sm-5">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Division</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <?php echo form_open(base_url().'admin/division/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
               <div class="form-group">
                  <label class="col-md-12">Standard<span class="bg-require">*</span></label>
                  <div class="col-sm-12">
                     <select name="class_id" class="form-control select2" required>
                        <option value="">Select Standard</option>
                        <?php foreach($this->db->order_by('sort_order','asc')->get('class')->result_array() as $cls): ?>
                        <option value="<?php echo $cls['class_id']; ?>"><?php echo $cls['name']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-12">Division<span class="bg-require">*</span></label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" name="name" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-12">Teacher</label>
                  <div class="col-sm-12">
                     <select name="teacher_id" class="form-control select2">
                        <option value="">Select Teacher</option>
                        <?php foreach($this->db->get('teacher')->result_array() as $tch): ?>
                        <option value="<?php echo $tch['teacher_id']; ?>"><?php echo $tch['name']; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;Add Division</button>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <div class="col-sm-7">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;List Division</div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <div class="tabs-vertical-env">
                  <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th><div>#</div></th>
                           <th><div>Standard</div></th>
                           <th><div>Division</div></th>
                           <th><div>Teacher</div></th>
                           <th><div>Options</div></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $counter = 1;
                        $sections = $this->db->select('section.*, class.name as class_name, teacher.name as teacher_name')
                            ->join('class', 'class.class_id = section.class_id', 'left')
                            ->join('teacher', 'teacher.teacher_id = section.teacher_id', 'left')
                            ->order_by('section.class_id', 'asc')
                            ->get('section')->result_array();
                        foreach($sections as $row):
                        ?>
                        <tr>
                           <td><?php echo $counter++; ?></td>
                           <td><?php echo $row['class_name']; ?></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['teacher_name']; ?></td>
                             <td>
                                <?php if (has_action('students', 'division', 'edit')): ?>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_section/<?php echo $row['section_id']; ?>');"><button type="button" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-pencil"></i></button></a>
                                <?php endif; ?>
                                <?php if (has_action('students', 'division', 'delete')): ?>
                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/division/delete/<?php echo $row['section_id']; ?>');"><button type="button" class="btn btn-danger btn-rounded btn-sm"><i class="fa fa-times"></i></button></a>
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
