<div class="modal-content slimscrollsidebar" style="overflow: hidden; width: auto; height: 100%;">
    <div class="modal-body" style="height:500px">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="panel panel-info">
                    <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp; New Client</div>
                    <div class="panel-body table-responsive">
                        <form id="myForm" method="post" onsubmit="return addClientFromModal(this)">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-md-12" for="example-text">Name<span class="bg-require">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" for="example-text">Address</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Save Client</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>