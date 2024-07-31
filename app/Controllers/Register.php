<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PasienModel;
use App\Models\StatCourseModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();

        return view('register');
    }

    public function daftar_pasien()
    {
        if ($this->request->getPost('submit') !== null) {
            $rules = [
                'name' => 'required',
                'gender' => 'required',
                'usia' => 'required|greater_than[-1]',
                'pekerjaan' => 'required',
                'riwayat' => 'required',
                'no-hp' => 'required',
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'is_unique' => 'This email is already registered.'
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'is_unique' => 'This username is already taken.'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|regex_match[/(?=.*[A-Z])(?=.*\d).{8,}/]',
                    'errors' => [
                        'regex_match' => 'Password must be at least 8 characters long and contain at least one uppercase letter and one number.'
                    ]
                ],
                're-password' => [
                    'label' => 'Confirm Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'matches' => 'The password confirmation does not match the password.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $pasienModel = new PasienModel();
                $userModel = new UserModel();
                $statCourseModel = new StatCourseModel();

                $dataUser = [
                    'role' => 'pasien',
                    'nama' => esc($this->request->getPost('name')),
                    'gender' => esc($this->request->getPost('gender')),
                    'usia' => esc($this->request->getPost('usia')),
                    'no_hp' => esc($this->request->getPost('no-hp')),
                    'email' => esc($this->request->getPost('email')),
                    'username' => esc($this->request->getPost('username')),
                    'password' => password_hash(esc($this->request->getPost('password')), PASSWORD_ARGON2ID),
                    'foto' => 'assets/images/learning/default.jpg',
                ];

                if ($userModel->insertData($dataUser)) {
                    $id_user = $userModel->getID($this->request->getPost('username'));
                    $dataPasien = [
                        'id_user' => $id_user,
                        'pekerjaan' => esc($this->request->getPost('pekerjaan')),
                        'riwayat' => esc($this->request->getPost('riwayat')),
                    ];
                    $addPasien = $pasienModel->insertData($dataPasien);
                    $id_pasien = $pasienModel->getDataID($id_user)["id"];
                    $statPasien = [
                        'id_pasien' => $id_pasien,
                        'pretest' => 'belum',
                        'posttest' => 'belum',
                        'course' => 0
                    ];
                    $addStat = $statCourseModel->insertData($statPasien);
                    if (!$addPasien || !$addStat) {
                        return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
                    }
                    return redirect()->to('/login')->with('success', 'Registration successful.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

        }
    }
}
