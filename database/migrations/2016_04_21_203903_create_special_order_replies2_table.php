<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOrderReplies2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_order_replies2', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('sorder_id')->unsigned();
            $table->timestamps('created_at');
            $table->boolean('isCustomer');
            $table->text('text');
            $table->foreign('sorder_id')->references('id')->on('special_orders_similar')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('sorder_id', 'created_at','isCustomer'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('special_order_replies2');
    }
}
