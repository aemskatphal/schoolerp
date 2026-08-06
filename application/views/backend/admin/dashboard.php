<div class="row" style="margin-bottom:0">
                <div class="col-md-3 col-sm-6">
                   <div class="panel panel-info" style="margin-bottom:5px">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                         <div class="panel-body table-responsive p-4">
                           <div class="form-group mb-2">
                           <label class="col-md-12" for="example-text">Academic Year</label>
                            <div class="col-sm-12">
                               <select name="running_session" class="form-control select2" id="academic_year">
                                     <option value="">Select Academic Year</option>
                                      <?php for ($y = 2023; $y <= 2031; $y++): ?>
                                     <option value="<?php echo $y.'-'.($y+1); ?>" <?php if ($running_year == $y.'-'.($y+1)) echo 'selected'; ?>><?php echo $y.'-'.($y+1); ?></option>
                                     <?php endfor; ?>
                               </select>
                           </div>
                           </div>
                         </div>
                      </div>
                   </div>
               </div>
                <div class="col-md-9 col-sm-6 row m-0 topcnt">
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box b-success">
                          <div class="r-icon-stats">
                             <div class="bodystate">
                                <a style="cursor:pointer;"><h4 id="totalfees"></h4></a>
                                <span class="text-muted">Total Fees</span>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box b-purple">
                          <div class="r-icon-stats">
                             <div class="bodystate">
                                <a style="cursor:pointer;"><h4 id="discountfees"></h4></a>
                                <span class="text-muted">Discount</span>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box b-info">
                          <div class="r-icon-stats">
                             <div class="bodystate">
                                <a style="cursor:pointer;"><h4 id="paidfees"></h4></a>
                                <span class="text-muted">Paid Fees</span>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                       <div class="white-box b-danger">
                          <div class="r-icon-stats">
                             <div class="bodystate">
                                <a style="cursor:pointer;"><h4 id="duefees"></h4></a>
                                <span class="text-muted">Due Fees</span>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
<!--/row -->

<div class="row">
   <div class="col-md-3 col-sm-6">
      <div class="panel panel-info pb-3">
         <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body table-responsive">
               <div class="form-group">
                  <label class="col-md-12" for="example-text">From</label>
                  <div class="col-sm-12">
                     <input class="form-control m-r-10" name="from" type="date" value="<?php echo date('Y-m-d');?>" id="from" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-12" for="example-text">To</label>
                  <div class="col-sm-12">
                     <input class="form-control m-r-10" name="to" type="date" value="<?php echo date('Y-m-d');?>" id="to" required>
                  </div>
               </div>
               <a type="submit" class="btn btn-primary btn-sm btn-block preport" style="color:white" id="showdaywaise"> <i class="fa fa-search"></i> Show</a>
            </div>
         </div>
      </div>
   </div>
      <div class="col-md-9 col-sm-6 row m-0">
      <div class="col-md-4 col-sm-6">
         <div class="white-box">
            <div class="r-icon-stats">
               <i class="ti-arrow-circle-down bg-info"></i>
               <div class="bodystate">
                  <a style="cursor:pointer;"><h4 id="todayfees"></h4></a>
                  <span class="text-muted">Fee Collection</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-sm-6">
         <div class="white-box">
            <div class="r-icon-stats">
               <i class="ti-arrow-circle-up bg-danger"></i>
               <div class="bodystate">
                  <a style="cursor:pointer;"><h4 id="expense"></h4></a>
                  <span class="text-muted">Expense</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-sm-6">
         <div class="white-box">
            <div class="r-icon-stats">
               <i class="ti-user bg-megna"></i>
               <div class="bodystate">
                  <a style="cursor:pointer;"><h4 id="students"></h4></a>
                  <span class="text-muted">Students</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-sm-6">
         <div class="white-box">
            <div class="r-icon-stats">
               <i class="fa fa-birthday-cake bg-inverse"></i>
               <div class="bodystate">
                  <a style="cursor:pointer;"><h4 id="birthdays"></h4></a>
                  <span class="text-muted">Birthdays</span>
               </div>
            </div>
         </div>
      </div>
       <div class="col-md-8 col-sm-6">
         <div class="white-box" style="padding: 14px;">
            <form action="<?php echo base_url();?>admin/dailyreport" class="form-horizontal form-groups-bordered validate" target="_top" id="dailyreport" method="post" accept-charset="utf-8">
            <div class="row">
             <div class="col-md-4 col-sm-4">
                <div class="form-group">
                  <select id="admin_id" name="admin_id" class="form-control">
                     <option value="0">All User</option>
                     <?php $admins = $this->db->get('admin')->result_array();?>
                     <?php foreach($admins as $admin):?>
                                             <option value="<?php echo $admin['admin_id'];?>" ><?php echo $admin['name'];?></option>
                     <?php endforeach;?>
                                       </select>
                 </div>
              </div>
              <div class="col-md-4 col-sm-4">
                  <div class="form-group">
                     <input class="form-control m-r-10" name="from" type="date" value="<?php echo date('Y-m-d');?>" id="fromdate" required>
                  </div>
              </div>
              <div class="col-md-4 col-sm-4">
                  <div class="form-group">
                     <input class="form-control m-r-10" name="to" type="date" value="<?php echo date('Y-m-d');?>" id="todate" required>
                  </div>
              </div>
              <button type="submit" class="btn btn-success btn-sm preport m-auto" style="color:white" id="userReport"> <i class="fa fa-search"></i> Show daily Report</button>
            </div>
            </form>         </div>
      </div>
     
   </div>
 </div>
