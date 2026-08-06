    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
	
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="modal_ajax">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body " style="height:auto;max-height:80vh;overflow-y:auto"></div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	function approve_modal(approve_url)
	{
		jQuery('#modal-approve').modal('show', {backdrop: 'static'});
		document.getElementById('approve_link').setAttribute('href' , approve_url);
	}
	function reject_modal(reject_url)
	{
		jQuery('#modal-reject').modal('show', {backdrop: 'static'});
		document.getElementById('reject_link').setAttribute('href' , reject_url);
	}
	function status_modal(delete_url)
	{
		jQuery('#modal-8').modal('show', {backdrop: 'static'});
		document.getElementById('status_link').setAttribute('href' , delete_url);
	}
	function confirm_print(delete_url)
	{
		jQuery('#modal-5').modal('show', {backdrop: 'static'});
		document.getElementById('print_link').setAttribute('href' , delete_url);
	}
	function confirm_hide(){
        $("#modal-5").modal("hide");
    }
	function showToast(message){
        var toast = document.createElement('div');
        toast.style.cssText = 'position:fixed;top:20px;right:20px;z-index:99999;background:#00c292;color:#fff;padding:15px 25px;border-radius:5px;font-size:14px;box-shadow:0 4px 12px rgba(0,0,0,0.3);transition:opacity 0.5s;';
        toast.innerHTML = '<i class="fa fa-check-circle"></i> ' + message;
        document.body.appendChild(toast);
        setTimeout(function(){ toast.style.opacity = '0'; }, 3000);
        setTimeout(function(){ document.body.removeChild(toast); }, 3500);
    }
    function addClientFromModal(form){
        var name = form.name.value;
        var address = form.address.value;
        if(!name) { showWarningToast('Name is required'); return false; }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo base_url('admin/add_client_ajax');?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(xhr.responseText === 'success'){
                showToast('Client Added');
                jQuery('#modal_ajax').modal('hide');
                var xhr2 = new XMLHttpRequest();
                xhr2.open('GET', '<?php echo base_url('admin/get_client_list');?>', true);
                xhr2.onload = function(){
                    var select = document.getElementById('client_id');
                    if(select) {
                        select.innerHTML = xhr2.responseText;
                        jQuery('#client_id').select2();
                    }
                };
                xhr2.send();
            } else {
                showWarningToast('Error adding client');
            }
        };
        xhr.send('name='+encodeURIComponent(name)+'&address='+encodeURIComponent(address));
        return false;
    }
    function showWarningToast(message){
        var toast = document.createElement('div');
        toast.style.cssText = 'position:fixed;top:20px;right:20px;z-index:99999;background:#e67e22;color:#fff;padding:15px 25px;border-radius:5px;font-size:14px;box-shadow:0 4px 12px rgba(0,0,0,0.3);transition:opacity 0.5s;';
        toast.innerHTML = '<i class="fa fa-exclamation-triangle"></i> ' + message;
        document.body.appendChild(toast);
        setTimeout(function(){ toast.style.opacity = '0'; }, 3500);
        setTimeout(function(){ document.body.removeChild(toast); }, 4000);
    }
	</script>
    
    <!-- (Normal Modal)-->

    <!-- (Approve Modal)-->
    <div class="modal fade" id="modal-approve">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>


                <div class="modal-footer" align="center">
                <div class="row">
                 <div class="col-sm-7">
                ARE YOU SURE YOU WANT TO APPROVE THIS INFORMATION ?
                </div>
                 <div class="col-sm-5">
                    <a href="#" class="btn btn-success btn-rounded btn-sm" id="approve_link"><i class="fa fa-check">&nbsp;</i>Approve</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (Approve Modal) End-->

    <!-- (Reject Modal)-->
    <div class="modal fade" id="modal-reject">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header" style="background:#e74c3c;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>
                <div class="modal-footer" align="center">
                <div class="row">
                 <div class="col-sm-7">
                ARE YOU SURE YOU WANT TO REJECT THIS APPLICATION ?
                </div>
                 <div class="col-sm-5">
                    <a href="#" class="btn btn-danger btn-rounded btn-sm" id="reject_link"><i class="fa fa-ban">&nbsp;</i>Reject</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (Reject Modal) End-->

    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>
                

                <div class="modal-footer" align="center">
				<div class="row">
				 <div class="col-sm-7">	
				ARE YOU SURE YOU WANT TO DELETE THIS INFORMATION ?
				</div>
				 <div class="col-sm-5">	
                    <a href="#" class="btn btn-success btn-rounded btn-sm" id="delete_link"><i class="fa fa-check">&nbsp;</i>Delete</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>

    <!-- (Status Modal)-->
    <div class="modal fade" id="modal-8">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>
                

                <div class="modal-footer" align="center">
				<div class="row">
				 <div class="col-sm-7">	
				ARE YOU SURE YOU WANT TO CHANGE THE USER STATUS ?
				</div>
				 <div class="col-sm-5">	
                    <a class="btn btn-success btn-rounded btn-sm" id="status_link"><i class="fa fa-check">&nbsp;</i>Yes</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>No</button>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>

    <!-- (Print Modal)-->
    <div class="modal fade" id="modal-5">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>
                <div class="modal-footer" align="center">
				<div class="row">
				 <div class="col-sm-7">	
				ARE YOU SURE YOU WANT PRINT THIS DOCUMENT ?
				</div>
				 <div class="col-sm-5">	
                    <a target="_blank" class="btn btn-success btn-rounded btn-sm" id="print_link" onclick="confirm_hide()"><i class="fa fa-check">&nbsp;</i>Yes</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>

    <!-- (Select Modal)-->
    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">Warning&nbsp;!!!</strong></h4>
                </div>
                <div class="modal-body" align="center">
					<div class="row">
						<div class="col-sm-12">	
							Please select atleast one record..!!
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
