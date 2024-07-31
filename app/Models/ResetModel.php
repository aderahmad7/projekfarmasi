<?php

namespace App\Models;

use CodeIgniter\Model;

class ResetModel extends Model
{
    protected $table = 'reset_sandi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'reset_token', 'token_exp'];

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function getID($token)
    {
        return $this->where('reset_token', $token)->first()['id_user'];
    }

    public function deleteByToken($token)
    {
        return $this->where('reset_token', $token)->delete();
    }

    public function deleteByIDUser($id_user)
    {
        return $this->where('id_user', $id_user)->delete();
    }

    public function cekID($id_user)
    {
        return $this->where('id_user', $id_user)->first() === null;
    }
}
