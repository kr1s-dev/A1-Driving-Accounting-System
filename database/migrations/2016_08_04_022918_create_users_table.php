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
        //Create users Table in DB if it doesn't exist
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('branch_id')->unsigned()->nullable();
                $table->foreign('branch_id')->references('id')->on('branch');
                $table->Integer('user_type_id')->unsigned();
                $table->foreign('user_type_id')->references('id')->on('user_type');
                $table->Integer('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->string('first_name',255);
                $table->string('last_name',255);
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->string('mobile_number',255);
                $table->string('telephone_number',255);
                $table->longtext('address');
                $table->boolean('is_active')->default(0);
                $table->string('confirmation_code')->nullable();
                $table->rememberToken();
                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Table of users if exist
        Schema::dropIfExists('users');
    }
}
