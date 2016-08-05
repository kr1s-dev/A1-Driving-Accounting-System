<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name',
                            'last_name',
                            'email', 
                            'password',
                            'mobile_number',
                            'telephone_number',
                            'address',
                            'is_active',
                            'confirmation_code',
                            'branch_id',
                            'user_type_id',
                            'created_by',
                            'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 
                            'remember_token'];


    public function userType(){
        return $this->belongsTo('App\UserTypeModel');
    }
}
