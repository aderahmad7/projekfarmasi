<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'spesialis', 'exp_years'];

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
        return $this->select('dokter.*, user.id, user.nama, user.gender, user.usia, user.no_hp, user.email, user.username, user.foto')
            ->join('user', 'user.id = dokter.id_user')
            ->where('user.role', 'dokter')
            ->findAll();
    }
}
