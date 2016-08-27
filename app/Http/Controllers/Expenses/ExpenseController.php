<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class ExpenseController extends Controller
{
    use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Expense";
        $expenseList = $this->searchExpense(null);
        return view('expense.show_expense_list',
                        compact('expenseList',
                                'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $expenseAccountItems = array();
            $title = 'Expense';
            $_method = 'POST';
            $expenseAccountGroup = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>'Expenses'));
            foreach ($expenseAccountGroup->accountTitles as $accountTitle) {
                foreach ($accountTitle->items as $item) {
                    $expenseAccountItems[] = $item;
                }
            }
            $lastInsertedExpense = $this->getControlNo('expense_cash_voucher');
            $expNumber = ($lastInsertedExpense->AUTO_INCREMENT);
            $expense = $this->putExpense();
            return view('expense.create_update_expense',
                            compact('title',
                                    '_method',
                                    'expenseAccountItems',
                                    'expNumber',
                                    'expense'));
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
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
        unset($input['data']);
        try{
            //Insert Expense
            $expenseId = $this->insertRecords('expense_cash_voucher',$input,false);

            $dataToInsert = $this->populateListOfToInsertItems($data,
                                                                'Expenses',
                                                                'expense_cash_voucher_id',
                                                                $expenseId,
                                                                'ExpenseModel');
            //Insert Invoice Items
            $this->insertRecords('expense_cash_voucher_items',$dataToInsert,true);

            //Insert Journal Entry for Invoice
            $this->insertRecords('journal_entry',$this->createJournalEntry($dataToInsert,
                                                                            'Expense',
                                                                            'expense_id',
                                                                            $expenseId,
                                                                            'Created Expense for Recepient ' .
                                                                                $input['vendor_name'],
                                                                            $input['total_amount']),
                                true);

            
            echo $expenseId;
        }catch(\Exception $ex){
            echo 'Error ' . $ex->getMessage();

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
        $title = 'Expense';
        try{
            $expense = $this->searchExpense($id);
            return view('expense.show_expense',
                            compact('expense.show_expense',
                                    'title',
                                    'expense'));
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenseAccountItems = array();
        $title = 'Expense';
        $_method = 'PATCH';
        $expenseAccountGroup = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>'Expenses'));
        foreach ($expenseAccountGroup->accountTitles as $accountTitle) {
            foreach ($accountTitle->items as $item) {
                $expenseAccountItems[] = $item;
            }
        }
        $expNumber = $id;
        try{
            $expense = $this->searchExpense($id);
            return view('expense.create_update_expense',
                            compact('title',
                                    '_method',
                                    'expenseAccountItems',
                                    'expNumber',
                                    'expense'));
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
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
        $input = $this->removeKeys($request->all(),false,true);
        $data = $input['data'];
        unset($input['data']);
        try{
            $dataToInsert = $this->populateListOfToInsertItems($data,
                                                                'Expenses',
                                                                'expense_cash_voucher_id',
                                                                $id,
                                                                'ExpenseModel');

            //Update Expense
            $this->updateRecords('expense_cash_voucher',array($id),$input);

            //Delete Journal Entry before inserting to avoid duplication
            $this->deleteRecords('journal_entry',array('expense_id'=>$id));

            //Delete Invoice items before inserting to avoid duplication
            $this->deleteRecords('expense_cash_voucher_items',array('expense_cash_voucher_id'=>$id));

            //Insert Invoice Items
            $this->insertRecords('expense_cash_voucher_items',$dataToInsert,true);

            //Insert Journal Entry for Invoice
            $this->insertRecords('journal_entry',$this->createJournalEntry($dataToInsert,
                                                                            'Expense',
                                                                            'expense_id',
                                                                            $id,
                                                                            'Created Expense for Recepient ' .
                                                                                $input['vendor_name'],
                                                                            $input['total_amount']),
                                true);

            
            echo $id;
        }catch(\Exception $ex){
            echo 'Error ' . $ex->getMessage();

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
