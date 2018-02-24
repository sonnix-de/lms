<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lend extends Model
{
    use Notifiable;
    protected $table = 'lends';
    protected $nonFillable = ['id'];
    protected $fillable = ['book_id','user_id','return_expected_at','lend_out_at','return'];
    public function user()
    {
        return $this->hasOne('\App\User');
    }
    public function book()
    {
        return $this->hasOne('\App\Book');
    }
    public function open()
    {
        return where('return',null);
    }
}
