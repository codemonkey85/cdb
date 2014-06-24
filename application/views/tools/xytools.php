<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pokemon X/Y Tools
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>xytools">X/Y Tools</a></li>
        <li class="active">Boxes Simulator</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
	 	<div class="col-md-12" id="">
	        <!-- Primary box -->
	        <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    <li class=""><a href="#blind" data-toggle="tab">Blind Breeding</a></li>
                    <li class="active"><a href="#box-data" data-toggle="tab">Box Simulator</a></li>
                    <li class="pull-left header"><i class="fa fa-wrench"></i></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="box-data">
                        <div class="row">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-3">
                            
                            <!-- Success box -->
                                <div class="box box-success">
                                    <div class="box-header">
                                        <h3 class="box-title">Box 1</h3>
                                        <div class="box-tools pull-right">
                                            <div class="btn-group">
                                                <div class="btn-group">
                                                    <button class="btn btn-success btn-sm switch-box to-prev-box" data-to-box="#B30"><i class="fa fa-angle-left"></i></button>
                                                    <button type="button" class="btn btn-success btn-sm box-num dropdown-toggle" data-toggle="dropdown">#B1</button>
                                                    <button class="btn btn-success btn-sm switch-box to-next-box" data-to-box="#B2"><i class="fa fa-angle-right"></i></button>
                                                    <ul class="dropdown-menu box-list" style="max-height: 300px; overflow-y: scroll;">
                                                        <?php for ($bl=1; $bl < 31; $bl++): ?>
                                                            <li><a href="#B<?php echo $bl ?>">Box <?php echo $bl ?></a></li>
                                                        <?php endfor ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-sm" id="cim">Import</button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                    <?php for ($b=1; $b < 31; $b++): ?>
                                        <table class="table poke-box" <?php if ($b >= 2) echo 'style="display: none"' ?> id="B<?php echo $b ?>">
                                            <tbody>
                                            <?php for ($r=1; $r < 6; $r++): ?>
                                                <tr>
                                                <?php for ($c=1; $c < 7; $c++): ?>
                                                    <td id="<?php echo $r."-".$c ?>" style="text-align: center;"><button id="" class="btn btn-default show-info" data-container="body" data-toggle="popover" data-placement="top" data-content="Empty slot"><img src="/cdb/public/images/favicon.ico" alt=""></button></td>
                                                <?php endfor ?>
                                                </tr>
                                            <?php endfor ?>
                                            </tbody>
                                        </table>
                                    <?php endfor ?>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.col -->
                        </div>
                    </div>

                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="predict">
                        
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="import-modal">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="pull-right btn btn-xs btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="notice-title">Raw Data</h4>
				</div>
				<div class="modal-body" id="">
                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
				</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success" id="impd">Import</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">&times; 
                    Close</button>
                </div>
			</div>
		</div>
	</div>
</section>
</aside>