<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_replies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('request_id')->unsigned();
            $table->timestamps('created_at');
            $table->boolean('isCustomer');
            $table->text('text');
            $table->foreign('request_id')->references('id')->on('sell_requests')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('request_id', 'created_at','isCustomer'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sell_replies');
    }
}
