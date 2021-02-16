<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loginadmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mauth');
    }

    public function index()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') == 'user') {
                redirect('panelpromotor', 'refresh');
            } else {
                redirect('dashboard', 'refresh');
            }
        } else {
            $this->load->view('vheader');
            $this->load->view('vloginadmin');
            $this->load->view('vfooter');
        }
    }

    public function register()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') == 'user') {
                redirect('panelpromotor', 'refresh');
            } else {
                redirect('dashboard', 'refresh');
            }
        } else {
            $this->load->view('vheader');
            $this->load->view('vregister');
            $this->load->view('vfooter');
        }
    }

    public function register_action()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $cek = $this->Mauth->cek_email($email);
        if (!$cek) {
            $data = array(
                'email' => $email,
                'password' => $hash,
                'level' => 'admin'
            );
            $this->Mauth->create_akun('auth', $data);
            $this->session->set_flashdata('msg', 'Create Account Success !! ');
            redirect('loginadmin');
        } else {
            $this->session->set_flashdata('msg', 'Email telah terdaftar !!');
            redirect('loginadmin/register');
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $cek = $this->Mauth->cek_email($email);
        $cek_password = $this->Mauth->cek_password($email);
        if ($cek) {
            if (password_verify($pass, $cek_password[0]->password)) {
                $data_session = array(
                    'id_login' => $cek_password[0]->id_auth,
                    'email' => $email,
                    'level' => $cek_password[0]->level,
                    'status' => "login",
                );
                $this->session->set_userdata($data_session);
                if ($cek_password[0]->level == 'user') {
                    redirect('panelpromotor');
                } else {
                    redirect('dashboard');
                }
            } else {
                $this->session->set_flashdata('msg', 'Password Salah !!');
                redirect('loginadmin');
            }
        } else {
            $this->session->set_flashdata('msg', 'Email Tidak terdaftar !!');
            redirect('loginadmin');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }
    public function update_password()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') != 'user') {
                redirect('userconfig', 'refresh');
            } else {
                echo "User tidak bisa ganti password disini";
            }
        } else {
            $this->load->view('vheader');
            $this->load->view('vloginadmin');
            $this->load->view('vfooter');
        }
    }

    public function lupa_password()
    {
    }
}
