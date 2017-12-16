<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
        	$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('name',50)->unique()->nullable(false);
            $table->string('address')->nullable(false);           
            $table->string('email')->unique()->nullable(false);
            $table->string('phone',15)->unique()->nullable(false);
            $table->string('password')->unique()->nullable(false);
            $table->tinyinteger('role')->nullable(false); //0 for admin, 1 for customer, 2 for QS, 3 for HR
            $table->rememberToken();
            $table->timestamps();
        });

        DB::update("ALTER TABLE users AUTO_INCREMENT = 11;"); //to start counting the id from 11 and the first 10 rows for admins , qss and hrs
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
