<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Rekap');
    }
    public function index()
    {
        $data['kelasDataMTs'] = $this->M_Rekap->kelasDataMTs()->result();
        $data['kelasDataSMP'] = $this->M_Rekap->kelasDataSMP()->result();
        $data['kelasDataMA'] = $this->M_Rekap->kelasDataMA()->result();
        $data['kelasDataSMK'] = $this->M_Rekap->kelasDataSMK()->result();

        $data['title'] = 'rekap';
        $this->load->view('head', $data);
        $this->load->view('rekap', $data);
        $this->load->view('foot');
    }

    public function pi()
    {
        $data['pi'] = $this->M_Rekap->data2()->result();
        $data['title'] = 'rekap';
        $this->load->view('head', $data);
        $this->load->view('sanpi', $data);
        $this->load->view('foot');
    }
}