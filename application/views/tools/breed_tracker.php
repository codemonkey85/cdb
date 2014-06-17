<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tools
        <small>Calculators</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>tools"><i class="fa fa-wrench"></i> Tools</a></li>
        <li class="active">Calculators</li>
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
                    <li class="active"><a href="#blind" data-toggle="tab">Blind Breeding</a></li>
                    <li class=""><a href="#predict" data-toggle="tab">Predicted Breeding</a></li>
                    <li class="pull-left header"><i class="fa fa-wrench"></i></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="blind">
                    <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>HP</th>
                            <th>ATK</th>
                            <th>DEF</th>
                            <th>S.ATK</th>
                            <th>S.DEF</th>
                            <th>SPD</th>
                        </tr>
                    </thead>
                    <tbody id="tracker">
                        <?php for ($i=1; $i <= 5; $i++) : ?>
                        <tr>
                            <th data-track-no="<?php echo $i ?>">Pkm <?php echo $i ?></th>
                            <td><input type="checkbox" name="" id="" value="1"></td>
                            <td><input type="checkbox" name="" id="" value="2"></td>
                            <td><input type="checkbox" name="" id="" value="3"></td>
                            <td><input type="checkbox" name="" id="" value="4"></td>
                            <td><input type="checkbox" name="" id="" value="5"></td>
                            <td><input type="checkbox" name="" id="" value="6"></td>
                        </tr>
                        <?php endfor ?> 
                    </tbody>
                    </table>
                    </div>

                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="predict">
                        
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
	</div>
    <?php echo "<pre>{elapsed_time}/{memory_usage}</pre>";?>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="notice-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Warning</h4>
				</div>
				<div class="modal-body" id="notice-message">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="success-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="notice-title">Success</h4>
				</div>
				<div class="modal-body" id="notice-message">
					Hooray!
				</div>
			</div>
		</div>
	</div>
</section>
</aside>