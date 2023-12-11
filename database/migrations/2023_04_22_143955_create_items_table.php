<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('availed_service_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity')->default(0);
            $table->float('price',8,2)->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('availed_service_id')->references('id')->on('availed_services');
            $table->foreign('item_id')->references('id')->on('inventory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
