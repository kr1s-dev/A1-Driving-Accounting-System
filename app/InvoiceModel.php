<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students_invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['students_id',
                            'total_amount',
                            'is_paid',
                            'created_by',
                            'updated_by'];
}
