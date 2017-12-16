<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOrderSimilarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('special_orders_similar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',30)->nullable(false);
            $table->integer('qs_id')->nullable()->unsigned(); 
            $table->boolean('closed')->default(false);
            $table->integer('similaritem_id')->unsigned()->nullable(false);
            $table->integer('requester_id')->unsigned();
            $table->foreign('similaritem_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('qs_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('requester_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('special_orders_similar');
    }
}
