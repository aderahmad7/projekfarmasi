<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['role', 'nama', 'gender', 'tgl_lahir', 'no_hp', 'email', 'username', 'password', 'foto']; // Kolom yang dapat diisi

    public function insertData($data)
    {
        return $this->insert($data);
    }

    // Mendapatkan ID pengguna berdasarkan username
    public function getID($username)
    {
        return $this->where('username', $username)->first()['id'];
    }

    public function getDataByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function cekUser($username)
    {
        return $this->where('username', $username)->first() === null;
    }

    public function getData($username)
    {
        return $this->where('username', $username)->first();
    }

    public function cekEmail($email)
    {
        return $this->where('email', $email)->first() === null;
    }
    public function countDoctors()
    {
        return $this->where('role', 'dokter')->countAllResults();
    }
    public function countPatients()
    {
        return $this->where('role', 'pasien')->countAllResults();
    }
    public function getAllDoctors()
    {
        return $this->where('role', 'dokter')->findAll();
    }
<<<<<<< HEAD
    public function getAllPosttestScoresPaginated($perPage = 10)
{
    $builder = $this->db->table('user');
    $builder->select('user.id, user.nama');
    $builder->where('role', 'pasien');
    $builder->orderBy('user.id', 'ASC');

    $users = $builder->get()->getResultArray();
    
    // Ambil semua data soal dan kunci jawaban
    $soal = $this->db->table('posttest')->get()->getResultArray();
    $jawabanBenar = [];
    foreach ($soal as $s) {
        $jawabanBenar[$s['id']] = $s['id_jawaban'];
    }
    $jumlahSoal = count($soal);

    // Ambil semua jawaban pasien
    $jawabanUser = $this->db->table('jawaban_posttest')->get()->getResultArray();

    // Kelompokkan jawaban pasien berdasarkan user dan soal
    $userJawaban = [];
    foreach ($jawabanUser as $j) {
        $userJawaban[$j['id_pasien']][$j['id_posttest']] = $j['id_pilihan'];
    }

    // Proses skor
    foreach ($users as &$u) {
        $benar = 0;
        $uid = $u['id'];
        if (isset($userJawaban[$uid])) {
            foreach ($jawabanBenar as $id_posttest => $id_jawaban_benar) {
                if (isset($userJawaban[$uid][$id_posttest]) &&
                    $userJawaban[$uid][$id_posttest] == $id_jawaban_benar) {
                    $benar++;
                }
            }
        }
        $u['benar'] = $benar;
        $u['total_soal'] = $jumlahSoal;
    }

    return $users;
}

=======
>>>>>>> 423e6abd066d9c0623b64b22e39ae85cee06f51c
}
