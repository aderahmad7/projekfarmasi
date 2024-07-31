<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoProgressModel extends Model
{
    protected $table = 'video_progress';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'video_id', 'duration_watched'];

    public function getProgress($id_pasien, $video_id)
    {
        return $this->where('id_pasien', $id_pasien)
            ->where('video_id', $video_id)
            ->first();
    }

    public function updateProgress($id_pasien, $video_id, $duration_watched)
    {
        $existingProgress = $this->getProgress($id_pasien, $video_id);

        if ($existingProgress) {
            return $this->update($existingProgress['id'], ['duration_watched' => $duration_watched]);
        } else {
            return $this->insert([
                'id_pasien' => $id_pasien,
                'video_id' => $video_id,
                'duration_watched' => $duration_watched
            ]);
        }
    }

    public function getAllProgress($id_pasien)
    {
        return $this->where('id_pasien', $id_pasien)->findAll();
    }
}