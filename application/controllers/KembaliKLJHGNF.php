<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kembali extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Kembali');
    }
    public function index()
    {
        $data['sudah'] = $this->M_Kembali->data()->result();

        $data['mts_data'] = $this->M_Kembali->mts_data()->num_rows();
        $data['mts_kelas'] = $this->M_Kembali->mts_kelas()->result();
        $data['mts_data_ambil'] = $this->M_Kembali->mts_data_ambil()->num_rows();

        $data['smp_data'] = $this->M_Kembali->smp_data()->num_rows();
        $data['smp_kelas'] = $this->M_Kembali->smp_kelas()->result();
        $data['smp_data_ambil'] = $this->M_Kembali->smp_data_ambil()->num_rows();

        $data['ma_data'] = $this->M_Kembali->ma_data()->num_rows();
        $data['ma_kelas'] = $this->M_Kembali->ma_kelas()->result();
        $data['ma_data_ambil'] = $this->M_Kembali->ma_data_ambil()->num_rows();

        $data['smk_data'] = $this->M_Kembali->smk_data()->num_rows();
        $data['smk_kelas'] = $this->M_Kembali->smk_kelas()->result();
        $data['smk_data_ambil'] = $this->M_Kembali->smk_data_ambil()->num_rows();

        $data['title'] = 'kembali';

        $this->load->view('head', $data);
        $this->load->view('kembali', $data);
        $this->load->view('foot');
    }

    public function add()
    {
        $nis = $this->input->post('nis', true);


        $cek4 = $this->M_Kembali->cek4($nis)->num_rows();
        $cek2 = $this->M_Kembali->cek2($nis)->num_rows();

        if ($cek2 > 0) {
            $this->session->set_flashdata('wrong', 'Maaf Santri Sudah absen kembali');
            redirect(base_url('kembali'));
        } else if ($cek4 < 1) {
            $this->session->set_flashdata('wrong', 'Maaf Santri belum melakukan absen pulang');
            redirect(base_url('kembali'));
        } else {
            $data = [
                'nis' => $nis,
                'waktu' => date('d-m-Y H:i:s')
            ];

            $this->M_Kembali->input('kembali', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('yes', 'Kembali Berhasil');
            }
            redirect(base_url('kembali'));
        }
    }
}