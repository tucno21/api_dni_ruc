<?php

namespace App\Controller\FrontView;

use System\Controller;

/**
 * controlador de la web
 */
class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Home Mini Framework',
        ]);
    }
}
