<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LendController extends LmsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('lms.lends');
    }

    public function lendBook(int $idUser, int $idBook)
    {
        return \App\Lend::lend($idUser,$idBook);
    }

    public function returnBook(int $idBook)
    {
        return \App\Lend::returnBook($idBook);
    }

}
