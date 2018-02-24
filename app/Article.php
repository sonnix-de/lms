<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const INTERN="intern";
    protected $guarded = ['id'];
    protected $fillable = ['title','teaser','content','online','offline'];
    //
}
