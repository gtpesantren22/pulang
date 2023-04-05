<?php

class M_Login extends CI_Model
{

    private $_table = "user";
    const SESSION_KEY = 'id_user';

    public function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->_table);
        $user = $query->row();

        // cek apakah user sudah terdaftar?
        if (!$user) {
            return FALSE;
        }

        // cek apakah passwordnya benar?
        if ($password != $user->password) {
            return FALSE;
        }

        // cek apakah user aktif?
        // if ($user->aktif === 'T') {
        //     return FALSE;
        // }

        // bikin session
        $this->session->set_userdata([self::SESSION_KEY => $user->id_user]);
        // $this->_update_last_login($user->id_user);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $id_user = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
        return $query->row();
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }
}
