<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategic_po', function (Blueprint $table) {
            $table->id('id');
            $table->string('po_number');
            $table->foreignId('series_name');
            $table->integer('status')->comment = '1=Active; 2=Archived';
            $table->foreignId('created_by');
            $table->foreignId('last_updated_by');
            $table->tinyInteger('logdel')->default(0);
            $table->timestamps();

            $table->foreign('series_name')->references('id')->on('serieses');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('last_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strategic_po');
    }
}
