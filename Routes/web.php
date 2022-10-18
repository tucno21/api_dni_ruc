<?php

use System\Route;
use App\Controller\ApiController;
use App\Controller\FrontView\HomeController;

/**
 * cargar el autoloader de composer Y la configuracion de la aplicacion
 */
require_once dirname(__DIR__) . '/System/Autoload.php';

//  FrontView
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/consulta', [ApiController::class, 'index'])->name('consulta');
