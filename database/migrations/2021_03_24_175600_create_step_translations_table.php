<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('step_id')->index();
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            
            $table->string('illustration_title')->nullable();
            $table->string('illustration_desc')->nullable();
            $table->string('illustration_source')->nullable();
            
            $table->unique(['step_id', 'locale']);
            $table->foreign('step_id')->references('id')->on('steps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('step_translations');
    }
}
