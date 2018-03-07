<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Verwaltung der möglichen Features in der Datenbank
 * Damit ist auch eine Verrechtung der Mitarbeiter möglich.
 */

class Feature extends Model
{
    const AUSLEIHEN = 'Ausleihen';
    const MEDIEN_VERWALTUNG = 'Medienverwaltung';
    const STATISTIK = 'Statistik';
    Const ARTICLES = 'Articles';
    Const BENUTZER = 'User';

    protected $fillable = ['key','title','descr','route'];


}
