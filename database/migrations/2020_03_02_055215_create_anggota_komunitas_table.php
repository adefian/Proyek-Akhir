<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKomunitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_komunitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('nohp');
            $table->string('alamat');
            $table->string('jenis_kelamin');
            $table->string('wilayah');
            $table->string('level');
            $table->timestamps();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('id_komunitas')->unsigned();
            $table->foreign('id_komunitas')
                    ->references('id')
                    ->on('komunitas')
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
        Schema::dropIfExists('anggota_komunitas');
    }
}
