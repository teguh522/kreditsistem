<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userconfig extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'user') {
            redirect('panelpromotor', 'refresh');
        }
    }
    public function index()
    {
        $this->load->view('vheader');
        $this->load->view('user/vupdatepassuser');
        $this->load->view('vfooter');
    }
    public function action_update()
    {
        $id = $this->session->userdata('id_login');
        $newpass = $this->input->post('password_w');
        $hash = password_hash($newpass, PASSWORD_DEFAULT);
        $data = array(
            'password' => $hash,
        );
        $this->Madmin->update_data('id_auth', $id, $data, 'auth');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('paneladmin');
    }
}
