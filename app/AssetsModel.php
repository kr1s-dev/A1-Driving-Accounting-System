<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetsModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asset_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['created_by',
                            'updated_by',
                            'account_title_id',
                            'asset_name',
                            'asset_desc',
                            'asset_vendor',
                            'asset_date_acquired',
                            'asset_original_cost',
                            'asset_salvage_value',
                            'asset_lifespan',
                            'monthly_depreciation',
                            'asset_mode_of_acq',
                            'asset_down_payment',
                            'accumulated_depreciation',
                            'net_value',];

    public function userCreateInfo(){
        return $this->belongsTo('App\User','created_by');
    }

    public function accountTitleInfo(){
        return $this->belongsTo('App\AccountTitleModel','account_title_id');
    }

}