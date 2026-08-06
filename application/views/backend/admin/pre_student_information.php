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
                                $current_session = $this->db->get_where('settings', array('type' => 'session'))->row();
                                $current_year = $current_session ? $current_session->description : date('Y').'-'.(date('Y')+1);
                                for($y = date('Y')+1; $y >= 2020; $y--){
                                    $yr = ($y-1).'-'.$y;
                                    echo '<option value="'.$yr.'">'.$yr.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2" id="status">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Confirmed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="class_id" class="form-control select2">
                                <option value="">Select Standard</option>
                                <?php foreach($this->db->order_by('sort_order','asc')->get('class')->result_array() as $cls): ?>
                                <option value="<?php echo $cls['class_id']; ?>"><?php echo $cls['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="board_id" class="form-control select2">
                                <option value="">Select Board</option>
                                <?php foreach($this->db->get('board')->result_array() as $brd): ?>
                                <option value="<?php echo $brd['board_id']; ?>"><?php echo $brd['board_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="ad_type" class="form-control select2">
                                <option value="">Ad Type</option>
                                <option value="Regular">Regular</option>
                                <option value="RTE">RTE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-4">
                            <select id="academy_id" class="form-control select2">
                                <option value="">Select Academy</option>
                                <?php foreach($this->db->get('academy')->result_array() as $acd): ?>
                                <option value="<?php echo $acd['academy_id']; ?>"><?php echo $acd['academy_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <select id="group_id" class="form-control select2">
                                <option value="">Select Group</option>
                                <?php foreach($this->db->get('student_group')->result_array() as $grp): ?>
                                <option value="<?php echo $grp['group_id']; ?>"><?php echo $grp['group_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-4">
                            <input class="form-control m-r-10" name="from" type="date" id="from">
                        </div>
                        <div class="col-md-3 mt-4">
                            <input class="form-control m-r-10" name="to" type="date" id="to">
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
                    <table id="tblPreStudentInfo" class="display nowrap table-bordered" cellspacing="0" width="100%" data-url="<?php echo base_url();?>admin/prestudentList">
                        <thead>
                            <tr>
                                <th><div><input type="checkbox" class="largecheck" id="bulkSelect" /></div></th>
                                <th><div>Actions</div></th>
                                <th><div>Ad Date</div></th>
                                <th><div>Ad Status</div></th>
                                <th><div>Photo</div></th>
                                <th><div>Ad Year</div></th>
                                <th><div>Gen Reg No</div></th>
                                <th><div>Name</div></th>
                                <th><div>Standard</div></th>
                                <th><div>Division</div></th>
                                <th><div>Gender</div></th>
                                <th><div>Religion</div></th>
                                <th><div>Category</div></th>
                                <th><div>Caste</div></th>
                                <th><div>UID</div></th>
                                <th><div>Student Mobile</div></th>
                                <th><div>Parent Mobile</div></th>
                                <th><div>Blood Group</div></th>
                                <th><div>Village</div></th>
                                <th><div>Tal</div></th>
                                <th><div>Dist</div></th>
                                <th><div>Birthday</div></th>
                                <th><div>Ad Type</div></th>
                                <th><div>Father Name</div></th>
                                <th><div>Mother Name</div></th>
                                <th><div>Group Name</div></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


