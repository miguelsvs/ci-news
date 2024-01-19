<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AlreadyLoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if(session()->has('loggedUserId') && $request->uri->getPath() !== 'news/lista') {
           log_message("info","Redirecting because user is logged in"); // Add logging
            return redirect("news/lista");
        }
/*         if(session()->has('loggedUserId')) {
            return redirect("news/lista");
        } */
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }


}