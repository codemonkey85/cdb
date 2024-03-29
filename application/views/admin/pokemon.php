<?php 
$types_list = array('Bug', 'Dark', 'Dragon', 'Electric', 'Fairy', 'Fighting', 'Fire', 'Flying', 'Ghost', 'Grass', 'Ground', 'Ice', 'Normal', 'Poison', 'Psychic', 'Rock', 'Steel', 'Water');
if (isset($current_pkm)) {
    foreach ($current_pkm as $key => $value) {
        ${$key} = $value;
    }
}
$natures = array("Adamant", "Bashful", "Bold", "Brave", "Calm", "Careful", "Docile", "Gentle", "Hardy", "Hasty", "Impish", "Jolly", "Lax", "Lonely", "Mild", "Modest", "Naive", "Naughty", "Quiet", "Quirky", "Rash", "Relaxed", "Sassy", "Serious", "Timid");
$stats_list = array('hp' => 'HP', 'atk' => 'Attack', 'def' => 'Defense', 'sp_atk' => 'Sp.Atk', 'sp_def' => 'Sp.Def', 'spd' => 'Speed');
?>
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo ucwords($work_mode) ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url(); ?>move"><i class="fa fa-wrench"></i> <?php echo $work_mode ?></a></li>
        <li class="active"><i class="fa fa-bug"></i> <?php echo (isset($species) ? $species : "Pokémon") ?></li>
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
                    <li class=""><a href="#recommended" data-toggle="tab"><i class="fa fa-magic"></i> Recommended Strategy</a></li>
                    <li class=""><a href="#move" data-toggle="tab"><i class="fa fa-ge"></i> Move</a></li>
                    <li class=""><a href="#ability" data-toggle="tab"><i class="fa fa-gift"></i> Ability</a></li>
                    <li class=""><a href="#type" data-toggle="tab"><i class="fa fa-fire"></i> Type</a></li>
                    <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-bug"></i> Basic Info</a></li>
                    <li class="pull-left header"><i class="fa fa-gamepad"></i><?php echo (isset($species) ? $species : "") ?></li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="basic">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($work_mode == 'edit'): ?>
                                <label class="control-label" for="pkm-pkdx_id">Select a species</label>
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <select class="form-control input-sm pkm-list selectpicker" name="" id="pkm-species_id">
                                            <option value="">Select a species</option>
                                            <?php foreach ($pkm_list as $pkm): ?>
                                                <option value="<?php echo $pkm->species_id ?>" <?php if(isset($species_id) && $species_id == $pkm->species_id) echo "selected" ?>><?php echo $pkm->dex_id.". ".$pkm->species ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-md-4"><button class="btn btn-primary btn-sm"><i class="fa fa-tick"></i> Submit</button></div>
                                </div>
                                <?php else: ?>
                                <label for="" class="label-control">Species ID</label>
                                <div class="row">
                                    <div class="col-md-8 col-md-8">
                                        <input type="text" id="pkm-species_id" class="form-control input-sm">
                                    </div>
                                    <div class="col-md-4 col-md-4"><button class="btn btn-primary btn-sm"><i class="fa fa-tick"></i> Submit</button></div>
                                </div>
                                <?php endif ?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-dex_id">Index</label>
                                <input type="text" class="form-control input-sm" id="pkm-dex_id" placeholder="Index" value="<?php echo (isset($dex_id) ? $dex_id : "") ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-species">Name</label>
                                <input type="text" class="form-control input-sm" id="pkm-species" placeholder="Name" value="<?php echo (isset($species) ? $species : "") ?>"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="pkm-form">Base Species</label>
                                <select class="form-control input-sm" id="pkm-base_species" placeholder="">
                                    <option value="0">Select a species</option>
                                    <?php foreach ($pkm_list as $pkm): ?>
                                        <option value="<?php echo $pkm->species_id ?>" <?php if(isset($base_species) && $base_species == $pkm->species_id) echo "selected" ?>><?php echo $pkm->dex_id.". ".$pkm->species ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-hp">HP</label>
                                <input type="text" class="form-control input-sm" id="pkm-hp" placeholder="HP" value="<?php echo (isset($hp) ? $hp : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-att">ATK</label>
                                <input type="text" class="form-control input-sm" id="pkm-attack" placeholder="ATT" value="<?php echo (isset($atk) ? $atk : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-def">DEF</label>
                                <input type="text" class="form-control input-sm" id="pkm-defense" placeholder="DEF" value="<?php echo (isset($def) ? $def : "") ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-satt">Special ATK</label>
                                <input type="text" class="form-control input-sm" id="pkm-sp_atk" placeholder="Special ATT" value="<?php echo (isset($sp_atk) ? $sp_atk : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-sdef">Special DEF</label>
                                <input type="text" class="form-control input-sm" id="pkm-sp_def" placeholder="Special DEF" value="<?php echo (isset($sp_def) ? $sp_def : "") ?>"/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="pkm-spd">Speed</label>
                                <input type="text" class="form-control input-sm" id="pkm-speed" placeholder="Speed" value="<?php echo (isset($spd) ? $spd : "") ?>"/>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->

                    <!-- Recommended Build Tab -->
                    <div class="tab-pane" id="recommended">
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                <select name="" id="strategy_list" class="form-control input-sm">
                                    <option value="">Pick a strategy</option>
                                    <?php if (isset($strategy_list)): ?>
                                        <?php foreach ($strategy_list as $strategy): ?>
                                            <option value="<?php echo $strategy->id ?>"><?php echo $strategy->name ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <input type="hidden" id="strategy-species-id" name="" data-species-id="<?php if (isset($species_id)) echo $species_id ?>">
                                <input type="text" id="strategy-name" class="form-control input-sm" placeholder="Strategy name">
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <button class="btn btn-danger btn-sm"><i class="fa fa-eraser"></i> Reset</button>
                                <button id="submit-strategy" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
                            </div>
                        </div><!-- .row for Build Name-->
                        <div class="row">
                            <div class="col-md-3">
                            <label for="" class="label-control"><i class="fa fa-image"></i></label>
                            <?php if (isset($species)): ?>
                                <img src='<?php echo base_url()."public/images/f-sprite/$species.gif" ?>' alt="" class="center-block img-responsive pkm-sprite">
                            <?php endif ?>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label for="" class="label-control"><i class="fa fa-gift"></i> Ability</label>
                                <select name="" id="strategy-ability" class="form-control input-sm">
                                    <option value="0">Select ab ability</option>
                                    <?php foreach ($abilities as $pkm_ab): ?>
                                        <option value="<?php echo $pkm_ab->ability_id ?>"><?php echo $pkm_ab->ability_name ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label for="" class="label-control"><i class="fa fa-key"></i> Item</label>
                                <select name="" id="strategy-item" class="form-control input-sm">
                                    <option value="0">Select an item</option>
                                    <?php foreach ($items_list as $item): ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label for="" class="label-control">Level</label>
                                <input type="number" id="strategy-lv" name="" id="" min="1" max="100" value="100" class="form-control input-sm">
                                <label for="" class="label-control">Happiness</label>
                                <input type="number" id="strategy-happiness" name="" id="" min="0" max="255" value="255" class="form-control input-sm">
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <label for="" class="label-control">Nature</label>
                                <select name="" id="nature-list" class="form-control input-sm">
                                    <?php foreach ($natures as $nature): ?>
                                        <option value="<?php echo $nature ?>"><?php echo $nature ?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>
                        </div><!-- .row for Detail-->
                        <div class="row">
                            <div class="col-md-3  col-xs-3">
                                <label for="" class="label-control">Move 1</label>
                                <select name="" id="strategy-move-1" class="form-control input-sm">
                                    <option value="">Select a move</option>
                                    <?php if (isset($learn_set)): ?>
                                            <?php foreach ($learn_set as $pkm_move): ?>
                                                    <option value="<?php echo $pkm_move->move_id ?>"><?php echo $pkm_move->move_id ?></option>
                                            <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-3  col-xs-3">
                                <label for="" class="label-control">Move 2</label>
                                <select name="" id="strategy-move-2" class="form-control input-sm">
                                    <option value="">Select a move</option>
                                    <?php if (isset($learn_set)): ?>
                                            <?php foreach ($learn_set as $pkm_move): ?>
                                                    <option value="<?php echo $pkm_move->move_id ?>"><?php echo $pkm_move->move_id ?></option>
                                            <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-3  col-xs-3">
                                <label for="" class="label-control">Move 3</label>
                                <select name="" id="strategy-move-3" class="form-control input-sm">
                                    <option value="">Select a move</option>
                                    <?php if (isset($learn_set)): ?>
                                            <?php foreach ($learn_set as $pkm_move): ?>
                                                    <option value="<?php echo $pkm_move->move_id ?>"><?php echo $pkm_move->move_id ?></option>
                                            <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-3  col-xs-3">
                                <label for="" class="label-control">Move 4</label>
                                <select name="" id="strategy-move-4" class="form-control input-sm">
                                    <option value="">Select a move</option>
                                    <?php if (isset($learn_set)): ?>
                                            <?php foreach ($learn_set as $pkm_move): ?>
                                                    <option value="<?php echo $pkm_move->move_id ?>"><?php echo $pkm_move->move_id ?></option>
                                            <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div><!-- .row for Moves-->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="label-control">Stats</label>
                                <table class="table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Base</th>
                                            <th colspan="2"><?php if (isset($current_pkm)): ?>
                                                <?php echo $hp+$atk+$def+$sp_atk+$sp_def+$spd ?>
                                            <?php endif ?></th>
                                            <th colspan="2">EVs</th>
                                            <th>IV</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($current_pkm)): ?>
                                        <?php foreach ($stats_list as $key => $value): ?>
                                        <tr>
                                            <th><?php echo $value ?></th>
                                            <td><span id="<?php echo $key ?>" class="badge bg-<?php
                                                    if (${$key} < 90) {
                                                            echo 'yellow';
                                                        } 
                                                        if (90 <= ${$key} && ${$key} <= 110 ) {
                                                            echo 'aqua';
                                                        }
                                                        if (${$key} > 110 && ${$key} < 150) {
                                                            echo 'green';
                                                        }
                                                        if (${$key} >= 150) {
                                                            echo 'red';
                                                        }
                                                        ?>"><?php echo ${$key} ?></span></td>
                                                <td class="col-md-4 col-sm-4 col-xs-3">
                                                    <div class="progress sm progress-striped">
                                                        <div class="progress-bar progress-bar-<?php 
                                                        if (${$key} < 90) {
                                                            echo 'yellow';
                                                        } 
                                                        if (90 <=${$key} && ${$key} <= 110 ) {
                                                            echo 'aqua';
                                                        }
                                                        if (${$key} > 110 && ${$key} < 150) {
                                                            echo 'green';
                                                        }
                                                        if (${$key} >= 150) {
                                                            echo 'red';
                                                        }
                                                        ?>" style="width: <?php echo ${$key}/250*100 ?>%"></div>
                                                    </div>
                                                </td>
                                                <td class="col-md-4 col-sm-4 col-xs-3"><input class="ev-range" id="ev-<?php echo $key ?>" type="text" name="ev-range-<?php echo $key ?>" value="" /></td>
                                                <td><input type="text" min="0" max="252" maxlength="3" size="3" class="form-control input-sm input-ev" id="input-ev-<?php echo $key ?>" value="0"></td>
                                                <td><input type="text"  min="0" max="31" maxlength="2" size="3" id="iv-<?php echo $key ?>" class="form-control input-sm" value="31"></td>
                                                <th><input type="text" class="form-control input-sm" id="total-<?php echo $key ?>" readonly=""/></th>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-md-12">
                                    <form>
                                        <textarea id="strategy-desc" class="wysihtml5" id="strategy-description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
                                    </form>
                            </div>
                        </div>
                    </div><!-- /.tab-pane --><!-- Recommended strategy Tab -->


                    <div class="tab-pane" id="move">
                        <div class="row"> <!-- -->
                        <?php foreach ($types_list as $type): ?>
                            <div class="col-md-2">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><span class="type-icon-flat type-<?php echo strtolower($type) ?>"><?php echo $type ?></span></h3>
                                        <!-- <div class="box-tools pull-right">
                                            <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div> -->
                                    </div>
                                    <div class="box-body moves-box">
                                        <div class="form-group"> 
                                            <?php foreach ($move_list as $move): ?>
                                                <?php if ($move->type == $type): ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="<?php echo $move->id ?>" <?php if (isset($learn_set)) {foreach ($learn_set as $pkm_move) {if ($pkm_move->move_id == $move->id) echo "checked"; }}?>/>
                                                        <?php echo $move->name ?>
                                                    </label>                                                
                                                </div>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div> <!-- .col-md-2 -->
                        <?php endforeach ?>
                        </div> <!-- .row -->
                    </div><!-- /.tab-pane -->



                    <div class="tab-pane" id="ability">
                        <label class="control-label" for="ability-0">Ability 0</label>
                        <select class="form-control" name="" id="ability-0">
                            <option value="0">Select an ability</option>
                            <?php foreach ($ab_list as $ab): ?>
                                <option value="<?php echo $ab->id ?>" <?php if (isset($abilities)) {foreach ($abilities as $pkm_ab) {
                                    if ($pkm_ab->id == 0 && $pkm_ab->ability_id == $ab->id) echo "selected";
                                }} ?>>
                                <?php echo $ab->name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        
                        <label class="control-label" for="aility-1">Ability 1</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" id="enable-a1" <?php if (isset($abilities)) {foreach ($abilities as $pkm_ab) {
                                    if ($pkm_ab->id == 1) echo "checked";
                                }} ?>>
                            </span>
                            <select id="ability-1" class="form-control">
                                <option value="0">Select an ability</option>
                                <?php foreach ($ab_list as $ab): ?>
                                    <option value="<?php echo $ab->id ?>" <?php if (isset($abilities)) {foreach ($abilities as $pkm_ab) {
                                        if ($pkm_ab->id == 1 && $pkm_ab->ability_id == $ab->id) echo "selected";
                                    }} ?>>
                                    <?php echo $ab->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div><!-- /input-group -->
                        
                        <label class="control-label" for="ha">Hidden Ability</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" id="enable-ha" <?php if (isset($abilities)) {foreach ($abilities as $pkm_ab) {
                                    if ($pkm_ab->id == "H") echo "checked";
                                }} ?>>
                            </span>
                            <select id="ha" class="form-control">
                                <option value="0">Select an ability</option>
                                <?php foreach ($ab_list as $ab): ?>
                                    <option value="<?php echo $ab->id ?>" <?php if (isset($abilities)) { foreach ($abilities as $pkm_ab) {
                                        if ($pkm_ab->id == "H" && $pkm_ab->ability_id == $ab->id) echo "selected";
                                    } } ?>>
                                    <?php echo $ab->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div><!-- /input-group -->
                    </div><!-- /.tab-pane -->



                    <div class="tab-pane" id="type">
                        <label class="control-label" for="type-1">Type 1</label>
                        <select class="form-control" name="" id="type-1">
                            <option value="0">Select a type</option>
                            <?php foreach ($types_list as $type): ?>
                                <option value="<?php echo $type ?>" <?php if (isset($types[0]) && $types[0]==$type) echo 'selected'; ?>><?php echo $type ?></option>
                            <?php endforeach ?>
                        </select>

                        <label class="control-label" for="type-2">Type 2</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" id="enable-t2" <?php if (isset($types[1])) echo 'checked' ?>>
                            </span>
                            <select id="type-2" class="form-control">
                                <option value="0">Select a type</option>
                                <?php foreach ($types_list as $type): ?>
                                    <option value="<?php echo $type ?>"<?php if (isset($types[1]) && $types[1]==$type) echo 'selected'; ?>><?php echo $type ?></option>
                                <?php endforeach ?>
                            </select>
                        </div><!-- /input-group -->                    
                    </div><!-- /.tab-pane -->


                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
	    </div><!-- /.col -->
	</div>
    <?php #echo '<pre>';print_r($info); echo '</pre>' ?>
    <?php #if (isset($current_pkm)) { echo '<pre>';foreach ($current_pkm as $key => $value) { echo "\$$key = "; print_r($value); echo"<br>";  } echo '</pre>'; } ?>
    <?php #if (isset($abilities)) {echo '<pre>';print_r($learn_set); echo '</pre>'; } ?>
    <?php #echo '<pre>';print_r($move_list); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($ab_list); echo '</pre>' ?>
    <?php #echo '<pre>';print_r($strategy_list); echo '</pre>' ?>
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