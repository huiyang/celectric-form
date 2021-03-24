<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersAddCustomerIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('orders', function($table) {
            $table->unsignedInteger('requestor_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('requestor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('orders', function($table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['requestor_id']);
            $table->dropColumn('customer_id');
            $table->dropColumn('requestor_id');
        });
    }
}
