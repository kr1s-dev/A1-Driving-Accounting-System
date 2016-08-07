<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['created_by',
                            'stud_address',
                            'stud_company',
                            'stud_company_tel_no',
                            'stud_contact_mobile_no',
                            'stud_tel_no',
                            'stud_contact_name',
                            'stud_contact_tel_no',
                            'stud_vehicle',
                            'stud_date_of_birth',
                            'stud_birth_place',
                            'stud_email',
                            'stud_first_name',
                            'stud_gender',
                            'stud_last_name',
                            'stud_marital_status',
                            'stud_mobile_no',
                            'stud_nationality',
                            'stud_occupation',
                            'training_station_id',
                            'updated_by',];

    public function userCreateInfo(){
        return $this->belongsTo('App\User','created_by');
    }

    public function branchInfo(){
        return $this->belongsTo('App\BranchModel','training_station_id');
    }
}
