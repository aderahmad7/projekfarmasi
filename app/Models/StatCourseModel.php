<?php

namespace App\Models;

use CodeIgniter\Model;

class StatCourseModel extends Model
{
    protected $table = 'status_course';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pasien', 'pretest', 'posttest', 'course'];
    public function insertData($data)
    {
        return $this->insert($data);
    }
    public function getData($id_pasien)
    {
        return $this->where('id_pasien', $id_pasien)->first();
    }
    public function countCourseComplete()
    {
        return $this->where('course', 100)->countAllResults();
    }
}
