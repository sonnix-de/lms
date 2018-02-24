<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\Http\Controllers\api\booksApiControlller;



class isbnServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_isbn_service_returns_korrekt_author_test()
    {
        $isbn13 = "9783834815378";
        $ctl = new \App\Http\Controllers\api\booksApiController();
        $result = $ctl->getIsbnData(request(), $isbn13);
        $this->assertTrue($result['author'] === 'Gottfried Vossen, Kurt-Ulrich Witt');
    }
}
