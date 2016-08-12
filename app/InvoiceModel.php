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
    protected $fillable = ['student_id',
                            'total_amount',
                            'is_paid',
                            'created_by',
                            'updated_by',];

    public function studentInfo(){
        return $this->belongsTo('App\StudentModel','student_id');
    }

    public function invoiceItemsInfo(){
        return $this->hasMany('App\InvoiceItemModel','invoice_id');
    }

    
}
