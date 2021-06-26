<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('topic_id')->index();
            $table->unsignedBigInteger('resourceable_id')->index();
            $table->string('resourceable_type')->index();

            $table->string('layout')->nullable();
            $table->boolean('show_steps')->default(false);
            $table->integer('sort')->nullable()->default(0)->index();
            $table->integer('parent')->nullable()->default(0)->index();
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('topic_resources');
    }
}
