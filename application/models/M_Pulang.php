<?php

class M_Pulang extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login');
        $user = $this->M_Login->current_user();

        $this->db2 = $this->load->database('sentral', TRUE);

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

        $this->jenisPulang = 'ramadhan';
        $this->tahun = '2024/2025';
    }

    public function cek($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    public function cek2($nis)
    {
        $this->db->where('nis', $nis);
        $this->db->from('pulang');
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
        $this->db->from('surat');
        return $this->db->get();
    }

    public function data()
    {
        $this->db->select('*');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
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
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function mts_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'MTs');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function mts_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'MTs');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
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
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function smp_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'SMP');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function smp_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'SMP');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
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
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function ma_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'MA');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function ma_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'MA');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }

    // SMK
    public function smk_data()
    {
        $this->db->where('t_formal', 'SMK');
        $this->db->where('aktif', 'Y');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->from('tb_santri');
        return $this->db->get();
    }
    public function smk_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'SMK');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }
    public function smk_kelas()
    {
        $this->db->select('k_formal');
        $this->db->where('t_formal', 'SMK');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->from('tb_santri');
        $this->db->group_by('k_formal');
        return $this->db->get();
    }


    // MHS
    public function mhs_data()
    {
        $this->db->where('t_formal', 'Mahasiswa');
        $this->db->where('aktif', 'Y');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->from('tb_santri');
        return $this->db->get();
    }
    public function mhs_data_ambil()
    {
        $this->db->where('tb_santri.t_formal', 'Mahasiswa');
        $this->db->where('tb_santri.aktif', 'Y');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        return $this->db->get();
    }

    public function sudah()
    {
        $this->db->select('tb_santri.nama, tb_santri.t_formal,tb_santri.k_formal, pulang.waktu');
        $this->db->from('pulang');
        $this->db->join('tb_santri', 'tb_santri.nis = pulang.nis');
        $this->db->group_start();
        $this->db->where('tb_santri.jkl', $this->jkl1);
        $this->db->or_where('tb_santri.jkl', $this->jkl2);
        $this->db->group_end();
        $this->db->order_by('t_formal', 'ASC');
        $this->db->order_by('k_formal', 'ASC');
        $this->db->order_by('pulang.waktu', 'DESC');
        return $this->db->get();
    }

    public function belum()
    {
        return $this->db->query("SELECT * FROM tb_santri WHERE (jkl = '$this->jkl1' OR jkl = '$this->jkl2') AND aktif = 'Y' AND NOT EXISTS (SELECT nis FROM pulang WHERE pulang.nis = tb_santri.nis) ORDER BY t_formal ASC, k_formal ASC ");
    }

    public function cekRekom($nis)
    {
        $this->db2->from('rekom');
        $this->db2->where('nis', $nis);
        $this->db2->where('ket', $this->jenisPulang);
        $this->db2->where('tahun', $this->tahun);
        return $this->db2->get();
    }

    public function edit($table, $where, $dtwhere, $data)
    {
        $this->db->where($where, $dtwhere);
        $this->db->update($table, $data);
    }
}
