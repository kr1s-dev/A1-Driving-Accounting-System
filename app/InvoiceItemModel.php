<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItemModel extends Model
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
    protected $fillable = ['invoice_id',
                            'item_id',
                            'amount',
                            'remarks',
                            'created_by',
                            'updated_by'];

    public function invoiceInfo(){
        return $this->belongsTo('App\InvoiceModel','invoice_id');
    }

    public function item(){
        return $this->belongsTo('App\InvExpItemModel','item_id');
    }
}
