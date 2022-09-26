<?php

class M_Kembali extends CI_Model
{
    public function cek($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    public function cek2($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->from('kembali');
        return $this->db->get();
    }

    public function cek3($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->where('aktif', 'T');
        $this->db->from('tb_santri');
        return $this->db->get();
    }
    public function cek4($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->from('pulang');
        return $this->db->get();
    }

    public function data()
    {
        $this->db->select('*');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'tb_santri.nis = kembali.nis');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->order_by('waktu', 'DESC');
        $this->db->limit(5);
        return $this->db->get();
    }

    public function input($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function mts_data()
    {
        $this->db->where('t_formal', 'MTs');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function mts_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'MTs');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'tb_santri.nis = kembali.nis');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function mts_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'MTs');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }

    // SMP
    public function smp_data()
    {
        $this->db->where('t_formal', 'SMP');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function smp_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'SMP');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'tb_santri.nis = kembali.nis');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function smp_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'SMP');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }

    // MA
    public function ma_data()
    {
        $this->db->where('t_formal', 'MA');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function ma_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'MA');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'tb_santri.nis = kembali.nis');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function ma_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'MA');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }

    // SMK
    public function smk_data()
    {
        $this->db->where('t_formal', 'SMK');
        $this->db->where('aktif', 'Y');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->from('tb_santri');
        return $this->db->get();
    }
    public function smk_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'SMK');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('kembali');
        $this->db->join('tb_santri', 'tb_santri.nis = kembali.nis');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        return $this->db->get();
    }
    public function smk_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'SMK');
        $this->db->where('tb_santri.jkl', 'Laki-laki');
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }
}