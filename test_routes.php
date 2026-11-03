<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

$routesToTest = [
    '/login',
    '/dashboard/super-admin',
    '/dashboard/administrator',
    '/dashboard/psb',
    '/dashboard/akademik',
    '/dashboard/guru',
    '/dashboard/wali-kelas',
    '/dashboard/keasramaan',
    '/dashboard/keuangan',
    '/dashboard/perpustakaan',
    '/dashboard/santri',
    '/dashboard/wali-santri',
    '/admin/students',
    '/admin/students/create',
    '/admin/students/STU-1',
    '/admissions/applicants',
    '/admissions/applicants/ADM-1/verify',
    '/admissions/tests',
    '/admissions/selection-results',
    '/academic/schedules',
    '/academic/attendance',
    '/academic/grades',
    '/dormitory/activities',
    '/dormitory/permissions',
    '/dormitory/gate-check',
    '/finance/bills',
    '/finance/transactions',
    '/finance/tariffs',
    '/finance/reports',
    '/finance/invoices/INV-2026-0001/print',
    '/library/books',
    '/library/copies',
    '/library/qr-generator',
    '/library/circulation/borrow',
    '/library/circulation/return',
    '/library/history',
    '/settings/users',
    '/settings/roles-permissions',
    '/settings/audit-logs',
    '/settings/notifications',
    '/auth/profile',
];

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "Testing all application routes:\n";
$success = 0;
$fail = 0;

foreach ($routesToTest as $uri) {
    $request = Illuminate\Http\Request::create($uri, 'GET');
    try {
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        if ($status >= 200 && $status < 400) {
            echo " [OK {$status}] {$uri}\n";
            $success++;
        } else {
            echo " [FAIL {$status}] {$uri}\n";
            $fail++;
        }
        $kernel->terminate($request, $response);
    } catch (\Throwable $e) {
        echo " [ERROR] {$uri}: " . $e->getMessage() . "\n";
        $fail++;
    }
}

echo "\nResult: {$success} passed, {$fail} failed.\n";
