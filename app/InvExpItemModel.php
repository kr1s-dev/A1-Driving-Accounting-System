<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvExpItemModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_expense_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_title_id',
    						'account_title_id',
    						'default_value',
    						'subject_to_vat',
    						'vat_percent',
                            'remarks',
                            'created_by',
                            'updated_by'];

    public function accountTitle(){
        return $this->belongsTo('App\AccountTitleModel','account_title_id');
    }
}
