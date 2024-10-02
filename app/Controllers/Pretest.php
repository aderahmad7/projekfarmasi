<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnsPretestModel;
use App\Models\OptPretestModel;
use App\Models\PasienModel;
use App\Models\PretestModel;
use App\Models\StatCourseModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pretest extends BaseController
{
    protected $pretestModel;
    protected $optPretestModel;

    public function __construct()
    {
        $this->pretestModel = new PretestModel();
        $this->optPretestModel = new OptPretestModel();
        $this->ansPretestModel = new AnsPretestModel();
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
        // Ambil data pertanyaan dan pilihan ganda
        $pertanyaan = $this->pretestModel->findAll();
        $pilihan = [];

        foreach ($pertanyaan as $p) {
            $pilihan[$p['id']] = $this->optPretestModel->where('id_pretest', $p['id'])->findAll();
        }

        // Kirim data ke view
        return view('pasien/pre-test-screen', [
            'pertanyaan' => $pertanyaan,
            'pilihan' => $pilihan
        ]);
    }
    public function submit()
    {
        $pasienModel = new PasienModel();
        $selectedOptions = $this->request->getPost('pilihan');
        $id_user = session()->get('id_user'); // Ambil ID pasien dari sesi
        $id_pasien = $pasienModel->getDataID($id_user)["id"];

        // Ambil data pertanyaan dan pilihan ganda
        $pertanyaan = $this->pretestModel->findAll();
        $pilihan = [];

        foreach ($pertanyaan as $p) {
            $pilihan[$p['id']] = $this->optPretestModel->where('id_pretest', $p['id'])->findAll();
        }

        $data = [
            'selectedOptions' => $selectedOptions,
            'pertanyaan' => $pertanyaan,
            'pilihan' => $pilihan
        ];
        return view('pasien/pretest-review', $data);
    }
    public function done()
    {
        $pasienModel = new PasienModel();
        $id_user = session()->get('id_user'); // Ambil ID pasien dari sesi
        $id_pasien = $pasienModel->getDataID($id_user)["id"];

        // Update status pretest menjadi 'sudah'
        $statModel = new StatCourseModel();
        $statModel->where('id_pasien', $id_pasien)->set(['pretest' => 'sudah'])->update();

        // Redirect atau tampilkan pesan sesuai kebutuhan
        return redirect()->to('/pasien'); // Contoh redirect ke halaman hasil
    }
    public function add_question()
    {
        $rules = [
            'text' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $text = $this->request->getPost('text');
        $data = [
            'pertanyaan' => $text,
            'id_jawaban' => 0
        ];
        if ($this->pretestModel->insert($data)) {
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
        }

    }

    public function edit_question()
    {
        $rules = [
            'options' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pertanyaan = esc($this->request->getPost('options'));
        $idPertanyaan = esc($this->request->getPost('id_pertanyaan'));
        $data = [
            'pertanyaan' => $pertanyaan
        ];
        if ($this->pretestModel->update($idPertanyaan, $data)) {
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
        }
    }

    public function delete_question($id)
    {
        $this->optPretestModel->where('id_pretest', $id)->delete();
        $this->pretestModel->delete($id);

        return redirect()->back();
    }

    public function add_option()
    {
        $rules = [
            'options' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $teksPilihan = esc($this->request->getPost('options'));
        $idPretest = esc($this->request->getPost('id_pertanyaan'));
        $data = [
            'id_pretest' => $idPretest,
            'teks_pilihan' => $teksPilihan
        ];
        if ($this->optPretestModel->insert($data)) {
            $isChecked = esc($this->request->getPost('is_correct'));
            if ($isChecked) {
                $newID = $this->optPretestModel->insertID();
                $addAns = [
                    'id_jawaban' => $newID,
                ];
                $ans = $this->pretestModel->update($idPretest, $addAns);
                if (!$ans) {
                    return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
        }
    }

    public function edit_option()
    {
        $rules = [
            'options' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $teksPilihan = esc($this->request->getPost('options'));
        $idPilihan = esc($this->request->getPost('id_pilihan'));
        $idAns = esc($this->request->getPost('id_jawaban'));
        $idPertanyaan = esc($this->request->getPost('id_pertanyaan'));
        $data = [
            'teks_pilihan' => $teksPilihan
        ];
        if ($this->optPretestModel->update($idPilihan, $data)) {
            $isChecked = esc($this->request->getPost('is_correct'));
            if ($isChecked) {
                $addAns = [
                    'id_jawaban' => $idPilihan,
                ];
                $ans = $this->pretestModel->update($idPertanyaan, $addAns);
                if (!$ans) {
                    return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
                }
            } else {
                if ($idPilihan === $idAns) {
                    $addAns = [
                        'id_jawaban' => 0,
                    ];
                    $ans = $this->pretestModel->update($idPertanyaan, $addAns);
                    if (!$ans) {
                        return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
                    }
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->with('errors', 'Gagal menambahkan pertanyaan.');
        }
    }

    public function delete_option($id)
    {
        $this->optPretestModel->delete($id);

        return redirect()->back();
    }

}
