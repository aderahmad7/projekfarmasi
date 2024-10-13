<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\ChatModel;
use App\Models\DokterModel;
use App\Models\OptPostTestModel;
use App\Models\OptPretestModel;
use App\Models\PasienModel;
use App\Models\PostTestModel;
use App\Models\PretestModel;
use App\Models\StatCourseModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{

    public function index()
    {
        return view('admin/login_admin');
    }

    public function login()
    {
        $adminModel = new AdminModel();

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = esc($this->request->getPost('username'));
        $password = esc($this->request->getPost('password'));

        if ($adminModel->cekUser($username)) {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
        }

        $hassPass = $adminModel->getData($username)["password"];

        if (!password_verify($password, $hassPass)) {
            return redirect()->back()->withInput()->with('error', 'Username atau kata sandi tidak valid');
        }

        $session_data = [
            'admin_in' => true,
        ];
        session()->set($session_data);
        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }

    public function dashboard()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $userModel = new UserModel();
            $statCourseModel = new StatCourseModel();
            $nCourseDone = $statCourseModel->countCourseComplete();
            $jumlahDokter = $userModel->countDoctors();
            $jumlahPasien = $userModel->countPatients();
            $data = [
                'n_course_done' => $nCourseDone,
                'n_dokter' => $jumlahDokter,
                'n_pasien' => $jumlahPasien
            ];
            return view('admin/home-screen-admin', $data);
        } else {
            return redirect()->to('/admin');
        }
    }

    public function users()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            return view('admin/users-screen');
        } else {
            return redirect()->to('/admin');
        }
    }

    public function dokter_screen()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $dokterModel = new DokterModel();

            $dokters = $dokterModel->getAllDoctors();

            $filteredDoctors = [];
            foreach ($dokters as $doctor) {
                $filteredDoctors[] = [
                    'id' => $doctor['id'],
                    'id_user' => $doctor['id_user'],
                    'name' => $doctor['nama'],
                    'username' => $doctor['username'],
                    'gender' => $doctor['gender'],
                    'usia' => $doctor['usia'],
                    'tahunPengalaman' => $doctor['exp_years'],
                    'nomorHandphone' => $doctor['no_hp'],
                    'specialty' => $doctor['spesialis'],
                    'email' => $doctor['email']
                ];
            }
            return view('admin/dokter-screen', ['doctors' => $filteredDoctors]);
        } else {
            return redirect()->to('/admin');
        }
    }

    public function save_dokter()
    {
        $userModel = new UserModel();
        $dokterModel = new DokterModel();
        $data = esc($this->request->getPost());

        // Simpan ke tabel user
        $userData = [
            'role' => 'dokter',
            'foto' => 'assets/images/learning/default.jpg',
            'nama' => $data['name'],
            'gender' => $data['gender'],
            'usia' => $data['usia'],
            'no_hp' => $data['no-hp'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_ARGON2ID),
        ];

        $userModel->insert($userData);
        $userId = $userModel->getID($data['username']);

        // Simpan ke tabel dokter
        $dokterData = [
            'id_user' => $userId,
            'spesialis' => $data['spesialis'],
            'exp_years' => $data['exp-years'],
        ];

        $dokterModel->insert($dokterData);

        return $this->response->setJSON(['success' => true]);
    }

    public function update_dokter($id)
    {
        $userModel = new UserModel();
        $dokterModel = new DokterModel();
        $data = esc($this->request->getPost());

        // Update tabel user
        $userData = [
            'nama' => $data['name'],
            'gender' => $data['gender'],
            'usia' => $data['usia'],
            'no_hp' => $data['no-hp'],
            'email' => $data['email'],
            'username' => $data['username'],
        ];

        $userModel->update($id, $userData);

        // Update tabel dokter
        $dokterData = [
            'spesialis' => $data['spesialis'],
            'exp_years' => $data['exp-years'],
        ];

        $dokterModel->where('id_user', $id)->set($dokterData)->update();

        return $this->response->setJSON(['success' => true]);
    }

    public function delete_dokter($id)
    {
        $userModel = new UserModel();
        $dokterModel = new DokterModel();
        $chatModel = new ChatModel();
        $chatModel->where('id_penerima', $id)->orWhere('id_pengirim', $id)->delete();
        $dokterModel->where('id_user', $id)->delete();
        $userModel->delete($id);

        return redirect()->back()->with('success', 'Menghapus tenaga kesehatan berhasil.');
    }

    public function pasien_screen()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $pasienModel = new PasienModel();

            $pasiens = $pasienModel->getAllPatients();

            $filteredPasiens = [];
            foreach ($pasiens as $row) {
                $filteredPasiens[] = [
                    'id' => $row['id'],
                    'id_user' => $row['id_user'],
                    'name' => $row['nama'],
                    'username' => $row['username'],
                    'gender' => $row['gender'],
                    'usia' => $row['usia'],
                    'nomorHandphone' => $row['no_hp'],
                    'pekerjaan' => $row['pekerjaan'],
                    'history' => $row['riwayat'],
                    'email' => $row['email']
                ];
            }
            return view('admin/pasien-screen', ['pasiens' => $filteredPasiens]);
        } else {
            return redirect()->to('/admin');
        }
    }

    public function save_pasien()
    {
        $userModel = new UserModel();
        $pasienModel = new PasienModel();
        $statCourseModel = new StatCourseModel();
        $data = esc($this->request->getPost());

        // Simpan ke tabel user
        $userData = [
            'role' => 'pasien',
            'foto' => 'assets/images/learning/default.jpg',
            'nama' => $data['name'],
            'gender' => $data['gender'],
            'usia' => $data['usia'],
            'no_hp' => $data['no-hp'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_ARGON2ID),
        ];

        $userModel->insert($userData);
        $userId = $userModel->getID($data['username']);

        // Simpan ke tabel dokter
        $pasienData = [
            'id_user' => $userId,
            'pekerjaan' => $data['pekerjaan'],
            'riwayat' => $data['riwayat'],
        ];

        $pasienModel->insert($pasienData);

        $id_pasien = $pasienModel->getDataID($userId)["id"];
        $statPasien = [
            'id_pasien' => $id_pasien,
            'pretest' => 'belum',
            'posttest' => 'belum',
            'course' => 0
        ];
        $statCourseModel->insert($statPasien);
        return $this->response->setJSON(['success' => true]);
    }

    public function update_pasien($id)
    {
        $userModel = new UserModel();
        $pasienModel = new PasienModel();
        $data = esc($this->request->getPost());

        // Update tabel user
        $userData = [
            'nama' => $data['name'],
            'gender' => $data['gender'],
            'usia' => $data['usia'],
            'no_hp' => $data['no-hp'],
            'email' => $data['email'],
            'username' => $data['username'],
        ];

        $userModel->update($id, $userData);

        // Update tabel dokter
        $pasienData = [
            'pekerjaan' => $data['pekerjaan'],
            'riwayat' => $data['riwayat'],
        ];

        $pasienModel->where('id_user', $id)->set($pasienData)->update();

        return $this->response->setJSON(['success' => true]);
    }

    public function delete_pasien($id)
    {
        $userModel = new UserModel();
        $statusCourseModel = new StatCourseModel();
        $pasienModel = new PasienModel();
        $chatModel = new ChatModel();
        $chatModel->where('id_penerima', $id)->orWhere('id_pengirim', $id)->delete();
        $id_pasien = $pasienModel->where('id_user', $id)->first()['id'];
        $statusCourseModel->where('id_pasien', $id_pasien)->delete();
        $pasienModel->where('id_user', $id)->delete();
        $userModel->delete($id);

        return redirect()->back()->with('success', 'Menghapus pasien berhasil.');
    }

    public function content()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            return view('admin/content-screen');
        } else {
            return redirect()->to('/admin');
        }
    }

    public function pre_test_screen()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $pretestModel = new PretestModel();
            $optPretestModel = new OptPretestModel();
            $questions = $pretestModel->findAll();
            foreach ($questions as &$question) {
                $question['options'] = $optPretestModel->where('id_pretest', $question['id'])->findAll();
            }
            return view('admin/pre-test-screen', ['questions' => $questions]);
        } else {
            return redirect()->to('/admin');
        }
    }

    public function post_test_screen()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $postTestModel = new PostTestModel;
            $optPostTestModel = new OptPostTestModel;
            $questions = $postTestModel->findAll();
            foreach ($questions as &$question) {
                $question['options'] = $optPostTestModel->where('id_posttest', $question['id'])->findAll();
            }
            return view('admin/post-test-screen', ['questions' => $questions]);
        } else {
            return redirect()->to('/admin');
        }
    }

    public function course_screen()
    {
        $session = session();
        if ($session->has('admin_in') || $session->get('admin_in') === true) {
            $this->setHeaders();
            $courseModel = new \App\Models\CourseModel();
            $data['courses'] = $courseModel->findAll();
            return view('admin/cources-screen', $data);
        } else {
            return redirect()->to('/admin');
        }
    }

}
