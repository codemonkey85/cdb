<?php
class Tools extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function calc() {
		$data = array();
		$data['title'] = "IV calculator";
		$data['tools_script'] = $this->load->view('scripts/tools_script', null, true);
		$data['selected'] = 'tools';
		$data['sub_selected'] = 'calc';
		$this->load->view('header', $data);
		$this->load->view('tools/calculators');
		$this->load->view('footer');
	}

	function breed_tracker() {
		$data = new stdClass();
		$data->title = "Breed tracker";
		$data->selected = 'tools';
		$data->sub_selected = 'breed_tracker';
		$this->load->view('header', $data);
		$this->load->view('tools/breed_tracker');
		$this->load->view('footer');
	}
}