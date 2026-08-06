<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo get_phrase('Payment Failed');?></div>
            <div class="panel-body">
                <div class="alert alert-danger">
                    <?php echo get_phrase('Payment processing is not available.'); ?>
                </div>
                <a href="<?php echo base_url(); ?>" class="btn btn-info btn-sm"><?php echo get_phrase('Go to Dashboard');?></a>
            </div>
        </div>
    </div>
</div>
