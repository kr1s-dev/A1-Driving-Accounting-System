<?php

namespace App\Http\Requests\Receipt;

use App\Http\Requests\Request;

class ReceiptRequest extends Request
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
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['amount_paid' => 'required|min:0|max:9999999',];
                break;
            }
            //for update
            case 'PATCH':{  
                break;
            }
            //default
            default: break;
        }
    }
}
