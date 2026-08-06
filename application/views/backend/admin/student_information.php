<?php
$preset_class = isset($class_id) ? $class_id : $this->input->get('class_id');
$preset_from  = isset($from)     ? $from     : $this->input->get('from');
$preset_to    = isset($to)       ? $to       : $this->input->get('to');
?>
<div class="row">
   <div class="col-md-12">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-filter"></i>&nbsp;&nbsp;<i>Filter</i></div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" id="year">
                      <option value="">Academic Year</option>
                      <?php
                      $current_year = date('Y');
                      for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                          $year_val = $y.'-'.($y+1);
                      ?>
                          <option value="<?php echo $year_val; ?>"><?php echo $year_val; ?></option>
                      <?php endfor; ?>
                  </select>
               </div>
               <div class="col-md-3">
                   <select id="class_id" class="form-control">
                      <option value="">Select Standard</option>
                      <?php foreach($this->db->order_by('sort_order','asc')->get('class')->result_array() as $cls): ?>
                         <option value="<?php echo $cls['class_id']; ?>" <?php if(!empty($preset_class) && $preset_class == $cls['class_id']) echo 'selected'; ?>><?php echo $cls['name']; ?></option>
                      <?php endforeach; ?>
                   </select>
               </div>
               <div class="col-md-3">
                  <select id="ad_type" class="form-control">
                      <option value="">Ad Type</option>
                      <option value="1">Regular</option>
                      <option value="2">RTE</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <select id="board_id" class="form-control">
                     <option value="">Select Board</option>
                     <?php foreach($this->db->order_by('board_id','asc')->get('board')->result_array() as $brd): ?>
                        <option value="<?php echo $brd['board_id']; ?>"><?php echo $brd['board_name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
             </div>
              <div class="row">
                <div class="col-md-3 mt-4">
                  <select id="academy_id" class="form-control">
                     <option value="">Select Academy</option>
                     <?php foreach($this->db->get('academy')->result_array() as $acd): ?>
                        <option value="<?php echo $acd['academy_id']; ?>"><?php echo $acd['academy_name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="col-md-3 mt-4">
                  <select id="group_id" class="form-control">
                     <option value="">Select Group</option>
                     <?php foreach($this->db->get('student_group')->result_array() as $grp): ?>
                        <option value="<?php echo $grp['group_id']; ?>"><?php echo $grp['group_name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <div class="col-md-3 mt-4">
                  <select id="status" class="form-control">
                      <option value="">Student Status</option>
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                      <option value="2">Out Of School</option>
                  </select>
               </div>
                <div class="col-md-3 mt-4">
                   <input class="form-control m-r-10" name="from" type="date" value="<?php echo html_escape($preset_from); ?>" id="from">
                </div>
                <div class="col-md-3 mt-4">
                   <input class="form-control m-r-10" name="to" type="date" value="<?php echo html_escape($preset_to); ?>" id="to">
            </div>
         </div>
      </div>
   </div>
</div>
   </div>
</div>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <div class="actionbtn pb-4">
                   <?php if (has_action('students', 'student_list', 'student_promotion')): ?>
                   <button id="transfer" title="Click here for student promotion" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;&nbsp;Student Promotion</button>&nbsp;
                   <?php endif; ?>
                   <button id="qrcode" title="Click here to generate QRcode " class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp;&nbsp;QRcode</button>
                   <?php if (has_action('students', 'student_list', 'bulk_lc')): ?>
                   &nbsp;<button id="lcprint" type="button" title="Click here to print LC of selected students" data-target-url="<?php echo base_url(); ?>report/MultipalStudentLC" class="btn btn-danger btn-rounded btn-sm preport"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Bulk LC Print</button>
                   <?php endif; ?>
                   <?php if (has_action('students', 'student_list', 'bulk_idcard')): ?>
                   <button id="idprint" type="button" title="Click here to print ID Card of selected students" data-target-url="<?php echo base_url(); ?>report/MultipalstudentIdCard" class="btn btn-primary btn-rounded btn-sm preport"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Bulk ID Card Print</button>
                   <?php endif; ?>
               </div>
               <table id="tblstudentinfo" class="display nowrap table-bordered" cellspacing="0" width="100%" data-url="<?php echo base_url();?>admin/studentList">
                  <thead>
                     <tr>
                        <th><div><input type="checkbox" class="largecheck" id="bulkSelect" /></div></th>
                        <th><div>Actions</div></th>
                        <th><div>Ad Date</div></th>
                        <th><div>QR Code</div></th>
                        <th><div>Photo</div></th>
                        <th><div>Ad Year</div></th>
                        <th><div>Gen Reg No</div></th>
                        <th><div>Name</div></th>
                        <th><div>Standard</div></th>
                        <th><div>Division</div></th>
                        <th><div>Board</div></th>
                        <th><div>Academy</div></th>
                        <th><div>Gender</div></th>
                        <th><div>Religion</div></th>
                        <th><div>Category</div></th>
                        <th><div>Caste</div></th>
                        <th><div>UID</div></th>
                        <th><div>Student Mobile</div></th>
                        <th><div>Parent Mobile</div></th>
                        <th><div>Blood Group</div></th>
                        <th><div>Address</div></th>
                        <th><div>Birthday</div></th>
                        <th><div>Ad Type</div></th>
                        <th><div>Father Name</div></th>
                        <th><div>Mother Name</div></th>
                        <th><div>Parent Uid</div></th>
                        <th><div>Group Name</div></th>
                        <th><div>Entry User</div></th>
                        <th><div>Documents</div></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="docPreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#3498db;color:#fff;padding:10px 15px;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;opacity:0.8;"><span>&times;</span></button>
                <h4 class="modal-title" id="docPreviewTitle"><i class="fa fa-file-image-o"></i> Document Preview</h4>
            </div>
            <div class="modal-body" id="docPreviewBody" style="text-align:center;padding:15px;">
            </div>
            <div class="modal-footer" style="padding:8px 15px;">
                <a id="docPreviewDownload" href="#" target="_blank" class="btn btn-success btn-sm btn-rounded" style="color:#fff"><i class="fa fa-download"></i> Download</a>
                <a id="docPreviewOpen" href="#" target="_blank" class="btn btn-info btn-sm btn-rounded" style="color:#fff"><i class="fa fa-external-link"></i> Open Full Size</a>
                <button type="button" class="btn btn-default btn-sm btn-rounded" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function previewDocument(url, ext, docType, remarks) {
    var title = docType;
    if(remarks) title += ' - ' + remarks;
    $('#docPreviewTitle').html('<i class="fa fa-file-image-o"></i> ' + title);
    $('#docPreviewDownload').attr('href', url);
    $('#docPreviewOpen').attr('href', url);
    var imageExts = ['jpg','jpeg','png','gif','bmp','webp'];
    if(imageExts.indexOf(ext) !== -1) {
        $('#docPreviewBody').html('<img src="' + url + '" style="max-width:100%;max-height:500px;border-radius:4px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">');
    } else {
        $('#docPreviewBody').html('<div style="padding:40px;"><i class="fa fa-file" style="font-size:60px;color:#3498db;"></i><br><br><p>Preview not available for this file type.</p><a href="' + url + '" target="_blank" class="btn btn-primary btn-rounded" style="color:#fff"><i class="fa fa-download"></i> Download to View</a></div>');
    }
    $('#docPreviewModal').modal('show');
}
</script>
