<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\M_user;
use App\Models\M_kategori;

class kategori extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();
		$this->account = $this->m_user->getUserById(session()->get('iduser'))[0];
		$this->m_kategori = new M_kategori();
	}

	public function index()
	{	
		$list_kategori = $this->m_kategori->getAllKategori();

		$dataset = [
			'title' => 'List Kategori',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_kategori' => $list_kategori
		];

		return view('admin/kat/list-kategori', $dataset);
	}

	public function add_proc()
	{
		$dataset = [
			'nama_kategori' => $this->request->getPost('nama_kategori'),
			'keterangan' => $this->request->getPost('keterangan'),
			'flag' => 1
		];

		$this->m_kategori->insertKategori($dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Menambahkan Kategori Baru',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}

	public function edit_proc($idkategori = false)
	{
		$dataset = [
			'nama_kategori' => $this->request->getPost('nama_kategori'),
			'keterangan' => $this->request->getPost('keterangan')
		];

		$this->m_kategori->updateKategori($idkategori, $dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Mengubah Kategori',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
	
	public function flag_switch($idkategori = false)
	{
		$kategori = $this->m_kategori->getKategoriById($idkategori)[0];

		if ($kategori->flag == 0) {
			
			$this->m_kategori->aktifkanKategori($idkategori);
			$alert = view('partials/notification-alert', 
				[
					'notif_text' => 'User Diaktifkan',
				 	'status' => 'success'
				]
			);
			
			session()->setFlashdata('notif', $alert);

		}elseif ($kategori->flag == 1) {

			$this->m_kategori->nonaktifkanKategori($idkategori);

			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'User Dinonaktifkan',
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
			$kategori = $this->m_kategori->getKategoriById($id)[0];
			$data = ['a' => $kategori];
			echo view('admin/kat/part-kat-mod-switch', $data);
		}
	}

	public function editKategori()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			$kategori = $this->m_kategori->getKategoriById($id)[0];
			$data = ['a' => $kategori];
			echo view('admin/kat/part-kat-mod-edit', $data);
		}
	}
}