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

	// Logout from admin page
	public function logout()
	{

		// Removing session data
		$sess_array = array(
			'namaSesi' => ''
		);
		$this->session->unset_userdata('namaSesi', $sess_array);
		// $data['message_display'] = 'Successfully Logout';
		$this->session->set_flashdata('berhasil', 'Logout Berhasil');
		redirect('login');
	}
}