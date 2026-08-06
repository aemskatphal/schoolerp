<script>var baseUrl = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url(); ?>assets/js/security.js"></script>
<script src="<?php echo base_url(); ?>optimum/js/calculator.js" ></script>
<script>
                            function showPluginDetails() {
                                var id = $('#pluginslist').val();
                                $('.plugin-details').hide();
                                $('#' + id).show();
                                return;
                            }
                            </script>
							
							
	<?php
	$flash_msg = $this->session->flashdata('flash_message');
	$error_msg = $this->session->flashdata('error_message');
	if (!empty($flash_msg) || !empty($error_msg)) {
		unset($_SESSION['flash_message'], $_SESSION['error_message']);
		if (isset($_SESSION['__ci_vars'])) {
			unset($_SESSION['__ci_vars']['flash_message'], $_SESSION['__ci_vars']['error_message']);
			if (empty($_SESSION['__ci_vars'])) unset($_SESSION['__ci_vars']);
		}
		session_write_close();
	}
	?>
	<?php if ($error_msg != ""): ?>
	<script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            heading: 'Warning!!!',
            text: '<?php echo addslashes($error_msg); ?>',
            position: 'top-right',
            loaderBg: '#f56954',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>
	<?php endif; ?>
	
	<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
	
	
	<!-- jQuery -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js" ></script>
	<script src="<?php echo base_url(); ?>optimum/js/fullcalendar/fullcalendar.min.js" ></script>
	<script src="<?php echo base_url(); ?>optimum/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" ></script>

	<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/dropzone-master/dist/dropzone.js" ></script>

	
	 <!-- Magnific popup JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js" ></script>
	<!--Wave Effects -->
    <script src="<?php echo base_url(); ?>optimum/js/waves.js" ></script> 

	<script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js" ></script> 
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js" ></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js" ></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
	 <!-- icheck -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/icheck.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/icheck.init.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/js/jquery.slimscroll.js" ></script>
	<script type="text/javascript">
    $('.slimscrollsidebar').slimScroll({
        height: '100%'
    });
   
    </script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>optimum/js/waves.js" ></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/raphael/raphael-min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/morrisjs/morris.js" ></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js" ></script>
    <!-- jQuery peity -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/peity/jquery.peity.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/peity/jquery.peity.init.js" ></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/js/custom.min.js" ></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var navOpen = sessionStorage.getItem('nav_open');

        if (navOpen) {
            sessionStorage.removeItem('nav_open');
            var $openUl = $('#side-menu ul.nav-second-level[data-nav="' + navOpen + '"]');
            if ($openUl.length > 0) {
                $openUl.addClass('in');
                $openUl.closest('li').addClass('active');
            }
        } else {
            $('#side-menu li.active').removeClass('active');
            $('#side-menu ul.nav-second-level.in').removeClass('in');
        }

        $('#side-menu ul.nav-second-level a').on('click', function() {
            var $ul = $(this).closest('ul.nav-second-level');
            var key = $ul.data('nav');
            if (key === undefined || key === null || key === '') {
                key = $ul.index();
            }
            sessionStorage.setItem('nav_open', key);
        });
    });
    </script>
    <script src="<?php echo base_url(); ?>optimum/js/dashboard1.js" ></script>
 <!-- Calendar JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/jquery-ui.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/moment/moment.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/dist/fullcalendar.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/dist/cal-init.js" ></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js" ></script>
	 <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js" ></script>
	 <script src="<?php echo base_url(); ?>optimum/js/validator.js" ></script>
	 
	<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/switchery/dist/switchery.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/select2/select2.min.js" type="text/javascript"></script>
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/select2/select2.min.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>optimum/plugins/bower_components/multiselect/js/jquery.multi-select.js" ></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js" >
	
	 <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/datatables/jquery.dataTables.min.js" ></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" ></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" ></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js" ></script>
    <!-- end - This is for export functionality only -->
	<!-- icheck -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/icheck.min.js" ></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/icheck.init.js" ></script>
	 <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js" ></script>
	 
	 <script src="<?php echo base_url(); ?>optimum/js/materialize.min.js"></script>
	     <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/dropify/dist/js/dropify.min.js" ></script>

	 
	 <!--Wave Effects -->
    <script type="text/javascript" src="<?php echo base_url(); ?>optimum/plugins/bower_components/gallery/js/animated-masonry-gallery.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>optimum/plugins/bower_components/gallery/js/jquery.isotope.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>optimum/plugins/bower_components/fancybox/ekko-lightbox.min.js" ></script>
    <script type="text/javascript">
    $(document).ready(function($) {
        // delegate calls to data-toggle="lightbox"
        $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
            event.preventDefault();
            return $(this).ekkoLightbox({
                onShown: function() {
                    if (window.console) {
                        return console.log('Checking our the events huh?');
                    }
                },
                onNavigate: function(direction, itemIndex) {
                    if (window.console) {
                        return console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
                    }
                }
            });
        });

        //Programatically call
        $('#open-image').click(function(e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#open-youtube').click(function(e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });

        // navigateTo
        $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
            event.preventDefault();

            var lb;
            return $(this).ekkoLightbox({
                onShown: function() {

                    lb = this;

                    $(lb.modal_content).on('click', '.modal-footer a', function(e) {

                        e.preventDefault();
                        lb.navigateTo(2);

                    });

                }
            });
        });


    });
    </script>
	 
	 
	 <!-- Chart Files -->
		<script src="<?php echo base_url(); ?>optimum/flot/jquery.flot.js"></script>
		<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.js"></script>
		<script src="<?php echo base_url(); ?>optimum/flot/jquery.flot.pie.js"></script>
		<script src="<?php echo base_url(); ?>optimum/flot/jquery.flot.categories.js"></script>
		<script src="<?php echo base_url(); ?>optimum/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo base_url(); ?>optimum/liquid-meter/liquid.meter.js"></script>
		<script src="<?php echo base_url(); ?>optimum/snap.svg/snap.svg.js"></script>
	
		<!-- Examples -->
		<script src="<?php echo base_url();?>assets/javascripts/dashboard/custom_dashboard.js"></script>
		<script src="<?php echo base_url();?>assets/javascripts/forms/custom_validation.js"></script>
        <script src="<?php echo base_url();?>assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="<?php echo base_url();?>assets/javascripts/tables/examples.datatables.tabletools.js"></script>
	 
