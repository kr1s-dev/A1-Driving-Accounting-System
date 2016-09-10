<?php

namespace App\Http\Requests\Students;

use App\Http\Requests\Request;
use App\StudentModel;
class StudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $student = StudentModel::find($this->students);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['training_station_id'=>'required',
                        'stud_first_name' => 'required|max:255',
                        'stud_last_name' => 'required|max:255',
                        'stud_mobile_no' => 'required|min:11|max:13',
                        'stud_address' => 'required|max:255',
                        'stud_vehicle'=>'required|max:255',
                        'stud_email' => 'required|email|max:255|unique:students',
                        'stud_date_of_birth' => 'required',
                        'stud_birth_place'=>'required|min:3|max:255',
                        'stud_nationality'=>'required|min:3|max:255',
                        'stud_marital_status' => 'required',
                        'stud_gender' => 'required',
                        'stud_occupation' => 'required|min:3|max:255',
                        'stud_company' => 'required|min:3|max:255',
                        'stud_company_tel_no' => 'required|min:7|max:11',
                        'stud_contact_name' => 'required|max:255',
                        'stud_contact_mobile_no' => 'required|min:11|max:13',
                        'stud_contact_tel_no' => 'min:7|max:11',];
            }
            //for update
            case 'PATCH':{  
                return ['training_station_id'=>'required',
                        'stud_first_name' => 'required|max:255',
                        'stud_last_name' => 'required|max:255',
                        'stud_mobile_no' => 'required|min:11|max:13',
                        'stud_address' => 'required|max:255',
                        'stud_vehicle'=>'required|max:255',
                        'stud_email' => 'required|email|max:255|unique:students,stud_email,'.$student->id,
                        'stud_date_of_birth' => 'required',
                        'stud_birth_place'=>'required|min:3|max:255',
                        'stud_nationality'=>'required|min:3|max:255',
                        'stud_marital_status' => 'required',
                        'stud_gender' => 'required',
                        'stud_occupation' => 'required|min:3|max:255',
                        'stud_company' => 'required|min:3|max:255',
                        'stud_company_tel_no' => 'required|min:7|max:11',
                        'stud_contact_name' => 'required|max:255',
                        'stud_contact_mobile_no' => 'required|min:11|max:13',
                        'stud_contact_tel_no' => 'min:7|max:11',];
            }
            //default
            default: break;
        }
    }
}
