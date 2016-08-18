<?php

namespace App\Http\Requests\Assets;

use App\Http\Requests\Request;

class AssetRequest extends Request
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
                return ['asset_name' => 'required|min:3|max:255',
                        'asset_vendor' => 'required|min:0|max:255',
                        'asset_date_acquired'=>'required',
                        'asset_original_cost'=>'required',
                        'asset_salvage_value'=>'required',
                        'asset_lifespan'=>'required',
                        'asset_mode_of_acq'=>'required',];
            }
            //for update
            case 'PATCH':{  
                return ['asset_name' => 'required|min:3|max:255',
                        'asset_vendor' => 'required|min:0|max:255',
                        'asset_date_acquired'=>'required',
                        'asset_original_cost'=>'required',
                        'asset_salvage_value'=>'required',
                        'asset_lifespan'=>'required',
                        'asset_mode_of_acq'=>'required',];
            }
            //default
            default: break;
        }
    }
}