<script src="<?php echo base_url(); ?>optimum/js/jquery.PrintArea.js" type="text/JavaScript"></script>

	 
	  <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>
	
	  <!-- Chart JS -->
	<!-- <script src="<?php echo base_url(); ?>optimum/fullcalendar/js/index.js"></script>-->

   		<!--<script src="<?php echo base_url();?>assets/js/fullcalendar/fullcalendar.min.js"></script>-->
		<!--<script src="assets/js/neon-calendar.js"></script>-->

   <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    <?php $example23_export = has_action('masters', 'religion', 'export'); ?>
    $('#example23').DataTable({
        <?php if ($example23_export): ?>
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        <?php else: ?>
        dom: 'frtip'
        <?php endif; ?>
    });

    if ($('#tblstudentinfo').length > 0 && !$.fn.DataTable.isDataTable('#tblstudentinfo')) {
        <?php $student_export = has_action('students', 'student_list', 'export'); ?>
        var studentInfoDataTable = $('#tblstudentinfo').DataTable({
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true,
            <?php if ($student_export): ?>
            dom: 'Blfirtip',
            <?php else: ?>
            dom: 'frtip',
            <?php endif; ?>
            paging: true,
            <?php if ($student_export): ?>
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            <?php endif; ?>
            'ajax': {
                'url': $('#tblstudentinfo').data('url'),
                'data': function(data) {
                    data.class_id = $('#class_id').val();
                    data.board_id = $('#board_id').val();
                    data.group_id = $('#group_id').val();
                    data.academy_id = $('#academy_id').val();
                    data.ad_type = $('#ad_type').val();
                    data.status = $('#status').val();
                    data.year = $('#year').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28],
                "searchable": false
            }],
        });

        $('#class_id,#board_id,#group_id,#academy_id,#ad_type,#status,#from,#to,#year').change(function() {
            studentInfoDataTable.draw();
        });

        <?php if (has_action('students', 'student_list', 'student_promotion')): ?>
        $('#bulkSelect').on('click', function() {
            var status = this.checked;
            $('#tblstudentinfo .selectRow').each(function() {
                $(this).prop('checked', status);
            });
        });

        $('#transfer').off('click').on('click', function(){
            var checked = $('#tblstudentinfo .selectRow:checked');
            if(checked.length > 0){
                var ids = [];
                checked.each(function(){
                    var val = $(this).val();
                    if(val && val.trim() !== '') ids.push(val.trim());
                });
                if(ids.length === 0){
                    showWarningToast('No valid students selected.');
                    return;
                }
                var std_ids = ids.join(',');
                $.ajax({
                    url: baseUrl + 'admin/student_transfer_modal',
                    type: 'POST',
                    data: { student_ids: std_ids },
                    success: function(result){
                        $('#modal_ajax .modal-body').html(result);
                        $('#modal_ajax').modal('show');
                    },
                    error: function(){
                        showWarningToast('Failed to load promotion form. Please try again.');
                    }
                });
            } else {
                $('#modal-6').modal('show');
            }
        });
        <?php endif; ?>

        $('#qrcode').click(function(){
            if($('.selectRow:checked').length > 0){
                var ids = [];
                $('.selectRow').each(function(){
                    if($(this).is(':checked')){
                        ids.push($(this).val());
                    }
                });
                var std_ids = ids.toString();
                $.ajax({
                    url: baseUrl + 'admin/qrcodeprintFn',
                    method: 'post',
                    data: { std_ids: std_ids },
                    success: function(response){
                        window.location.reload();
                    }
                });
            } else {
                $('#modal-6').modal('show');
            }
        });

        <?php if (has_action('students', 'student_list', 'bulk_lc') || has_action('students', 'student_list', 'bulk_idcard')): ?>
        $('#lcprint, #idprint').on('click', function(e) {
            e.preventDefault();
            var btnId = $(this).attr('id');
            if (btnId === 'lcprint' && !<?php echo json_encode(has_action('students', 'student_list', 'bulk_lc')); ?>) return;
            if (btnId === 'idprint' && !<?php echo json_encode(has_action('students', 'student_list', 'bulk_idcard')); ?>) return;
            var checked = $('#tblstudentinfo .selectRow:checked');
            if(checked.length > 0){
                var form = $('<form>', { action: this.getAttribute('data-target-url'), method: 'POST', target: '_blank' });
                checked.each(function(){
                    var val = $(this).val();
                    if(val && val.trim() !== ''){
                        form.append($('<input>', { type: 'hidden', name: 'student_ids[]', value: val.trim() }));
                    }
                });
                $('body').append(form);
                form.submit();
                form.remove();
            } else {
                $('#modal-6').modal('show');
            }
        });
        <?php endif; ?>
    }
    </script>

    <script>
    if ($('#tblPreStudentInfo').length > 0 && !$.fn.DataTable.isDataTable('#tblPreStudentInfo')) {
        <?php $pending_export = has_action('students', 'pending_admission', 'export'); ?>
        var preStudentDataTable = $('#tblPreStudentInfo').DataTable({
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true,
            <?php if ($pending_export): ?>
            dom: 'Blfirtip',
            <?php else: ?>
            dom: 'frtip',
            <?php endif; ?>
            paging: true,
            <?php if ($pending_export): ?>
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            <?php endif; ?>
            aaSorting: [[2, 'desc']],
            'ajax': {
                'url': $('#tblPreStudentInfo').data('url'),
                'data': function(data) {
                    data.class_id = $('#class_id').val();
                    data.board_id = $('#board_id').val();
                    data.group_id = $('#group_id').val();
                    data.academy_id = $('#academy_id').val();
                    data.ad_type = $('#ad_type').val();
                    data.year = $('#year').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.status = $('#status').val();
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
                "searchable": false
            }],
        });

        $('#class_id,#board_id,#group_id,#academy_id,#ad_type,#from,#to,#year,#status').change(function() {
            preStudentDataTable.draw();
        });

        <?php if (has_action('students', 'pending_admission', 'delete')): ?>
        $('#bulkSelect').on('click', function() {
            var status = this.checked;
            $('#tblPreStudentInfo .selectRow').each(function() {
                $(this).prop('checked', status);
            });
        });
        <?php endif; ?>
    }
    </script>

    <script>
    if ($('#tbldocument').length > 0 && !$.fn.DataTable.isDataTable('#tbldocument')) {
        <?php $doc_export = has_action('academics', 'manage_documents', 'export'); ?>
        var docDataTable = $('#tbldocument').DataTable({
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true,
            <?php if ($doc_export): ?>
            dom: 'Blfirtip',
            <?php else: ?>
            dom: 'frtip',
            <?php endif; ?>
            paging: true,
            <?php if ($doc_export): ?>
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            <?php endif; ?>
            'ajax': {
                'url': $('#tbldocument').data('url'),
                'data': function(data) {
                    data.class_id = $('#class_id').val();
                    data.board_id = $('#board_id').val();
                    data.group_id = $('#group_id').val();
                    data.academy_id = $('#academy_id').val();
                    data.ad_type = $('#ad_type').val();
                    data.year = $('#year').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.status = $('#status').val();
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35],
                "searchable": false
            }],
        });

        $('#class_id,#board_id,#group_id,#academy_id,#ad_type,#from,#to,#year,#status').change(function() {
            docDataTable.draw();
        });

        <?php if (has_action('academics', 'manage_documents', 'view')): ?>
        $('#bulkSelect').on('click', function() {
            var status = this.checked;
            $('#tbldocument .selectRow').each(function() {
                $(this).prop('checked', status);
            });
        });
        <?php endif; ?>

        <?php if (has_action('academics', 'manage_documents', 'bulk_lc')): ?>
        $('#lcprint').on('click', function(e) {
             e.preventDefault();
              if($('#tbldocument .selectRow:checked').length > 0){
                var frmaction = this.getAttribute('data-target-url');
                $('#exportfrm').attr('action', frmaction);
                $('#exportfrm').unbind('submit').submit();
              } else {
                 $('#modal-6').modal('show');
              }
        });
        <?php endif; ?>

        <?php if (has_action('academics', 'manage_documents', 'bulk_idcard')): ?>
        $('#idprint').on('click', function(e) {
             e.preventDefault();
              if($('#tbldocument .selectRow:checked').length > 0){
                var frmaction = this.getAttribute('data-target-url');
                $('#exportfrm').attr('action', frmaction);
                $('#exportfrm').unbind('submit').submit();
              } else {
                 $('#modal-6').modal('show');
              }
        });
        <?php endif; ?>
    }
    </script>

    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();


    });
    </script>
	
	
