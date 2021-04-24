<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Checkout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Checkout table

        Schema::create('checkout', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string("name");
            $table->string("cart_id");
            $table->text("billing");
            $table->string("add_fee");
            $table->string("discount");
            $table->string("subtotal");
            $table->string('grand_total');
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
        //
    }
}
