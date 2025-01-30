<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_link', 'title', 'desc'];

    public function showCourse($idUser, $idCourse) {

    }
}
