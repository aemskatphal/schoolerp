<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                NEW ENQUIRY
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW ENQUIRY HERE</a></div>
            </div>
            <div class="panel-wrapper collapse out" aria-expanded="true">
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/list_enquiry/insert', array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-12">Name<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Mobile<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="mobile" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Date<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input class="form-control" name="date" type="date" value="<?php echo date('Y-m-d');?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-12">Email<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Who To See<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="whom_to_meet" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Purpose<span style="color:red">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="3" name="purpose" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm"><i class="fa fa-plus"></i>&nbsp;Save Enquiry</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-search"></i>&nbsp;Search Enquiries</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="searchName" class="form-control" placeholder="Search by name...">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" id="searchMobile" class="form-control" placeholder="Search by mobile...">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="searchEmail" class="form-control" placeholder="Search by email...">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" id="searchPurpose" class="form-control" placeholder="Search by purpose...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" id="searchFromDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" id="searchToDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Who To See</label>
                            <input type="text" id="searchWhom" class="form-control" placeholder="Search by who to see...">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-info btn-block btn-sm" id="btnSearch"><i class="fa fa-search"></i>&nbsp;Search</button>
                            <button type="button" class="btn btn-default btn-block btn-sm" id="btnReset"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
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
            <div class="panel-heading"><i class="fa fa-list"></i>&nbsp;List Enquiry</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="enquiry" class="display nowrap table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <div><input type="checkbox" class="largecheck" id="bulkSelect">&nbsp;&nbsp;<button id="bulkdelete" title="Click here to delete enquiry" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button></div>
                                </th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Purpose</th>
                                <th>Who to see</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Entry User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            foreach ($select_enquiry as $row):?>
                            <tr>
                                <td><input type="checkbox" class="selectRow" value="<?php echo $row['enquiry_id'];?>">&nbsp;&nbsp;<?php echo $counter++;?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['date']));?></td>
                                <td><?php echo $row['category'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['purpose'];?></td>
                                <td><?php echo $row['whom_to_meet'];?></td>
                                <td><?php echo $row['mobile'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['entry_user'];?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var enquiryTable;
$(document).ready(function(){
    enquiryTable = $('#enquiry').DataTable({
        dom: 'Blfirtip',
        paging: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        aaSorting: [[1, 'desc']],
        columnDefs: [{
            orderable: false,
            targets: [0],
            searchable: false
        }]
    });

    $('#btnSearch').on('click', function(){
        filterTable();
    });

    $('#btnReset').on('click', function(){
        $('#searchName, #searchMobile, #searchEmail, #searchPurpose, #searchFromDate, #searchToDate, #searchWhom').val('');
        enquiryTable.search('').columns().search('').draw();
    });

    $('#searchName, #searchMobile, #searchEmail, #searchPurpose, #searchWhom').on('keyup', function(){
        filterTable();
    });

    $('#searchFromDate, #searchToDate').on('change', function(){
        filterTable();
    });

    function filterTable(){
        var name = $('#searchName').val().toLowerCase();
        var mobile = $('#searchMobile').val().toLowerCase();
        var email = $('#searchEmail').val().toLowerCase();
        var purpose = $('#searchPurpose').val().toLowerCase();
        var whom = $('#searchWhom').val().toLowerCase();
        var fromDate = $('#searchFromDate').val();
        var toDate = $('#searchToDate').val();

        enquiryTable.rows().every(function(){
            var row = this.node();
            var rowData = this.data();
            var show = true;

            if(name && rowData[3].toLowerCase().indexOf(name) === -1) show = false;
            if(mobile && rowData[6].toLowerCase().indexOf(mobile) === -1) show = false;
            if(email && rowData[7].toLowerCase().indexOf(email) === -1) show = false;
            if(purpose && rowData[4].toLowerCase().indexOf(purpose) === -1) show = false;
            if(whom && rowData[5].toLowerCase().indexOf(whom) === -1) show = false;

            if(fromDate || toDate){
                var rowDate = rowData[1];
                var parts = rowDate.split('-');
                var rowDateObj = new Date(parts[2], parts[1]-1, parts[0]);
                if(fromDate){
                    var from = new Date(fromDate);
                    if(rowDateObj < from) show = false;
                }
                if(toDate){
                    var to = new Date(toDate);
                    if(rowDateObj > to) show = false;
                }
            }

            if(show) $(row).show();
            else $(row).hide();
        });
    }

    $("#bulkSelect").on('click', function(){
        var status = this.checked;
        $(".selectRow").each(function(){
            $(this).prop("checked", status);
        });
    });

    $("#bulkdelete").click(function(){
        if($('.selectRow:checked').length > 0){
            $('#modal-4').modal('show');
        } else {
            $('#modal-6').modal('show');
        }
    });

    $('#delete_link').on("click", function(event){
        event.preventDefault();
        var ids = [];
        $('.selectRow').each(function(){
            if($(this).is(':checked')){
                ids.push($(this).val());
            }
        });
        var enq_ids = ids.toString();
        if(enq_ids != ''){
            $.ajax({
                url: '<?php echo base_url();?>admin/list_enquiry/delete',
                method: 'post',
                data: { enq_ids: enq_ids },
                success: function(response){
                    $("#modal-4").modal("hide");
                    window.location.reload();
                }
            });
        } else {
             showWarningToast("Please select required data");
        }
    });
});
</script>