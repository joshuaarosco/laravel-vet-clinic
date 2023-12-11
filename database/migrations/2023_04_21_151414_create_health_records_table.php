<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vet_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('procedure')->nullable();
            $table->string('weight')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('vet_id')->references('id')->on('veterinarians');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_records');
    }
}
