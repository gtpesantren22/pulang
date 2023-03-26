<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_Login');

		$user = $this->M_Login->current_user();

		if (!$this->M_Login->current_user()) {
			redirect('login/logout');
		}
	}

	public function index()
	{
		$data['title'] = 'index';
		$data['user'] = $this->M_Login->current_user();

		$this->load->view('head', $data);
		$this->load->view('index');
		$this->load->view('foot');
	}

	// Logout from admin page
	// public function logout()
	// {

	// 	// Removing session data
	// 	$sess_array = array(
	// 		'namaSesi' => ''
	// 	);
	// 	$this->session->unset_userdata('namaSesi', $sess_array);
	// 	// $data['message_display'] = 'Successfully Logout';
	// 	$this->session->set_flashdata('berhasil', 'Logout Berhasil');
	// 	redirect('login');
	// }

	public function logout()
	{
		// $this->load->model('M_Login');
		$this->M_Login->logout();
		redirect('login');
	}
}
