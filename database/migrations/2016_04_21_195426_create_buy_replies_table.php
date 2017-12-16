<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_replies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('request_id')->unsigned();
            $table->timestamps('created_at');
            $table->boolean('isCustomer');
            $table->text('text');   
            $table->primary(array('request_id', 'created_at','isCustomer'));
        });

         Schema::table('buy_replies', function (Blueprint $table) {  
            $table->foreign('request_id')->references('id')->on('buy_requests')->onUpdate('cascade')->onDelete('cascade');   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buy_replies');
    }
}
