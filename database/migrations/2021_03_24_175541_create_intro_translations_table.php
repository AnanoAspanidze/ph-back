<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intro_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('intro_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('sub_title');
            $table->text('description');
                        
            $table->unique(['intro_id', 'locale']);
            $table->foreign('intro_id')->references('id')->on('intros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intro_translations');
    }
}
