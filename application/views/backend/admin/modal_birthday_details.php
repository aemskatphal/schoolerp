<?php
$from = $this->input->post('from');
$to   = $this->input->post('to');

$this->db->select('s.*, c.name as class_name');
$this->db->from('student s');
$this->db->join('class c', 'c.class_id = s.class_id', 'left');
if (!empty($from) && !empty($to)) {
    $this->db->where('DAYOFYEAR(s.birthday) >= DAYOFYEAR(' . $this->db->escape($from) . ')');
    $this->db->where('DAYOFYEAR(s.birthday) <= DAYOFYEAR(' . $this->db->escape($to) . ')');
}
$this->db->where('s.birthday IS NOT NULL');
$this->db->where('s.birthday !=', '0000-00-00');
$this->db->order_by('MONTH(s.birthday)', 'ASC');
$this->db->order_by('DAY(s.birthday)', 'ASC');
$students = $this->db->get()->result_array();
?>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading">&nbsp;Student Birthday</div>
         <form action="<?php echo base_url();?>report/std_birthday_banner" class="form-horizontal form-groups-bordered validate" target="_blank" id="banfrm" method="post" accept-charset="utf-8">
         <div class="panel-body table-responsive">
            <div class="actionbtn pb-4">
              <button id="birthbanner" type="submit" title="Print Banner" class="btn btn-inverse btn-rounded btn-sm"><i class="fa fa-birthday-cake" aria-hidden="true"></i>&nbsp;&nbsp;Print Banner</button>
            </div>
            <table class="table display nowrap table-bordered" cellspacing="0" width="100%">
               <thead>
                  <tr><th><div><input type="checkbox" class="largecheck" id="bulkSelect">Select all</div></th>
                  <th>Ad. year</th>
                  <th>Class</th>
                  <th>Name</th>
                  <th>Photo</th>
               </tr></thead>
               <tbody>
                  <?php $counter = 1; foreach ($students as $row): ?>
                  <tr>
                     <td><input type="checkbox" name="student_id[]" class="selectRow" value="<?php echo $row['student_id']; ?>">&nbsp;<?php echo $counter++; ?></td>
                     <td><?php echo html_escape($row['ad_year']); ?></td>
                     <td><?php echo html_escape($row['class_name'] ?? 'N/A'); ?></td>
                     <td><a href="<?php echo base_url();?>admin/view_student/<?php echo $row['student_id']; ?>" target="_blank"><?php echo html_escape($row['name']); ?></a></td>
                     <td>
                        <?php if(!empty($row['photo'])): ?>
                            <img src="<?php echo base_url();?>uploads/student_image/<?php echo html_escape($row['photo']); ?>" width="40" height="40" class="img-circle">
                        <?php else: ?>
                            <img src="<?php echo base_url();?>uploads/default.png" width="40" height="40" class="img-circle">
                        <?php endif; ?>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
$("#bulkSelect").on('click',function() {
    var status = this.checked;
    $(".selectRow").each( function() {
        $(this).prop("checked",status);
    });
});
$('#banfrm').on('submit', function(e) {
    e.preventDefault();
    if( $('.selectRow:checked').length > 0 ){
        $('#banfrm').unbind('submit').submit();
    } else {
        $('#modal-6').modal('show');
    }
});
</script>
