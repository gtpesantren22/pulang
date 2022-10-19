<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login');

        if ($this->session->userdata('namaSesi') === 'hgvhgjhGHJGJHKJHkjhjhjh87645365457hjgjgjhGJHGjhgjHGHG76876') {
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['title'] = "Halaman Login";
        $this->load->view('sign-in');
    }

    public function user_login_process()
    {

        $data['title'] = "Halaman Login";

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $where = array('nis' => $username);

        $cek = $this->M_Login->cek_login('tb_santri', $where);

        if ($cek->num_rows() == 1) {
            $hasil = $cek->row();
            if ($password === $hasil->pass) {
                $this->session->set_userdata('id_santri', $hasil->id_santri);
                $this->session->set_userdata('nis_santri', $hasil->nis);
                $this->session->set_userdata('namaSesi', 'qwertyuiop0987654321');

                $this->session->set_flashdata('success', 'Login Berhasil');
                redirect('home');
            } else {
                $this->session->set_flashdata(
                    "pesan",
                    "Password salah/tidak ditemukan"
                );
                // $this->session->set_flashdata('error', 'Login Salah');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata(
                "pesan",
                "Username salah/tidak ditemukan"
            );
            redirect('login');
        }
    }
}