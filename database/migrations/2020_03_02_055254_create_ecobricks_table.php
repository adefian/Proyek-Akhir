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
            $table->string('nama_pengirimsaran')->nullable();
            $table->string('foto_diusulkan')->nullable();
            $table->string('foto_diaplikasikan')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('level')->default(0);
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
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
