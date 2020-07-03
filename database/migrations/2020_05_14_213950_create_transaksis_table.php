<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_hadiah');
            $table->string('harga_hadiah');
            $table->integer('sisapoin');
            $table->integer('jumlah_hadiah');
            $table->string('file_gambar');
            $table->bigInteger('masyarakat_id')->unsigned()->nullable();
            $table->foreign('masyarakat_id')
                    ->references('id')
                    ->on('masyarakat')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('point_id')->unsigned()->nullable();
            $table->foreign('point_id')
                    ->references('id')
                    ->on('point')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('transaksi');
    }
}
