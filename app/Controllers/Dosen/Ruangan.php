<?php 

namespace App\Controllers\Dosen;

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
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan
		];

		return view('dosen/ruangan/list-ruangan', $dataset);
	}
	
	//Daftar Peminjaman Ruangan
	
	public function dokumen_peminjaman()
	{	
		$list_ruangan = $this->m_ruangan->getAllPinjamanDosen(session()->get('iduser'));

		$dataset = [
			'title' => 'List Peminjaman Ruangan',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan,
			'ruangan'      => $this->m_ruangan->getAllActiveRuangan()
		];
		return view('dosen/ruangan/daftar-peminjaman', $dataset);
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
			echo view('dosen/ruangan/part-check-mod-keterangan', $data);
		}
	}
	
	public function deletePinjaman()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$ruangan = $this->m_ruangan->getPeminjamanById($id)[0];
			$data = ['a' => $ruangan];
			echo view('dosen/ruangan/part-ruangan-mod-switch', $data);
		}
	}
	
	public function hapus_pinjaman($idriwayat_pinjaman = false)
	{
		$ruangan = $this->m_ruangan->getPeminjamanById($idriwayat_pinjaman)[0];
			
			$this->m_ruangan->deletePinjaman($idriwayat_pinjaman);
			$alert = view('partials/notification-alert', 
				[
					'notif_text' => 'Peminjaman Dihapus',
				 	'status' => 'danger'
				]
			);
			session()->setFlashdata('notif', $alert);

		return redirect()->back();
	}
	
	public function riwayat_peminjaman()
	{	
		$list_ruangan = $this->m_ruangan->getAllRiwayatPinjamanDosen(session()->get('iduser'));

		$dataset = [
			'title' => 'Riwayat Peminjaman Ruangan',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan,
			'total' => $this->m_ruangan->getTotalPinjamanDosen(session()->get('iduser')),
			'pending' => $this->m_ruangan->getPendingPinjamanDosen(session()->get('iduser')),
			'approval' => $this->m_ruangan->getApprovalPinjamanDosen(session()->get('iduser')),
			'decline' => $this->m_ruangan->getDeclinePinjamanDosen(session()->get('iduser'))
		];

		return view('dosen/ruangan/riwayat_peminjaman', $dataset);
	}
	
	public function checkRuangan()
	{	
		$list_ruangan = $this->m_ruangan->getAllPinjamanRuanganEksisting();

		$dataset = [
			'title' => 'Peminjaman Ruangan Terkini',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_ruangan' => $list_ruangan,
		];

		return view('dosen/ruangan/peminjaman_eksisting', $dataset);
	}
}