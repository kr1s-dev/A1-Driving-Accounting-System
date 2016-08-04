<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create user_type Table in DB if it doesn't exist
        if(!Schema::hasTable('branch')){
            Schema::create('branch', function (Blueprint $table) {
                $table->increments('id');
                $table->string('branch_name',255)->unique();
                $table->string('branch_address',255);
                $table->boolean('main_office')->default(0);
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
        Schema::dropIfExists('branch');
    }
}
