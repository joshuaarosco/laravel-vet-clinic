<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('record_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('invoice_number');
            $table->float('amount',8,2);
            $table->string('status');
            $table->string('description');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('record_id')->references('id')->on('health_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
