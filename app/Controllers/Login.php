<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_user;

class login extends Controller
{

	function __construct()
	{
		$this->m_user = new M_user();	
	}

	public function index()
	{
		$dataset = [
			'title' => 'Login - SB Admin'
		];

		return view('login-page', $dataset);
	}
	
	public function index2()
	{
		$dataset = [
			'title' => 'Login - SB Admin'
		];

		return view('login-page', $dataset);
	}

	public function login_proc()
	{
		$username = $this->request->getPost('username');

		$cek_username = $this->m_user->countUserByUsername($username)[0]->hitung;

		if ($cek_username != 0) {
			
			$user = $this->m_user->getUserByUsername($username)[0];
			
			$userdata = [
				'iduser' => $user->iduser,
				'username' => $user->username,
				'idgroup' => $user->idgroup,
				'logged_in' => TRUE
			];
			
			session()->set($userdata);
			
			if($user->idgroup == 1){
				return redirect()->to('admin/dashboard');
			}
			elseif($user->idgroup == 2){
				return redirect()->to('dekan/dashboard');
			}
			elseif($user->idgroup == 3){
				return redirect()->to('dosen/dashboard');
			}

		}else{
			$alert = view(
				'partials/notification-alert', 
				[
					'notif_text' => 'Username tidak terdaftar',
				 	'status' => 'danger'
				]
			);
		
			$data_session = ['notif' => $alert];
			session()->setFlashdata($data_session);

			return redirect()->back();
		}
	}

	function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}