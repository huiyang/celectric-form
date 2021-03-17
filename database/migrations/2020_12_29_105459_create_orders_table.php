<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_person');
            $table->string('cust_name');
            $table->string('term');
            $table->string('po_number');
            $table->date('pr_date');
            $table->string('quotation_number');
            $table->date('delivery_date');
            $table->double('grand_total_price');
            $table->double('grand_total_cost');
           
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
