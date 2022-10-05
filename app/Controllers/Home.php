<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function dashboard()
    {

        $dataset = [
            'title' => 'Dashboard - Admin'
        ];
        
        return view('dashboard', $dataset);
    }
}
