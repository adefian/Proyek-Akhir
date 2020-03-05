<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KontenAnimasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konten_animasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_konten');
            $table->string('animasi');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konten_animasi');
    }
}
