<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availed_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('record_id');
            $table->unsignedBigInteger('service_id');
            $table->date('date')->nullable();
            $table->date('next_due_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('record_id')->references('id')->on('health_records');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availed_services');
    }
}
