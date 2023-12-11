<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAvailedSericesTableAddInvoiceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availed_services', function($table)
        {
            $table->integer("invoice_id")->nullable()->after('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availed_services', function($table)
        {
            $table->dropColumn(array('invoice_id',));
        });
    }
}
