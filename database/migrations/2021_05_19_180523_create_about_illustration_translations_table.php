<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutIllustrationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_img_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_img_id')->index();
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->string('file_name')->nullable();

            $table->unique(['about_img_id', 'locale']);
            $table->foreign('about_img_id')->references('id')->on('about_imgs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_illustration_translations');
    }
}
