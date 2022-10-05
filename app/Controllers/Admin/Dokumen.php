<?php 

namespace App\Controllers\Admin;

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
		$list_surat = $this->m_surat->getSuratByAcc();

		$dataset = [
			'title' => 'List Surat',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'list_surat' => $list_surat
		];

		return view('admin/surat/list-surat', $dataset);
	}

	public function detail($idsurat = false)
	{
		$detail_surat = $this->m_surat->getSuratById($idsurat)[0];
		
		$dataset = [
			'title' => 'Detail Dokumen',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'detail_surat' => $detail_surat
		];

		return view('admin/surat/detail-surat', $dataset);
	}

	public function sign_document($idsurat = false)
	{
		$judul_surat = $this->request->getPost('judul_surat');
		$dsurat = $this->m_surat->getSuratById($idsurat)[0];

		$doc = $this->request->getFile('file_sekpem');

		if ($doc->isValid()) {
			$newName = 'signed_' . $this->request->getPost('judul_surat') . '_' . $doc->getRandomName();
			$doc->move(ROOTPATH . 'public/uploads/user/' . $dsurat->username . '/doc/', $newName);
			$file_sekpem = $doc->getName();
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
			'tanggal_acc' => date('Y-m-d H:i:s'),
			'flag' => 3,
			'file_sekpem' => $file_sekpem
		];

		$this->m_surat->updateSurat($idsurat, $dataset);

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
}