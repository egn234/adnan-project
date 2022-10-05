<?php 

namespace App\Controllers\Dosen;

use CodeIgniter\Controller;
use App\Models\M_user;
use App\Models\M_surat;
use App\Models\M_kategori;

class Dokumen extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();
		$this->account = $this->m_user->getUserById(session()->get('iduser'))[0];
		$this->m_surat = new M_surat();
		$this->m_kategori = new M_kategori();
	}

	public function index()
	{
		$list_surat = $this->m_surat->getSuratByIdUser($this->account->iduser);
		$list_kategori = $this->m_kategori->getAllKategori();

		$dataset = [
			'title' => 'List Surat',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_surat' => $list_surat,
			'list_kategori' => $list_kategori
		];

		return view('dosen/surat/list-surat', $dataset);
	}

	public function add_proc()
	{	
		$idkategori = $this->request->getPost('idkategori');
		if ($idkategori == "") {
			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Gagal mengupload dokumen: Pilih kategori dokumen terlebih dahulu',
				 	'status' => 'warning'
				]
			);
			
			$data_session = ['notif' => $alert];
			session()->setFlashdata($data_session);
			return redirect()->back();
		}

		$doc = $this->request->getFile('file_dosen');

		if ($doc->isValid()) {
			$newName = $this->request->getPost('judul_surat') . '_' . $doc->getRandomName();
			$doc->move(ROOTPATH . 'public/uploads/user/' . $this->account->username . '/doc/', $newName);
			$file_dosen = $doc->getName();
		}else{
			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Gagal mengupload dokumen: file tidak sesuai',
				 	'status' => 'warning'
				]
			);
			
			$data_session = ['notif' => $alert];
			session()->setFlashdata($data_session);
			return redirect()->back();
		}

		$dataset = [
			'judul_surat' => $this->request->getPost('judul_surat'),
			'tanggal_upload' => date('Y-m-d H:i:s'),
			'flag' => 1,
			'file_dosen' => $file_dosen,
			'idkategori' => $idkategori,
			'iduser_dosen' => $this->account->iduser
		];

		$this->m_surat->insertSurat($dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Mengupload Dokumen',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}

	public function revisi_proc()
	{
		$idsurat = $this->request->getPost('idsurat');
		$dsurat = $this->m_surat->getSuratById($idsurat)[0];

		$idkategori = $this->request->getPost('idkategori');

		if ($idkategori == "") {
			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Gagal mengupload dokumen: Pilih kategori dokumen terlebih dahulu',
				 	'status' => 'warning'
				]
			);
			
			$data_session = ['notif' => $alert];
			session()->setFlashdata($data_session);
			return redirect()->back();
		}

		$doc = $this->request->getFile('file_dosen');

		if ($doc->isValid()) {
			
			unlink(ROOTPATH . "public/uploads/user/" . $this->account->username . "/doc/" . $dsurat->file_dosen );

			$newName = $this->request->getPost('judul_surat') . '_' . $doc->getRandomName();
			$doc->move(ROOTPATH . 'public/uploads/user/' . $this->account->username . '/doc/', $newName);
			$file_dosen = $doc->getName();
		}else{
			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Gagal mengupload dokumen: file tidak sesuai',
				 	'status' => 'warning'
				]
			);
			
			$data_session = ['notif' => $alert];
			session()->setFlashdata($data_session);
			return redirect()->back();
		}

		$dataset = [
			'judul_surat' => $this->request->getPost('judul_surat'),
			'tanggal_revisi' => date('Y-m-d H:i:s'),
			'flag' => 1,
			'file_dosen' => $file_dosen,
			'idkategori' => $idkategori,
			'iduser_dosen' => $this->account->iduser
		];

		$this->m_surat->updateSurat($idsurat, $dataset);
		
		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil Revisi Dokumen',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}

	public function revisi_update()
	{
		if ($_POST['rowid']) {
			$id = $_POST['rowid'];
			
			$surat = $this->m_surat->getSuratById($id)[0];
			$kategori = $this->m_kategori->getAllKategori();
			$data = [
				'a' => $surat,
				'kat' => $kategori,
			];
			echo view('dosen/surat/part-surat-mod-revisi', $data);
		}
	}
}