<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialorderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialorder_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('link')->default("");
            $table->integer('order_id')->unsigned()->nullable(false);
            $table->foreign('order_id')->references('id')->on('special_orders_basic')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['link', 'order_id']);
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
        Schema::drop('specialorder_images');
    }
}
