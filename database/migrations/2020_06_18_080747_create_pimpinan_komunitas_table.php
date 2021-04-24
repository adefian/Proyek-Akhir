<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePimpinanKomunitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pimpinan_komunitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nohp');
            $table->string('alamat');   
            $table->string('bio')->nullable();
            $table->string('file_gambar')->nullable();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('komunitas_id')->unsigned();
            $table->foreign('komunitas_id')
                    ->references('id')
                    ->on('komunitas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('pimpinan_ecoranger_id')->unsigned();
            $table->foreign('pimpinan_ecoranger_id')
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
        Schema::dropIfExists('pimpinan_komunitas');
    }
}
