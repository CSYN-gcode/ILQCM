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
            $table->foreignId('operator')->nullable();
            $table->foreignId('station_id')->nullable()->nullable();
            $table->string('po_no')->nullable();
            $table->string('series')->nullable();
            $table->double('sample_size')->nullable();
            $table->double('accept')->nullable();
            $table->double('reject')->nullable();
            $table->double('dppm')->nullable();
            $table->integer('result')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('validation_result')->nullable();
            $table->integer('no_production')->nullable()->comment = '1=Yes; 2=No';
            $table->integer('status')->nullable()->comment = '1=Active; 2=Archived';
            $table->date('no_production_date')->nullable();
            $table->integer('sampling_type')->nullable()->comment = '0=Automatic; 1=Manual';
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
