<?php

namespace App\Http\Controllers;

use App\Services\PesantrenService;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function books(Request $request)
    {
        return view('modules.library.books', [
            'books' => PesantrenService::getBooks(),
        ]);
    }

    public function copies(Request $request)
    {
        return view('modules.library.copies', [
            'copies' => PesantrenService::getBookCopies(),
        ]);
    }

    public function qrGenerator(Request $request)
    {
        return view('modules.library.qr-generator', [
            'copies' => PesantrenService::getBookCopies(),
            'books' => PesantrenService::getBooks(),
        ]);
    }

    public function borrow(Request $request)
    {
        return view('modules.library.borrow', [
            'students' => PesantrenService::getStudents(),
            'copies' => PesantrenService::getBookCopies(),
        ]);
    }

    public function borrowDesk(Request $request)
    {
        return $this->borrow($request);
    }

    public function returnBook(Request $request)
    {
        return view('modules.library.return', [
            'circulations' => PesantrenService::getCirculations(),
            'copies' => PesantrenService::getBookCopies(),
        ]);
    }

    public function returnDesk(Request $request)
    {
        return $this->returnBook($request);
    }

    public function history(Request $request)
    {
        return view('modules.library.history', [
            'circulations' => PesantrenService::getCirculations(),
        ]);
    }
}
