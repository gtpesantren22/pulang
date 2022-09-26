<?php

class M_Rekap extends CI_Model
{
    // MTs Data
    public function kelasDataMTs()
    {
        $this->db->select('k_formal');
        $this->db->where('jkl', 'Laki-laki');
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
        $this->db->where('jkl', 'Laki-laki');
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
        $this->db->where('jkl', 'Laki-laki');
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
        $this->db->where('jkl', 'Laki-laki');
        $this->db->where('t_formal', 'SMK');
        $this->db->group_by('k_formal');
        $this->db->order_by('nis', 'DESC');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }
}
