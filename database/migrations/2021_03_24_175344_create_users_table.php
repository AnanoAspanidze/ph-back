<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->integer('position_id')->index()->unsigned();
            $table->integer('region_id')->index()->unsigned();

            $table->string('name');
            $table->string('surname');
            $table->string('position_name')->nullable();
            $table->string('work_place');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('approve')->default(false);
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
