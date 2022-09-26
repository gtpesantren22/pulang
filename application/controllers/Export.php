<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('M_Export', 'export');
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
        // load excel library
        $this->load->library('excel');
        $listInfo = $this->export->exportList();
        $objPHPExcel = new PHPExcel();
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
            if ($list->waktu > date('11-05-2022 17:00:00')) {
                $ket = 'Terlambat';
                $waktuawal  = date_create('11-05-2022 17:00:00'); //waktu di setting
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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    public function belum()
    {
        // create file name
        $fileName = 'data-' . time() . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $listInfo = $this->export->exportBelum();
        $objPHPExcel = new PHPExcel();
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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }

    public function telat()
    {
        // create file name
        $fileName = 'data-' . time() . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $listInfo = $this->export->exportTelat();
        $objPHPExcel = new PHPExcel();
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
            if ($list->waktu > date('11-05-2022 17:00:00')) {
                $ket = 'Terlambat';
                $waktuawal  = date_create('11-05-2022 17:00:00'); //waktu di setting
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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
    }
}
