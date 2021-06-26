<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplanationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explanation_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('explanation_id')->index();
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();

            $table->string('illustration_title')->nullable();
            $table->string('illustration_desc')->nullable();
            $table->string('illustration_source')->nullable();
 
            $table->unique(['explanation_id', 'locale']);
            $table->foreign('explanation_id')->references('id')->on('explanations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('explanation_translations');
    }
}
