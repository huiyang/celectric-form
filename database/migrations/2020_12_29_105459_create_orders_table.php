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
            $table->string('salesperson');
            $table->string('name');
            $table->string('term');
            $table->string('POnumber');
            $table->date('PRDate');
            $table->string('quatationNum');
            $table->date('deliveryDate');
            $table->string('itemDes');
            $table->string('model');
            $table->integer('poQty');
            $table->integer('orderQty');
            $table->double('sellprc');
            $table->double('cost');
            $table->double('totalprc');
            $table->double('totalcst');
            $table->string('supplier');
            $table->string('term2');
            $table->string('leadtime');
            $table->double('totalmargin');
            $table->double('margin');
            $table->string('invoiceNum');
            $table->string('deliveryStat');
            $table->string('remark');
            
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
