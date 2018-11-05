<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_id');
            $table->integer('order_status');
            $table->integer('order_date');
            $table->integer('total_price');
            $table->string('name');
            $table->string('area');
            $table->string('block');
            $table->string('street');
            $table->string('avenue');
            $table->string('house_buliding');
            $table->string('flat');
            $table->string('mobile_no');
            $table->text('notes');
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
