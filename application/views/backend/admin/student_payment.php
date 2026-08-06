<?php
    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
    $academies = $this->db->get('academy')->result_array();
    $groups = $this->db->get('student_group')->result_array();
    $current_year = date('Y');
    $selected_year = $current_year . '-' . ($current_year + 1);
    $invoice_number = rand(100000, 999999) . 'INV' . date('Y');

    $auto_student_id = isset($student_id) ? $student_id : null;
    $auto_academy_id = '';
    $auto_class_id = '';
    $auto_group_id = '';
    $auto_student_name = '';
    if($auto_student_id){
        $auto_student_data = $this->db->get_where('student', array('student_id' => $auto_student_id))->row_array();
        if(!empty($auto_student_data)){
            $auto_academy_id = $auto_student_data['academy_id'];
            $auto_class_id = $auto_student_data['class_id'];
            $auto_group_id = $auto_student_data['group_id'];
            $auto_student_name = $auto_student_data['name'];
            $selected_year = $auto_student_data['ad_year'] ? $auto_student_data['ad_year'] : $selected_year;
        }
    }
?>

<style type="text/css">
    .form-inline .input-group{ display: flex; }
    .form-inline label{ display: block; }
    .mycontainer .form-group{ width: 100%; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Invoice</div>
            <div class="panel-body table-responsive">
                <form action="<?php echo base_url('admin/student_payment/mass_invoice');?>" class="form-horizontal form-groups-bordered validate" target="_top" method="post" accept-charset="utf-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <input type="hidden" id="student_id" value="<?php echo $auto_student_id ? $auto_student_id : '';?>">
                                <select name="academic_year" id="academic_year" class="form-control" onchange="return get_class_mass_student()" required>
                                    <option value="">Select Academic Year</option>
                                    <?php for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                                        $year_val = $y . '-' . ($y + 1);
                                        $sel = ($year_val == $selected_year) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $year_val;?>" <?php echo $sel; ?>><?php echo $year_val;?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Date<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <input type="date" name="creation_timestamp" value="<?php echo date('Y-m-d');?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Invoice Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="invoice_number" value="<?php echo $invoice_number;?>" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Select Academy<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select id="academy_id" class="form-control" onchange="return get_class_mass_student()" required>
                                    <option value="">Select Academy</option>
                                    <?php foreach($academies as $academy):?>
                                    <option value="<?php echo $academy['academy_id'];?>" <?php echo ($academy['academy_id'] == $auto_academy_id) ? 'selected' : ''; ?>><?php echo $academy['academy_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Class<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="class_id" id="class_id" class="form-control" onchange="return get_class_mass_student()" required>
                                    <option value="">Select Class</option>
                                    <?php foreach($classes as $class):?>
                                    <option value="<?php echo $class['class_id'];?>" <?php echo ($class['class_id'] == $auto_class_id) ? 'selected' : ''; ?>><?php echo $class['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" id="ifYes" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-12">Group Name<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="group_id" id="group_id" class="form-control" onchange="return get_class_mass_student()">
                                    <option value="">Select Group</option>
                                    <?php foreach($groups as $group):?>
                                    <option value="<?php echo $group['group_id'];?>" <?php echo ($group['group_id'] == $auto_group_id) ? 'selected' : ''; ?>><?php echo $group['group_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="progress" class="text-center" style="display: none;">
                            <img style="width:100px;" src="<?php echo base_url('assets/images/preloader.gif');?>">
                        </div>
                        <blockquote class="text-center" id="stderrormsg" style="display: none;">Students not available/selected</blockquote>
                        <div class="form-group">
                            <label class="col-md-12">Student Name<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <div id="mass_student_selector_holder"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <blockquote class="text-center" id="errormsg" style="display: none;">Fees Template not available</blockquote>
                <div id="feestemplate_selector_holder"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.preloader').hide();
    $('#progress').hide();
    $('#ifYes').hide();
    $('#errormsg').hide();
    $('#stderrormsg').hide();

    <?php if($auto_student_id && $auto_class_id): ?>
    var class_name = $('#class_id option:selected').text().toLowerCase();
    if(class_name.indexOf('11') >= 0 || class_name.indexOf('12') >= 0 || class_name.indexOf('xi') >= 0 || class_name.indexOf('xii') >= 0) {
        document.getElementById("ifYes").style.display = "block";
        $('#group_id').prop("required", true);
    }
    get_class_mass_student();
    <?php endif; ?>

    $(document).on('click', '#checkAll', function(){
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on('click', '.itemRow', function(){
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });

    var count = 10;

    $(document).on('click', '#addRows', function(){
        count++;
        var allproduct = 1;
        $.ajax({
            url: '<?php echo base_url();?>admin/get_all_feehead/' + allproduct,
            type: 'post',
            dataType: 'json',
            data: {allproduct: allproduct},
            success:function(response) {
                var htmlRows = '';
                htmlRows += '<tr>';
                htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
                htmlRows += '<td><select class="form-control" id="productName_'+count+'" name="productName[]" onchange="getProductData('+count+')" required>';
                htmlRows += '<option value="">select</option>';
                $.each(response, function(index, value) {
                    htmlRows += '<option value="'+value.fees_head_id+'">'+value.title+'</option>';
                });
                htmlRows += '</select></td>';
                htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';
                htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off" readonly></td>';
                htmlRows += '</tr>';
                $('#invoiceItem').append(htmlRows);
            }
        });
    });

    $(document).on('click', '#removeRows', function(){
        $(".itemRow:checked").each(function() {
            $(this).closest('tr').remove();
        });
        $('#checkAll').prop('checked', false);
        calculateTotal();
    });

    $(document).on('blur', "[id^=price_]", function(){
        calculateTotal();
    });
    $(document).on('blur', "#amountPaid", function(){
        var amountPaid = $(this).val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(totalAftertax);
        }
    });
});

function select(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = true;
    }
}

function unselect(){
    var chk = $('.check');
    for(i = 0; i < chk.length; i++){
        chk[i].checked = false;
    }
}

function calculateTotal(){
    var totalAmount = 0;
    $("[id^='price_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("price_", '');
        var price = $('#price_' + id).val();
        if(!price) {
            price = 1;
        }
        var total = parseFloat(price);
        $('#total_' + id).val(parseFloat(total));
        totalAmount += total;
    });
    $('#subTotal').val(parseFloat(totalAmount));
    var subTotal = $('#subTotal').val();
    if(subTotal) {
        subTotal = parseFloat(subTotal);
        $('#totalAftertax').val(subTotal);
        var amountPaid = $('#amountPaid').val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(subTotal);
        }
    }
}

