<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lend extends Model
{
    use Notifiable;
    protected $table = 'lends';
    protected $nonFillable = ['id'];
    protected $fillable = ['book_id', 'user_id', 'return_expected_at', 'lend_out_at', 'return'];

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
        return where('return', null);
    }

    /**
     * Ausleihroutine.
     */
    public static function lend(int $idUser, int $idBook)
    {
        $insert = [
            'user_id' => $idUser,
            'book_id' => $idBook,
            'lend_out_at' => date('Y-m-d'),
            'return_expected_at' => self::getReturnDate($idBook),
        ];
        $record = self::create($insert);
        $record->save();
        return $record->id;
    }

    /**
     * bucht ein Buch wieder zurück
     */
    public static function returnBook(int $idBook)
    {
        $records = self::where('book_id',$idBook)->where('return_at',null)->get();
        foreach ($records as $record)
        {
            $record->return_at = date('Y-m-d');
            $record->save();
        }
    }

    /**
     * Berechnet das Rückgabedatum!
     */
    private static function getReturnDate(int $idBook)
    {
        $date = new \Carbon\Carbon();
        $date->addDay(env('AUSLEIHDAUER', 28));
        return $date->format('Y-m-d');
    }

}
