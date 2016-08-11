<?php

namespace App\Http\Controllers\Invoices;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class InvoiceController extends Controller
{
    use UtilityHelper;
    /**
     * Display a listing of the resource.
     *data
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
        $title = "Invoice";
        $_method = 'POST';
        $student = $studentList = $this->searchStudent($id);
        $lastInsertedInvoice = $this->getLastRecord('InvoiceModel',null);
        $invNumber = count($lastInsertedInvoice)===0?'1':($lastInsertedInvoice->id)+1;
        return view('invoice.create_invoice',
                        compact('title',
                                '_method',
                                'student',
                                'invNumber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $this->removeKeys($request->all(),true,true);
        $data = $input['data'];
        $input['payment_due_date'] = date('Y-m-d',strtotime($input['payment_due_date']));
        unset($input['data']);
        //$studInvId = $this->insertRecord('journal_entry',$input,false);
        // $this->insertRecord('invoice_item_model',
        //                         $this->populateListOfToInsertItems($data,
        //                                                             'Revenues',
        //                                                             'invoice_id',
        //                                                             $studInvId,
        //                                                             'InvoiceModel'),
        //                         true);
        //return $studInvId;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
