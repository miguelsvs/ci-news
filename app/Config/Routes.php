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

$routes->get('news', [News::class, 'index']); 
$routes->get('news/create', [News::class, 'formCreate']);
$routes->post('news/create', [News::class, 'create']);      
$routes->get('news/formDelete', [News::class, 'formDelete']);  
$routes->post('news/delete', [News::class, 'delete']);  
$routes->get('news/formDeleteOptions', [News::class, 'formDeleteOptions']);
$routes->post('news/deleteOptions', [News::class, 'deleteOptions']);  
$routes->get('news/lista',[News::class,'listNews']);
$routes->post('news/listaDelete', [News::class, 'listaDelete']);  
$routes->get('news/bin',[News::class,'bin']);
$routes->post('news/binDelete', [News::class, 'binDelete']);  
$routes->post('news/binRestore', [News::class, 'binRestore']);  
$routes->get('news/editor', [News::class, 'editor']);
$routes->post('news/listaUpdate', [News::class, 'listaUpdate']);  
$routes->get('news/editor', [News::class, 'editor']);

$routes->get("login", [Auth::class, "login"], ['filter' => 'AlreadyLoggedInFilter']);
$routes->get('register', [Auth::class, 'register']); 
$routes->post('login', [Auth::class, 'check']);
$routes->post('register', [Auth::class, 'save']);
$routes->get('logout', [Auth::class, 'logout']);

 $routes->get('news/(:segment)', [News::class, 'show']);


$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

service('auth')->routes($routes);
