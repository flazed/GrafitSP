<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('print_dpi_id')->unsigned();
            $table->foreign('print_dpi_id')->references('id')->on('print_dpi');
            $table->string('name', 128);
            $table->integer('m10');
            $table->integer('m50');
            $table->integer('m200');
            $table->integer('m200plus');
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
        Schema::dropIfExists('materials');
    }
}
