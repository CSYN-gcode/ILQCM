<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samplings', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('monitoring_id');
            $table->foreignId('operator');
            $table->foreignId('station_id');
            $table->string('po_no');
            $table->string('series');
            $table->double('sample_size');
            $table->double('accept');
            $table->double('reject');
            $table->double('dppm');
            $table->integer('result');
            $table->text('remarks')->nullable();
            $table->integer('validation_result')->nullable();
            $table->integer('status')->comment = '1=Active; 2=Archived';
            $table->bigInteger('created_by');
            $table->bigInteger('last_updated_by');
            $table->tinyInteger('logdel')->default(0);
            $table->timestamps();
            
            // Foreign Key
            $table->foreign('monitoring_id')->references('id')->on('monitorings');
            $table->foreign('operator')->references('id')->on('users');
            $table->foreign('station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samplings');
    }
}
