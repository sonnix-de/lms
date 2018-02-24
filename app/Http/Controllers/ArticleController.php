<?php

namespace App\Http\Controllers;

use App\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($field, $value)
    {
        //dd($title);
        $article = [];
        $articles = Article::where($field,$value)->get();
        if (sizeof($articles))
        {
            $article = $articles->first();
        }
        
        return json_encode($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        //
    }

    public function SetTestDaten()
    {
        $pageHome = [
            'title' => 'Home',
            'teaser' => 'thats my home page',
            'content' => json_encode([
                'paragraph' => [
                    'category' => 'image',
                    'text' => 'Das ist ein <strong>Beispiel</strong> mit etwas Text',
                    'position' => ['width'=>4,'height' => 'auto'],
                ],
                'paragraph' => [
                    'category' => 'image',
                    'text' => 'Das ist ein <strong>Beispiel</strong> mit etwas Text',
                    'width' => '4',
                    'position' => ['width'=>4,'height' => 'auto'],
                ],
                ]),
            'online' => '2017-12-12',
            'offline' => '2019-12-12'
        ];
        //$pageHome['content'] = json_encode($pageHome['content']);
        $article = article::firstOrNew(['title'=>'Home']);
        $article->update($pageHome);
        $article->save();
        dd($article->toArray());
        /*
         'content' => [
            ],
            */
    }
}