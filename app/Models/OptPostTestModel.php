<?php

namespace App\Models;

use CodeIgniter\Model;

class OptPostTestModel extends Model
{
    protected $table = 'pilihan_posttest ';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_posttest', 'teks_pilihan'];
}
