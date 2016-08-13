<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountInformationModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'journal_entry';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['updated_by',
    						'created_by',
                            'credit_title_id',
                            'debit_title_id',
                            'description',
                            'expense_id',
                            'invoice_id',
                            'receipt_id',
                            'asset_id',
                            'type'];


    // public function expense(){
    //     return $this->belongsTo('App\ExpenseModel');
    // }

    public function receipt(){
        return $this->belongsTo('App\ReceiptModel','receipt_id');
    }

    public function invoice(){
        return $this->belongsTo('App\InvoiceModel','invoice_id');
    }

    // public function asset(){
    //     return $this->belongsTo('App\InvoiceModel');
    // }

    public function credit(){
        return $this->belongsTo('App\AccountTitleModel','credit_title_id');
    }

    public function debit(){
        return $this->belongsTo('App\AccountTitleModel','debit_title_id');
}
