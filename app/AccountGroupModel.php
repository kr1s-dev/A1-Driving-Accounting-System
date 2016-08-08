<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountGroupModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'account_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_group_name',
                            'description',
                            'created_by',
                            'updated_by'];
}
