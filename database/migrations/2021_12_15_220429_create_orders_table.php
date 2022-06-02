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
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->nullable();
            $table->bigInteger('orderNo')->unique()->nullable();
            $table->double('subtotal', 16, 2);
            $table->double('shipping', 16, 2)->nullable();
            $table->double('discount', 16, 2)->nullable();
            $table->double('total', 16, 2)->nullable();
            $table->string('month');
            $table->string('year');
            $table->boolean('status')->default(1);
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
