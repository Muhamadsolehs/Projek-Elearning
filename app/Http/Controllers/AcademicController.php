<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function schedules()
    {
        return view('modules.academic.schedules', [
            'teachers' => PesantrenService::getTeachers(),
            'classes' => PesantrenService::getData()['classes'],
        ]);
    }

    public function attendance()
    {
        return view('modules.academic.attendance', [
            'students' => PesantrenService::getStudents(),
            'classes' => PesantrenService::getData()['classes'],
        ]);
    }

    public function grades()
    {
        return view('modules.academic.grades', [
            'students' => PesantrenService::getStudents(),
            'classes' => PesantrenService::getData()['classes'],
        ]);
    }
}
