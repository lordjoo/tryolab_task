<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{

    public function getAll()
    {
        return Student::all();
    }

    public function getById($id)
    {
        return Student::find($id);
    }

    public function create($data)
    {
        return Student::create($data);
    }

    public function update($id, $data)
    {
        $student = Student::find($id);
        $student->update($data);
        return $student;
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        return $student;
    }
}
