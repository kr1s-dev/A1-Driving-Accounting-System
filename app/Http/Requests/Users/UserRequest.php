<?php

namespace App\Http\Requests\Users;

use App\User;
use App\Http\Requests\Request;

class UserRequest extends Request
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
        $user = User::find($this->user);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'email' => 'required|email|max:255|unique:users',
                        'mobile_number' => 'required|min:11|max:13',
                        'telephone_number' => 'required|min:7|max:11',
                        'address' => 'required|max:255',
                        'user_type_id'=>'required',
                        'branch_id' => 'required',];
            }
            //for update
            case 'PATCH':{  
                return ['first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                        'mobile_number' => 'required|min:11|max:13',
                        'telephone_number' => 'required|min:7|max:11',
                        'address' => 'required|max:255',
                        'user_type_id'=>'required',
                        'branch_id' => 'required',];
            }
            //default
            default: break;
        }
    }
}
