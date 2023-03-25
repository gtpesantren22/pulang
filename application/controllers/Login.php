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

        if ($this->M_Login->current_user()) {
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

        // $cek = $this->M_Login->cek_login('user', $where);

        if ($this->M_Login->login($username, $password)) {
            $this->session->set_flashdata('success', 'Login Berhasil');
            redirect('welcome');
        } else {
            // $this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan passwrod benar!');
            echo "
            <script>
                alert('Maaf username atau password salah');
                window.location = '" . base_url('login') . "';
            </script>
            ";
            // $this->load->view('login');
        }
    }

    public function logout()
    {
        // $this->load->model('M_Login');
        $this->M_Login->logout();
        redirect('login');
    }
}
