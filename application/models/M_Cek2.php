<?php

class M_Cek2 extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id_santri');
        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id ")->row();

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

    public function cek_kelas_s($formal, $kelas)
    {
        $this->db->select('*');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->where('tb_santri.k_formal', $kelas);
        $this->db->where('tb_santri.t_formal', $formal);
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'pulang.nis = tb_santri.nis');
        return $this->db->get();
    }

    public function cek_kelas_b($formal, $kelas)
    {
        return $this->db->query("SELECT * FROM tb_santri WHERE (jkl = '$this->jkl1' OR jkl = '$this->jkl2') AND aktif = 'Y' AND k_formal = '$kelas' AND t_formal = '$formal' AND NOT EXISTS (SELECT nis FROM pulang WHERE pulang.nis = tb_santri.nis) ");
        // return $this->db->;
    }
}
