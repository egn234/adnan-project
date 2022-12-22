<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\M_user;
use App\Models\M_kategori;

class akun extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();
		$this->account = $this->m_user->getUserById(session()->get('iduser'))[0];
		$this->m_kategori = new M_kategori();
	}

	public function index()
	{	
		$list_dosen = $this->m_user->getAllDosen();

		$dataset = [
			'title' => 'List Akun Dosen',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_dosen' => $list_dosen
		];

		return view('admin/akun/list-dosen', $dataset);
	}

	public function add_proc()
	{
		$dataset = [
		    'username' => $this->request->getPost('username'),
			'nama_lengkap' => $this->request->getPost('nama_lengkap'),
			'nip' => $this->request->getPost('nip'),
			'jabatan' => $this->request->getPost('jabatan'),
			'no_hp' => $this->request->getPost('no_hp'),
			'email' => $this->request->getPost('email'),
			'idgroup' => 3
		];

		$this->m_user->insertUser($dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Menambahkan Akun Baru',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}

	public function edit_proc($iddosen = false)
	{
		$dataset = [
			'username' => $this->request->getPost('username'),
			'nama_lengkap' => $this->request->getPost('nama_lengkap'),
			'nip' => $this->request->getPost('nip'),
			'jabatan' => $this->request->getPost('jabatan'),
			'no_hp' => $this->request->getPost('no_hp'),
			'email' => $this->request->getPost('email')
		];

		$this->m_user->updateDosen($iddosen, $dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Mengubah Data Akun',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
	
	public function hapus_akun($iddosen = false)
	{
		$dosen = $this->m_user->getDosenById($iddosen)[0];

			$this->m_user->deleteUser($iddosen);

			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'User Dihapus',
					'status' => 'success'
				]
			);

			session()->setFlashdata('notif', $alert);

		return redirect()->back();
	}

	public function konfirSwitch()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$kategori = $this->m_user->getDosenById($id)[0];
			$data = ['a' => $kategori];
			echo view('admin/akun/part-kat-mod-switch', $data);
		}
	}

	public function editDosen()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$dosen = $this->m_user->getDosenById($id)[0];
			$data = ['a' => $dosen];
			echo view('admin/akun/part-dosen-mod-edit', $data);
		}
	}
}