<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('loginadmin', 'refresh');
        }
        if ($this->session->userdata('level') == 'user') {
            redirect('panelpromotor', 'refresh');
        }
    }

    public function index()
    {
        $data['pelanggan'] = $this->Madmin->get_data_all('mpelanggan', 'id_pelanggan', 'DESC');
        $data['barang'] = $this->Madmin->get_data_all('mbarang', 'id_barang', 'DESC');
        $this->load->view('vheader');
        $this->load->view('vmenu');
        $this->load->view('admin/vdashboard', $data);
        $this->load->view('vfooter');
    }
    public function get_laporan_kredit()
    {
        $data = $this->Madmin->get_barang_kredit();
        echo json_encode($data);
    }
}
