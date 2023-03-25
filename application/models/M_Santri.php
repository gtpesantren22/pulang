<?php

class M_Santri extends CI_Model
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

    public function data()
    {

        $this->db->where('jkl', 'Laki-laki');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }

    public function data2()
    {
        $this->db->where('jkl', 'Perempuan');
        $this->db->where('aktif', 'Y');
        $this->db->from('tb_santri');
        return $this->db->get();
    }
}
