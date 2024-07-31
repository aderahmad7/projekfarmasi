<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['role', 'nama', 'gender', 'usia', 'no_hp', 'email', 'username', 'password', 'foto']; // Kolom yang dapat diisi

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
}
