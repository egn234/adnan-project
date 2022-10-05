<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\M_user;

class dashboard extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();	
	}

	public function index()
	{
		$dataset = [
			'title' => 'Dashboard',
			'usertype' => 'Admin'
		];

		return view('admin/dashboard', $dataset);
	}
}