<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('journal_entry')){
            Schema::create('journal_entry', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->Integer('invoice_id')->unsigned()->nullable();
                $table->foreign('invoice_id')->references('id')->on('students_invoice');
                $table->Integer('receipt_id')->unsigned()->nullable();
                $table->foreign('receipt_id')->references('id')->on('payment_transaction');
                $table->Integer('expense_id')->unsigned()->nullable();
                $table->foreign('expense_id')->references('id')->on('expense_cash_voucher');
                $table->Integer('asset_id')->unsigned()->nullable();
                $table->foreign('asset_id')->references('id')->on('asset_items');
                $table->String('type',255);
                $table->string('description',255)->default('No Description');
                $table->Integer('debit_title_id')->unsigned()->nullable();
                $table->foreign('debit_title_id')->references('id')->on('account_titles');
                $table->Integer('credit_title_id')->unsigned()->nullable();
                $table->foreign('credit_title_id')->references('id')->on('account_titles');
                $table->decimal('debit_amount',10,2)->default(0.00);
                $table->decimal('credit_amount',10,2)->default(0.00);
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
        //Drop Table of journal_entry if exist
        Schema::dropIfExists('journal_entry');
    }
}
