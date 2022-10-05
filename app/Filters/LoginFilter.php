<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
	    if(session()->get('logged_in')){
	    	$idgroup = session()->get('idgroup');

	    	if ($idgroup == 1) {
	    		return redirect()->to('admin/dashboard');
	    	}

	    	if ($idgroup == 2) {
	    		return redirect()->to('dekan/dashboard');
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