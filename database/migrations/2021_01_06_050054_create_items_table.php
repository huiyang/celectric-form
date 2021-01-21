<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('item_des');
            $table->string('model')->nullable();
            $table->integer('po_qty')->nullable();
            $table->integer('order_qty')->nullable();
            $table->double('sell_price')->nullable();
            $table->double('cost')->nullable();
            $table->double('total_price')->nullable();
            $table->double('total_cost')->nullable();
            $table->string('supplier')->nullable();
            $table->string('term_2')->nullable();
            $table->string('leadtime')->nullable();
            $table->double('margin')->nullable();
            $table->double('margin_percent')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('delivery_stat')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('items');
    }
}
