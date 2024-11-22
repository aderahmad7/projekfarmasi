<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'spesialis', 'exp_years', 'hari_mulai', 'hari_selesai', 'jam_mulai', 'jam_selesai'];

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function getDataID($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }

    public function getAllDoctors()
    {
        return $this->select('dokter.*, user.id, user.nama, user.gender, user.tgl_lahir, user.no_hp, user.email, user.username, user.foto')
            ->join('user', 'user.id = dokter.id_user')
            ->where('user.role', 'dokter')
            ->findAll();
    }

    public function getDoctors($id)
    {
        return $this->select('dokter.*, user.id, user.nama, user.gender, user.tgl_lahir, user.no_hp, user.email, user.username, user.foto')
            ->join('user', 'user.id = dokter.id_user')
            ->where('user.role', 'dokter')
            ->where('dokter.id_user', $id)  // Tambahkan kondisi untuk mencocokkan id_user dengan $id
            ->findAll();
    }

}
