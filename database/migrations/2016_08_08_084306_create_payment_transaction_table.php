<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create home_owner_payment_transaction Table in DB if it doesn't exist
        if(!Schema::hasTable('payment_transaction')){
            Schema::create('payment_transaction', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('payment_id')->unsigned();
                $table->foreign('payment_id')->references('id')->on('students_invoice');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->decimal('amount_paid',10,2)->default(0.00);
                $table->binary('file_related');
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
        //Drop Table of home_owner_payment_transaction if exist
        Schema::dropIfExists('payment_transaction');
    }
}
