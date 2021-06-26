<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutIllustrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_imgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_id')->index();
           
            $table->string('illustration');
            $table->boolean('active')->default(true);
            
            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_illustrations');
    }
}
