<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatigoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catigory_translations', function (Blueprint $table) {
                        $table->increments('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
                        $table->string('locale')->index();
                 
                        // Foreign key to the main model
                        $table->unsignedInteger('catigory_id');
                        $table->unique(['catigory_id', 'locale']);
                        $table->foreign('catigory_id')->references('id')->on('catigories')->onDelete('cascade');
                 
                        // Actual fields you want to translate
                        $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catigory_translations');
    }
}


//