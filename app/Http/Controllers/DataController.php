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

    /**
     * Bringt die gewünschten Features ans Licht.
     * wenn nicht gefunden, wird der Datensatz angelegt.
     */
    public function getFeature(Request $request, $key = "", $newCreated=false)
    {
        if ($key)
        {
            $features = Feature::where('key',$key)->get();
            if (sizeof($features))
            {
                return $features->first()->toJson();
            }
            if (!$newCreated)
            {
                $record = Feature::create(['key'=>$key,'title'=>$key,'descr'=>'gerade neu angelegt!']);
                return $this->getFeature($request,$key,true);

            }
        }
        return json_encode(['title'=>$key,'descr'=>'Fehler bei der Anlage','img'=>'irgeineinbloedesImage']);
    }


}
