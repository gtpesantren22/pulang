<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('namaSesi') != 'hgvhgjhGHJGJHKJHkjhjhjh87645365457hjgjgjhGJHGjhgjHGHG76876') {
			redirect('login');
		}
	}

	public function index()
	{
		$data['title'] = 'index';

		$this->load->view('head', $data);
		$this->load->view('index');
		$this->load->view('foot');
	}
}