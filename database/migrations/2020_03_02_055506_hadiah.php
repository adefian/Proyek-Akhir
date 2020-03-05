<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hadiah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadiah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_hadiah');
            $table->integer('jumlah');
            $table->string('keterangan');
            $table->timestamps();
            $table->bigInteger('id_petugas_kontenreward')->unsigned();
            $table->foreign('id_petugas_kontenreward')
                    ->references('id')
                    ->on('petugas_kontenreward')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('id_pimpinan_ecoranger')->unsigned();
            $table->foreign('id_pimpinan_ecoranger')
                    ->references('id')
                    ->on('pimpinan_ecoranger')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('id_masyarakat')->unsigned();
            $table->foreign('id_masyarakat')
                    ->references('id')
                    ->on('masyarakat')
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
        Schema::dropIfExists('hadiah');
    }
}
