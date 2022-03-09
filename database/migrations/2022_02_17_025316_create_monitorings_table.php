<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('product_line_id');
            $table->foreignId('line_id');
            $table->foreignId('machine_id');
            $table->integer('work_week');
            $table->string('shift');
            $table->foreignId('qc_inspector')->nullable();
            $table->foreignId('qc_checked_by')->nullable();
            $table->integer('status')->comment = '1=Active; 2=Archived';
            $table->bigInteger('created_by');
            $table->bigInteger('last_updated_by');
            $table->tinyInteger('logdel')->default(0);
            $table->timestamps();

            $table->foreign('product_line_id')->references('id')->on('product_lines');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->foreign('qc_inspector')->references('id')->on('users');
            $table->foreign('qc_checked_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitorings');
    }
}
