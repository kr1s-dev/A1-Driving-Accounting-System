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
                            'item_name',
                            'description',
                            'total_cost',
                            'salvage_value',
                            'quantity',
                            'monthly_depreciation',
                            'useful_life',
                            'mode_of_acquisition',
                            'interest',
                            'down_payment',
                            'accumulated_depreciation',
                            'net_value',];

    public function accountTitleInfo(){
        return $this->belongsTo('App\AccountTitleModel','account_title_id');
    }

}
