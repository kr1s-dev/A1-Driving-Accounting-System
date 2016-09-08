<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employee')){
            Schema::create('employee', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->String('employee_first_name',255);
                $table->String('employee_middle_name',255);
                $table->String('employee_last_name',255);
                $table->String('employee_email',255)->unique();
                $table->String('employee_position',255);
                $table->decimal('employee_sss_deduction',10,2);
                $table->decimal('employee_philhealth_deduction',10,2);
                $table->decimal('employee_pagibig_deduction',10,2);
                $table->decimal('employee_withholding_tax',10,2);
                $table->decimal('other_deduction',10,2);
                $table->decimal('added_source_of_salary_taxable',10,2);
                $table->decimal('added_source_of_salary_non_taxable',10,2);
                $table->String('tax_status',255);
                $table->boolean('is_active')->default(1);
                $table->decimal('employee_salary',10,2)->default(0);
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
        //Drop Table of asset_items if exist
        Schema::dropIfExists('employee');
    }
}
