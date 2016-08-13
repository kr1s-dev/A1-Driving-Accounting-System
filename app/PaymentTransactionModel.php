<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransactionModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['payment_id',
                            'amount_paid',
                            'created_by',
                            'updated_by',
                            'outstanding_balance'];



    public function invoiceInfo(){
        return $this->belongsTo('App\InvoiceModel','payment_id');
    }
}
