<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cubes', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('last_coordinate');
            $table->tinyInteger('queries_number');
            $table->unsignedInteger('test_case_id');
            $table->foreign('test_case_id')->references('id')->on('test_cases');
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
        Schema::dropIfExists('cubes');
    }
}
