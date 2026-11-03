<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, string $role = 'super-admin')
    {
        $validRoles = [
            'super-admin', 'administrator', 'psb', 'akademik', 
            'guru', 'wali-kelas', 'keasramaan', 'keuangan', 
            'perpustakaan', 'santri', 'wali-santri'
        ];

        if (!in_array($role, $validRoles)) {
            $role = 'super-admin';
        }

        $data = [
            'role' => $role,
            'students' => PesantrenService::getStudents(),
            'admissions' => PesantrenService::getAdmissions(),
            'teachers' => PesantrenService::getTeachers(),
            'books' => PesantrenService::getBooks(),
            'copies' => PesantrenService::getBookCopies(),
            'circulations' => PesantrenService::getCirculations(),
            'bills' => PesantrenService::getBills(),
            'permissions' => PesantrenService::getPermissions(),
            'audit_logs' => PesantrenService::getAuditLogs(),
        ];

        return view("dashboards.{$role}", $data);
    }
}
