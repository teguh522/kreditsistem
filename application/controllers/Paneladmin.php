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
	function laporan()
	{
		$data['action'] = base_url('paneladmin/cari_laporan_action');
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vcarilaporan', $data);
		$this->load->view('vfooter');
	}
	function cari_laporan_action()
	{
		$id_barang = $this->input->get('id_barang');
		$data['hasil'] = $this->Madmin->get_data_join4where(
			'kredit',
			'mbarang',
			'mpelanggan',
			'totalangsuran',
			'id_barang',
			$id_barang
		);
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vtampildata', $data);
		$this->load->view('vfooter');
	}
	function angsuran()
	{
		$data['hasil'] = $this->Madmin->get_data_join4(
			'kredit',
			'mbarang',
			'mpelanggan',
			'totalangsuran'
		);
		$this->load->view('vheader');
		$this->load->view('vmenu');
		$this->load->view('admin/vangsuran', $data);
		$this->load->view('vfooter');
	}

	function create_angsuran()
	{
		$id = $this->input->post('id_kredit');
		$nominal = $this->input->post('jumlah_angsuran');
		$data = array(
			'id_kredit' => $id,
			'jumlah_angsuran' => $nominal,
		);
		$this->Madmin->create_data('angsuran', $data);
		echo json_encode("");
	}
	function getangsuran()
	{
		$param = $this->input->post('id');
		$data = $this->Madmin->get_data_allarray('id_kredit', $param, 'angsuran');
		echo json_encode($data);
	}

	function tambahkredit()
	{
		$func = $this->input->get('func');
		$id_row = $this->input->get('id');
		if ($func == 'updatekredit') {
			$data['getrow'] = $this->Madmin->get_data_row(
				'id_kredit',
				$id_row,
				'kredit',
				'mbarang',
				'mpelanggan',
				'kredit.id_barang=mbarang.id_barang',
				'kredit.id_pelanggan=mpelanggan.id_pelanggan',
			);
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
	function update_kredit()
	{
		$id = $this->input->post('id_kredit');
		$data = array(
			'id_pelanggan' => $this->input->post('id_pelanggan'),
			'id_barang' => $this->input->post('id_barang'),
			'harga_jual' => $this->input->post('harga_jual'),
			'tenor' => $this->input->post('tenor'),
			'jatuh_tempo' => $this->input->post('jatuh_tempo'),
			'tgl_tagihan' => $this->input->post('tgl_tagihan'),
		);
		$this->Madmin->update_data('id_kredit', $id, $data, 'kredit');
		$this->session->set_flashdata('msg', 'Berhasil Terupdate!');
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
