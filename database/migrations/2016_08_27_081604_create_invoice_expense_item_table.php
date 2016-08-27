<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceExpenseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create home_owner_invoice_items Table in DB if it doesn't exist
        if(!Schema::hasTable('invoice_expense_items')){
            Schema::create('invoice_expense_items', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('account_title_id')->unsigned();
                $table->foreign('account_title_id')->references('id')->on('account_titles');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->String('item_name');
                $table->decimal('default_value',10,2)->default(0.00);
                $table->Boolean('subject_to_vat')->default(0);
                $table->Decimal('vat_percent',10,2)->default(0);
                $table->longText('remarks');
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
        //
    }
}
