<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pulang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Pulang');

        if ($this->session->userdata('namaSesi') != 'hgvhgjhGHJGJHKJHkjhjhjh87645365457hjgjgjhGJHGjhgjHGHG76876') {
            redirect('login');
        }
    }
    public function index()
    {
        $data['sudah'] = $this->M_Pulang->data()->result();

        $data['mts_data'] = $this->M_Pulang->mts_data()->num_rows();
        $data['mts_kelas'] = $this->M_Pulang->mts_kelas()->result();
        $data['mts_data_ambil'] = $this->M_Pulang->mts_data_ambil()->num_rows();

        $data['smp_data'] = $this->M_Pulang->smp_data()->num_rows();
        $data['smp_kelas'] = $this->M_Pulang->smp_kelas()->result();
        $data['smp_data_ambil'] = $this->M_Pulang->smp_data_ambil()->num_rows();

        $data['ma_data'] = $this->M_Pulang->ma_data()->num_rows();
        $data['ma_kelas'] = $this->M_Pulang->ma_kelas()->result();
        $data['ma_data_ambil'] = $this->M_Pulang->ma_data_ambil()->num_rows();

        $data['smk_data'] = $this->M_Pulang->smk_data()->num_rows();
        $data['smk_kelas'] = $this->M_Pulang->smk_kelas()->result();
        $data['smk_data_ambil'] = $this->M_Pulang->smk_data_ambil()->num_rows();

        $data['title'] = 'pulang';
        $this->load->view('head', $data);
        $this->load->view('pulang', $data);
        $this->load->view('foot');
    }

    public function add()
    {
        $nis = $this->input->post('nis', true);


        $cek4 = $this->M_Pulang->cek4($nis)->num_rows();
        $cek2 = $this->M_Pulang->cek2($nis)->num_rows();

        if ($cek4 < 1) {
            $this->session->set_flashdata('wrong', 'Maaf Santri belum melakukan pengambilan surat');
            redirect('pulang');
        } elseif ($cek2 > 0) {
            $this->session->set_flashdata('wrong', 'Maaf santri ini sudah melakukan izin pulang');
            redirect('pulang');
        } else {
            $data = [
                'nis' => $nis,
                'waktu' => date('d-m-Y H:i:s')
            ];

            $this->M_Pulang->input('pulang', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('yes', 'Pengambilan pulang Berhasil');
            }
            redirect('pulang');
        }
    }
}
