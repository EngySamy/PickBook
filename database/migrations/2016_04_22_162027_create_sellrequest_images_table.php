<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellrequestImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellrequest_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('link')->default("");
            $table->integer('request_id')->unsigned()->nullable(false);
            $table->foreign('request_id')->references('id')->on('sell_requests')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['link', 'request_id']);
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
        Schema::drop('sellrequest_images');
    }
}
