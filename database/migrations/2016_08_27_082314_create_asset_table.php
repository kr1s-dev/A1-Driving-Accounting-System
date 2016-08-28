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
                $table->String('asset_name',255);
                $table->String('asset_desc',255)->default('No Description');
                $table->String('asset_vendor',255);
                $table->timestamp('asset_date_acquired');
                $table->Decimal('asset_original_cost',10,2)->default(0);
                $table->Decimal('asset_salvage_value',10,2)->default(0);
                $table->Integer('asset_lifespan')->default(0);
                $table->Decimal('monthly_depreciation',10,2)->default(0);
                $table->String('asset_mode_of_acq',255);
                $table->Decimal('asset_down_payment',10,2)->default(0);    
                $table->Decimal('accumulated_depreciation',10,2)->default(0);
                $table->Decimal('net_value',10,2)->default(0);
                $table->timestamp('next_depreciation_date');
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
