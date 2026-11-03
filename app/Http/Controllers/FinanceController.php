<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function bills(Request $request)
    {
        return view('modules.finance.bills', [
            'bills' => PesantrenService::getBills(),
            'students' => PesantrenService::getStudents(),
        ]);
    }

    public function transactions(Request $request)
    {
        return view('modules.finance.transactions', [
            'bills' => PesantrenService::getBills(),
            'students' => PesantrenService::getStudents(),
        ]);
    }

    public function tariffs()
    {
        return view('modules.finance.tariffs');
    }

    public function reports()
    {
        return view('modules.finance.reports', [
            'bills' => PesantrenService::getBills(),
        ]);
    }

    public function printInvoice(string $id)
    {
        $all = PesantrenService::getBills();
        $bill = null;
        foreach ($all as $item) {
            if ($item['id'] === $id) {
                $bill = $item;
                break;
            }
        }
        if (!$bill) {
            $bill = $all[0];
        }

        return view('modules.finance.invoice-print', ['bill' => $bill]);
    }
}
