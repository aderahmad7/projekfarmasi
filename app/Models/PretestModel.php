<?php

namespace App\Models;

use CodeIgniter\Model;

class PretestModel extends Model
{
    protected $table = 'pretest';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pertanyaan', 'id_jawaban'];
}
