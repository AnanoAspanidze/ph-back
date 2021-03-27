<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_additionals', function (Blueprint $table) {
            $table->id();

            $table->integer('topic_resource_id')->unsigned()->nullable();
            $table->integer('topic_id')->unsigned()->nullable();
            
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('type')->index();
            $table->string('pdf')->nullable();
            $table->string('source')->nullable();            
            $table->boolean('pinned')->default(false);
            $table->boolean('active')->default(true);

            $table->foreign('topic_resource_id')->references('id')->on('topic_resources')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_additionals');
    }
}
