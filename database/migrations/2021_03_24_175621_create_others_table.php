<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('resource_id')->index()->nullable();
            $table->string('type')->nullable()->index();
            $table->string('illustration')->nullable();
            $table->string('video')->nullable();
            // $table->boolean('show_steps')->default(false);
            // $table->boolean('active')->default(true);

            // $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('others');
    }
}
