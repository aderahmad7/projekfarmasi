<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\DosisObatModel;
use App\Models\PasienModel;
use App\Models\RiwayatMedisModel;
use App\Models\UserModel;
use App\Models\DokterModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dokter extends BaseController
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
        $dokterModel = new DokterModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $data = [
            "nama" => $userData["nama"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
            "jumlah_pasien" => $userModel->where('role', 'pasien')->countAllResults()
        ];

        $dokterData = $dokterModel->getDataID($idUser);
        if ($dokterData != null) {
            return view('dokter/laman_utama', $data);
        } else {
            return redirect()->to('login/logout');
        }

    }

    public function setperson()
    {
        $dokterModel = new DokterModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $dokterData = $dokterModel->getDataID($idUser);
        $data = [
            "id" => $dokterData["id"],
            "username" => $userData["username"],
            "nama" => $userData["nama"],
            "gender" => $userData["gender"],
            "tgl_lahir" => $userData["tgl_lahir"],
            "no_hp" => $userData["no_hp"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
            "spesialis" => $dokterData["spesialis"],
            "exp_years" => $dokterData["exp_years"],
            "hari_mulai" => $dokterData["hari_mulai"],
            "hari_selesai" => $dokterData["hari_selesai"],
            "jam_mulai" => $dokterData["jam_mulai"],
            "jam_selesai" => $dokterData["jam_selesai"],
        ];

        return view('dokter/personal-setting', $data);
    }

    public function ubah_profil()
    {
        $dokterModel = new DokterModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $id_dokter = esc($this->request->getPost('id'));

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
            "tgl_lahir" => esc($this->request->getPost('tanggal-lahir')),
            "no_hp" => esc($this->request->getPost('no-hp')),
        ];

        if ($filePath) {
            $dataUser["foto"] = $filePath; // Only update foto if a new file is uploaded
        }
        $dataDokter = [
            "spesialis" => esc($this->request->getPost('spesialis')),
            "exp_years" => esc($this->request->getPost('exp-years')),
            "hari_mulai" => esc($this->request->getPost('hari-mulai')),
            "hari_selesai" => esc($this->request->getPost('hari-selesai')),
            "jam_mulai" => esc($this->request->getPost('jam-mulai')),
            "jam_selesai" => esc($this->request->getPost('jam-selesai')),
        ];

        if ($dokterModel->update($id_dokter, $dataDokter) && $userModel->update($idUser, $dataUser)) {
            return redirect()->to('dokter')->with('success', 'Pembaruan berhasil.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Pembaruan gagal. Silakan coba lagi.');
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

        return view('dokter/account_security', $data);
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
                    'required' => 'Kolom kata sandi saat ini wajib diisi.'
                ]
            ],
            'new-pass' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/(?=.*[A-Z])(?=.*\d).{8,}/]',
                'errors' => [
                    'regex_match' => 'Kata sandi harus minimal 8 karakter dan mengandung minimal satu huruf besar dan satu angka.'
                ]
            ],
            're-new-pass' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[new-pass]',
                'errors' => [
                    'matches' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $currPass = esc($this->request->getPost('curr-pass'));
        $newPass = esc($this->request->getPost('new-pass'));

        if (!password_verify($currPass, $password)) {
            return redirect()->back()->withInput()->with('error', 'Kata sandi tidak valid.');
        }

        $dataUpdate = [
            'password' => password_hash($newPass, PASSWORD_ARGON2ID)
        ];

        $id_user = session()->get('id_user');
        if ($userModel->update($id_user, $dataUpdate)) {
            // kode disini
            return redirect()->to('dokter')->with('success', 'Berhasil memperbarui pengguna');
        } else {
            return redirect()->back()->withInput()->with('error', $userModel->errors());
        }
    }

    public function consultation()
    {
        return view('dokter/consultation');
    }

    public function akun()
    {
        $dokterModel = new DokterModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $dokterData = $dokterModel->getDataID($idUser);
        $data = [
            "nama" => $userData["nama"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
        ];

        return view('dokter/account', $data);
    }

    public function medical_history_data()
    {
        $pasienModel = new PasienModel();
        $riwayatModel = new RiwayatMedisModel();
        $dosisModel = new DosisObatModel();

        // Ambil data id dan nama pasien
        $dataPasien = $pasienModel->getPatients();

        // Siapkan array untuk menyimpan riwayat dan dosis obat terkait
        $dataPasienWithDetails = [];

        // Looping untuk setiap pasien
        foreach ($dataPasien as $pasien) {
            $id_pasien = $pasien['id'];

            // Ambil semua data riwayat berdasarkan id pasien
            $riwayat = $riwayatModel->getDataID($id_pasien);

            // Array untuk menyimpan data riwayat beserta dosis obat terkait
            $riwayatWithDosis = [];

            foreach ($riwayat as $r) {
                // Ambil dosis obat berdasarkan id riwayat
                $dosis = $dosisModel->where('id_riwayat', $r['id'])->findAll();

                // Simpan riwayat beserta dosis obat terkait dalam satu array
                $riwayatWithDosis[] = [
                    'riwayat' => $r,
                    'dosis' => $dosis
                ];
            }

            // Simpan data pasien dengan riwayat dan dosis obat terkait
            $dataPasienWithDetails[] = [
                'id' => $pasien['id'],
                'nama' => $pasien['nama'],
                'riwayat' => $riwayatWithDosis
            ];
        }
        // Mengirim data pasien lengkap ke view
        return view('dokter/medical-history-data', ['dataPasienWithDetails' => $dataPasienWithDetails]);
    }

    public function chat($id)
    {
        // id = id usernya pasien
        $userModel = new UserModel();
        $pasienModel = new PasienModel();
        $chatModel = new ChatModel();
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $idUser = $userModel->getID($username);
        $dataPasien = $pasienModel->getPatient($id);
        $dataChat = $chatModel->getChatByUsers($idUser, $id);

        $data = [
            'data_pasien' => $dataPasien,
            'data_chat' => $dataChat,
            'id_user' => $idUser,
        ];
        return view('dokter/chat', $data);
    }

    public function list_chat()
    {
        $userModel = new UserModel();
        $chatModel = new ChatModel();
        $username = session()->get('username');
        $idUser = $userModel->getID($username);
        $listChat = $chatModel->getListChat($idUser);
        $data = [
            'list_chat' => $listChat
        ];
        return view('dokter/list-chat', $data);
    }

}
