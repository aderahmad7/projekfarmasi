<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Chat extends BaseController
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

    public function kirim()
    {
        $chatModel = new ChatModel();
        $rules = [
            'pesan' => 'permit_empty',  // Allow empty 'pesan'
            'foto' => [
                'label' => 'Image File',
                'rules' => 'permit_empty|is_image[foto]|max_size[foto,5120]',
            ],
        ];

        // Jalankan validasi berdasarkan aturan yang sudah ditetapkan
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pesan = esc($this->request->getPost('pesan'));
        $foto = $this->request->getFile('foto');

        // Jika keduanya kosong, tampilkan error
        if (empty($pesan) && $foto->getError() == 4) {
            return redirect()->back()->withInput()->with('errors', ['Harus mengirimkan pesan atau foto.']);
        }else if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'assets/images/fitur-chat', $newName);
            $jenis = 'gambar';
            $pesan = 'assets/images/fitur-chat/' . $newName;
        } else {
            $jenis = 'teks';
        }

        $id_pengirim = esc($this->request->getPost('id_pengirim'));
        $id_penerima = esc($this->request->getPost('id_penerima'));

        $chat = [
            'id_pengirim' => $id_pengirim,
            'id_penerima' => $id_penerima,
            'jenis' => $jenis,
            'pesan' => $pesan
        ];
        if ($chatModel->insert($chat)) {
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->with('errors', $chatModel->errors());
        }

    }

    public function index()
    {
        //
    }
}
