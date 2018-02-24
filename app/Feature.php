<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Verwaltung der möglichen Features in der Datenbank
 * Damit ist auch eine Verrechtung der Mitarbeiter möglich.
 */

class Feature extends Model
{
    const AUSLEIHEN = 'ausleihen';
    const MEDIEN_VERWALTUNG = 'medienverwaltung';
    const STATISTIK = 'statistik';
    Const ARTICLES = 'articles';
}
