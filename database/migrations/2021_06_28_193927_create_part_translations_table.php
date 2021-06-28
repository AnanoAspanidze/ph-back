<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id')->index();
            $table->string('locale')->index();

            $table->string('title')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();

            $table->unique(['part_id', 'locale']);
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_translations');
    }
}
