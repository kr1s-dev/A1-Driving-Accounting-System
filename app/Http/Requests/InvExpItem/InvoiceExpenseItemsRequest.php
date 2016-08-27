<?php

namespace App\Http\Requests\InvExpItem;

use App\InvExpItemModel;
use App\Http\Requests\Request;

class InvoiceExpenseItemsRequest extends Request
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
        $item = InvExpItemModel::find($this->item);
        switch($this->method())
        {
            case 'GET': break;
            case 'DELETE': break;
            //for insert
            case 'POST':{
                return ['item_name' => 'required|min:3|max:255|unique:invoice_expense_items',
                        'account_title_id'=>'required',];
                        // 'opening_balance' => 'required|min:0',];
            }
            //for update
            case 'PATCH':{  
                return ['item_name' => 'required|min:3|max:255|unique:invoice_expense_items,item_name,'.$item->id,
                        'account_title_id'=>'required',];
                        // 'opening_balance' => 'required|min:0',];
            }
            //default
            default: break;
        }
    }
}
