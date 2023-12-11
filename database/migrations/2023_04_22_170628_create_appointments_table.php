<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('vet_id')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->string('status')->default('Pending')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->text('details')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('vet_id')->references('id')->on('veterinarians');
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
        Schema::dropIfExists('appointments');
    }
}
