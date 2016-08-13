<?php

namespace App\Http\Controllers\Receipt;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class ReceiptController extends Controller
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
        $title = 'Receipt';
        $invoice = $this->searchInvoice($id);
        $lastInsertedReceipt = $this->getLastRecord('ReceiptModel',null);
        $recNumber = count($lastInsertedReceipt)===0?'1':($lastInsertedReceipt->id)+1;
        $lastInvReceipt = $this->getLastRecord('ReceiptModel',array('payment_id'=>$id));
        return view('receipt.create_receipt',
                        compact('title',
                                'invoice',
                                'recNumber',
                                'lastInvReceipt'));
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
        $balance = str_replace(',','', $input['outstanding_balance']) - $input['amount_paid'];
        $input['outstanding_balance'] = $balance<0?0:$balance;
        $invoice = $this->getLastRecord('InvoiceModel',array('id'=>$input['payment_id']));
        if($input['outstanding_balance']==0){
            $invoice->is_paid=true;
            $invoice->save();
        }

        try{
            //Insert receipt
            $receiptId = $this->insertRecords('payment_transaction',$input,false);

            //Insert Journal Entry for Receipt
            $this->insertRecords('journal_entry',$this->createJournalEntry($input,
                                                                            'Receipt',
                                                                            'receipt_id',
                                                                            $receiptId,
                                                                            'Created Receipt for Student ' .
                                                                                $invoice->studentInfo->stud_first_name . ' ' .
                                                                                $invoice->studentInfo->stud_last_name,
                                                                            $input['amount_paid']),
                                true);
            return redirect('/receipt/' . $receiptId);
        }catch(\Exception $ex){
            echo $ex->getMessage();
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
        $lastInvReceipt;
        $change = 0;
        $title = 'Receipt';
        $receipt = $this->searchReceipt($id);
        $receiptList = $this->getRecords('ReceiptModel',array('payment_id'=>$receipt->payment_id));
        
        if($receipt->outstanding_balance==0){
            if(count($receiptList)>=2){
                $change = $receipt->amount_paid-$receiptList[count($receiptList)-2]->outstanding_balance;
            }else{
                $change = $receipt->amount_paid - $receipt->invoiceInfo->total_amount;
            }
        }
        
        
        //echo $lastInvReceipt->outstanding_balance;
        return view('receipt.show_receipt',
                        compact('receipt',
                                'title',
                                'change'));

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
