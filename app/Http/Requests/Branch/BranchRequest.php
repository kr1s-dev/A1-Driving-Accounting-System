<?php

namespace App\Http\Requests\Branch;

use App\BranchModel;
use App\Http\Requests\Request;

class BranchRequest extends Request
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
        $branch = BranchModel::find($this->branches);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['branch_name' => 'required|max:255|unique:branch',
                        'branch_address' => 'required',];
            }
            //for update
            case 'PATCH':{  
                return ['branch_name' => 'required|max:255|unique:branch,branch_name,'.$branch->id,
                        'branch_address' => 'required',];
            }
            //default
            default: break;
        }
    }
}
