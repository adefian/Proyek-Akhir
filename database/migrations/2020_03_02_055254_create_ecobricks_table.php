<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcobricksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecobrick', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pengirimsaran');
            $table->string('foto_diusulkan');
            $table->string('foto_diaplikasikan');
            $table->string('keterangan');
            $table->integer('level');
            $table->timestamps();
            $table->bigInteger('id_pimpinan_ecoranger')->unsigned();
            $table->foreign('id_pimpinan_ecoranger')
                    ->references('id')
                    ->on('pimpinan_ecoranger')
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
        Schema::dropIfExists('ecobrick');
    }
}
