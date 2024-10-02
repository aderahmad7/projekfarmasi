<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PasienModel;
use App\Models\StatCourseModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function __construct()
    {
        helper('cookie');
    }
    public function index()
    {
        $session = session();
        $session->destroy();

        return view('login');
    }

    public function validasi()
    {
        if ($this->request->getPost('submit') !== null) {
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();

                $username = esc($this->request->getPost('username'));
                $password = esc($this->request->getPost('password'));
                $rememberMe = esc($this->request->getPost('remember_me'));

                if ($userModel->cekUser($username)) {
                    return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
                }

                $pass_user = $userModel->getData($username)['password'];

                if (!password_verify($password, $pass_user)) {
                    return redirect()->back()->withInput()->with('error', 'Nama pengguna atau kata sandi tidak valid.');
                }

                $id_user = $userModel->getData($username)['id'];

                $session_data = [
                    'id_user' => $id_user,
                    'username' => $username,
                    'logged_in' => true,
                ];

                if ($rememberMe) {
                    $cookie_data = $username . '|' . $id_user;
                    $cookie = [
                        'name' => 'remember_me',
                        'value' => $cookie_data,
                        'expire' => 86400 * 30, // 30 days
                        'secure' => false,     // Set ke true jika menggunakan HTTPS
                        'httponly' => true,    // Optional: Mencegah akses dari JavaScript
                    ];
                    set_cookie($cookie);
                } else {
                    session()->set($session_data);
                }

                $role = $userModel->getData($username)['role'];

                if ($role === 'pasien') {
                    $statModel = new StatCourseModel();
                    $pasienModel = new PasienModel();
                    $id_pasien = $pasienModel->getDataID($id_user)["id"];
                    $statPretest = $statModel->getData($id_pasien)['pretest'];
                    if ($statPretest === 'belum') {
                        return redirect()->to('/pretest')->with('success', 'Login successful.');
                    } else {

                        return redirect()->to('/pasien')->with('success', 'Login successful.');
                    }
                } elseif ($role === 'dokter') {
                    return redirect()->to('/dokter')->with('success', 'Login successful.');
                } elseif ($role === 'admin') {
                    # code...
                }
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        delete_cookie('remember_me');
        return redirect()->to('/login');
    }

    public function lupa_password()
    {
        return view('lupa-password');
    }
}
