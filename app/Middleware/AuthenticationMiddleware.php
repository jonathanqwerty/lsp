<?php

namespace App\Middleware;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Middleware\BaseMiddleware;

class AuthenticationMiddleware extends BaseMiddleware
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        // Cek apakah pengguna telah login
        if (!$session->isLoggedIn) {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah middleware
    }
}