<script>
    function checkDelete()
    {
        var chk = confirm("Are You Sure To Delete This !");
        if (chk)
        {
            return true;
        } else {
            return false;
        }
    }
</script>
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/tinymce/tinymce.min.js"></script>
    <script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>
	
	<script type="text/javascript">
    //Alerts

    $(".myadmin-alert .closed").click(function(event) {
        $(this).parents(".myadmin-alert").fadeToggle(350);

        return false;
    });

    /* Click to close */

    $(".myadmin-alert-click").click(function(event) {
        $(this).fadeToggle(350);

        return false;
    });

    $(".showtop").click(function() {
        $(".alerttop").fadeToggle(350);
    });
    $(".showtop2").click(function() {
        $(".alerttop2").fadeToggle(350);
    });
	</script>
	 <script>
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'

    });

    $('.clockpicker').clockpicker({
            donetext: 'Done',

        })
        .find('input').change(function() {
            console.log(this.value);
        });

    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker

    try { $(".colorpicker").asColorPicker(); } catch(e) {}
    try { $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    }); } catch(e) {}
    try { $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    }); } catch(e) {}
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({

        todayHighlight: true
    });

    // Daterange picker

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
	
	<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
	<?php if ($flash_msg != ""): ?>
	<script type="text/javascript">
    $(document).ready(function() {
        $.toast({
			heading: 'Congratulations!!!',
            text: '<?php echo addslashes($flash_msg); ?>',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>
	<?php endif; ?>
	
	
	
	
	<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/switchery/dist/switchery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
        // For select 2

        try { $(".select2").select2(); } catch(e) {}
        $('.selectpicker').selectpicker();

        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }

        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();

        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });

        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });

        // For multiselect

        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });

        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });

    });
    </script>
    <!--Style Switcher disabled -->
    
	<script type="text/javascript" src="<?php echo base_url(); ?>optimum/date/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/date/daterangepicker.css" />
	<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
	
			
