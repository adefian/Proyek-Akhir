<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('keterangan');
            $table->string('jenis_agenda')->default(0);
            $table->string('tanggal');
            $table->timestamps();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('komunitas_id')->unsigned()->nullable();
            $table->foreign('komunitas_id')
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
        Schema::dropIfExists('agenda');
    }
}
