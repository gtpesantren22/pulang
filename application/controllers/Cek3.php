<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek3 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Cek3');

        if ($this->session->userdata('namaSesi') != 'hgvhgjhGHJGJHKJHkjhjhjh87645365457hjgjgjhGJHGjhgjHGHG76876') {
            redirect('login');
        }
    }

    public function kelas()
    {
        $formal = $this->uri->segment(3);
        $kelas = $this->uri->segment(4);

        $kls = explode('%20', $kelas);
        $klsOk = implode(' ', $kls);

        $data['cek_kelas_s'] = $this->M_Cek3->cek_kelas_s($formal, $klsOk)->result();
        $data['cek_kelas_b'] = $this->M_Cek3->cek_kelas_b($formal, $klsOk)->result();
        $data['cek_kelas_s_jml'] = $this->M_Cek3->cek_kelas_s($formal, $klsOk)->num_rows();
        $data['cek_kelas_b_jml'] = $this->M_Cek3->cek_kelas_b($formal, $klsOk)->num_rows();
        $data['kelas'] = $klsOk;
        $data['formal'] = $formal;

        $data['title'] = 'kembali';
        $this->load->view('head', $data);
        $this->load->view('cek_kelas3', $data);
        $this->load->view('foot');
    }
}