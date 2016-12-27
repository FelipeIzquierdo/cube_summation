<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubeQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cube_queries', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['QUERY', 'UPDATE']);
            $table->tinyInteger('x1');
            $table->tinyInteger('y1');
            $table->tinyInteger('z1');
            $table->tinyInteger('x2')->nullable();
            $table->tinyInteger('y2')->nullable();
            $table->tinyInteger('z2')->nullable();
            $table->float('w')->nullable();
            $table->float('result')->nullable();
            $table->unsignedInteger('cube_id');
            $table->foreign('cube_id')->references('id')->on('cubes');
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
        Schema::dropIfExists('cube_queries');
    }
}
