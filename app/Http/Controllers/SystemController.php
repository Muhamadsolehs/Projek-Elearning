<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function users()
    {
        return view('modules.settings.users', [
            'teachers' => PesantrenService::getTeachers(),
        ]);
    }

    public function rolesPermissions()
    {
        return view('modules.settings.roles-permissions');
    }

    public function auditLogs()
    {
        return view('modules.settings.audit-logs', [
            'audit_logs' => PesantrenService::getAuditLogs(),
        ]);
    }

    public function notifications()
    {
        return view('modules.settings.notifications');
    }
}
