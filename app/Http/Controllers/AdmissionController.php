<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function applicants()
    {
        return view('modules.admissions.applicants', [
            'admissions' => PesantrenService::getAdmissions(),
        ]);
    }

    public function verify(string $id)
    {
        $all = PesantrenService::getAdmissions();
        $applicant = null;
        foreach ($all as $item) {
            if ($item['id'] === $id || $item['registration_number'] === $id) {
                $applicant = $item;
                break;
            }
        }
        if (!$applicant) {
            $applicant = $all[0];
        }

        return view('modules.admissions.verify', ['applicant' => $applicant]);
    }

    public function tests()
    {
        return view('modules.admissions.tests', [
            'admissions' => PesantrenService::getAdmissions(),
        ]);
    }

    public function selectionResults()
    {
        return view('modules.admissions.selection-results', [
            'admissions' => PesantrenService::getAdmissions(),
        ]);
    }
}
