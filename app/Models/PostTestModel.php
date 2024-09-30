<?php

namespace App\Models;

use CodeIgniter\Model;

class PostTestModel extends Model
{
    protected $table = 'posttest';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pertanyaan', 'id_jawaban'];
}
