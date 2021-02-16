<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paneladmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Madmin');
		$this->load->library('curl');
		if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
			$this->session->sess_destroy();
			redirect('loginadmin', 'refresh');
		}
		if ($this->session->userdata('level') == 'user') {
			redirect('panelpromotor', 'refresh');
		}
	}

	function tambahkredit()
	{
		$func = $this->input->get('func');
		$id_row = $this->input->get('id');
		if ($func == 'updatekredit') {
			$data['getrow'] = $this->Madmin->get_data('id_kredit', $id_row, 'kredit');
			$data['action'] = base_url('paneladmin/update_kredit');
		} else {
			$data['action'] = base_url('paneladmin/create_kredit');
		}
		$data['hasil'] = $this->Madmin->get_data_join3(
			'kredit',
			'mbarang',
			'mpelanggan',
			'kredit.id_barang=mbarang.id_barang',
			'kredit.id_pelanggan=mpelanggan.id_pelanggan',
			'id_kredit',
			'DESC'
		);
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vkredit', $data);
		$this->load->view('vfooter');
	}
	function create_kredit()
	{
		$data = array(
			'id_pelanggan' => $this->input->post('id_pelanggan'),
			'id_barang' => $this->input->post('id_barang'),
			'harga_jual' => $this->input->post('harga_jual'),
			'tenor' => $this->input->post('tenor'),
			'jatuh_tempo' => $this->input->post('jatuh_tempo'),
			'tgl_tagihan' => $this->input->post('tgl_tagihan'),
		);
		$this->Madmin->create_data('kredit', $data);
		$this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
		redirect('paneladmin/tambahkredit');
	}
	public function get_penerima()
	{
		$param = $this->input->get('param');
		$data = $this->Madmin->getpenerima('mpelanggan', 'nama_pel', $param);
		echo json_encode($data);
	}
	public function get_barang()
	{
		$param = $this->input->get('param');
		$data = $this->Madmin->getpenerima('mbarang', 'nama_barang', $param);
		echo json_encode($data);
	}

	function barang()
	{
		$func = $this->input->get('func');
		$id_row = $this->input->get('id');
		if ($func == 'updatebarang') {
			$data['getrow'] = $this->Madmin->get_data('id_barang', $id_row, 'mbarang');
			$data['action'] = base_url('paneladmin/update_barang');
		} else {
			$data['action'] = base_url('paneladmin/create_barang');
		}
		$data['hasil'] = $this->Madmin->get_data_all('mbarang', 'id_barang', 'DESC');
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vbarang', $data);
		$this->load->view('vfooter');
	}
	function create_barang()
	{
		if (!empty($_FILES["foto"]["name"])) {
			$this->upload_foto(time());
			$data = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
				'hpp' => $this->input->post('hpp'),
				'foto' => $this->upload->data("file_name"),
			);
			$this->Madmin->create_data('mbarang', $data);
			$this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
			redirect('paneladmin/barang');
		} else {
			$data = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
				'hpp' => $this->input->post('hpp'),
			);
			$this->Madmin->create_data('mbarang', $data);
			$this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
			redirect('paneladmin/barang');
		}
	}
	function update_barang()
	{
		$id = $this->input->post('id_barang');
		if (!empty($_FILES["foto"]["name"])) {
			$file = $this->Madmin->get_data('id_barang', $id, 'mbarang');
			$nmfile = $file->foto;
			@unlink("./upload/foto/" . $nmfile);
			$this->upload_foto(time());
			$data = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
				'hpp' => $this->input->post('hpp'),
				'foto' => $this->upload->data("file_name"),
			);
			$this->Madmin->update_data('id_barang', $id, $data, 'mbarang');
			$this->session->set_flashdata('msg', 'Berhasil Terupdate!');
			redirect('paneladmin/barang');
		} else {
			$data = array(
				'nama_barang' => $this->input->post('nama_barang'),
				'deskripsi' => $this->input->post('deskripsi'),
				'hpp' => $this->input->post('hpp'),
			);
			$this->Madmin->update_data('id_barang', $id, $data, 'mbarang');
			$this->session->set_flashdata('msg', 'Berhasil Terupdate!');
			redirect('paneladmin/barang');
		}
	}

	public function index()
	{
		$this->pelanggan();
	}

	public function pelanggan()
	{
		$func = $this->input->get('func');
		$id_row = $this->input->get('id');
		if ($func == 'updatepelanggan') {
			$data['getrow'] = $this->Madmin->get_data('id_pelanggan', $id_row, 'mpelanggan');
			$data['action'] = base_url('paneladmin/update_pelanggan');
		} else {
			$data['action'] = base_url('paneladmin/create_pelanggan');
		}
		$data['hasil'] = $this->Madmin->get_data_all('mpelanggan', 'id_pelanggan', 'DESC');
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vpelanggan', $data);
		$this->load->view('vfooter');
	}

	public function create_pelanggan()
	{
		$data = array(
			'nama_pel' => $this->input->post('nama_pel'),
			'no_ktp' => $this->input->post('no_ktp'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'no_wa' => $this->input->post('no_wa'),
			'alamat' => $this->input->post('alamat'),
			'no_saudara' => $this->input->post('no_saudara'),
			'nama_saudara' => $this->input->post('nama_saudara'),
		);
		$this->Madmin->create_data('mpelanggan', $data);
		$this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
		redirect('paneladmin');
	}

	public function update_pelanggan()
	{
		$id = $this->input->post('id_pelanggan');
		$data = array(
			'nama_pel' => $this->input->post('nama_pel'),
			'no_ktp' => $this->input->post('no_ktp'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'no_wa' => $this->input->post('no_wa'),
			'alamat' => $this->input->post('alamat'),
			'no_saudara' => $this->input->post('no_saudara'),
			'nama_saudara' => $this->input->post('nama_saudara'),
		);
		$this->Madmin->update_data('id_pelanggan', $id, $data, 'mpelanggan');
		$this->session->set_flashdata('msg', 'Berhasil Terupdate!');
		redirect('paneladmin');
	}


	function delete()
	{
		$func = $this->input->get('func');
		$id = $this->input->get('id');
		if ($func == 'pelanggan') {
			$this->Madmin->delete('id_pelanggan', $id, 'mpelanggan');
			$this->session->set_flashdata('msg', 'Terhapus!');
			redirect('paneladmin');
		} else if ($func == 'barang') {
			$file = $this->Madmin->get_data('id_barang', $id, 'mbarang');
			$nmfile = $file->foto;
			@unlink("./upload/foto/" . $nmfile);
			$this->Madmin->delete('id_barang', $id, 'mbarang');
			$this->session->set_flashdata('msg', 'Terhapus!');
			redirect('paneladmin/barang');
		} else if ($func == 'kredit') {
			$this->Madmin->delete('id_kredit', $id, 'kredit');
			$this->session->set_flashdata('msg', 'Terhapus!');
			redirect('paneladmin/tambahkredit');
		}
	}

	public function upload_foto($nama)
	{
		$config['upload_path'] = './upload/foto/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name'] = $nama;
		$config['overwrite'] = true;
		$config['max_size'] = 500;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto')) {
			return $this->upload->data("file_name");
		}
		print_r($this->upload->display_errors());
	}
	public function update_tugas()
	{
		$id_tugas = $this->input->post('id_tugas');
		$file = 'img_admin_' . date('his');
		$this->upload_file('file_upload', $file);
		if (!empty($_FILES["file_upload"]["name"])) {
			$file = $this->upload->data("file_name");
		} else {
			$file = $this->input->post('img');
		}
		$data = array(
			'nama_tugas' => $this->input->post('nama_tugas'),
			'kategori_tugas' => $this->input->post('kategori_tugas'),
			'nilai_nominal' => $this->input->post('nominal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'link' => $this->input->post('link'),
			'upload_image' => $file,
			'target' => $this->input->post('target_tugas'),
			'tgl_awal' => $this->input->post('tgl_awal'),
			'tgl_akhir' => $this->input->post('tgl_akhir'),
		);
		$this->Madmin->update_data('id_create_tugas', $id_tugas, $data, 'frm_create_tugas');
		$this->session->set_flashdata('msg', 'Berhasil Terupdate!');
		redirect('paneladmin');
	}

	public function get_profile_customer()
	{
		$customer_id = $this->input->post('id');
		$hasil = $this->post_http_formdata('https://api.olshop.id/v1/customer/info', ['customer_id' => $customer_id]);
		echo $hasil;
	}
	function post_saldo()
	{
		$id_usr_tugas = $this->input->post('id_user_tugas');
		$customer_id = $this->input->post('customer_id');
		$saldo = $this->input->post('amount');
		$earning = $this->input->post('earning');
		$data = array(
			'customer_id' => $customer_id,
			'order_id' => 0,
			'description' => "Penambahan dari promotor system",
			'amount' => $saldo,
			'earning' => $earning,
			'sumber' => 'admin_add_transaction'
		);
		$hasil = $this->post_http_formdata('https://api.olshop.id/v1/transaction/store/balance', $data);
		$row = json_decode($hasil);
		$status = $row->status;
		if ($status) {
			$this->Madmin->update_data('id_user_tugas', $id_usr_tugas, ['kirim_saldo' => 1], 'frm_usr_tugas');
			echo json_encode($row);
		} else {
			echo json_encode($row);
		}
	}

	public function getuserbytype()
	{
		$id = $this->input->post('id');
		$idtugas = $this->input->post('idtugas');
		$this->Madmin->update_data('id_create_tugas', $idtugas, ['is_broadcast' => 1], 'frm_create_tugas');
		$hasil = $this->post_http_formdata('https://api.olshop.id/v1/customer/by/group', ['customer_group_id' => $id]);
		echo $hasil;
	}

	public function post_http_formdata($json_url, $data)
	{
		$ch = curl_init($json_url);
		$options = array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			// CURLOPT_HTTPHEADER => array('Content-type: application/json;'),
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($data),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public function detailverif()
	{
		$id = $this->input->get('id');
		$data['hasil'] = $this->Madmin->get_data_allarray(
			'id_usr_tugas',
			$id,
			'frm_usr_laporan'
		);
		if ($data['hasil'] != null) {
			$id_auth = $data['hasil'][0]->id_auth;
			$infouser = $this->post_http_formdata('https://api.olshop.id/v1/customer/info', ['customer_id' => $id_auth]);
			$data['userinfo'] = json_decode($infouser);
		} else {
			$data['userinfo'] = '';
		}

		$data['action'] = base_url('paneladmin/update_status');
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vdetailverif', $data);
		$this->load->view('vfooter');
	}

	public function getimagedetail()
	{
		$id = $this->input->post('id');
		$data['gambar'] = $this->Madmin->get_data_allarray(
			'id_laporan',
			$id,
			'usr_image'
		);
		echo json_encode($data);
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
	public function proses_upload_multiple()
	{
		$file = 'img_tugas_' . date('his');
		$this->upload_file('adminimg', $file);
		$token = $this->input->post('token_foto');
		$id_tugas = $this->input->post('id_tugas');
		$nama = $this->upload->data('file_name');
		$data = array(
			'id_tugas' => $id_tugas,
			'token' => $token,
			'file' => $nama,
		);
		$this->Madmin->create_data('admin_image', $data);
	}
	function remove_foto()
	{
		$token = $this->input->post('token');
		$foto = $this->Madmin->get_data('token', $token, 'admin_image');
		$nama_foto = $foto->file;
		if (file_exists($file = './upload/foto/' . $nama_foto)) {
			unlink($file);
		}
		$this->Madmin->delete('token', $token, 'admin_image');
		echo "{}";
	}
	public function getlaporandetail()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->Madmin->get_data_allarray(
			'id_usr_tugas',
			$id,
			'frm_usr_laporan'
		);
		echo json_encode($data);
	}

	public function update_status()
	{
		$id_usr_tugas = $this->input->post('id_user_tugas');
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan');
		$nama = $this->input->post('nama_promotor');
		$hp = $this->input->post('hp');
		$data = array(
			'status' => $status,
			'keterangan' => $keterangan
		);
		$namatugas = $this->Madmin->get_data_join_str(
			'id_user_tugas',
			$id_usr_tugas,
			'frm_usr_tugas',
			'frm_create_tugas',
			'frm_usr_tugas.id_tugas=frm_create_tugas.id_create_tugas'
		);
		$laporan = $this->Madmin->get_data_allarray(
			'id_usr_tugas',
			$id_usr_tugas,
			'frm_usr_laporan'
		);
		$listlap = array();
		foreach ($laporan as $val) {
			array_push($listlap, "*" . $val->keterangan . "*");
		}
		$lap = implode(", ", $listlap);

		$this->Madmin->update_data('id_user_tugas', $id_usr_tugas, $data, 'frm_usr_tugas');
		if ($status == 'selesai') {
			$pesan = "*Konfirmasi Laporan Tugas Promotor*

	Halo Kak *{$nama}*, Kami mau informasikan bahwa Laporan Tugas Kakak dengan Judul Tugas : *{$namatugas[0]->nama_tugas}*
			
	Dengan keterangan laporan:
		";

			$lanjutan = " 
			
	Kami nyatakan:
	*DITERIMA*

	Dengan Fee komisi yang didapatkan sebesar : *Rp. {$keterangan}*

	Lebih lengkap silakan cek akun promotor dan akun olshop.id Kakak

	Terimakasih.
	Admin
			
	*Note:*
	Mohon tidak membalas pesan ini";
			$pesanlengkap = $pesan . $lap . $lanjutan;
			$this->kirimPesan($pesanlengkap, $hp, $nama);
		} else {
			$pesan = "*Konfirmasi Laporan Tugas Promotor*

	Halo Kak *{$nama}*, Kami mau informasikan bahwa Laporan Tugas Kakak dengan Judul Tugas : *{$namatugas[0]->nama_tugas}*
					
	Dengan keterangan laporan:
		";

			$lanjutan = " 
					
	Kami nyatakan:
	*DITOLAK*
		
	Dengan Alasan: *{$keterangan}*
	
	Silahkan perbaiki dan submit kembali laporannya di panel promotor
		
	Terimakasih.
	Admin
				
	*Note:*
	Mohon tidak membalas pesan ini";
			$pesanlengkap = $pesan . $lap . $lanjutan;
			$this->kirimPesan($pesanlengkap, $hp, $nama);
		}

		$this->session->set_flashdata('msg', 'Berhasil Terverifikasi!');
		redirect('paneladmin/verifikasitugas');
	}

	public function broadcastwa()
	{
		$nohp = $this->input->post('hp');
		$pesan = "
		Informasi tugas baru dari promotor.olshop.id,
		silahkan masuk untuk melihat deskripsi
		";
		foreach ($nohp as $val) {
			$this->kirimPesan($pesan, $val, "Boot Promotor");
		}
		echo json_encode("");
	}

	public function create_tugas()
	{
		$file = 'img_admin_' . date('his');
		$this->upload_file('file_upload', $file);
		if (!empty($_FILES["file_upload"]["name"])) {
			$file = $this->upload->data("file_name");
		} else {
			$file = '';
		}
		$target = $this->input->post('target_tugas');
		$data = array(
			'nama_tugas' => $this->input->post('nama_tugas'),
			'kategori_tugas' => $this->input->post('kategori_tugas'),
			'nilai_nominal' => $this->input->post('nominal'),
			'deskripsi' => $this->input->post('deskripsi'),
			'link' => $this->input->post('link'),
			'upload_image' => $file,
			'target' => $target,
			'tgl_awal' => $this->input->post('tgl_awal'),
			'tgl_akhir' => $this->input->post('tgl_akhir'),
		);
		$this->Madmin->create_data('frm_create_tugas', $data);
		$this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
		redirect('paneladmin');
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

	function kirimPesan($pesan, $no_hp, $nama)
	{
		$x_api_key = 'd5f05f8232ef7c86fd2a6ac963edcd0f3a13b8b1';

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.autochat.id/api/message/send",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => array(
				'phone' => $no_hp,
				'name' => $nama,
				'message' => $pesan
			),
			CURLOPT_HTTPHEADER => array(
				"x-api-key: $x_api_key"
			),
		));

		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
}
