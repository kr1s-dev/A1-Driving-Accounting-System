<?php

namespace App\Http\Requests\AccountTitles;

use App\AccountTitleModel;
use App\Http\Requests\Request;

class AccountTitleRequest extends Request
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
        $accountTitle = AccountTitleModel::find($this->accounttitles);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['account_title_name' => 'required|max:255|unique:account_titles',
                        'opening_balance' => 'required|min:0',];
            }
            //for update
            case 'PATCH':{  
                return ['account_title_name' => 'required|max:255|unique:account_titles,account_title_name,'.$accountTitle->id,
                        'opening_balance' => 'required|min:0',];
            }
            //default
            default: break;
        }
    }
}
