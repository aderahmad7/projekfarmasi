<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatMedisModel extends Model
{
    protected $table = 'riwayat_pasien';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'tanggal', 'keluhan', 'guldar_puasa', 'guldar_sewaktu', 'guldar_2jam'];

    public function getDataID($id_pasien)
    {
        return $this->where('id_pasien', $id_pasien)
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }
}
