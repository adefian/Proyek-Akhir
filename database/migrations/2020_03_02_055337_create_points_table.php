<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->string('kode_reward')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
            $table->bigInteger('masyarakat_id')->unsigned()->nullable();
            $table->foreign('masyarakat_id')
                    ->references('id')
                    ->on('masyarakat')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->bigInteger('tempat_sampah_id')->unsigned()->nullable();
            $table->foreign('tempat_sampah_id')
                    ->references('id')
                    ->on('tempat_sampah')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('code_reward')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point');
    }
}
