<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('students_invoice')){
            Schema::create('students_invoice', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('student_id')->unsigned();
                $table->foreign('student_id')->references('id')->on('students');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->decimal('total_amount',10,2)->default(0.00);
                $table->Boolean('is_paid')->default(0);
                $table->timestamp('payment_due_date');
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
        //Drop Table of students_invoice if exist
        Schema::dropIfExists('students_invoice');
    }
}
