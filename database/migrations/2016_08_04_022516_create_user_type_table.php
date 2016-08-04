<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create user_type Table in DB if it doesn't exist
        if(!Schema::hasTable('user_type')){
            Schema::create('user_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type',255)->unique();
                $table->string('description',255)->default('No Description');
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
        //Drop Table of UserType if exist
        Schema::dropIfExists('user_type');
    }
}