<script src="<?php echo base_url(); ?>js/meteorEmoji.min.js"></script>
  <script>
    (() => {
      new MeteorEmoji()
    })()
  </script>
  
  <script src="<?php echo base_url(); ?>js/chat.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.set_langs').on('click', function () {
            var lang_url = $(this).data('href');
            $.ajax({url: lang_url, success: function (result) {
                    location.reload();
                }});
        });
    });
</script>



 <!-- jQuery file upload -->
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-d�posez un fichier ici ou cliquez',
                replace: 'Glissez-d�posez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'D�sol�, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
                 showToast('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
		
		<!--BlockUI Script -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/blockUI/jquery.blockUI.js"></script>
    <script type="application/javascript">
    // This is for BlockUI plugin demo
    $('#blockbtn1').click(function() {
        $('div.block1').block({
            message: null
        });
    });
    $('#blockbtn2').click(function() {
        $('div.block2').block({
            message: '<h3>Please Wait...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn3').click(function() {
        $('div.block3').block({
            message: '<h3>Please Wait...</h3>',
            overlayCSS: {
                backgroundColor: '#02bec9'
            },
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn4').click(function() {
        $('div.block4').block({
            message: '<p style="margin:0;padding:8px;font-size:24px;">Just a moment...</p>',
            css: {
                color: '#fff',
                border: '1px solid #fb9678',
                backgroundColor: '#fb9678'
            }
        });
    });
    $('#blockbtn5').click(function() {
        $('div.block5').block({
            message: '<h4><img src="<?php echo base_url(); ?>optimum/plugins/images/busy.gif" /> Just a moment...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#blockbtn6').click(function() {
        $('div.block6').block({
            message: $('#domMessage'),
            css: {
                border: '1px solid #fff'
            }
        });
    });
    $('#unblockbtn1').click(function() {
        $('div.block1').unblock();
    });
    $('#unblockbtn2').click(function() {
        $('div.block2').unblock();
    });
    $('#unblockbtn3').click(function() {
        $('div.block3').unblock();
    });
    $('#unblockbtn4').click(function() {
        $('div.block4').unblock();
    });
    $('#unblockbtn5').click(function() {
        $('div.block5').unblock();
    });
    $('#unblockbtn6').click(function() {
        $('div.block6').unblock();
    });
    </script>
	
	 <!-- Session-timeout-idle 
    <script src="<?php echo base_url(); ?>optimum/idle/jquery.idletimeout.js"></script>
    <script src="<?php echo base_url(); ?>optimum/idle/jquery.idletimer.js"></script>
    <script src="<?php echo base_url(); ?>optimum/idle/session-timeout-idle-init.js"></script>
    -->
	
	<script>
    function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  // add a zero in front of numbers<10
  m = checkTime(m);
  s = checkTime(s);
  var ampm = " PM "
        if (h < 12) {
            ampm = " AM "
        }
  var timeEl = document.getElementById('time');
  if (timeEl) timeEl.innerHTML = h + ":" + m + ":" + s + ampm;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();
</script>

 <!-- jQuery for carousel -->
    <script src="<?php echo base_url();?>optimum/plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>optimum/plugins/bower_components/owl.carousel/owl.custom.js"></script>
	
	<script src="<?php echo base_url('js/font-awesome-icon-picker/fontawesome-four-iconpicker.min.js');?>" charset="utf-8"></script>

<script>
$(document).ready(function() {
    $(".html5editor").each(function(){$(this).wysihtml5();});
});
$(function() {
   $('.icon-picker').iconpicker();
 });
</script>

<script>
    var currentRequest = null;

    function searchQuery() {
        <?php if (!has_action('students', 'student_list', 'view')): ?>
        return;
        <?php endif; ?>
        var query = $('#quert_txt').val();
        var resultStudent = '';
        if (query != '') {
            var data = {"query": query};
            currentRequest = $.ajax({
                url: "<?php echo base_url(); ?>admin/ajax_student_serach",
                type: "POST",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    if (currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                success: function (data) {
                    var len = data.length;
                    if (len == 0) {
                        resultStudent += '<p class="std-search-element"><a>No Result Found. </a></p>';
                    } else {
                        for (var i = 0; i < len; i++) {
                            resultStudent += '<p class="std-search-element"><a href="' + data[i].url + '"><i class="fa fa-external-link">&nbsp;</i>' + data[i].value + '</a></p>';
                        }
                    }
                    $('#search-list-area').html(resultStudent);
                    currentRequest = null;
                },
                error: function (data) {
                    currentRequest = null;
                }
            });
        } else {
            $('#search-list-area').html(resultStudent);
        }
    }
</script>
</body>

</html>