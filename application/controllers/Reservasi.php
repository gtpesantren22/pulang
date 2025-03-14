<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Login');
        $this->load->model('M_Reservasi', 'model');
        $user = $this->M_Login->current_user();

        if (!$this->M_Login->current_user()) {
            redirect('login');
        }

        $this->jenisPulang = 'ramadhan';
    }

    public function index()
    {
        $data['title'] = 'reservasi';
        // $data['data'] = $this->model->getData()->result();

        // $this->load->view('head', $data);
        $this->load->view('reservasi', $data);
        // $this->load->view('foot');
    }

    public function add()
    {
        $data['title'] = 'reservasi';
        $data['data'] = $this->model->getDataAdd()->result();
        $data['santri'] = $this->model->santri()->result();

        $this->load->view('head', $data);
        $this->load->view('reservasiAdd', $data);
        $this->load->view('foot');
    }

    public function saveAdd($nis)
    {
        $cek = $this->model->getBy2('reservasi', 'nis', $nis, 'ket', $this->jenisPulang)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Data sudah ada');
            redirect("reservasi/add");
        } else {
            $cekRekom = $this->model->cekRekom($nis)->num_rows();
            if ($cekRekom < 1) {
                $this->session->set_flashdata('error', 'Maaf belum lunas tanggungan/BP');
                redirect('reservasi/add');
            } else {
                $data = [
                    'nis' => $nis,
                    'tanggal' => date('Y-m-d'),
                    'waktu' => date('H:i:s'),
                    'status' => 'proses',
                    'ket' => $this->jenisPulang
                ];
                $this->model->simpan('reservasi', $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('ok', 'Reservasi selesai');
                    redirect("reservasi/add");
                } else {
                    $this->session->set_flashdata('error', 'Reservasi gagal');
                    redirect("reservasi/add");
                }
            }
        }
    }

    public function saveAddManual()
    {
        $nis = $this->input->post('nis', true);
        $cek = $this->model->getBy2('reservasi', 'nis', $nis, 'ket', $this->jenisPulang)->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Data sudah ada');
            redirect("reservasi/add");
        } else {
            $cekRekom = $this->model->cekRekom($nis)->num_rows();
            if ($cekRekom < 1) {
                $this->session->set_flashdata('error', 'Maaf belum lunas tanggungan/BP');
                redirect('reservasi/add');
            } else {
                $data = [
                    'nis' => $nis,
                    'tanggal' => date('Y-m-d'),
                    'waktu' => date('H:i:s'),
                    'status' => 'proses',
                    'ket' => $this->jenisPulang
                ];
                $this->model->simpan('reservasi', $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('ok', 'Reservasi selesai');
                    redirect("reservasi/add");
                } else {
                    $this->session->set_flashdata('error', 'Reservasi gagal');
                    redirect("reservasi/add");
                }
            }
        }
    }

    public function del($id)
    {
        $this->model->hapus('reservasi', 'id_reservasi', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Reservasi terhapus');
            redirect("reservasi/add");
        } else {
            $this->session->set_flashdata('error', 'Hapus Reservasi gagal');
            redirect("reservasi/add");
        }
    }

    public function getAll($kls)
    {
        $data = $this->model->getData($kls)->result();

        echo json_encode(["data" => $data]);
    }
}
