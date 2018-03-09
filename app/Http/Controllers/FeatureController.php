<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $key, $newCreated = false)
    {
        $features = Feature::where('key', $key)->get();
        if (sizeof($features)) {
            $feature = $features->first();
            if ($feature->route)
            {
                try
                {
                $feature->url = route($feature->route);
                }
                catch (\Exception $e) 
                {
                    //echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
                }
            }
            return $feature->toJson();
        }            
        else
            {
                $feature->url = "#";
                return $feature->toJson();
        }
        if (!$newCreated) {
            $record = Feature::create(['key' => $key, 'title' => $key, 'descr' => 'gerade neu angelegt!']);
            return $this->show($request, $key, true);
        }

    }

    /**
     * Show the form for editing a program feature
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.feature', ['feature' => \App\Feature::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'key' => 'required',
        ]);
        $params = $request->post();
        $key = $params['key'];
        $record = Feature::where('key', $key)->first();
        $record->update($params);
        //$record->save();
        return $record->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
