<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Santri');

        if ($this->session->userdata('namaSesi') != 'hgvhgjhGHJGJHKJHkjhjhjh87645365457hjgjgjhGJHGjhgjHGHG76876') {
            redirect('login');
        }
    }
    public function index()
    {
        $data['pa'] = $this->M_Santri->data()->result();

        $data['title'] = 'santri';

        $this->load->view('head', $data);
        $this->load->view('sanpa', $data);
        $this->load->view('foot');
    }

    public function pi()
    {
        $data['pi'] = $this->M_Santri->data2()->result();
        $data['title'] = 'santri';

        $this->load->view('head', $data);
        $this->load->view('sanpi', $data);
        $this->load->view('foot');
    }
}