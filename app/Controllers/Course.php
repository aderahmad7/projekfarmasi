<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Course extends BaseController
{
    public function add_course()
    {
        $courseModel = new \App\Models\CourseModel();
        $data = $this->request->getJSON(true);

        if ($courseModel->insert($data)) {
            return redirect()->back();
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function edit_course($id)
    {
        $courseModel = new \App\Models\CourseModel();
        $data = $this->request->getJSON(true);

        if ($courseModel->update($id, $data)) {
            return redirect()->back();
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function get_courses()
    {
        // Mengambil semua data kursus dari database
        $courseModel = new \App\Models\CourseModel();
        $courses = $courseModel->findAll();

        // Memeriksa apakah data berhasil diambil
        if ($courses) {
            // Jika berhasil, kirim data sebagai respons JSON
            return redirect()->back();
        } else {
            // Jika gagal, kirim respons error
            return redirect()->back();
        }
    }

    public function delete_course($id)
    {
        $courseModel = new \App\Models\CourseModel();

        if ($courseModel->delete($id)) {
            return redirect()->back();
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
