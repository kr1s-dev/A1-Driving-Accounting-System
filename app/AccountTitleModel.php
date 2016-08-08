<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountTitleModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'account_titles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_group_id',
                            'account_title_name',
                            'opening_balance',
                            'description',
                            'account_title_id',
                            'created_by',
                            'updated_by'];
}
