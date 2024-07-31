<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PasienModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pasien extends BaseController
{
    public function __construct()
    {
        helper('cookie');
        // Cek autentikasi di konstruktor
        $this->cekAuth();
    }

    private function cekAuth()
    {
        // Cek session
        if (session()->has('logged_in') || session()->get('logged_in') === true) {
            return true;
        }

        // Cek cookie
        $remember_me_cookie = get_cookie('remember_me');

        if ($remember_me_cookie) {
            list($username, $id_user) = explode('|', $remember_me_cookie);

            $userModel = new UserModel();

            if (!$userModel->cekUser($username)) {
                $session_data = [
                    'id_user' => $id_user,
                    'username' => $username,
                    'logged_in' => true,
                ];
                session()->set($session_data);
                return;
            }
        }
        return redirect()->to('/login');
    }

    public function index()
    {
        $pasienModel = new PasienModel();
        $userModel = new UserModel();
        $courseModel = new \App\Models\CourseModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');

        $userData = $userModel->getData($username);
        $pasienData = $pasienModel->getDataID($idUser);
        $data = [
            "role" => $userData["role"],
            "nama" => $userData["nama"],
            "gender" => $userData["gender"],
            "usia" => $userData["usia"],
            "no_hp" => $userData["no_hp"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
            "pekerjaan" => $pasienData["pekerjaan"],
            "riwayat" => $pasienData["riwayat"],
            "courses" => $courseModel->findAll()
        ];

        return view('pasien/laman_utama', $data);
    }

    public function setperson()
    {
        $pasienModel = new PasienModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $pasienData = $pasienModel->getDataID($idUser);
        $data = [
            "id" => $pasienData["id"],
            "username" => $userData["username"],
            "nama" => $userData["nama"],
            "gender" => $userData["gender"],
            "usia" => $userData["usia"],
            "no_hp" => $userData["no_hp"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
            "pekerjaan" => $pasienData["pekerjaan"],
            "riwayat" => $pasienData["riwayat"],
        ];

        return view('pasien/personal-setting', $data);
    }

    public function ubah_profil()
    {
        $pasienModel = new PasienModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $id_pasien = esc($this->request->getPost('id'));

        $rules = [
            'foto' => [
                'label' => 'Image File',
                'rules' => 'permit_empty|is_image[foto]|max_size[foto,5120]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'assets/images/learning', $newName);
            $filePath = 'assets/images/learning/' . $newName;
        } else {
            $filePath = null; // No file uploaded
        }


        $dataUser = [
            "nama" => esc($this->request->getPost('nama')),
            "gender" => esc($this->request->getPost('gender')),
            "usia" => esc($this->request->getPost('usia')),
            "no_hp" => esc($this->request->getPost('no-hp')),
        ];

        if ($filePath) {
            $dataUser["foto"] = $filePath; // Only update foto if a new file is uploaded
        }
        $dataPasien = [
            "riwayat" => esc($this->request->getPost('riwayat')),
            "pekerjaan" => esc($this->request->getPost('pekerjaan')),
        ];

        if ($pasienModel->update($id_pasien, $dataPasien) && $userModel->update($idUser, $dataUser)) {
            return redirect()->to('pasien')->with('success', 'Update successful.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Update failed. Please try again.');
        }
    }

    public function set_akun()
    {
        $userModel = new UserModel();
        $username = session()->get('username');
        $userData = $userModel->getData($username);

        $data = [
            "email" => $userData["email"]
        ];

        return view('pasien/account-security', $data);
    }

    public function ubah_sandi()
    {
        $userModel = new UserModel();
        $username = session()->get('username');
        $password = $userModel->getData($username)["password"];

        $rules = [
            'curr-pass' => [
                'label' => 'Current Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The current password field is required.'
                ]
            ],
            'new-pass' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/(?=.*[A-Z])(?=.*\d).{8,}/]',
                'errors' => [
                    'regex_match' => 'Password must be at least 8 characters long and contain at least one uppercase letter and one number.'
                ]
            ],
            're-new-pass' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[new-pass]',
                'errors' => [
                    'matches' => 'The password confirmation does not match the password.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $currPass = esc($this->request->getPost('curr-pass'));
        $newPass = esc($this->request->getPost('new-pass'));

        if (!password_verify($currPass, $password)) {
            return redirect()->back()->withInput()->with('error', 'Invalid password.');
        }

        $dataUpdate = [
            'password' => password_hash($newPass, PASSWORD_ARGON2ID)
        ];

        $id_user = session()->get('id_user');
        if ($userModel->update($id_user, $dataUpdate)) {
            // kode disini
            return redirect()->to('pasien')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', $userModel->errors());
        }
    }

    public function consultation()
    {
        return view('pasien/consultation');
    }

    public function akun()
    {
        $pasienModel = new PasienModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $data = [
            "nama" => $userData["nama"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
        ];

        return view('pasien/account', $data);
    }
}
