<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SystemController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Manajemen Pesantren Terintegrasi (SIM-Pesantren)
|--------------------------------------------------------------------------
*/

// Root & Authentication
Route::get('/', function () {
    return redirect('/dashboard/super-admin');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/profile', function () {
    return view('auth.profile');
})->name('auth.profile');

Route::get('/auth/forgot-password', function () {
    return view('auth.login');
});

// Dashboards (11 Roles)
Route::get('/dashboard', function () {
    return redirect('/dashboard/super-admin');
});

$roles = [
    'super-admin', 'administrator', 'psb', 'akademik', 'guru', 
    'wali-kelas', 'keasramaan', 'keuangan', 'perpustakaan', 'santri', 'wali-santri'
];

foreach ($roles as $roleSlug) {
    Route::get('/dashboard/' . $roleSlug, [DashboardController::class, 'index'])->name('dashboard.' . $roleSlug);
}

Route::get('/dashboard/{role}', [DashboardController::class, 'index'])->name('dashboard.role');

// Administrasi & Data Induk Santri (Detail 360°)
Route::prefix('admin')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

    Route::get('/teachers', function () {
        return view('modules.admin.teachers');
    })->name('admin.teachers');

    Route::get('/classes', function () {
        return view('modules.admin.classes');
    })->name('admin.classes');

    Route::get('/dormitories', function () {
        return view('modules.admin.dormitories');
    })->name('admin.dormitories');
});

// Penerimaan Santri Baru (PSB) Pipeline
Route::prefix('admissions')->group(function () {
    Route::get('/applicants', [AdmissionController::class, 'applicants'])->name('admissions.applicants');
    Route::get('/applicants/{id}/verify', [AdmissionController::class, 'verify'])->name('admissions.verify');
    Route::get('/tests', [AdmissionController::class, 'tests'])->name('admissions.tests');
    Route::get('/selection-results', [AdmissionController::class, 'selectionResults'])->name('admissions.selection-results');
});

// Akademik Formal
Route::prefix('academic')->group(function () {
    Route::get('/schedules', [AcademicController::class, 'schedules'])->name('academic.schedules');
    Route::get('/attendance', [AcademicController::class, 'attendance'])->name('academic.attendance');
    Route::get('/grades', [AcademicController::class, 'grades'])->name('academic.grades');
});

// Keasramaan & Pengasuhan
Route::prefix('dormitory')->group(function () {
    Route::get('/activities', [DormitoryController::class, 'activities'])->name('dormitory.activities');
    Route::get('/permissions', [DormitoryController::class, 'permissions'])->name('dormitory.permissions');
    Route::get('/gate-check', [DormitoryController::class, 'gateCheck'])->name('dormitory.gate-check');
});

// Keuangan & Pembayaran
Route::prefix('finance')->group(function () {
    Route::get('/bills', [FinanceController::class, 'bills'])->name('finance.bills');
    Route::get('/transactions', [FinanceController::class, 'transactions'])->name('finance.transactions');
    Route::get('/tariffs', [FinanceController::class, 'tariffs'])->name('finance.tariffs');
    Route::get('/reports', [FinanceController::class, 'reports'])->name('finance.reports');
    Route::get('/invoices/{id}/print', [FinanceController::class, 'printInvoice'])->name('finance.invoices.print');
});

// Perpustakaan & QR Code Circulation
Route::prefix('library')->group(function () {
    Route::get('/books', [LibraryController::class, 'books'])->name('library.books');
    Route::get('/copies', [LibraryController::class, 'copies'])->name('library.copies');
    Route::get('/qr-generator', [LibraryController::class, 'qrGenerator'])->name('library.qr-generator');
    Route::get('/circulation/borrow', [LibraryController::class, 'borrowDesk'])->name('library.borrow');
    Route::get('/circulation/return', [LibraryController::class, 'returnDesk'])->name('library.return');
    Route::get('/history', [LibraryController::class, 'history'])->name('library.history');
});

// Pengaturan Sistem & Audit Logs
Route::prefix('settings')->group(function () {
    Route::get('/users', [SystemController::class, 'users'])->name('settings.users');
    Route::get('/roles-permissions', [SystemController::class, 'rolesPermissions'])->name('settings.roles-permissions');
    Route::get('/audit-logs', [SystemController::class, 'auditLogs'])->name('settings.audit-logs');
    Route::get('/notifications', [SystemController::class, 'notifications'])->name('settings.notifications');
});
