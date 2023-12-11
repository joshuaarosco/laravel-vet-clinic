<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_code');
            $table->string('name');
            $table->string('type');
            $table->integer('stock')->default(0);
            $table->float('purchase_price',8,2)->nullable();
            $table->float('sale_price',8,2)->nullable();
            $table->float('profit',8,2)->nullable();
            $table->float('total_profit',8,2)->nullable();
            $table->date('expiration_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
