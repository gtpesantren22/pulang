<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Export extends CI_Model
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
    }

    public function exportList()
    {
        $this->db->select('*');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'kembali.nis=tb_santri.nis');
        $this->db->order_by('t_formal', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function exportBelum()
    {
        return $this->db->query("SELECT * FROM tb_santri WHERE (jkl = '$this->jkl1' OR jkl = '$this->jkl2') AND aktif = 'Y' AND NOT EXISTS (SELECT nis FROM kembali WHERE kembali.nis=tb_santri.nis) ORDER BY t_formal DESC")->result();
    }

    public function exportTelat()
    {
        return $this->db->query("SELECT kembali.*, tb_santri.nama, tb_santri.kec,tb_santri.desa, tb_santri.kab, tb_santri.k_formal, tb_santri.t_formal, tb_santri.kamar, tb_santri.komplek, (SELECT waktu FROM batas WHERE batas.k_formal=tb_santri.k_formal AND batas.t_formal=tb_santri.t_formal AND batas.jkl=tb_santri.jkl) AS batas_waktu FROM tb_santri JOIN kembali ON tb_santri.nis=kembali.nis WHERE (tb_santri.jkl = '$this->jkl1' OR tb_santri.jkl = '$this->jkl2') AND aktif = 'Y' ORDER BY t_formal DESC")->result();
    }
}
