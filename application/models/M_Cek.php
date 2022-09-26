<?php

class M_Cek extends CI_Model
{
    public function cek_kelas_s($formal, $kelas)
    {
        $this->db->select('*');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->where('tb_santri.k_formal', $kelas);
        $this->db->where('tb_santri.t_formal', $formal);
        $this->db->from('surat');
        $this->db->join('tb_santri', 'surat.nis = tb_santri.nis');
        return $this->db->get();
    }

    public function cek_kelas_b($formal, $kelas)
    {
        return $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND k_formal = '$kelas' AND t_formal = '$formal' AND NOT EXISTS (SELECT nis FROM surat WHERE surat.nis = tb_santri.nis) ");
        // return $this->db->;
    }
}