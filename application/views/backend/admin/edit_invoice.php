<?php
    $row = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row_array();
    if(empty($row)){
        redirect(base_url().'admin/manage_invoice', 'refresh');
        return;
    }
    $student = $this->db->get_where('student', array('student_id' => $row['student_id']))->row_array();
    $class_name_val = '';
    $class_id_val = '';
    if(!empty($student)){
        $cls = $this->db->get_where('class', array('class_id' => $student['class_id']))->row_array();
        $class_name_val = $cls ? $cls['name'] : '';
        $class_id_val = $student['class_id'];
    }
    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
    $fee_heads = $this->db->get('fees_head')->result_array();
    $items = $this->db->get_where('invoice_item', array('invoice_id' => $invoice_id))->result_array();
    $current_year = date('Y');
    $has_discount = $row['discount'] > 0;
?>

<style type="text/css">
    .form-inline .input-group{ display: flex; }
    .form-inline label{ display: block; }
    .mycontainer .form-group{ width: 100%; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;&nbsp;Edit Invoice</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url().'admin/student_payment/update_invoice/'.$row['invoice_id'], array('class'=>'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Class<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="class_id" id="class_id" class="form-control" onchange="return get_class_student(this.value)" required>
                                    <option value="">Select Class</option>
                                    <?php foreach($classes as $class):?>
                                    <option value="<?php echo $class['class_id'];?>" <?php echo ($class['class_id'] == $class_id_val) ? 'selected' : ''; ?>><?php echo $class['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Student Name<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="student_id" id="student_selector_holder" class="form-control" required>
                                    <option value="<?php echo $student['student_id'];?>" selected><?php echo $student['name'];?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Receipt Date<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <input type="date" name="creation_timestamp" value="<?php echo $row['creation_timestamp'];?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="academic_year" class="form-control" required>
                                    <option value="">Select Academic Year</option>
                                    <?php for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                                        $year_val = $y . '-' . ($y + 1);
                                        $sel = ($year_val == $row['year']) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $year_val;?>" <?php echo $sel; ?>><?php echo $year_val;?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Invoice Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="invoice_number" value="<?php echo $row['invoice_id'];?>" readonly required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="load-animate animated fadeInUp">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered" id="invoiceItem">
                                <tbody>
                                <tr style="background-color: #eee;">
                                    <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                    <th width="25%">Title</th>
                                    <th width="10%">Amount</th>
                                    <th width="15%">Total</th>
                                </tr>
                                <?php if(!empty($items)): $row_num = 0; foreach($items as $item): $row_num++; ?>
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td>
                                        <select class="form-control" id="productName_<?php echo $row_num;?>" name="productName[]" onchange="getProductData(<?php echo $row_num;?>)" required>
                                            <option value="">Select</option>
                                            <option value="0" <?php if($item['fees_head_id'] == 0) echo 'selected';?>>Previous Due</option>
                                            <?php foreach($fee_heads as $fh):?>
                                            <option value="<?php echo $fh['fees_head_id'];?>" <?php echo ($fh['fees_head_id'] == $item['fees_head_id']) ? 'selected' : ''; ?>><?php echo $fh['title'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td><input type="number" value="<?php echo $item['amount'];?>" name="price[]" id="price_<?php echo $row_num;?>" class="form-control price" autocomplete="off"></td>
                                    <td><input type="number" value="<?php echo $item['amount'];?>" name="total[]" id="total_<?php echo $row_num;?>" class="form-control total" autocomplete="off" readonly></td>
                                </tr>
                                <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <button class="btn btn-default" id="addRows" type="button">+ Add More</button>
                            <button class="btn btn-default delete" id="removeRows" type="button">- Delete</button>
                        </div>
                    </div>
                    <br>
                    <div class="row col-sm-12 mycontainer">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offset-sm-8">
                            <span class="form-inline">
                                <div class="form-group">
                                    <label class="col-md-12">Subtotal: &nbsp;</label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input value="<?php echo $row['amount'];?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Total: &nbsp;</label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input value="<?php echo $row['amount'];?>" type="number" class="form-control" name="total_amt" id="totalAftertax" placeholder="Total" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Discount: &nbsp;</label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input type="number" value="<?php echo $row['discount'];?>" class="form-control" name="discount" id="amountDiscount" onblur="return set_document()" placeholder="Discount">
                                    </div>
                                </div>
                                <div class="form-group" id="fordiscount" style="display: <?php echo $has_discount ? 'block' : 'none'; ?>; color: red;">
                                    <label class="col-sm-12">Discount Attachment</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="dcntfile" id="dcntfile" <?php echo $has_discount ? 'required' : ''; ?>>
                                        <?php if(!empty($row['discount_file'])): ?>
                                        <a href="<?php echo base_url('uploads/discount/'.$row['discount_file']); ?>" target="_blank" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-file"></i> View File</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Amount Paid: &nbsp;<span class="bg-require">*</span></label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input type="number" value="<?php echo $row['amount_paid'];?>" class="form-control" name="paid_amt" id="amountPaid" placeholder="Amount Paid" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Amount Due: &nbsp;</label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input value="<?php echo $row['due'];?>" type="number" class="form-control" name="due_amt" id="amountDue" placeholder="Amount Due" readonly>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.preloader').hide();
});

function get_class_student(class_id){
    $.ajax({
        url: '<?php echo base_url();?>admin/get_class_student/' + class_id,
        success: function(response){
            jQuery('#student_selector_holder').html(response);
        }
    });
}

$(document).ready(function(){
    $(document).on('click', '#checkAll', function(){
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on('click', '.itemRow', function(){
        if($('.itemRow:checked').length == $('.itemRow').length){
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });

    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function(){
        count++;
        var allproduct = 1;
        $.ajax({
            url: '<?php echo base_url();?>admin/get_all_feehead/' + allproduct,
            type: 'post',
            dataType: 'json',
            data: {allproduct: allproduct},
            success: function(response) {
                var htmlRows = '';
                htmlRows += '<tr>';
                htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
                htmlRows += '<td><select class="form-control" id="productName_'+count+'" name="productName[]" onchange="getProductData('+count+')" required>';
                htmlRows += '<option value="">Select</option>';
                $.each(response, function(index, value) {
                    htmlRows += '<option value="'+value.fees_head_id+'">'+value.title+'</option>';
                });
                htmlRows += '</select></td>';
                htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';
                htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off" readonly></td>';
                htmlRows += '</tr>';
                $('#invoiceItem tbody').append(htmlRows);
            }
        });
    });

    $(document).on('click', '#removeRows', function(){
        $(".itemRow:checked").each(function(){
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
        var amountDiscount = $('#amountDiscount').val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax) {
            totalAftertax = (totalAftertax - amountDiscount) - amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(totalAftertax);
        }
    });
    $(document).on('blur', "#amountDiscount", function(){
        var amountDiscount = $(this).val();
        var amountPaid = $('#amountPaid').val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountDiscount && totalAftertax) {
            totalAftertax = (totalAftertax - amountDiscount) - amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(totalAftertax);
        }
    });
});

function calculateTotal(){
    var totalAmount = 0;
    $("[id^='price_']").each(function(){
        var id = $(this).attr('id');
        id = id.replace("price_", '');
        var price = $('#price_' + id).val();
        if(!price) price = 1;
        var total = parseFloat(price);
        $('#total_' + id).val(parseFloat(total));
        totalAmount += total;
    });
    $('#subTotal').val(parseFloat(totalAmount));
    var subTotal = $('#subTotal').val();
    if(subTotal){
        subTotal = parseFloat(subTotal);
        $('#totalAftertax').val(subTotal);
        var amountPaid = $('#amountPaid').val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax){
            totalAftertax = totalAftertax - amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(subTotal);
        }
    }
}

function getProductData(id){
    var product_id = $("#productName_" + id).val();
    if(product_id == ""){
        $("#price_" + id).val("");
    } else {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_feehead_info/' + product_id,
            type: 'post',
            success: function(response) {
                $('#price_' + id).val(parseFloat(response));
                calculateTotal();
            }
        });
    }
}

function set_document(){
    var amountDiscount = $("#amountDiscount").val();
    if(amountDiscount >= "1"){
        $('#dcntfile').prop("required", true);
        document.getElementById("fordiscount").style.color = "red";
        document.getElementById("fordiscount").style.display = "block";
    } else {
        $('#dcntfile').prop("required", false);
        document.getElementById("fordiscount").style.display = "none";
    }
}
</script>
