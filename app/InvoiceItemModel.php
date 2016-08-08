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
                            'account_title_id',
                            'amount',
                            'remarks',
                            'created_by',
                            'updated_by'];
}
