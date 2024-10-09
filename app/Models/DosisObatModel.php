<?php

namespace App\Models;

use CodeIgniter\Model;

class DosisObatModel extends Model
{
    protected $table            = 'dosis_obat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_riwayat', 'nama_obat', 'aturan_pakai'];
}
