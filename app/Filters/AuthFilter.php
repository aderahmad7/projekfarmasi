<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('logged_in') || session()->get('logged_in') !== true) {
            helper('cookie');
            // Cek cookie untuk autentikasi otomatis
            $remember_me_cookie = get_cookie('remember_me');

            if ($remember_me_cookie) {
                list($username, $id_user) = explode('|', $remember_me_cookie);
                $userModel = new \App\Models\UserModel();

                if (!$userModel->cekUser($username)) {
                    // Jika user ada di database, set session
                    $session_data = [
                        'id_user' => $id_user,
                        'username' => $username,
                        'logged_in' => true,
                    ];
                    session()->set($session_data);
                    return; // Autentikasi berhasil
                }
            }

            // Jika autentikasi gagal, redirect ke halaman login
            return redirect()->to('/login')->with('error', 'You need to login first.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
