<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\DokterModel;
use App\Models\DosisObatModel;
use App\Models\RiwayatMedisModel;
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
            return redirect()->to('pasien')->with('success', 'Pembaruan berhasil.');
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
            return redirect()->to('pasien')->with('success', 'Memperbarui pengguna berhasil.');
        } else {
            return redirect()->back()->withInput()->with('error', $userModel->errors());
        }
    }

    public function consultation()
    {
        $dokterModel = new DokterModel();
        $dokterData = $dokterModel->getAllDoctors();
        $data = [
            'dokter_data' => $dokterData
        ];

        return view('pasien/consultation', $data);
    }

    public function akun()
    {
        $pasienModel = new PasienModel();
        $userModel = new UserModel();

        $idUser = session()->get('id_user');
        $username = session()->get('username');
        $pasienData = $pasienModel->getDataID($idUser);
        $userData = $userModel->getData($username);
        $data = [
            "id_pasien" => $pasienData["id"],
            "nama" => $userData["nama"],
            "email" => $userData["email"],
            "foto" => $userData["foto"],
        ];

        return view('pasien/account', $data);
    }

    public function medical_history_form($id)
    {
        return view('pasien/medical-history-form', ['id_pasien' => $id]);
    }
    public function medical_history_data($id)
    {
        $riwayatModel = new RiwayatMedisModel();
        $dosisModel = new DosisObatModel();

        $riwayatData = $riwayatModel->getDataID($id);

        $dosisData = [];
        foreach ($riwayatData as $riwayat) {
            $dosisData[$riwayat['id']] = $dosisModel->where('id_riwayat', $riwayat['id'])->findAll();
        }

        $data = [
            'riwayat' => $riwayatData,
            'dosis' => $dosisData
        ];

        return view('pasien/medical-history-data', $data);
    }

    public function add_riwayat($id_pasien)
    {
        $riwayatModel = new RiwayatMedisModel();
        $dosisModel = new DosisObatModel();

        $rules = [
            'keluhan' => 'required',
            'gula-darah-puasa' => 'required|numeric',
            'gula-darah-sewaktu' => 'required|numeric',
            'gula-darah-setelah-makan' => 'required|numeric',
            'nama-obat.*' => 'required',
            'aturan-pakai.*' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $keluhan = esc($this->request->getPost('keluhan'));
        $gd_puasa = esc($this->request->getPost('gula-darah-puasa'));
        $gd_sewaktu = esc($this->request->getPost('gula-darah-sewaktu'));
        $gd_setelah_makan = esc($this->request->getPost('gula-darah-setelah-makan'));
        $tanggal = date('Y-m-d');
        $nama_obat = array_map('esc', $this->request->getPost('nama-obat'));
        $aturan_pakai = array_map('esc', $this->request->getPost('aturan-pakai'));

        $dataRiwayat = [
            'id_pasien' => $id_pasien,
            'tanggal' => $tanggal,
            'keluhan' => $keluhan,
            'guldar_puasa' => $gd_puasa,
            'guldar_sewaktu' => $gd_sewaktu,
            'guldar_2jam' => $gd_setelah_makan
        ];
        if ($riwayatModel->insert($dataRiwayat)) {
            $id_riwayat = $riwayatModel->insertID(); // Dapatkan ID dari riwayat yang baru disimpan

            // Insert data obat dan aturan pakai ke tabel dosis_obat
            foreach ($nama_obat as $key => $obat) {
                $dataDosis = [
                    'id_riwayat' => $id_riwayat,
                    'nama_obat' => $obat,
                    'aturan_pakai' => $aturan_pakai[$key]
                ];

                $dosisModel->insert($dataDosis);
            }

            return redirect()->back()->with('success', 'Berhasil menambahkan data riwayat dan obat.');
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan data.');
        }
    }

    public function chat($id)
    {
        // id = id usernya dokter
        $dokterModel = new DokterModel();
        $userModel = new UserModel();
        $chatModel = new ChatModel();
        $username = session()->get('username');
        $idUser = $userModel->getID($username);
        $dataDokter = $dokterModel->getDoctors($id);
        $dataChat = $chatModel->getChatByUsers($idUser, $id);
        $data = [
            'data_dokter' => $dataDokter,
            'data_chat' => $dataChat,
            'id_user' => $idUser,
        ];
        return view('pasien/chat', $data);
    }

    public function kirim_chat()
    {

    }

    public function list_chat()
    {
        $userModel = new UserModel();
        $username = session()->get('username');
        $userData = $userModel->getData($username);
        $data = [
            "foto" => $userData["foto"],
        ];
        return view('pasien/list-chat', $data);
    }
}
