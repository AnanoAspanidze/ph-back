<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->index();
            $table->string('locale')->index();

            $table->text('short_desc')->nullable();

            $table->unique(['course_id', 'locale']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_translations');
    }
}
