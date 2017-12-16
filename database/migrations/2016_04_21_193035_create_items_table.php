<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',30)->unique()->nullable(false);
            $table->double('width', 15, 8)->nullable(false);
            $table->double('length', 15, 8)->nullable(false);
            $table->double('height', 15, 8)->nullable(false);
            $table->double('price', 15, 8)->nullable(false);
            $table->integer('language_id')->nullable(false)->unsigned();
            $table->integer('category_id')->nullable(false)->unsigned();
            $table->boolean('sold')->default(false);
            $table->integer('rating')->unsigned()->default(0);
            $table->integer('buyer_id')->unsigned()->nullable();   //after closing the buy request 
            $table->integer('seller_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('seller_id')->references('id')->on('users');
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
        Schema::drop('items');
    }
}
