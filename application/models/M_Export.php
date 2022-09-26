<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Export extends CI_Model
{

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
        return $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND NOT EXISTS (SELECT nis FROM kembali WHERE kembali.nis=tb_santri.nis) ORDER BY t_formal DESC")->result();
    }

    public function exportTelat()
    {
        return $this->db->query("SELECT * FROM tb_santri a JOIN kembali b ON a.nis=b.nis WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND waktu > '11-05-2022 17:00:00' ORDER BY t_formal DESC ")->result();
    }
}
