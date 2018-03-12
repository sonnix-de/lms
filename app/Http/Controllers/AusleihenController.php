<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AusleihenController extends LmsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('lms.ausleihen');
    }

    public function lendBook(int $idUser, int $idBook)
    {
        return \App\Lend::lend($idUser,$idBook);
    }


    /**
     * Durchführung der Ausleihe!
     */
    public function ausleihe(Request $request )
    {
        $books = $request->input('books');
        $idUser = $request->input('id_user');
        foreach ($books as $book)
        {
            \App\Ausleihen::leiheAus($idUser, $book['id']);
        }
        return "OK";
    }


    public function returnBook(int $idBook)
    {
        return \App\Lend::returnBook($idBook);
    }

}
