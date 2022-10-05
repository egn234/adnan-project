<?php 

namespace App\Controllers\Dekan;

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
		$dataset = [
			'title' => 'Dashboard',
			'usertype' => 'Dekan',
			'duser' => $this->account
		];

		return view('dekan/dashboard', $dataset);
	}
}