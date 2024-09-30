<?php

namespace App\Models;

use CodeIgniter\Model;

class AnsPretestModel extends Model
{
    protected $table = 'jawaban_pretest';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pretest', 'id_pilihan'];
}
