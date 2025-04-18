<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once FCPATH . 'vendor/autoload.php';

class Export extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('M_Export', 'export');
        $user = $this->M_Login->current_user();
        $this->load->model('M_Login');

        if (!$this->M_Login->current_user()) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['export_list'] = $this->export->exportList();
        $this->load->view('export', $data);
    }
    // create xlsx
    public function sudah()
    {
        // create file name
        $fileName = 'data-' . time() . '.xlsx';

        $listInfo = $this->export->exportList();

        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NIS');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Alamat');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kelas');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Sekolah');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kamar');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Waktu Kembali');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Ket');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Waktu Terlambat');
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            if ($list->waktu > date('14-10-2022 17:00:00')) {
                $ket = 'Terlambat';
                $waktuawal  = date_create('14-10-2022 17:00:00'); //waktu di setting
                $waktuakhir = date_create($list->waktu);
                $diff  = date_diff($waktuawal, $waktuakhir);
                $jarak = $diff->d . ' hari, ' . $diff->h . ' jam ' . $diff->i . ' menit ';
            } else {
                $ket = 'Tidak Terlambat';
                $jarak = '-';
            }
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->nis);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->desa . ' - ' . $list->kec . ' - ' . $list->kab);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->k_formal);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->t_formal);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kamar . ' / ' . $list->komplek);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->waktu);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $ket);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $jarak);
            $rowCount++;
        }

        $filename = "Download Data Kembali " . date("Y-m-d H:i:s") . ".csv";

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat objek writer untuk menulis file Excel
        $writer = new Xlsx($objPHPExcel);
        // Tulis file Excel ke output
        $writer->save('php://output');
    }

    public function belum()
    {
        // create file name
        $fileName = 'data-' . time() . '.xlsx';
        // load excel library
        $listInfo = $this->export->exportBelum();
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NIS');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Alamat');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kelas');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Sekolah');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kamar');
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->nis);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->desa . ' - ' . $list->kec . ' - ' . $list->kab);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->k_formal);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->t_formal);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kamar . ' / ' . $list->komplek);
            $rowCount++;
        }
        $filename = "Download Data Kembali " . date("Y-m-d H:i:s") . ".csv";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Buat objek writer untuk menulis file Excel
        $writer = new Xlsx($objPHPExcel);
        // Tulis file Excel ke output
        $writer->save('php://output');
    }

    public function telat()
    {
        // create file name
        $fileName = 'data-' . time() . '.xlsx';
        // load excel library
        $listInfo = $this->export->exportTelat();
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NIS');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Alamat');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Kelas');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Sekolah');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Kamar');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Wajib Kembali');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Kembali');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Ket');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Waktu Terlambat');
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            if ($list->waktu > date($list->batas_waktu)) {
                $ket = 'Terlambat';
                $waktuawal  = date_create($list->batas_waktu); //waktu di setting
                $waktuakhir = date_create($list->waktu);
                $diff  = date_diff($waktuawal, $waktuakhir);
                $jarak = $diff->d . ' hari, ' . $diff->h . ' jam ' . $diff->i . ' menit ' . $diff->s . ' detik';
            } else {
                $ket = 'Tidak';
                $jarak = '-';
            }
            if ($ket == 'Terlambat') {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->nis);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->nama);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->desa . ' - ' . $list->kec . ' - ' . $list->kab);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->k_formal);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->t_formal);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->kamar . ' / ' . $list->komplek);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->batas_waktu);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $list->waktu);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $ket);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $jarak);
            }
            $rowCount++;
        }
        $filename = "Download Data Terlambat " . date("Y-m-d H:i:s") . ".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Buat objek writer untuk menulis file Excel
        $writer = new Xlsx($objPHPExcel);
        // Tulis file Excel ke output
        $writer->save('php://output');
    }
}
