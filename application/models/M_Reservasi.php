<?php

class M_Reservasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login');
        $user = $this->M_Login->current_user();

        if ($user->level === 'admin') {
            $this->jkl1 = 'Laki-laki';
            $this->jkl2 = 'Perempuan';
        } elseif ($user->level === 'putra') {
            $this->jkl1 = 'Laki-laki';
            $this->jkl2 = 'Laki-laki';
        } elseif ($user->level === 'putri') {
            $this->jkl1 = 'Perempuan';
            $this->jkl2 = 'Perempuan';
        }

        $this->sentral = $this->load->database('sentral', true);
        $this->jenisPulang = 'ramadhan';
        $this->tahun = '2024/2025';
    }

    function getBy($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        return $this->db->get($table);
    }
    function getBy2($table, $where, $dtwhere, $where2, $dtwhere2)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where2, $dtwhere2);
        return $this->db->get($table);
    }

    function simpan($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function hapus($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        $this->db->delete($table);
    }

    function getData($kls)
    {
        $this->db->select('id_reservasi,tb_santri.nis,tb_santri.k_formal,tb_santri.t_formal,tb_santri.nama,tb_santri.desa,tb_santri.kec,tb_santri.kab,reservasi.tanggal,reservasi.waktu');
        $this->db->from('reservasi');
        $this->db->join('tb_santri', 'tb_santri.nis = reservasi.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('reservasi.status', 'proses');
        $this->db->where('reservasi.ket', $this->jenisPulang);
        $this->db->where('tb_santri.k_formal', $kls);
        $this->db->order_by('reservasi.tanggal', 'ASC');
        $this->db->order_by('reservasi.waktu', 'ASC');
        return $this->db->get();
    }
    function getDataAdd()
    {
        $this->db->select('id_reservasi,tb_santri.nis,tb_santri.nama,tb_santri.desa,tb_santri.kec,tb_santri.kab,reservasi.tanggal,reservasi.waktu');
        $this->db->from('reservasi');
        $this->db->join('tb_santri', 'tb_santri.nis = reservasi.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('reservasi.status', 'proses');
        $this->db->where('reservasi.ket', $this->jenisPulang);
        $this->db->order_by('reservasi.tanggal', 'DESC');
        $this->db->order_by('reservasi.waktu', 'DESC');
        return $this->db->get();
    }

    function santri()
    {
        $this->db->select('*');
        $this->db->from('tb_santri');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('tb_santri.aktif', 'Y');
        return $this->db->get();
    }

    public function cekRekom($nis)
    {
        $this->sentral->where('nis', $nis);
        $this->sentral->where('ket', $this->jenisPulang);
        $this->sentral->where('tahun', $this->tahun);
        $this->sentral->from('rekom');
        return $this->sentral->get();
    }
}
