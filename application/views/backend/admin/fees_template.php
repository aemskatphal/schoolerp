<?php
    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
    $academies = $this->db->get('academy')->result_array();
    $groups = $this->db->get('student_group')->result_array();
    $current_year = date('Y');
    $session_row = $this->db->get_where('settings', array('type' => 'session'))->row();
    $current_session = $session_row ? $session_row->description : ($current_year . '-' . ($current_year + 1));
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="">
                    <a href="<?php echo base_url('admin/create_fees_template');?>" style="color:#000;" class="btn-sm btn-rounded preport m-auto"><i class="fa fa-plus"></i>&nbsp;&nbsp;New Template</a>
                </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <select id="academy_id" class="form-control">
                                <option value="">Select Academy</option>
                                <?php foreach($academies as $academy):?>
                                <option value="<?php echo $academy['academy_id'];?>"><?php echo $academy['academy_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="academic_year" class="form-control">
                                <option value="">Academic Year</option>
                                <?php for($y = $current_year - 5; $y <= $current_year + 3; $y++): ?>
                                <option value="<?php echo $y.'-'.($y+1); ?>" <?php echo ($current_session == $y.'-'.($y+1)) ? 'selected' : ''; ?>><?php echo $y.'-'.($y+1); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="class_id" class="form-control">
                                <option value="">Select Standard</option>
                                <?php foreach($classes as $class):?>
                                <option value="<?php echo $class['class_id'];?>"><?php echo $class['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="group_id" class="form-control">
                                <option value="">Select Group</option>
                                <?php foreach($groups as $group):?>
                                <option value="<?php echo $group['group_id'];?>"><?php echo $group['group_name'];?></option>
                                <?php endforeach;?>
                            </select>
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
                    <table id="tblfeesinfo" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><div>Date</div></th>
                                <th><div>Actions</div></th>
                                <th><div>Academy</div></th>
                                <th><div>Standard</div></th>
                                <th><div>Group</div></th>
                                <th><div>Year</div></th>
                                <th><div>Amount</div></th>
                                <th><div>Description</div></th>
                                <th><div>Entry User</div></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.preloader').hide();

        var feesTemplateDataTable = $('#tblfeesinfo').DataTable({
            'lengthMenu': [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true,
            <?php $ft_export = has_action('fees', 'fees_template', 'export'); ?>
            <?php if ($ft_export): ?>
            dom: 'Blfirtip',
            <?php else: ?>
            dom: 'frtip',
            <?php endif; ?>
            paging: true,
            <?php if ($ft_export): ?>
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            <?php endif; ?>
            aaSorting: [
                [1, 'desc']
            ],
            'ajax': {
                'url': '<?php echo base_url();?>admin/feestempList',
                'data': function(data) {
                    data.class_id = $('#class_id').val();
                    data.group_id = $('#group_id').val();
                    data.academy_id = $('#academy_id').val();
                    data.academic_year = $('#academic_year').val();
                }
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                "searchable": false
            }],
        });

        $('#class_id,#academy_id,#group_id,#academic_year').change(function() {
            feesTemplateDataTable.draw();
        });
    });
</script>