<!-- .row -->
<?php
$due_fees = 0;
$paid_fees = 0;
$this->db->select_sum('amount');
$this->db->where('status !=', '3');
$this->db->where('year', $running_year);
$this->db->from('invoice');
$invoices = $this->db->get()->row()->amount;
$this->db->select_sum('amount_paid');
$this->db->where('status !=', '3');
$this->db->where('year', $running_year);
$this->db->from('invoice');
$paidInvoices = $this->db->get()->row()->amount_paid;
$this->db->select_sum('discount');
$this->db->where('status !=', '3');
$this->db->where('year', $running_year);
$this->db->from('invoice');
$discountInvoices = $this->db->get()->row()->discount;
$due_fees = ($invoices - $paidInvoices - $discountInvoices) > 0 ? ($invoices - $paidInvoices - $discountInvoices) : 0;
$paid_fees = $paidInvoices > 0 ? $paidInvoices : 0;
$meter_value = $invoices > 0 ? round(($paid_fees / $invoices) * 100, 0) : 0;
$chart_labels = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$chart_values = array();
$chart_year = date('Y');
for ($m = 1; $m <= 12; $m++) {
    $month_pad = str_pad($m, 2, '0', STR_PAD_LEFT);
    $start_str = $chart_year . '-' . $month_pad . '-01';
    $next_str  = ($m == 12) ? ($chart_year + 1) . '-01-01' : $chart_year . '-' . str_pad($m + 1, 2, '0', STR_PAD_LEFT) . '-01';
    $this->db->select_sum('amount_paid');
    $this->db->where('creation_timestamp >=', $start_str);
    $this->db->where('creation_timestamp <', $next_str);
    $this->db->where('status !=', '3');
    $this->db->from('invoice');
    $chart_values[$m - 1] = (int) $this->db->get()->row()->amount_paid;
}
$chart_json = json_encode(array_map('intval', $chart_values));
?>
<div class="row">
   <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="white-box">
         <div class="stats-row">
            <style>
               #chartdiv1 {
               width: 100%;
               height: 500px;
               }
               .amcharts-chart-div a{
               display:none !important;
               }    
            </style>
            <script>
            am4core.ready(function() {
              am4core.useTheme(am4themes_animated);
              var chart = am4core.create("chartdiv1", am4charts.PieChart);
              chart.data = [
                {
                  "country": "Due Fees",
                  "litres": <?php echo $due_fees ? $due_fees : 0;?>
                }, 
                {
                  "country": "Paid Fees",
                  "litres": <?php echo $paid_fees ? $paid_fees : 0;?>
                }
              ];
              var pieSeries = chart.series.push(new am4charts.PieSeries());
              pieSeries.dataFields.value = "litres";
              pieSeries.dataFields.category = "country";
              pieSeries.innerRadius = am4core.percent(50);
              pieSeries.ticks.template.disabled = true;
              pieSeries.labels.template.disabled = true;
              var rgm = new am4core.RadialGradientModifier();
              rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
              pieSeries.slices.template.fillModifier = rgm;
              pieSeries.slices.template.strokeModifier = rgm;
              pieSeries.slices.template.strokeOpacity = 0.4;
              pieSeries.slices.template.strokeWidth = 0;
              chart.legend = new am4charts.Legend();
              chart.legend.position = "top";
            });
            </script>
            <div id="chartdiv1"></div>
         </div>
      </div>
   </div>
   <div class="col-md-9 col-sm-12 col-xs-12">
      <div class="white-box">
         <div class="stats-row">
            <style>
               #chartdiv {
               width: 100%;
               height: 500px;
               }
               .amcharts-chart-div a{
               display:none !important;
               }    
            </style>
            <script>
            am4core.ready(function() {
              am4core.useTheme(am4themes_animated);
              var chart = am4core.create("chartdiv", am4charts.XYChart);
              chart.hiddenState.properties.opacity = 0;
              chart.paddingBottom = 30;
              chart.data = [
              <?php 
              $today_start = strtotime(date('Y-m-d') . ' 00:00:00');
              $today_end = strtotime(date('Y-m-d') . ' 23:59:59');
              $students_list = $this->db->query(
                  "SELECT p.student_id, s.name, p.person_org_name, SUM(p.amount) AS paid_amount
                   FROM payment p
                   LEFT JOIN student s ON s.student_id = p.student_id
                   WHERE p.payment_type='income'
                     AND p.timestamp >= " . intval($today_start) . "
                     AND p.timestamp <= " . intval($today_end) . "
                   GROUP BY p.student_id, s.name, p.person_org_name
                   HAVING paid_amount > 0
                   ORDER BY paid_amount DESC"
              )->result_array();
              foreach ($students_list as $student):
                  $chart_name = !empty($student['name']) ? $student['name'] : $student['person_org_name'];
                  $chart_name = !empty($chart_name) ? $chart_name : 'Student ' . $student['student_id'];
              ?>
                {
                  "name": "<?php echo addslashes($chart_name);?>",
                  "steps": <?php echo floatval($student['paid_amount']);?>,
                  "href": "<?php echo base_url();?>uploads/student_image/<?php echo $student['student_id'];?>.jpg"
                },
              <?php endforeach;?>
              ];
              var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
              categoryAxis.dataFields.category = "name";
              categoryAxis.renderer.grid.template.strokeOpacity = 0;
              categoryAxis.renderer.minGridDistance = 10;
              categoryAxis.renderer.labels.template.disabled = true;
              categoryAxis.renderer.tooltip.dy = 35;
              var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
              valueAxis.renderer.inside = true;
              valueAxis.renderer.labels.template.fillOpacity = 0.3;
              valueAxis.renderer.grid.template.strokeOpacity = 0;
              valueAxis.min = 0;
              valueAxis.cursorTooltipEnabled = false;
              valueAxis.renderer.baseGrid.strokeOpacity = 0;
              var series = chart.series.push(new am4charts.ColumnSeries);
              series.dataFields.valueY = "steps";
               series.dataFields.categoryX = "name";
               series.tooltipText = "{categoryX}: {valueY.value}";
              series.tooltip.pointerOrientation = "vertical";
              series.tooltip.dy = - 6;
              series.columnsContainer.zIndex = 100;
              var columnTemplate = series.columns.template;
              columnTemplate.width = am4core.percent(50);
              columnTemplate.maxWidth = 10;
              columnTemplate.column.cornerRadius(60, 60, 10, 10);
              columnTemplate.strokeOpacity = 0;
              series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
              series.mainContainer.mask = undefined;
              var cursor = new am4charts.XYCursor();
              chart.cursor = cursor;
              cursor.lineX.disabled = true;
              cursor.lineY.disabled = true;
              cursor.behavior = "none";
              var bullet = columnTemplate.createChild(am4charts.CircleBullet);
              bullet.circle.radius = 0;
              bullet.valign = "bottom";
              bullet.align = "center";
              bullet.isMeasured = true;
              bullet.mouseEnabled = false;
              bullet.verticalCenter = "bottom";
              bullet.interactionsEnabled = false;
              var hoverState = bullet.states.create("hover");
              var outlineCircle = bullet.createChild(am4core.Circle);
              outlineCircle.adapter.add("radius", function (radius, target) {
                  var circleBullet = target.parent;
                  return circleBullet.circle.pixelRadius + 10;
              })
              var image = bullet.createChild(am4core.Image);
              image.width = 60;
              image.height = 60;
              image.horizontalCenter = "middle";
              image.verticalCenter = "middle";
              image.propertyFields.href = "href";
              image.adapter.add("mask", function (mask, target) {
                  var circleBullet = target.parent;
                  return circleBullet.circle;
              })
              var previousBullet;
              chart.cursor.events.on("cursorpositionchanged", function (event) {
                  var dataItem = series.tooltipDataItem;
                  if (dataItem.column) {
                      var bullet = dataItem.column.children.getIndex(1);
                      if (previousBullet && previousBullet != bullet) {
                          previousBullet.isHover = false;
                      }
                      if (previousBullet != bullet) {
                          var hs = bullet.states.getKey("hover");
                          hs.properties.dy = -bullet.parent.pixelHeight + 30;
                          bullet.isHover = true;
                          previousBullet = bullet;
                      }
                  }
              })
            });
            </script>
            <div id="chartdiv"></div>            <div class="m-t-20 text-center">
               <h4 class="m-b-0">Collection Progress</h4>
               <p class="text-muted">Paid vs total invoice amount</p>
               <div class="progress m-b-0" style="height:12px;">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo $meter_value; ?>%;"></div>
               </div>
               <small class="text-muted">Current progress: <?php echo $meter_value; ?>%</small>
            </div>         </div>
      </div>
   </div>
