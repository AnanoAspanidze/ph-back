<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id')->index();
            $table->string('locale')->index();
            
            $table->string('answer')->nullable();
            
            $table->unique(['answer_id', 'locale']);
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_translations');
    }
}
