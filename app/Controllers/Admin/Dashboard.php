<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\M_user;

class dashboard extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();
		$this->account = $this->m_user->getUserById(session()->get('iduser'))[0];
	}

	public function index()
	{
		$l_dosen = $this->m_user->getDetailDosen();
		$dataset = [
			'title' => 'Dashboard',
			'usertype' => 'Admin',
			'duser' => $this->account,
			'l_dosen' => $l_dosen,
		];

		return view('admin/dashboard', $dataset);
	}
}