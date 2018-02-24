<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('books'); 
        Schema::dropIfExists('medium_types'); 
        
        Schema::create('medium_types', function(Blueprint $table)
        {
            $table->increments('id')->unsigned()->index();
            $table->string('title',10);
            $table->string('descr',64)->nullable();
            $table->timestamps();

        });
        //DB::statement('select * from medium_types');
        DB::table('medium_types')->insert([
            ['title' => 'buch'],
        ]);

    
        
        Schema::create('books', function(Blueprint $table)
        {
            $table->increments('id')->unsigned()->index();
            $table->integer('nr')->unique();
            $table->string('barcode',13);
            $table->integer('id_medium_type');
            $table->foreign('id_medium_type')->references('id')->on('medium_types');
            $table->string('isbn13',13)->nullable();
            $table->string('author',255)->nullable();
            $table->string('title',255);
            $table->text('content')->nullable();
            $table->string('edition',64)->nullable();
            $table->integer('pages');
            $table->string('publisher')->nullable();
            $table->string('published_date')->nullable();
            $table->string('published_location')->nullable();
            
            $table->string('serie')->nullable();
            $table->string('signatur')->nullable();
            $table->string('category')->nullable();
            $table->string('lib_location')->nullable();
            $table->date('lib_added_date')->nullable();
            $table->date('lib_removed_date')->nullable();
            $table->string('status')->nullable();
            $table->string('antonlin')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
        
    }
    /**
     * Reverse the migrations.
     * (in umgekehrter reihenfolge!
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medium_types'); 
        Schema::dropIfExists('books');
    }
}