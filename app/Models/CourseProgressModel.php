<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseProgressModel extends Model
{
    protected $table            = 'course_progress';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_user', 'id_course'];

    
}
