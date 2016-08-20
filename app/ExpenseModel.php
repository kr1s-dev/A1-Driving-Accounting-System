<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expense_cash_voucher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_name',
    						'vendor_address',
    						'vendor_number',
                            'total_amount',
                            'created_by',
                            'updated_by',];


    public function expenseItemsInfo(){
        return $this->hasMany('App\ExpenseItemModel','expense_cash_voucher_id');
    }
}
