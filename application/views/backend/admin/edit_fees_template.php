<?php
    $fees_template_id = $param2;
    $row = $this->db->get_where('fees_template', array('fees_template_id' => $fees_template_id))->row_array();
    $classes = $this->db->order_by('sort_order', 'ASC')->get('class')->result_array();
    $academies = $this->db->get('academy')->result_array();
    $groups = $this->db->get('student_group')->result_array();
    $fee_heads = $this->db->get('fees_head')->result_array();
    $items = $this->db->get_where('fees_template_item', array('fees_template_id' => $fees_template_id))->result_array();
    $current_year = date('Y');
    $session_row = $this->db->get_where('settings', array('type' => 'session'))->row();
    $current_session = $session_row ? $session_row->description : ($current_year . '-' . ($current_year + 1));
?>
<style type="text/css">
   .form-inline .input-group{ display: flex; }
   .form-inline label{ display: block; }
   .mycontainer .form-group{ width: 100%; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Fees Template</div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/fees_template_update/'.$fees_template_id, array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Academic Year<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="academic_year" id="academic_year" class="form-control" required>
                                    <option value="">Select Academic Year</option>
                                    <?php for($y = $current_year - 5; $y <= $current_year + 3; $y++):
                                        $year_val = $y . '-' . ($y + 1);
                                        $sel = ($year_val == $row['academic_year']) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $year_val;?>" <?php echo $sel; ?>><?php echo $year_val;?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Select Academy<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select id="academy_id" name="academy_id" class="form-control" required>
                                    <option value="">Select Academy</option>
                                    <?php foreach($academies as $academy):?>
                                    <option value="<?php echo $academy['academy_id'];?>" <?php echo ($row['academy_id'] == $academy['academy_id']) ? 'selected' : ''; ?>><?php echo $academy['academy_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-md-12">Class<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">Select Class</option>
                                    <?php foreach($classes as $class):?>
                                    <option value="<?php echo $class['class_id'];?>" <?php echo ($row['class_id'] == $class['class_id']) ? 'selected' : ''; ?>><?php echo $class['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4" id="ifYes" style="display: <?php echo (!empty($row['group_id'])) ? 'block' : 'none'; ?>;">
                        <div class="form-group">
                            <label class="col-md-12">Group Name<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="">Select Group</option>
                                    <?php foreach($groups as $group):?>
                                    <option value="<?php echo $group['group_id'];?>" <?php echo ($row['group_id'] == $group['group_id']) ? 'selected' : ''; ?>><?php echo $group['group_name'];?></option>
                                    <?php endforeach;?>
                                </select>
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
                                <?php if(!empty($items)): $row_num = 0; foreach($items as $item): $row_num++;?>
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td>
                                        <select class="form-control" id="productName_<?php echo $row_num;?>" name="productName[]" onchange="getProductData(<?php echo $row_num;?>)" required>
                                            <option value="">Select</option>
                                            <?php foreach($fee_heads as $fh):?>
                                            <option value="<?php echo $fh['fees_head_id'];?>" <?php echo ($item['fees_head_id'] == $fh['fees_head_id']) ? 'selected' : ''; ?>><?php echo $fh['title'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td><input type="number" name="price[]" id="price_<?php echo $row_num;?>" class="form-control price" value="<?php echo intval($item['amount']);?>" autocomplete="off"></td>
                                    <td><input type="number" name="total[]" id="total_<?php echo $row_num;?>" class="form-control total" value="<?php echo intval($item['amount']);?>" autocomplete="off" readonly></td>
                                </tr>
                                <?php endforeach; else:?>
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td>
                                        <select class="form-control" id="productName_1" name="productName[]" onchange="getProductData(1)" required>
                                            <option value="">Select</option>
                                            <?php foreach($fee_heads as $fh):?>
                                            <option value="<?php echo $fh['fees_head_id'];?>"><?php echo $fh['title'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                                    <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off" readonly></td>
                                </tr>
                                <?php endif;?>
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
                                        <input value="<?php echo intval($row['amount']);?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Total: &nbsp;</label>
                                    <div class="input-group col-sm-12">
                                        <div class="input-group-addon currency">&#8377;</div>
                                        <input value="<?php echo intval($row['amount']);?>" type="number" class="form-control" name="total_amt" id="totalAftertax" placeholder="Total" readonly>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-12">Description<span class="bg-require">*</span></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="description" required><?php echo $row['description'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;Update Template</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('.preloader').hide();

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

    var count = <?php echo !empty($items) ? count($items) : 1;?>;

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
                htmlRows += '<option value=""></option>';
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
});

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
</script>
