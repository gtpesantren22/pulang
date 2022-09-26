<?php

class M_Santri extends CI_Model
{
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
