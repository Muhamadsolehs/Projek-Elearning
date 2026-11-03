<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'level' => $request->query('level', ''),
            'class' => $request->query('class', ''),
            'status' => $request->query('status', ''),
        ];

        $students = PesantrenService::getStudents($filters);

        return view('modules.students.index', [
            'students' => $students,
            'filters' => $filters,
            'totalCount' => count(PesantrenService::getStudents()),
        ]);
    }

    public function show(string $id)
    {
        $student = PesantrenService::findStudent($id) ?? PesantrenService::getStudents()[0];
        $circulations = array_values(array_filter(PesantrenService::getCirculations(), fn($c) => $c['student_id'] === $student['id'] || $c['student_nis'] === $student['nis']));
        $bills = array_values(array_filter(PesantrenService::getBills(), fn($b) => $b['student_id'] === $student['id'] || $b['student_nis'] === $student['nis']));
        $permissions = array_values(array_filter(PesantrenService::getPermissions(), fn($p) => $p['student_id'] === $student['id'] || $p['student_nis'] === $student['nis']));

        return view('modules.students.detail', [
            'student' => $student,
            'circulations' => $circulations,
            'bills' => $bills,
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('modules.students.create');
    }

    public function edit(string $id)
    {
        $student = PesantrenService::findStudent($id) ?? PesantrenService::getStudents()[0];
        return view('modules.students.edit', ['student' => $student]);
    }
}
