<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['branch_name',
                            'branch_address',
                            'main_office',
                            'branch_tel_number'];
}
