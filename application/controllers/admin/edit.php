<?php

class Edit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        redirect('admin/edit/pokemon', 301);
    }

    public function pokemon($species_id = false) {
        $this->load->model('pokemon_model');
        $this->load->model('ability_model');
        $this->load->model('move_model');
        $this->load->model('item_model');
        $data = array();
        $pkm = array();
        $data['selected'] = 'edit_database';
        $data['sub_selected'] = 'edit_pkm';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $pkm['work_mode'] = 'edit';
        $pkm['pkm_list'] = $this->pokemon_model->get_pkm_list();
        $pkm['move_list'] = $this->move_model->get_move_list();
        $pkm['ab_list'] =$this->ability_model->get_ability_list();
        $pkm['items_list'] = $this->item_model->get_item_list();
        if ($species_id) {
            $pkm['current_pkm'] = $this->pokemon_model->get_pkm_by_species($species_id);
            $pkm['learn_set'] = $this->pokemon_model->get_pkm_learnset_simple($species_id);
            $strategy_list = $this->pokemon_model->get_pkm_strategy_list($species_id);
            if ($strategy_list) {
                $pkm['strategy_list'] = $strategy_list;
            }
            $data['title'] = $pkm['current_pkm']->species;
        } else {
            $data['title'] = 'Edit Pokemon';
        }
        
        $this->load->view('header', $data);
        $this->load->view('admin/pokemon', $pkm);
        $this->load->view('footer');
    }

    public function move() {
        $this->load->model('move_model');
        $data = array();
        $data['title'] = 'Edit Move';
        $data['selected'] = 'edit_database';
        $data['sub_selected'] = 'edit_move';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);
        $moves['all_moves'] = $this->move_model->get_move_list();
        $this->load->view('header', $data);
        $this->load->view('admin/edit_move', $moves);
        $this->load->view('footer');
    }

    public function ability() {
        $this->load->model('ability_model');
        $data = array();
        $data['title'] = 'Edit Ability';
        $data['selected'] = 'edit_database';
        $data['sub_selected'] = 'edit_ability';
        $data['admin_script'] = $this->load->view('admin/admin_script', null, true);

        $this->load->view('header', $data);
        $abilities = array();
        $abilities['all_ab'] = $this->ability_model->get_ability_list();
        $this->load->view('/admin/edit_ability', $abilities);
        $this->load->view('footer');
    }

    public function update() {
        $model = $this->input->post('model');
        $function = 'edit_'.$this->input->post('object');
        $edit_data = $this->input->post('data');
        $id = $this->input->post('id');
        $this->load->model($model);
        // print_r($data);
        $response = $this->$model->$function($id, $edit_data);
        echo json_encode($response);
    }

    public function get($object, $id) {
        if ($id) {
            $result = $this->$object($id);
            // print_r($result);
            echo json_encode($result);
        }
    }
    private function _pokemon($id = false) {
        if ($id) {
            $this->load->model('pokemon_model');
            $pkm = $this->pokemon_model->get_pkm_by_id($id);
            return $pkm;
        }
    }
    public function _ability($id = false) {
        if ($id) {
            $this->load->model('ability_model');
            $ability = $this->ability_model->get_ability_by_id($id);
            return $ability;
        }
    }
    public function _move($id = false) {
        if ($id) {
            $this->load->model('move_model');
            $move = $this->move_model->get_move_by_id($id);
            return $move;
        }
    }
    public function _strategy($id = false) {
        if ($id) {
            $this->load->model('pokemon_model');
            $strategy = $this->pokemon_model->get_strategy_by_id($id);
            return $strategy;
        }
    }
}
