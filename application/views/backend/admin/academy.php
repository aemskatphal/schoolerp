<style type="text/css">
    .panel > .table-bordered, .panel > .table-responsive > .table-bordered {
        border: 1px solid #e4e7ea;
    }
    .r-icon-stats .bodystate span {
        display: block;
        margin-top: 8px;
    }
    #example30 td {
        padding: 12px 10px;
    }
</style>

<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive p-4">
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Academic Year<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <select name="running_session" class="form-control select2" id="academic_year">
                                <option value="">Select Academic Year</option>
                                <?php
                                $current_year = date('Y');
                                for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                                    $year_val = $y.'-'.($y+1);
                                    $selected = ($y == $current_year) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $year_val; ?>" <?php echo $selected; ?>><?php echo $year_val; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dashresult"></div>
</div>

<div class="row">
    <?php if (has_action('students', 'academy', 'create')): ?>
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Academy</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <?php echo form_open(base_url().'admin/academy/create', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top')); ?>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Academy Name<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="academy_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Email<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-9" for="example-text">Password<span class="bg-require">*</span></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)" required autocomplete="new-password">
                            <strong id="password_strength"></strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;Add Academy</button>
                    </div>
                    </form>
                    <p><b>Notes:</b>&nbsp;login credentials are auto shared on users email.</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;List Academies</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <div class="actionbtn pb-4">
                        <button id="qrcode" title="Generate pre admission from QRcode" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp;&nbsp;QRcode</button>
                    </div>
                    <table id="example30" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div><input type="checkbox" class="largecheck" id="bulkSelect" /></div></th>
                                <th><div>Status</div></th>
                                <th><div>Options</div></th>
                                <th><div>QR Code</div></th>
                                <th><div>Name</div></th>
                                <th><div>Email</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $academies = $this->academy_model->getAllAcademy();
                            foreach($academies as $row):
                            ?>
                            <tr>
                                <td><input type='checkbox' class='selectRow' value="<?php echo $row['academy_id']; ?>" />&nbsp;<?php echo $row['academy_id']; ?></td>
                                <td>
                                    <?php if($row['status'] == '1'): ?>
                                        <span class="btn btn-success btn-sm btn-rounded" title="Click here to Inactive" onclick="status_modal('<?php echo base_url();?>admin/academy/status/<?php echo $row['academy_id']; ?>');">Active</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-sm btn-rounded" title="Click here to Active" onclick="status_modal('<?php echo base_url();?>admin/academy/status/<?php echo $row['academy_id']; ?>');">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (has_action('students', 'academy', 'edit')): ?>
                                    <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_academy/<?php echo $row['academy_id']; ?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                                    <?php endif; ?>
                                    <?php if (has_action('students', 'academy', 'delete')): ?>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/academy/delete/<?php echo $row['academy_id']; ?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!empty($row['qr_code']) && file_exists('uploads/academy_qr_code/'.$row['qr_code'])): ?>
                                        <a href="<?php echo base_url();?>uploads/academy_qr_code/<?php echo $row['qr_code']; ?>" target="_blank"><img src="<?php echo base_url();?>uploads/academy_qr_code/<?php echo $row['qr_code']; ?>" class="" width="30"></a>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['academy_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
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
function loadAcademyCounter(){
    var year = $('#academic_year').val();
    $.ajax({
        url: '<?php echo base_url();?>admin/academy_counter/' + year,
        type: 'GET',
        success: function(result) {
            $("#dashresult").html(result);
        },
    });
}

$(document).ready(function() {
    loadAcademyCounter();
    $('#example30').DataTable({
        dom: 'Blfirtip',
        paging: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        aaSorting: [[0, 'asc']],
        columnDefs: [{
            orderable: false,
            targets: [0, 2, 3],
            searchable: true
        }]
    });
});

$('#academic_year').on('change', function () {
    loadAcademyCounter();
});

$("#bulkSelect").on('click', function() {
    var status = this.checked;
    $(".selectRow").each(function() {
        $(this).prop("checked", status);
    });
});

$("#qrcode").click(function(){
    if($('.selectRow:checked').length > 0){
        var ids = [];
        $('.selectRow').each(function(){
            if($(this).is(':checked')) {
                ids.push($(this).val());
            }
        });
        var academy_ids = ids.toString();
        $.ajax({
            url: '<?php echo base_url();?>admin/academyqrcodeprintFn',
            method: 'post',
            data: { academy_ids: academy_ids },
            success: function(response) {
                window.location.reload();
            }
        });
    } else {
        $('#modal-6').modal('show');
    }
});

$(document).on("click",".totalcnt", function(){
    var year = $('#academic_year').val();
    var academy_id = $(this).attr('id');
    $.ajax({
        url: '<?php echo base_url();?>modal/popup/modal_academy_details',
        type : "POST",
        data : {"academy_id" : academy_id, "year" : year},
        success: function(result) {
            $('#modal_ajax').modal('show');
            jQuery('#modal_ajax .modal-body').html(result);
        },
    });
});

function CheckPasswordStrength(password) {
    var password_strength = document.getElementById("password_strength");
    if (password.length == 0) {
        password_strength.innerHTML = "";
        return;
    }
    var regex = new Array();
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
    regex.push("[$@$!%*#?&]");
    var passed = 0;
    for (var i = 0; i < regex.length; i++) {
        if (new RegExp(regex[i]).test(password)) {
            passed++;
        }
    }
    var color = "";
    var strength = "";
    switch (passed) {
        case 0: case 1: case 2:
            strength = "Weak"; color = "red"; break;
        case 3:
            strength = "Medium"; color = "orange"; break;
        case 4:
            strength = "Strong"; color = "green"; break;
    }
    password_strength.innerHTML = strength;
    password_strength.style.color = color;
}
</script>
