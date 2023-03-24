<?php

class M_Rekap extends CI_Model
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

    // MTs Data
    public function kelasDataMTs()
    {
        $this->db->select('k_formal');
        $this->db->group_start();
        $this->db->where('jkl', $this->jkl1);
        $this->db->or_where('jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('t_formal', 'MTs');
        $this->db->group_by('k_formal');
        $this->db->order_by('nis', 'DESC');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    // SMP Data
    public function kelasDataSMP()
    {
        $this->db->select('k_formal');
        $this->db->group_start();
        $this->db->where('jkl', $this->jkl1);
        $this->db->or_where('jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('t_formal', 'SMP');
        $this->db->group_by('k_formal');
        $this->db->order_by('nis', 'DESC');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    // MA Data
    public function kelasDataMA()
    {
        $this->db->select('k_formal');
        $this->db->group_start();
        $this->db->where('jkl', $this->jkl1);
        $this->db->or_where('jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('t_formal', 'MA');
        $this->db->group_by('k_formal');
        $this->db->order_by('nis', 'DESC');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    // SMK Data
    public function kelasDataSMK()
    {
        $this->db->select('k_formal');
        $this->db->group_start();
        $this->db->where('jkl', $this->jkl1);
        $this->db->or_where('jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->where('t_formal', 'SMK');
        $this->db->group_by('k_formal');
        $this->db->order_by('nis', 'DESC');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }
}
