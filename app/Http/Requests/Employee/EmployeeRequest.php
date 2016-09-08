<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\Request;
use App\EmployeeModel;

class EmployeeRequest extends Request
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
        $employee = EmployeeModel::find($this->employee);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['employee_first_name' => 'required|min:3|max:255',
                        'employee_middle_name' => 'required|min:3|max:255',
                        'employee_last_name' => 'required|min:3|max:255',
                        'employee_email' => 'required|email|min:3|max:255|unique:employee',
                        'employee_position' => 'required|min:3|max:255',
                        'employee_sss_deduction' => 'required',
                        'employee_philhealth_deduction' => 'required',
                        'employee_pagibig_deduction' => 'required',
                        'tax_status'=>'required',
                        'employee_salary'=>'required',];
            }
            //for update
            case 'PATCH':{  
                return ['employee_first_name' => 'required|min:3|max:255',
                        'employee_middle_name' => 'required|min:3|max:255',
                        'employee_last_name' => 'required|min:3|max:255',
                        'employee_email' => 'required|email|min:3|max:255|unique:employee,employee_email,' . $employee->id,
                        'employee_position' => 'required|min:3|max:255',
                        'employee_sss_deduction' => 'required',
                        'employee_philhealth_deduction' => 'required',
                        'employee_pagibig_deduction' => 'required',
                        'tax_status'=>'required',
                        'employee_salary'=>'required',];
            }
            //default
            default: break;
        }
    }
}
