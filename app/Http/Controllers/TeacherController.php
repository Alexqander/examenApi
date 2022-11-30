<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::with(['courses'])->get();

        return $this->getResponse200($teacher);
    }
    public function store(Request $request)
    {
        try {
            $id =  $request->id;
            $existsTeacher = Teacher::where('id', $id)->exists();
            if (!$existsTeacher) {
                $teacher = new Teacher();
                $teacher->id = $id;
                $teacher->name = $request->name;
                $teacher->first_surname = $request->first_surname;
                $teacher->second_surname = $request->second_surname;
                $teacher->degree = $request->degree;
                $teacher->save();
                foreach ($request->courses as $course) {
                    $teacher->courses()->attach($course);
                }
                return $this->getResponse201('teacher', 'created', $teacher);
            } else {
                return $this->getResponse500(['el id es unico']);
            }
        } catch (Exception $e) {
            return $this->getResponse500([$e->getMessage()]);
        }
    }
}
