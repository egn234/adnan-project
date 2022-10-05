<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DekanFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		if(!session()->get('logged_in')){
			$alert = '
				<div class="alert alert-danger text-center mb-4 mt-4 pt-2" role="alert">
					Session habis
				</div>
			';

			session()->setFlashdata('notif', $alert);
			return redirect()->to('/');

	    }else{
	    	$idgroup = session()->get('idgroup');

	    	if ($idgroup == 1) {
	    		return redirect()->to('admin/dashboard');
	    	}

	    	if ($idgroup == 3) {
	    		return redirect()->to('dosen/dashboard');
	    	}
	    }        
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}