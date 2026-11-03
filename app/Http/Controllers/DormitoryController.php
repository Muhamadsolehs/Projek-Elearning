<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class DormitoryController extends Controller
{
    public function activities()
    {
        return view('modules.dormitory.activities');
    }

    public function permissions(Request $request)
    {
        return view('modules.dormitory.permissions', [
            'permissions' => PesantrenService::getPermissions(),
            'students' => PesantrenService::getStudents(),
        ]);
    }

    public function gateCheck(Request $request)
    {
        return view('modules.dormitory.gate-check', [
            'permissions' => PesantrenService::getPermissions(),
            'students' => PesantrenService::getStudents(),
        ]);
    }
}
