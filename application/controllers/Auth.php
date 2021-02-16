<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mauth');
        $this->load->library('curl');
    }

    public function index()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') == 'user') {
                redirect('panelpromotor', 'refresh');
            } else {
                redirect('paneladmin', 'refresh');
            }
        } else {
            $this->load->view('vheader');
            $this->load->view('vlogin');
            $this->load->view('vfooter');
        }
    }

    public function register()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') == 'user') {
                redirect('panelpromotor', 'refresh');
            } else {
                redirect('paneladmin', 'refresh');
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
            );
            $this->Mauth->create_akun('auth', $data);
            $this->session->set_flashdata('msg', 'Create Account Success !! ');
            redirect('auth');
        } else {
            $this->session->set_flashdata('msg', 'Email telah terdaftar !!');
            redirect('auth/register');
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $data = ['username' => $email, 'password' => $pass];
        $json = json_encode($data);
        $hasil = $this->post_http('https://api.autochat.id/api/authentication/login', $json);
        $row = json_decode($hasil);
        $status = $row->status;
        $msg = $row->message;
        if ($status) {
            $data_session = array(
                'id_login' => $row->customer_info->customer_id,
                'access_token' => $row->access_token,
                'email' => $row->customer_info->email,
                'firstname' => $row->customer_info->firstname,
                'lastname' => $row->customer_info->lastname,
                'level' => 'user',
                'status' => "login",
            );
            $this->session->set_userdata($data_session);
            redirect('panelpromotor');
        } else {
            $this->session->set_flashdata('msg', $msg);
            redirect('auth');
        }

        // $cek = $this->Mauth->cek_email($email);
        // $cek_password = $this->Mauth->cek_password($email);
        // if ($cek) {
        //     if (password_verify($pass, $cek_password[0]->password)) {
        //         $data_session = array(
        //             'id_login' => $cek_password[0]->id_auth,
        //             'email' => $email,
        //             'level' => $cek_password[0]->level,
        //             'status' => "login",
        //         );
        //         $this->session->set_userdata($data_session);
        //         if ($cek_password[0]->level == 'user') {
        //             redirect('panelpromotor');
        //         } else {
        //             redirect('paneladmin');
        //         }
        //     } else {
        //         $this->session->set_flashdata('msg', 'Password Salah !!');
        //         redirect('auth');
        //     }
        // } else {
        //     $this->session->set_flashdata('msg', 'Email Tidak terdaftar !!');
        //     redirect('auth');
        // }
    }

    public function post_http($json_url, $data)
    {
        $ch = curl_init($json_url);
        $options = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }
    public function update_password()
    {
        if (($this->session->userdata('level') != null)) {
            if ($this->session->userdata('level') == 'user') {
                redirect('userconfig', 'refresh');
            } else {
                redirect('adminconfig', 'refresh');
            }
        } else {
            $this->load->view('vheader');
            $this->load->view('vlogin');
            $this->load->view('vfooter');
        }
    }

    public function lupa_password()
    {
    }
}
