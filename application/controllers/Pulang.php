<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once FCPATH . 'vendor/autoload.php';

class Pulang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Pulang');

        $this->load->model('M_Login');
        $user = $this->M_Login->current_user();

        if (!$this->M_Login->current_user()) {
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

        $data['mhs_data'] = $this->M_Pulang->mhs_data()->num_rows();
        $data['mhs_data_ambil'] = $this->M_Pulang->mhs_data_ambil()->num_rows();

        $data['semua'] = $data['mts_data'] + $data['smp_data'] + $data['ma_data'] + $data['smk_data'] + $data['mhs_data'];
        $data['ambil'] = $data['mts_data_ambil'] + $data['smp_data_ambil'] + $data['ma_data_ambil'] + $data['smk_data_ambil'] + $data['mhs_data_ambil'];

        $data['title'] = 'pulang';
        $this->load->view('head', $data);
        $this->load->view('pulang', $data);
        $this->load->view('foot');
    }

    public function add()
    {
        // $nis = $this->input->post('nis', true);
        $nis = preg_replace("/[^0-9]/", "", $this->input->post('nis', true));


        $cek4 = $this->M_Pulang->cek4($nis)->num_rows();
        $cek2 = $this->M_Pulang->cek2($nis)->num_rows();
        $cek = $this->M_Pulang->cekRekom($nis)->num_rows();

        if ($cek4 < 1) {
            $this->session->set_flashdata('wrong', 'Maaf Santri belum melakukan pengambilan surat');
            redirect('pulang');
        } elseif ($cek2 > 0) {
            $this->session->set_flashdata('wrong', 'Maaf santri ini sudah melakukan izin pulang');
            redirect('pulang');
        } elseif ($cek < 1) {
            $this->session->set_flashdata('wrong', 'Maaf belum mendapat REKOM BENDAHARA');
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

    public function pulangDetail()
    {
        $data['sudah'] = $this->M_Pulang->sudah()->result();
        $data['belum'] = $this->M_Pulang->belum()->result();
        $data['title'] = 'pulang';

        $this->load->view('head', $data);
        $this->load->view('pulangDetail', $data);
        $this->load->view('foot');
    }

    public function exportSudah()
    {
        // Ambil data dari model
        $data = $this->M_Pulang->sudah()->result();
        $dataBelum = $this->M_Pulang->belum()->result();

        // Load library PhpSpreadsheet dan inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        // Buat sheet baru dengan nama "Data"
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Absensi Pulang');

        // Buat header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Lembaga');
        $sheet->setCellValue('E1', 'Waktu Pulang');

        // Loop untuk menampilkan data
        $no = 2; // Baris pertama untuk header, jadi data dimulai dari baris kedua
        // $urut = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $no, $no - 1);
            $sheet->setCellValue('B' . $no, $row->nama);
            $sheet->setCellValue('C' . $no, $row->k_formal);
            $sheet->setCellValue('D' . $no, $row->t_formal);
            $sheet->setCellValue('E' . $no, $row->waktu);
            $no++;
        }

        // Buat sheet baru dengan nama "Data"
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Data Belum Pulang');

        // Buat header kolom 
        $sheet2->setCellValue('A1', 'No');
        $sheet2->setCellValue('B1', 'Nama');
        $sheet2->setCellValue('C1', 'Kelas');
        $sheet2->setCellValue('D1', 'Lembaga');
        $sheet2->setCellValue('E1', 'Waktu Pulang');

        // Loop untuk menampilkan data
        $no2 = 2; // Baris pertama untuk header, jadi data dimulai dari baris kedua
        // $urut = 1;
        foreach ($dataBelum as $row2) {
            $sheet2->setCellValue('A' . $no2, $no2 - 1);
            $sheet2->setCellValue('B' . $no2, $row2->nama);
            $sheet2->setCellValue('C' . $no2, $row2->k_formal);
            $sheet2->setCellValue('D' . $no2, $row2->t_formal);
            $sheet2->setCellValue('E' . $no2, 'Belum');
            $no2++;
        }

        // Konfigurasi header untuk men-download file Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Absensi Pulang Izin Liburan.xlsx"');
        header('Cache-Control: max-age=0');

        // Buat objek writer untuk menulis file Excel
        $writer = new Xlsx($spreadsheet);
        // Tulis file Excel ke output
        $writer->save('php://output');
    }
}
