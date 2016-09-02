<?php

namespace App\Http\Controllers\InvExpItem;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;
use App\Http\Requests\InvExpItem\InvoiceExpenseItemsRequest;


class InvoiceExpenseItemsController extends Controller
{
	use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try{
        	$title = 'Invoice/Expense Item';
            $item = $this->setItem();
            $lastInsertedItem = $this->getControlNo('invoice_expense_items');
            $itemNumber = $lastInsertedItem->AUTO_INCREMENT;
            $eAccountTitle = $this->getLastRecord('AccountTitleModel',array('id'=>$id));
            return view('invoice_expense_items.create_invoice_expense_item',
                            compact('item',
                                    'eAccountTitle',
                                    'itemNumber',
                                    'title'));
        }catch(\Exception $ex){
            return view('errors.404');
            //echo $ex->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceExpenseItemsRequest $request)
    {
    	try{
    		$input = $this->removeKeys($request->all(),true,true);
	        $this->insertRecords('invoice_expense_items',$input,false);
            $this->createSystemLogs('Created New Item Record');
            flash()->success('Record successfully created');
	        return redirect('accounttitle/' . $input['account_title_id']);
    	}catch(\Exception $ex){
            return view('errors.404');
            //echo $ex->getMessage();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        	$title = 'Invoice/Expense Item';
            $item = $this->searchItem($id);
            $itemNumber = $id;
            $eAccountTitle = $this->getLastRecord('AccountTitleModel',array('id'=>$item->account_title_id));
            return view('invoice_expense_items.update_invoice_expense_item',
                            compact('item',
                                    'eAccountTitle',
                                    'itemNumber',
                                    'title'));
        }catch(\Exception $ex){
            return view('errors.404');
            //echo $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceExpenseItemsRequest $request, $id)
    {
        try{
    		$input = $this->removeKeys($request->all(),false,true);
	        $this->updateRecords('invoice_expense_items',array($id),$input);
            $this->createSystemLogs('Updated an Existing Item');
            flash()->success('Record successfully Updated');
	        return redirect('accounttitle/' . $input['account_title_id']);
    	}catch(\Exception $ex){
            return view('errors.404');
            //echo $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
