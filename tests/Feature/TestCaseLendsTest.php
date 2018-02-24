<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;


class TestCaseLends extends TestCase
{
 
    // supercool - mit Databasemigrations wird die Datenbank neu erzeugt und anschliessend zurückgesetzt.
    use DatabaseMigrations;

    public function test_simple_lend()
    {
        // Benutzer anlegen
        $user = factory(\App\User::class)->create();

        // buch anlegen
        $book = factory(\App\Book::class)->create();
        // buch an Benutzer ausleihen
        $controller = new \App\Http\Controllers\lendController();
        $controller->lendBook($user->id, $book->id);
        // Benutzer hat eine Ausleihe
        $this->assertTrue($user->Lends()->count() == 1);
        $this->assertTrue($book->Lends()->count() == 1);
        
        // rückgabedatum ist richtig?
        // Benutzer gibt das Buch zurück
        $controller->returnBook($book->id);
        // Benutzer hat keine Ausleihe
        $this->assertTrue($user->Lends()->where('return_at',null)->count() == 0);
    }
    
}
