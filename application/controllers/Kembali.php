<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once FCPATH . 'vendor/autoload.php';

class Kembali extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Kembali');
        $this->load->model('M_Login');
        $user = $this->M_Login->current_user();

        if (!$this->M_Login->current_user()) {
            redirect('login');
        }
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

        $data['mhs_data'] = $this->M_Kembali->mhs_data()->num_rows();
        $data['mhs_data_ambil'] = $this->M_Kembali->mhs_data_ambil()->num_rows();

        $data['semua'] = $data['mts_data'] + $data['smp_data'] + $data['ma_data'] + $data['smk_data'] + $data['mhs_data'];
        $data['ambil'] = $data['mts_data_ambil'] + $data['smp_data_ambil'] + $data['ma_data_ambil'] + $data['smk_data_ambil'] + $data['mhs_data_ambil'];

        $data['title'] = 'kembali';

        $this->load->view('head', $data);
        $this->load->view('kembali', $data);
        $this->load->view('foot');
    }

    public function add()
    {
        $nis = preg_replace("/[^0-9]/", "", $this->input->post('nis', true));


        $cek4 = $this->M_Kembali->cek4($nis)->num_rows();
        $cek2 = $this->M_Kembali->cek2($nis)->num_rows();

        if ($cek2 > 0) {
            $this->session->set_flashdata('wrong', 'Maaf Santri Sudah absen kembali');
            redirect('kembali');
        } else if ($cek4 < 1) {
            $this->session->set_flashdata('wrong', 'Maaf Santri belum melakukan absen pulang');
            redirect('kembali');
        } else {
            $data = [
                'nis' => $nis,
                'waktu' => date('d-m-Y H:i:s')
            ];

            $this->M_Kembali->input('kembali', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('yes', 'Kembali Berhasil');
            }
            redirect('kembali');
        }
    }

    public function kembaliDetail()
    {
        $data['sudah'] = $this->M_Kembali->sudah()->result();
        $data['belum'] = $this->M_Kembali->belum()->result();
        $data['title'] = 'pulang';

        $this->load->view('head', $data);
        $this->load->view('kembaliDetail', $data);
        $this->load->view('foot');
    }

    public function exportSudah()
    {
        // Ambil data dari model
        $data = $this->M_Kembali->sudah()->result();
        $dataBelum = $this->M_Kembali->belum()->result();

        // Load library PhpSpreadsheet dan inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        // Buat sheet baru dengan nama "Data"
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Absensi Kembali');

        // Buat header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Lembaga');
        $sheet->setCellValue('E1', 'Waktu Kembali');

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
        $sheet2->setTitle('Data Belum Kembali');

        // Buat header kolom 
        $sheet2->setCellValue('A1', 'No');
        $sheet2->setCellValue('B1', 'Nama');
        $sheet2->setCellValue('C1', 'Kelas');
        $sheet2->setCellValue('D1', 'Lembaga');
        $sheet2->setCellValue('E1', 'Waktu Kembali');

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
        header('Content-Disposition: attachment;filename="Data Absensi Kembali Santri.xlsx"');
        header('Cache-Control: max-age=0');

        // Buat objek writer untuk menulis file Excel
        $writer = new Xlsx($spreadsheet);
        // Tulis file Excel ke output
        $writer->save('php://output');
    }
}
