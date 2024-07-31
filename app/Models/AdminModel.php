<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];
    public function getData($username)
    {
        return $this->where('username', $username)->first();
    }
    public function cekUser($username)
    {
        return $this->where('username', $username)->first() === null;
    }
}
