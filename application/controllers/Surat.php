<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Surat');
    }
    public function index()
    {
        $data['sudah'] = $this->M_Surat->data()->result();

        $data['mts_data'] = $this->M_Surat->mts_data()->num_rows();
        $data['mts_kelas'] = $this->M_Surat->mts_kelas()->result();
        $data['mts_data_ambil'] = $this->M_Surat->mts_data_ambil()->num_rows();

        $data['smp_data'] = $this->M_Surat->smp_data()->num_rows();
        $data['smp_kelas'] = $this->M_Surat->smp_kelas()->result();
        $data['smp_data_ambil'] = $this->M_Surat->smp_data_ambil()->num_rows();

        $data['ma_data'] = $this->M_Surat->ma_data()->num_rows();
        $data['ma_kelas'] = $this->M_Surat->ma_kelas()->result();
        $data['ma_data_ambil'] = $this->M_Surat->ma_data_ambil()->num_rows();

        $data['smk_data'] = $this->M_Surat->smk_data()->num_rows();
        $data['smk_kelas'] = $this->M_Surat->smk_kelas()->result();
        $data['smk_data_ambil'] = $this->M_Surat->smk_data_ambil()->num_rows();

        $data['title'] = 'surat';

        $this->load->view('head', $data);
        $this->load->view('surat', $data);
        $this->load->view('foot');
    }

    public function add()
    {
        $nis = $this->input->post('nis', true);

        $cek = $this->M_Surat->cek($nis)->num_rows();
        $cek2 = $this->M_Surat->cek2($nis)->num_rows();
        $cek3 = $this->M_Surat->cek3($nis)->num_rows();

        if ($cek == 0) {
            $this->session->set_flashdata('wrong', 'Maaf Santri tidak terdaftar');
            redirect(base_url('surat'));
        } else if ($cek2 == 1) {
            $this->session->set_flashdata('wrong', 'Santri ini sudah melakukan pengambilan');
            redirect(base_url('surat'));
        } else if ($cek3 == 1) {
            $this->session->set_flashdata('wrong', 'Maaf Santri tidak aktif');
            redirect(base_url('surat'));
        } else {
            $data = [
                'nis' => $nis,
                'waktu' => date('d-m-Y H:i:s')
            ];

            $this->M_Surat->input('surat', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('yes', 'Pengambilan Surat Berhasil');
            }
            redirect(base_url('surat'));
        }
    }
}