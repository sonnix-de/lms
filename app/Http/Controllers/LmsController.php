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
 * 
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

    /**
     * Füllt die verhandenen Features in die Feature tabelle:
     */
    public function setFeatures(Request $request)
    {
        
        $features = [
            ['key' => 'User', 'title'=>'Benutzerverwaltung','descr' => 'Ausleihe von neuen Medien', 'route' => 'lms-medien'],
            ['key' => Feature::AUSLEIHEN,  'title'=>'','Ausleihen' => 'Ausleihe von neuen Medien', 'descr'=>'Ausleihe und Rückgabe', 'route' => 'lms-lends'],
            ['key' => Feature::ARTICLES, 'title'=>'Artikelverwaltung','descr' => 'Artikelverwaltung', 'route' => 'lms-lends'],
            ['key' => Feature::MEDIEN_VERWALTUNG,'title'=>'Medienverwaltung', 'descr' => 'Medienverwaltung', 'route' => 'lms-medien'],
            ['key' => Feature::STATISTIK, 'title'=>'Service', 'descr' => 'sTatistik, ', 'route' => 'lms-service'],
        ];
        
        
        foreach ($features as $feature)
        {
            $record = Feature::firstOrCreate (['key'=>$feature['key']]);
            $record->title = $feature['title'];
            $record->descr = $feature['descr'];
            $record->route = $feature['route'];
            $record->save();
        }
    }
}
