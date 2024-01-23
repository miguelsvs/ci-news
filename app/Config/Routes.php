<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\News;
use App\Controllers\Pages;
use App\Controllers\Auth;
use App\Controllers\UploadController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Public
$routes->get('news', [News::class, 'index']); 
$routes->get('news/lista',[News::class,'listNews']);



$routes->group('news', ['filter' => 'group:user'], function ($routes) {
    $routes->get('create', [News::class, 'formCreate']);
    $routes->post('create', [News::class, 'create']);      
    $routes->get('formDelete', [News::class, 'formDelete']);  
    $routes->post('delete', [News::class, 'delete']);  
    $routes->get('formDeleteOptions', [News::class, 'formDeleteOptions']);
    $routes->post('deleteOptions', [News::class, 'deleteOptions']);  
    $routes->post('listaDelete', [News::class, 'listaDelete']);  
    $routes->get('bin', [News::class, 'bin']);
    $routes->post('binDelete', [News::class, 'binDelete']);  
    $routes->post('binRestore', [News::class, 'binRestore']);  
    $routes->get('editor', [News::class, 'editor']);
    $routes->post('listaUpdate', [News::class, 'listaUpdate']);
});


$routes->get("login", [Auth::class, "login"],['filter'=>'auth-rates', 'filter'=>'alreadyLogged']);
$routes->get('register', [Auth::class, 'register'],['filter'=>'auth-rates']);
$routes->post('login', [Auth::class, 'check']);
$routes->post('register', [Auth::class, 'save']);
$routes->get('logout', [Auth::class, 'logout']);
$routes->get('profile', [Auth::class, 'profile'], ['filter' => 'group:user']);


$routes->get('news/(:segment)', [News::class, 'show']);



$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

service('auth')->routes($routes);
