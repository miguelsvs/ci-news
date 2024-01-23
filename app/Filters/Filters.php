<?php namespace Config;

use CodeIgniter\Config\BaseConfig;
use app\Filters\AlreadyLoggedFilter;

class Filters extends BaseConfig
{
   // Makes reading things below nicer,
   // and simpler to change out script that's used.
   public $aliases = [
      'csrf'     => \CodeIgniter\Filters\CSRF::class,
      'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
      'honeypot' => \CodeIgniter\Filters\Honeypot::class,
      'alreadyLogged' => AlreadyLoggedFilter::class
   ];

   // Always applied before every request
   public $globals = [
      'before' => [
         //'honeypot'
         // 'csrf',
      ],
      'after'  => [
         'toolbar',
         //'honeypot'
      ],
   ];

   // Works on all of a particular HTTP method
   // (GET, POST, etc) as BEFORE filters only
   //     like: 'post' => ['CSRF', 'throttle'],
   public $methods = [];

   // List filter aliases and any before/after uri patterns
   // that they should run on, like:
   //    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
   public $filters = [

      
      
      
      /*    SI QUIERES CONFIGURAR AUTO-RATES
      POR DEFECTO SON 10 POR MINUTO
     ]
     'auth-rates' => [
         'limit' => 5,  // Number of requests allowed
         'per'   => MINUTE,  // Time period (e.g., MINUTE, HOUR, DAY)
         'group' => 'auth',  // Identifier for the rate limit group
     ], */
   ];
}