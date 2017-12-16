<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_requests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',30)->nullable(false);
            $table->integer('qs_id')->nullable()->unsigned();
            $table->boolean('closed')->default(false);
            $table->integer('item_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->foreign('qs_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('buy_requests');
    }
}
