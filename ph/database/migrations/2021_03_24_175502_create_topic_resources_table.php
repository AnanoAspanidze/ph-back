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
        Schema::create('topic_resources', function (Blueprint $table) {
            $table->id();
            
            $table->integer('topic_id')->unsigned();
            $table->integer('topic_resourceable_id')->unsigned();
            $table->string('topic_resourceable_type');

            $table->string('layout');
            $table->boolean('show_steps')->default(false);
            $table->integer('sort')->default(0);
            $table->integer('parent')->default(0);
            $table->boolean('active')->default(true);

            $table->index(['morphable_id', 'morphable_type', 'parent', 'sort']);
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
