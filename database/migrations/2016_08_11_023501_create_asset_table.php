<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('asset_items')){
            Schema::create('asset_items', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('created_by')->unsigned();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->Integer('account_title_id')->unsigned();
                $table->foreign('account_title_id')->references('id')->on('account_titles');
                $table->String('item_name',255);
                $table->String('description',255);
                $table->Decimal('total_cost')->default(0);
                $table->Decimal('salvage_value')->default(0);
                $table->Integer('quantity')->default(0);
                $table->Decimal('monthly_depreciation',10,2)->default(0);
                $table->Integer('useful_life')->default(0);
                $table->String('mode_of_acquisition',255);
                $table->Decimal('interest');
                $table->Decimal('down_payment');    
                $table->Decimal('accumulated_depreciation',10,2)->default(0);
                $table->Decimal('net_value',10,2)->default(0);
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
        Schema::dropIfExists('asset_items');
    }
}
