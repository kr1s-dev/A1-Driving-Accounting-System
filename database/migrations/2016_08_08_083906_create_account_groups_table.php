<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('account_groups')){
            Schema::create('account_groups', function (Blueprint $table) {
                $table->increments('id');
                $table->string('account_group_name',255)->unique();
                $table->string('description',255)->default('No Description');
                $table->Integer('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');
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
        //Drop Table of account_groups if exist
        Schema::dropIfExists('account_groups');
    }
}
