<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Wallpaper extends BaseController
{
    public function index()
    {
        
        $wallpaper = $this->wallpaper->findAll();

        return view('layout', $wallpaper);
    }
}
