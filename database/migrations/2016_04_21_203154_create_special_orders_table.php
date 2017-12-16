<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_orders_basic', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',30)->unique()->nullable(false);
            $table->integer('qs_id')->nullable()->unsigned();
            $table->double('width', 15, 8)->nullable(false);
            $table->double('length', 15, 8)->nullable(false);
            $table->double('height', 15, 8)->nullable(false);
            $table->double('price', 15, 8)->nullable(false);
            $table->integer('colortype_id')->unsigned()->nullable(false);
            $table->integer('artschool_id')->unsigned()->nullable(false);
            $table->boolean('closed')->default(false);
            $table->integer('requester_id')->unsigned();
            $table->foreign('qs_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('colortype_id')->references('id')->on('color_types')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('artschool_id')->references('id')->on('art_schools')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::drop('special_orders_basic');
    }
}
