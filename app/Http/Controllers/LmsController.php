<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feature;
use App\Article;


/**
 * Die Einstiegsseite für das LMS-System.
 * hier werden die Möglichkeiten für die Benutzer dargestellt
 * 
 * @author hans-juergen@sonnix.de
 * @version 1.0
 * @
 * 
 */
class LmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // was darf der Benutzer?
        // @todo lese die Möglichkeiten aus der Benutzerverwaltung.
        // hier erstmal hard codiert.
        $features = [Feature::ARTICLES ,Feature::AUSLEIHEN, Feature::MEDIEN_VERWALTUNG, Feature::STATISTIK];
        //$features = [Feature::ARTICLES];

        // welche Article-Typen sollen auf dieser Seite ausgegeben werden?
        $articleTypes = [Article::INTERN];

        return view('home', compact('features','articleTypes'));
    }
}
