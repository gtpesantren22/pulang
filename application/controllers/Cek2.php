<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Cek2');
    }

    public function kelas()
    {
        $formal = $this->uri->segment(3);
        $kelas = $this->uri->segment(4);

        $kls = explode('%20', $kelas);
        $klsOk = implode(' ', $kls);

        $data['cek_kelas_s'] = $this->M_Cek2->cek_kelas_s($formal, $klsOk)->result();
        $data['cek_kelas_b'] = $this->M_Cek2->cek_kelas_b($formal, $klsOk)->result();
        $data['cek_kelas_s_jml'] = $this->M_Cek2->cek_kelas_s($formal, $klsOk)->num_rows();
        $data['cek_kelas_b_jml'] = $this->M_Cek2->cek_kelas_b($formal, $klsOk)->num_rows();
        $data['kelas'] = $klsOk;
        $data['formal'] = $formal;

        $data['title'] = 'pulang';
        $this->load->view('head', $data);
        $this->load->view('cek_kelas2', $data);
        $this->load->view('foot');
    }
}