function getProductData(id){
    var product_id = $("#productName_" + id).val();
    if(product_id == "") {
        $("#price_" + id).val("");
    } else {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_feehead_info/' + product_id,
            type: 'post',
            success:function(response) {
                $('#price_' + id).val(parseFloat(response));
                calculateTotal();
            }
        });
    }
}

function get_class_mass_student(){
    var student_id = $("#student_id").val();
    var a_year = $("#academic_year").val();
    var class_id = $("#class_id").val();
    var academy_id = $("#academy_id").val();
    var group_id = $("#group_id").val();

    var class_name = $('#class_id option:selected').text().toLowerCase();
    if(class_name.indexOf('11') >= 0 || class_name.indexOf('12') >= 0) {
        document.getElementById("ifYes").style.display = "block";
        $('#group_id').prop("required", true);
    } else {
        document.getElementById("ifYes").style.display = "none";
        $('#group_id').prop("required", false);
        $('#group_id').val('');
        group_id = '0';
    }
    if(group_id == '') {
        group_id = '0';
    }

    $('#progress').show();

    $.ajax({
        url: '<?php echo base_url();?>admin/get_class_mass_student/' + a_year + '/' + class_id + '/' + academy_id + '/' + group_id + '/' + student_id,
        success: function(response) {
            $('#progress').hide();
            var total = $(response).find('input[name="student_id[]"]:checked').length;
            if (total == 0) {
                $(':input[type="submit"]').hide();
            } else {
                $(':input[type="submit"]').show();
            }
            jQuery('#mass_student_selector_holder').html(response);
        }
    });

    $.ajax({
        url: '<?php echo base_url();?>admin/get_fess_template/' + class_id + '/' + academy_id + '/' + group_id + '/' + a_year,
        success: function(response) {
            if (response == "") {
                $('#errormsg').show();
                $(':input[type="submit"]').prop('disabled', true);
            } else {
                $(':input[type="submit"]').prop('disabled', false);
                $('#errormsg').hide();
            }
            jQuery('#feestemplate_selector_holder').html(response);
        }
    });
}
</script>
