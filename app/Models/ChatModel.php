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

    public function getListChat($id_user)
    {
        $builder = $this->db->table($this->table);

        // Subquery untuk mendapatkan last_chat_id untuk setiap percakapan
        $subquery = $this->db->table($this->table)
            ->select('MAX(chat.id) as last_chat_id')
            ->groupStart()
            ->where('chat.id_pengirim', $id_user)
            ->orWhere('chat.id_penerima', $id_user)
            ->groupEnd()
            ->groupBy('IF(chat.id_pengirim = ' . $id_user . ', chat.id_penerima, chat.id_pengirim)')
            ->getCompiledSelect();

        // Menggunakan subquery untuk mendapatkan pesan terakhir dan menambahkan nama dari lawan chat
        return $builder->select('IF(chat.id_pengirim = ' . $id_user . ', chat.id_penerima, chat.id_pengirim) as lawan_chat, chat.pesan, chat.jenis, chat.id as chat_id, user.nama, user.foto')
            ->join('user', 'user.id = IF(chat.id_pengirim = ' . $id_user . ', chat.id_penerima, chat.id_pengirim)', 'left')
            ->where('chat.id IN (' . $subquery . ')')
            ->orderBy('chat.id', 'DESC')
            ->get()
            ->getResultArray();
    }
}
