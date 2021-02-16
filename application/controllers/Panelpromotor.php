<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panelpromotor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Madmin');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'admin') {
            redirect('paneladmin', 'refresh');
        }
    }

    public function index()
    {
        $data['hasil'] = $this->Madmin->get_data_allarray('tgl_akhir >=', date('Y-m-d'), 'frm_create_tugas');
        $this->load->view('vheader');
        $this->load->view('vmenu');
        $this->load->view('user/vlisttugas', $data);
        $this->load->view('vfooter');
    }
    public function detailtugas()
    {
        $id_tugas = $this->input->get('id');
        $id_auth = $this->session->userdata('id_login');
        $getdata = $this->Madmin->get_threewhere(
            'id_tugas',
            $id_tugas,
            'id_auth',
            $id_auth,
            'status',
            'proses',
            'frm_usr_tugas'
        );
        if ($getdata != null) {
            $data['disable'] = true;
        } else {
            $data['disable'] = false;
        }
        $id = $this->input->get('id');
        $data['hasil'] = $this->Madmin->get_data('id_create_tugas', $id, 'frm_create_tugas');
        $data['action'] = base_url('panelpromotor/post_tugas');
        $this->load->view('vheader');
        $this->load->view('vmenu');
        $this->load->view('user/vdetailtugas', $data);
        $this->load->view('vfooter');
    }
    public function historitugas()
    {
        $id_auth = $this->session->userdata('id_login');
        $data['hasil'] = $this->Madmin->get_data_join_strusers(
            'id_auth',
            $id_auth,
            'frm_usr_tugas',
            'frm_create_tugas',
            'frm_usr_tugas.id_tugas=frm_create_tugas.id_create_tugas',
            'id_create_tugas',
            'DESC'
        );
        $this->load->view('vheader');
        $this->load->view('vmenu');
        $this->load->view('user/vhistorytugas', $data);
        $this->load->view('vfooter');
    }
    public function post_tugas()
    {
        $id_tugas = $this->input->post('id_tugas');
        $id_auth = $this->session->userdata('id_login');
        $nama_depan = $this->session->userdata('firstname');
        $nama_belakang = $this->session->userdata('lastname');
        $getdata = $this->Madmin->get_threewhere(
            'id_tugas',
            $id_tugas,
            'id_auth',
            $id_auth,
            'status',
            'proses',
            'frm_usr_tugas'
        );
        if ($getdata != null) {
            $this->session->set_flashdata('msg', 'Anda telah mengambil tugas ini dan belum selesai ');
            redirect("panelpromotor");
        } else {
            $data = array(
                'id_tugas' => $id_tugas,
                'id_auth' => $id_auth,
                'nama_user' => $nama_depan . " " . $nama_belakang,
                'tgl_submit_user' => date('Y-m-d h:i:s'),
                'status' => 'proses',
            );
            $this->Madmin->create_data('frm_usr_tugas', $data);
            $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
            redirect('panelpromotor/historitugas');
        }
    }

    public function laporankerja()
    {
        $id_auth = $this->session->userdata('id_login');
        $id_tugas = $this->input->get('id');
        $data['hasil'] = $this->Madmin->get_data_threewhere(
            $id_auth,
            $id_tugas,
            'frm_usr_laporan',
            'id_laporan_tugas',
            'DESC'
        );
        $data['action'] = base_url('panelpromotor/post_laporan');
        $data['last_data'] = $this->Madmin->get_data_last('frm_usr_laporan');
        $this->load->view('vheader');
        $this->load->view('vmenu');
        $this->load->view('user/vlaporankerja', $data);
        $this->load->view('vfooter');
    }
    public function post_laporan()
    {
        $file = 'img_user_' . date('his');
        $this->upload_file('file_upload', $file);
        if (!empty($_FILES["file_upload"]["name"])) {
            $file = $this->upload->data("file_name");
        } else {
            $file = '';
        }
        $id = $this->input->post('id_tugas');
        $data = array(
            'id_usr_tugas' => $id,
            'id_auth' => $this->session->userdata('id_login'),
            'keterangan' => $this->input->post('keterangan'),
            'upload_image' => $file,
        );
        $this->Madmin->create_data('frm_usr_laporan', $data);
        $status = array(
            'status' => 'proses',
        );
        $this->Madmin->update_data('id_user_tugas', $id, $status, 'frm_usr_tugas');
        $this->Madmin->update_data('id_user_tugas', $id, ['status_upload_laporan' => 1], 'frm_usr_tugas');
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('panelpromotor/historitugas');
    }
    function proses_upload_multiple()
    {
        $file = 'img_laporan_' . date('his');
        $this->upload_file('userimg', $file);
        $token = $this->input->post('token_foto');
        $id_laporan = $this->input->post('id_laporan_kerja');
        $nama = $this->upload->data('file_name');
        $data = array(
            'id_laporan' => $id_laporan,
            'token' => $token,
            'file' => $nama,
        );
        $this->Madmin->create_data('usr_image', $data);
    }
    function remove_foto()
    {
        $token = $this->input->post('token');
        $foto = $this->Madmin->get_data('token', $token, 'usr_image');
        $nama_foto = $foto->file;
        if (file_exists($file = './upload/foto/' . $nama_foto)) {
            unlink($file);
        }
        $this->Madmin->delete('token', $token, 'usr_image');
        echo "{}";
    }
    public function getlistimgadmin()
    {
        $id = $this->input->post('id');
        $data['gambar'] = $this->Madmin->get_data_allarray(
            'id_tugas',
            $id,
            'admin_image'
        );
        echo json_encode($data);
    }
    public function upload_file($name, $file)
    {
        $config['upload_path'] = './upload/foto/';
        $config['allowed_types'] = 'gif|jpg|png|ico|jpeg';
        $config['file_name'] = $file;
        $config['overwrite'] = true;
        $config['max_size'] = 4000;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($name)) {
            return $this->upload->data("file_name");
        }
        print_r($this->upload->display_errors());
    }
}
