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

    /**
     * Einfacher Ausleihvorgang ohne Einschränkungen
     */
    public function test_simple_lend()
    {
        // Benutzer anlegen
        $user = factory(\App\User::class)->create();

        // Buch anlegen
        $book = factory(\App\Medien::class)->create();

        // Buch an Benutzer ausleihen
        $controller = new \App\Http\Controllers\LendController();
        $id = $controller->lendBook($user->id, $book->id);
        echo "erzeugte ID =", $id;
        $this->assertTrue($id > 0);
        
        // Benutzer hat eine Ausleihe
        $this->assertTrue($book->lends()->count() == 1);
        
        // rückgabedatum ist richtig?
        // Benutzer gibt das Buch zurück
        $controller->returnBook($book->id);
        // Benutzer hat keine Ausleihe
        $this->assertTrue($user->lends()->where('return_at',null)->count() == 0);
    }

    /**
     * Wiederholte Ausleihe, bis das Maximum erreicht ist.
     */
    
}
