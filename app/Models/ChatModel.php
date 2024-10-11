<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pengirim', 'id_penerima', 'jenis', 'pesan'];

    public function getChatByUsers($id_pengirim, $id_penerima)
    {
        return $this->groupStart()
            ->where('id_pengirim', $id_pengirim)
            ->where('id_penerima', $id_penerima)
            ->groupEnd()
            ->orGroupStart()
            ->where('id_pengirim', $id_penerima)
            ->where('id_penerima', $id_pengirim)
            ->groupEnd()
            ->orderBy('id', 'ASC')  // Urutkan jika diperlukan, bisa diganti dengan 'DESC'
            ->findAll();
    }


}
