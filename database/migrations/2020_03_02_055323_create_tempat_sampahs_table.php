<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namalokasi');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            // $table->bigInteger('id_pimpinan_ecoranger')->unsigned()->nullable();
            // $table->foreign('id_pimpinan_ecoranger')
            //         ->references('id')
            //         ->on('pimpinan_ecoranger')
            //         ->onDelete('cascade')
            //         ->onUpdate('cascade');
            // $table->bigInteger('id_petugas_lapangan')->unsigned()->nullable();
            // $table->foreign('id_petugas_lapangan')
            //         ->references('id')
            //         ->on('petugas_lapangan')
            //         ->onDelete('cascade')
            //         ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_sampah');
    }
}
