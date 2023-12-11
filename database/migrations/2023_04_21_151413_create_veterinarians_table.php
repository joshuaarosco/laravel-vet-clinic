<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterinariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veterinarians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('salutation')->nullable();
            $table->string('address')->nullable();
            $table->string('specialty')->nullable();
            $table->text('bio')->nullable();

            $table->text('path')->nullable();
            $table->text('directory')->nullable();
            $table->string('filename', 100)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veterinarians');
    }
}