</div>
<!-- /.row -->

<script type="text/javascript">
   $(document).ready(function() {
      var year = $('#academic_year').val();
      var from = $('#from').val();
      var to   = $('#to').val();
      $.ajax({
           url: '<?php echo base_url();?>admin/dashboard_counter/' + year +'/'+from +'/'+to,
           success: function(result) {
             var data = result.split(">,");
             $("#totalfees").html(data[0]);
             $("#paidfees").html(data[1]);
             $("#duefees").html(data[2]);
             $("#birthdays").html(data[3]);
             $("#students").html(data[4]);
             $("#expense").html(data[5]);
             $("#todayfees").html(data[6]);
             $("#discountfees").html(data[7]);
           },
      });
});
window.addEventListener('DOMContentLoaded', function () {
      $('#academic_year').on('change', function () { 
      var year = $('#academic_year').val();
      $.ajax({
           url: '<?php echo base_url();?>admin/dashboard_counter_yearwaise/' + year,
           success: function(result) {
             var data = result.split(">,");
             $("#totalfees").html(data[0]);
             $("#paidfees").html(data[1]);
             $("#duefees").html(data[2]);
             $("#discountfees").html(data[3]);
           },
      });
});
});
$('#showdaywaise').on('click', function () { 
      var year = $('#academic_year').val();
      var from = $('#from').val();
      var to   = $('#to').val();
      $.ajax({
           url: '<?php echo base_url();?>admin/dashboard_counter_daywaise/' + from +'/'+to + '/' + year,
           success: function(result) {
             var data = result.split(">,");
             $("#birthdays").html(data[0]);
             $("#students").html(data[1]);
             $("#expense").html(data[2]);
             $("#todayfees").html(data[3]);
           },
      });
});
$('#totalfees,#paidfees,#duefees,#todayfees,#discountfees').on('click', function () { 
      var year = $('#academic_year').val();
      var from = $('#from').val();
      var to   = $('#to').val();
      var type = $(this).attr('id');
     $.ajax({
           url: '<?php echo base_url();?>modal/popup/modal_fees_details/',
           type : "POST",
           data : {"type" : type, "year" : year, "from" : from, "to" : to},
           success: function(result) {
            $('#modal_ajax').modal('show');
            jQuery('#modal_ajax .modal-body').html(result);
           },
      });
});
$('#expense').on('click', function () { 
      var from = $('#from').val();
      var to   = $('#to').val();
     $.ajax({
           url: '<?php echo base_url();?>modal/popup/modal_expense_details/',
           type : "POST",
           data : {"from" : from, "to" : to},
           success: function(result) {
            $('#modal_ajax').modal('show');
            jQuery('#modal_ajax .modal-body').html(result);
           },
      });
});
$('#students').on('click', function () { 
      var from = $('#from').val();
      var to   = $('#to').val();
     $.ajax({
           url: '<?php echo base_url();?>modal/popup/modal_student_details/',
           type : "POST",
           data : {"from" : from, "to" : to},
           success: function(result) {
            $('#modal_ajax').modal('show');
            jQuery('#modal_ajax .modal-body').html(result);
           },
      });
});
$('#birthdays').on('click', function () { 
      var from = $('#from').val();
      var to   = $('#to').val();
     $.ajax({
           url: '<?php echo base_url();?>modal/popup/modal_birthday_details/',
           type : "POST",
           data : {"from" : from, "to" : to},
           success: function(result) {
            $('#modal_ajax').modal('show');
            jQuery('#modal_ajax .modal-body').html(result);
           },
      });
});
</script>