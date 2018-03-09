<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Medien;
use App\Http\Resources\MedienResource;
use App\Feature;

/**
 * dieser Controller liefert div. Restabfragen aus.
 * z.B. für Features oder was auch immer.
 */
class DataController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        return "DatenController";
    }




}
