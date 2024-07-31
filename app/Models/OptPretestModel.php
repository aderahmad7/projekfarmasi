<?php

namespace App\Models;

use CodeIgniter\Model;

class OptPretestModel extends Model
{
    protected $table = 'pilihan_pretest ';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pretest', 'teks_pilihan'];
}
