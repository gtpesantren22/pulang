<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'index';

		$this->load->view('head', $data);
		$this->load->view('index');
		$this->load->view('foot');
	}
}