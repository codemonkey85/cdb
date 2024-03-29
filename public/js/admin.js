(function($, window, document) {


	// variables
	var base_url = '/cdb/';
	var notice = $('#notice-modal');
	var success_modal = $('#success-modal');
	var fail_modal = $('#fail-modal');
	var	notice_message = $('#notice-message');
	var move_section = '#move-section .box-body';
	var extracted_data = new Object;
	var progress_bar = $('#import-progress');
	var log_window = $('#log');
	var progress_number = $('#progress-number');
	var enableBtn = $('.btn#enable');
	var disableBtn = $('.btn#disable');
	var importBtn = $('.btn.import');
	var result_window = $('#result');
    var pkm_list = $('.pkm-list');
    var moves_box = $('.moves-box');
    var isShiny = $('input#is-shiny');
    var stats = ['hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd'];
    var wysihtml5 = $(".wysihtml5");

	//common events
	var tick = function(checkbox) {
		$(checkbox).prop('checked', true);
		$(checkbox).parent().addClass('checked');
	}
	var untick = function(checkbox) {
		$(checkbox).prop('checked', false);
		$(checkbox).parent().removeClass('checked');
	}
	var call_success_modal = function() {
		success_modal.modal('show');
		window.setTimeout(function() { success_modal.modal('hide') }, 1000);
	}
	var call_fail_modal = function() {
		fail_modal.modal('show');
	}
	var import_log = function(message) {
		log_window.empty().append(message);
	}
	var result_log = function(message) {
		result_window.append(message+'<br>');
	}
	var empty_result_log = function () {
		result_window.empty();
	}
	var init_progress_bar = function(max) {
		progress_bar.attr('aria-valuemax', max);
		progress_bar.attr('aria-valuenow', 0);
		progress_bar.css('width', '0%');
	}
	var iterate_progress_bar = function(max, current) {
		progress_bar.attr('aria-valuenow', (current*1)+1);
		progress_bar.css('width', ((current*1+1)/max)*100+'%');
		progress_number.empty().append(current+"/"+max);
	}
	//database related actions
	var get_object = function(object, id) {
		return $.ajax({
			url: base_url+'admin/edit/get/'+object+'/'+id,
			type: 'post',
			dataType: 'json',
		});	
	}

	var update_data = function(model, object, id, data) {
		return $.ajax({
			url: base_url+'admin/edit/update',
			type: 'post',
			dataType: 'json',
			data: {
				model: model,
                object: object,
                id: id,
				data: data,
			}
		});
	}
	var insert_data = function(model, func, data) {
		return $.ajax({
			url: base_url+'admin/insert/something',
			type: 'post',
			dataType: 'json',
			// async: false,
			data: {
                model: model,
                func: func,
                data: data,
            }
		});
	}
	var import_js_data = function(table, object, data) {
		return $.ajax({
			url: base_url+'admin/import/process_js_data',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {
				table: table,
				object: object,
				data: data
			},
		})		
	}
	// preview data from PokeAPI
	var extract_pokeAPI = function(api) {
		return $.ajax({
			url: base_url+'admin/import/get_pokeAPI',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {api: api},
		})
	}
	// import data from PokeAPI
	var import_pokeAPI = function(api, table) {
		return $.ajax({
			url: base_url+'admin/import/get_pokeAPI',
			type: 'post',
			dataType: 'json',
			async: false,
			data: {
				api: api,
				table: table
			},
		})
	}

	$(function(){
        pkm_list.on('change', function() {
            location = base_url+"admin/edit/pokemon/"+pkm_list.val();            
        });
        wysihtml5.wysihtml5();
		//Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red',
            increaseArea: '20%',
        });
		moves_box.slimscroll({
            height: "350px",
            size: "5px",
            alwaysVisible: false,
            wheelStep:1,
            size: "3px"
        });
        $('.selectpicker').selectpicker({
            style: 'btn-sm btn-primary',
            size: 8
        });
        enableBtn.click(function() {
        	importBtn.prop('disabled', false);
        });
        disableBtn.click(function() {
        	importBtn.prop('disabled', true);
        });
		
        $('#move-id').on('change', function() {
        	var id = $('#move-id').val();
        	get_object('_move', id).done(function(data) {
        		console.log(data);
        		$.each(data, function(index, val) {
        			$('#move-'+index).val(val);
        		});
        	})
        });

        $('#ab-id').on('change', function() {
        	var id = $('#ab-id').val();
        	get_object('_ability', id).done(function(data) {
        		$.each(data, function(index, val) {
        			$('#ab-'+index).val(val);
        		});
        	})
        });

        $('#pkm-pkdx_id').on('change', function () {
        	var id = $('#pkm-pkdx_id').val();
        	get_object('_pokemon', id).done(function(data) {
        		console.log(data);
        		untick($('input:checkbox'));
        		$.each(data, function(index, val) {
        			$('#pkm-'+index).val(val);
        		});
        		if (typeof data.form == "undefined") {
    				$('#pkm-form').val('');
    			};
    			$.each(data.stats, function(index, val) {
        			$('#pkm-'+index).val(val);
    			});
    			$.each(data.types, function(index, val) {
    				$('#type-'+(index*1+1)).val(val);
    				tick($('#enable-t'+(index*1+1)));
    			});
    			$.each(data.abilities, function(index, val) {
    				$('#ability-'+(index*1+1)).val(val.id);
    				tick($('#enable-a'+(index*1+1)));
    			});
    			$.each(data.moves, function(index, val) {
    				
    			});
        	})
        });
        $('#move-edit-submit').on('click', function() {
        	var data = new Object();
        	var key = '';
        	$('#move-section .form-control').each(function() {
        		key = $(this).attr('id').replace('move-', '');
        		data[key] = $(this).val();
        	});
        	update_data('move', data).done(function(data) {
        		if (data.success) {
        			$('#success-message').empty().append(data.message);
        			call_success_modal();
        		} else {
        			$('#fail-message').empty().append(data.message);
        			call_fail_modal();
        		};
        	});
        });
        $('#ab-edit-submit').on('click', function() {
        	var data = new Object();
        	var key = '';
        	$('#ab-section .form-control').each(function() {
        		key = $(this).attr('id').replace('ab-', '');
        		data[key] = $(this).val();
        	});
        	update_data('ability', data).done(function(data) {
        		if (data.success) {
        			$('#success-message').empty().append(data.message);
        			call_success_modal();
        		} else {
        			$('#fail-message').empty().append(data.message);
        			call_fail_modal();
        		};
        	});
        });

        $('#extract').on('click', function() {
			console.log(pokedex());
        });
        $('#import-pokedex').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('pokedex', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-attackdex').on('click', function() {
        	$('#source').val('moves.js')
        	var attack_dex = moves()
        	console.log(attack_dex)
        	var max = Object.keys(attack_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
			var no_of_success = 0;
        	$.each(attack_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('attack_dex', index, val).done(function(response) {
        			result_log(response.message);
        			if (response.success) {
        				no_of_success++;
        			};
        		});
        		iterate_progress_bar(max, current);
        	});
        	result_log(no_of_success+'/'+max+' moves has been added');
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-abilities').on('click', function() {
        	$('#source').val('abilities.js')
        	var abilities_dex = abilities();
        	console.log(abilities_dex)
        	var max = Object.keys(abilities_dex).length;
        	var current = 0;
        	init_progress_bar(max)
        	empty_result_log();
        	var btn = $(this);
        	btn.button('loading');
        	var no_of_success = 0;
        	$.each(abilities_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('abilities_dex', index, val).done(function(response) {
        			result_log(response.message);
        			if (response.success) {
        				no_of_success++;
        			};
        		})
        		iterate_progress_bar(max, current);
        	});
        	result_log(no_of_success+'/'+max+' abilities has been added.');
        	call_success_modal();
        	btn.button('reset');
        });
        $('#import-items').on('click', function() {
        	$('#source').val('items.js')
        	var items_dex = items();
        	console.log(items_dex)
        	var max = Object.keys(items_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(items_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('items_dex', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-learnset').click(function() {
        	$('#source').val('learnset-g6.js');
        	var learnsets = pkm_move();
        	console.log(learnsets)
        	var max = Object.keys(learnsets).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(learnsets, function(index, val) {
        		current++;
        		import_log('Importing '+index+'\'s moves');
        		import_js_data('learn_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-typeset').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index+ '\'s types');
        		import_js_data('types_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });
        $('#import-abilityset').on('click', function () {
        	$('#source').val('pokedex.js')
        	var poke_dex = pokedex();
        	// console.log(poke_dex)
			var max = Object.keys(poke_dex).length;
			var current = 0;
			init_progress_bar(max);
			empty_result_log();
        	var btn = $(this);
			btn.button('loading');
        	$.each(poke_dex, function(index, val) {
        		current++;
        		import_log('Importing '+index);
        		import_js_data('abilities_set', index, val).done(function(response) {
        			result_log(response.message);
        		});
        		iterate_progress_bar(max, current);
        	});
        	call_success_modal();
			btn.button('reset');
        });


        // Events on strategy build
        isShiny.on('ifChecked', function() {
            var current_pkm = $(this).attr('data-species');
            if (current_pkm != '') {
                $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite-shiny/'+current_pkm+'.gif');
            };
        });
        isShiny.on('ifUnchecked', function() {
            var current_pkm = $(this).attr('data-species');
            if (current_pkm != '') {
                $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite/'+current_pkm+'.gif');
            };
        });
        $(".ev-range").ionRangeSlider({
            min: 0,
            max: 252,
            type: 'single',
            step: 1,
            postfix: "",
            prettify: false,
            onChange: function(obj) {
                var input_id = 'input-'+obj.input.attr('id');
                var input_val = obj.input.val();
                $('#'+input_id).val(input_val);
            }
        });
        $('.input-ev').on('change', function() {
            var current_ev = $(this).val();
            var slider_id = $(this).attr('id').replace('input-', '');        
            $('#'+slider_id).ionRangeSlider("update", {
                from: current_ev,
            });
        });
        $('#submit-strategy').on('click', function() {
            var current_strategy = $('#strategy_list').val();
            var data = new Object();
            data['species_id'] = $('#strategy-species-id').attr('data-species-id');
            data['name'] = $('#strategy-name').val();
            data['ability_id'] = $('#strategy-ability').val();
            data['nature'] = $('#nature-list').val();
            data['item_id'] = $('#strategy-item').val();
            data['happiness'] = $('#strategy-happiness').val();
            data['move_1_id'] = $('#strategy-move-1').val();
            data['move_2_id'] = $('#strategy-move-2').val();
            data['move_3_id'] = $('#strategy-move-3').val();
            data['move_4_id'] = $('#strategy-move-4').val();
            data['ev_hp'] = $('#input-ev-hp').val();
            data['ev_atk'] = $('#input-ev-atk').val();
            data['ev_def'] = $('#input-ev-def').val();
            data['ev_sp_atk'] = $('#input-ev-sp_atk').val();
            data['ev_sp_def'] = $('#input-ev-sp_def').val();
            data['ev_spd'] = $('#input-ev-spd').val();
            data['iv_hp'] = $('#iv-hp').val();
            data['iv_atk'] = $('#iv-atk').val();
            data['iv_def'] = $('#iv-def').val();
            data['iv_sp_atk'] = $('#iv-sp_atk').val();
            data['iv_sp_def'] = $('#iv-sp_def').val();
            data['iv_spd'] = $('#iv-spd').val();
            data['description'] = $('#strategy-desc').val();
            // if (isShiny.prop('checked') == true) {
            //     data['is_shiny'] = 1;
            // } else {
            //     data['is_shiny'] = 0;
            // };
            console.log(data);
            if (data['species_id'] != '') {
                if (current_strategy == '') {
                    insert_data('pokemon_model', 'add_pkm_strategy', data);
                } else {
                    update_data('pokemon_model', 'pkm_strategy', current_strategy, data);
                }
            }
        });
        $('#strategy_list').on('change', function() {
            var strategy_id = $(this).val();
            // console.log(strategy_id);
            if (strategy_id != '') {
                get_object('_strategy', strategy_id).done(function(data) {
                    console.log(data)
                    $('#strategy-name').val(data.name);
                    $('#strategy-ability').val(data.ability_id);
                    $('#strategy-item').val(data.item_id);
                    $('#nature-list').val(data.nature);
                    $('#strategy-happiness').val(data.happiness);
                    $('#strategy-move-1').val(data.move_1_id);
                    $('#strategy-move-2').val(data.move_2_id);
                    $('#strategy-move-3').val(data.move_3_id);
                    $('#strategy-move-4').val(data.move_4_id);
                    $.each(stats, function(index, val) {
                        var ev_value = data['ev_'+val]
                        var iv_value = data['iv_'+val]
                        $('#input-ev-'+val).val(ev_value);
                        $('#iv-'+val).val(iv_value);
                        $('#ev-'+val).ionRangeSlider("update", {
                            from: ev_value,
                        });
                    });
                    $("#strategy-desc").data("wysihtml5").editor.setValue(data.description);
                    // var current_pkm = isShiny.attr('data-species');
                    // if (data.is_shiny == 1) {
                    //     isShiny.iCheck('check', function() {
                    //             $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite-shiny/'+current_pkm+'.gif');
                    //     })
                    // } else {
                    //     isShiny.iCheck('uncheck', function() {
                    //             $('.pkm-sprite').attr('src', base_url+'public/images/f-sprite/'+current_pkm+'.gif');
                    //     })
                    // };
                });
            }
        });
	});
}(window.jQuery, window, document));