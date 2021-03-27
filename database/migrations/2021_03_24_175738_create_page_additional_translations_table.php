<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageAdditionalTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_additional_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('page_additional_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('title');
            $table->text('description');
                        
            $table->unique(['page_additional_id', 'locale']);
            $table->foreign('page_additional_id')->references('id')->on('page_additionals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_additional_translations');
    }
}
