<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Medien extends Model
{
    use Notifiable;
    protected $table = 'books';
    protected $nonFillable = ['id'];
    protected $guarded = ['id'];

    /**
     * Ausleihen
     */
    public function lends()
    {
        return $this->hasMany('App\Lend','book_id');
    }
}
