<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('other_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('title');
            $table->string('sub_title');
            $table->text('description');
            $table->string('resource')->nullable();
                        
            $table->unique(['other_id', 'locale']);
            $table->foreign('other_id')->references('id')->on('others')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_translations');
    }
}
