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
            $table->string('nama_hadiah')->nullable();
            $table->integer('harga_hadiah')->dafult(0);
            $table->integer('sisapoin')->default(0);
            $table->integer('jumlah_hadiah')->default(0);
            $table->string('file_gambar')->nullable();
            $table->bigInteger('masyarakat_id')->unsigned()->nullable();
            $table->foreign('masyarakat_id')
                ->references('id')
                ->on('masyarakat')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('point_id')->unsigned()->nullable();
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
