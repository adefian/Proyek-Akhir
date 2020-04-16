<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasyarakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('nohp');
            $table->string('alamat');
            $table->timestamps();
            $table->bigInteger('hadiah_id')->unsigned()->nullable();
            $table->foreign('hadiah_id')
                    ->references('id')
                    ->on('hadiah')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('point_id')->unsigned()->nullable();
            $table->foreign('point_id')
                    ->references('id')
                    ->on('point')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masyarakat');
    }
}
