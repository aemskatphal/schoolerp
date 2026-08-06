<?php $section = $this->db->get_where('section', array('section_id' => $param2))->row_array(); ?>
<div class="row">
   <div class="col-sm-12">
      <div class="panel panel-info">
         <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Edit Division</div>
         <div class="panel-body table-responsive">
            <?php echo form_open(base_url().'admin/division/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
            <div class="form-group">
               <label class="col-md-12">Standard<span class="bg-require">*</span></label>
               <div class="col-sm-12">
                  <select name="class_id" class="form-control select2" required>
                     <option value="">Select Standard</option>
                     <?php foreach($this->db->order_by('sort_order','asc')->get('class')->result_array() as $cls): ?>
                     <option value="<?php echo $cls['class_id']; ?>" <?php if($section['class_id'] == $cls['class_id']) echo 'selected'; ?>><?php echo $cls['name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Division<span class="bg-require">*</span></label>
               <div class="col-sm-12">
                  <input type="text" class="form-control" name="name" value="<?php echo $section['name']; ?>" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-md-12">Teacher</label>
               <div class="col-sm-12">
                  <select name="teacher_id" class="form-control select2">
                     <option value="">Select Teacher</option>
                     <?php foreach($this->db->get('teacher')->result_array() as $tch): ?>
                     <option value="<?php echo $tch['teacher_id']; ?>" <?php if($section['teacher_id'] == $tch['teacher_id']) echo 'selected'; ?>><?php echo $tch['name']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;Update Division</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>