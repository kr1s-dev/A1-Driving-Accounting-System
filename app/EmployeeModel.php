<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_first_name',
                            'employee_middle_name',
                            'employee_last_name',
                            'employee_email',
                            'employee_position',
                            'employee_sss_deduction',
                            'employee_philhealth_deduction',
                            'employee_pagibig_deduction',
                            'employee_withholding_tax',
                            'other_deduction',
                            'added_source_of_salary_taxable',
                            'added_source_of_salary_non_taxable',
                            'tax_status',
                            'is_active',
                            'employee_salary',
                            'created_by',
                            'updated_by'];

    public function userCreateInfo(){
        return $this->belongsTo('App\User','created_by');
    }
}
