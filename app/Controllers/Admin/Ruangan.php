<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\M_user;
use App\Models\M_ruangan;

class ruangan extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();
		$this->account = $this->m_user->getUserById(session()->get('iduser'))[0];
		$this->m_ruangan = new M_ruangan();
	}

	public function index()
	{	
		$list_ruangan = $this->m_ruangan->getAllRuangan();

		$dataset = [
			'title' => 'List Ruangan',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan
		];

		return view('admin/ruangan/list-ruangan', $dataset);
	}
	
	public function add_proc()
	{
		$dataset = [
			'nama_ruangan' => $this->request->getPost('nama_ruangan'),
			'flag' => 1
		];

		$this->m_ruangan->insertRuangan($dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Menambahkan Ruangan Baru',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
	
	public function edit_proc($idruangan = false)
	{
		$dataset = [
			'nama_ruangan' => $this->request->getPost('nama_ruangan'),
		];

		$this->m_ruangan->updateRuangan($idruangan, $dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Mengubah Ruangan',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
	
	public function flag_switch($idruangan = false)
	{
		$ruangan = $this->m_ruangan->getRuanganById($idruangan)[0];

		if ($ruangan->flag == 0) {
			
			$this->m_ruangan->aktifkanRuangan($idruangan);
			$alert = view('partials/notification-alert', 
				[
					'notif_text' => 'Ruangan Diaktifkan',
				 	'status' => 'success'
				]
			);
			
			session()->setFlashdata('notif', $alert);

		}elseif ($ruangan->flag == 1) {

			$this->m_ruangan->nonaktifkanRuangan($idruangan);

			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Ruangan Dinonaktifkan',
					'status' => 'success'
				]
			);

			session()->setFlashdata('notif', $alert);
		}

		return redirect()->back();
	}

	public function konfirSwitch()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getRuanganById($id)[0];
			$data = ['a' => $ruangan];
			echo view('admin/ruangan/part-ruangan-mod-switch', $data);
		}
	}

	public function editRuangan()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getRuanganById($id)[0];
			$data = ['a' => $ruangan];
			echo view('admin/ruangan/part-ruangan-mod-edit', $data);
		}
	}
	
	//Daftar Peminjaman Ruangan
	
	public function dokumen_peminjaman()
	{	
		$list_ruangan = $this->m_ruangan->getAllPinjamanRuangan();

		$dataset = [
			'title' => 'List Peminjaman Ruangan',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan,
			'dataUser'     => $this->m_user->getAllUser(),
			'ruangan'      => $this->m_ruangan->getAllActiveRuangan()
		];

		return view('admin/ruangan/daftar-peminjaman', $dataset);
	}
	
	public function add_peminjaman_proc()
	{
		$dataset = [
		    'iduser' => $this->request->getPost('iduser'),
			'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
			'jam_mulai_peminjaman' => $this->request->getPost('jam_mulai_peminjaman'),
			'jam_mulai_peminjaman' => $this->request->getPost('jam_mulai_peminjaman'),
			'jam_selesai_peminjaman' => $this->request->getPost('jam_selesai_peminjaman'),
			'idruangan' => $this->request->getPost('idruangan'),
			'keterangan' => $this->request->getPost('keterangan'),
			'flag' => 0
		];

		$this->m_ruangan->insertPeminjaman($dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Menambahkan Ruangan Baru',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
	
	public function checkKeterangan()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getPeminjamanById($id)[0];
			$data = ['a' => $ruangan];
			echo view('admin/ruangan/part-check-mod-keterangan', $data);
		}
	}
	
	public function konfirSwitch2()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getPeminjamanById($id)[0];
			$data = ['a' => $ruangan];
			echo view('admin/ruangan/part-ruangan-mod-switch2', $data);
		}
	}
	
	public function flag_aktif($idriwayat_pinjaman = false)
	{
		$ruangan = $this->m_ruangan->getPeminjamanById($idriwayat_pinjaman)[0];
			
			$this->m_ruangan->approvalRuangan($idriwayat_pinjaman);
			$alert = view('partials/notification-alert', 
				[
					'notif_text' => 'Ruangan Diapproval',
				 	'status' => 'success'
				]
			);
			session()->setFlashdata('notif', $alert);

		return redirect()->back();
	}
	
	public function konfirSwitch3()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getPeminjamanById($id)[0];
			$data = ['a' => $ruangan];
			echo view('admin/ruangan/part-ruangan-mod-switch3', $data);
		}
	}
	
	public function flag_nonaktif($idriwayat_pinjaman = false)
	{
		$ruangan = $this->m_ruangan->getPeminjamanById($idriwayat_pinjaman)[0];
			
			$this->m_ruangan->declineRuangan($idriwayat_pinjaman);
			$alert = view('partials/notification-alert', 
				[
					'notif_text' => 'Ruangan Diapproval',
				 	'status' => 'success'
				]
			);
			session()->setFlashdata('notif', $alert);

		return redirect()->back();
	}
	
	public function riwayat_peminjaman()
	{	
		$list_ruangan = $this->m_ruangan->getAllRiwayatRuangan();

		$dataset = [
			'title' => 'Riwayat Peminjaman Ruangan',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan,
			'dataUser'     => $this->m_user->getAllUser(),
			'ruangan'      => $this->m_ruangan->getAllActiveRuangan()
		];

		return view('admin/ruangan/riwayat_peminjaman', $dataset);
	}
}