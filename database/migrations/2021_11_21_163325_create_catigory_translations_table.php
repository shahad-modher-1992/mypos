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
            $table->unsignedBigInteger('catigory_id');
            $table->string('name');
            $table->unique(['catigory_id', 'locale']);
            $table->foreign('catigory_id')->references('id')->on('catigories')->onDelete('cascade');
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
