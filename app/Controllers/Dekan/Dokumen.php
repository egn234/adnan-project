<?php 

namespace App\Controllers\Dekan;

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
		$list_surat = $this->m_surat->getSuratByReview();

		$dataset = [
			'title' => 'List Surat',
			'usertype' => 'Dosen',
			'duser' => $this->account,
			'list_surat' => $list_surat
		];

		return view('dekan/surat/list-surat', $dataset);
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

		return view('dekan/surat/detail-surat', $dataset);
	}

	function revisi_proc($idsurat = false)
	{
		$this->m_surat->setFlagSurat($idsurat, 0);

		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil mengajukan revisi',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}

	function acc_proc($idsurat = false)
	{
		$this->m_surat->setFlagSurat($idsurat, 2);

		$alert = view(
			'partials/notification-alert', 
			[
				'notif_text' => 'Berhasil ACC dokumen',
			 	'status' => 'success'
			]
		);
		
		$data_session = ['notif' => $alert];
		session()->setFlashdata($data_session);
		return redirect()->back();
	}
}