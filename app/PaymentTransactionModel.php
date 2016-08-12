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
    protected $table = 'invoice_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['payment_id',
                            'amount_paid',
                            'file_related',
                            'created_by',
                            'updated_by'];



    public function invoiceInfo(){
        return $this->belongsTo('App\InvoiceModel','invoice_id');
    }
}
