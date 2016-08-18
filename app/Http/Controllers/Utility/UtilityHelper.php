<?php

namespace App\Http\Controllers\Utility;

use DB;
use Auth;
use App\User;
use App\AssetsModel;
use App\BranchModel;
use App\StudentModel;
use App\InvoiceModel;
use App\JournalModel;
use App\UserTypeModel;
use App\AccountGroupModel;
use App\AccountTitleModel;
use App\PaymentTransactionModel;
trait UtilityHelper
{
    public function searchUser($id){
        return $id!=NULL?User::findOrFail($id):User::all();
    }

    public function putUser(){
        return new User;
    }

    public function searchBranch($id){
        return $id!=NULL?BranchModel::findOrFail($id):BranchModel::all();
    }

    public function putBranch(){
        return new BranchModel;
    }

    public function searchStudent($id){
        return $id!=NULL?StudentModel::findOrFail($id):StudentModel::all();
    }

    public function putStudent(){
        return new StudentModel;
    }

    //Get List of User Types/ or certain User Type for User
    public function getUsersUserType($id){
        $eUserTypesList = array();
        if($id==null){
            $tUserTypesList = DB::table('user_type')
                            ->get();
            foreach($tUserTypesList as $tUserType){
                $eUserTypesList[$tUserType->id] = $tUserType->type;
            }
        }else{
            $tUserType = UserTypeModel::findOrFail($id);
            $eUserTypesList[$tUserType->id] = $tUserType->type;
            $tUserTypesList = DB::table('user_type')
                            ->where('id','!=',$id)
                            ->get();
            foreach($tUserTypesList as $tUserType){
                $eUserTypesList[$tUserType->id] = $tUserType->type;
            }
        }
        return $eUserTypesList;
    }

    //Get List of User Types/ or certain User Type for User
    public function getUsersBranch($id){
        $ebranchList = array();
        if($id==null){
            $tBranchList = DB::table('branch')
                            ->get();
            foreach($tBranchList as $tBranch){
                $ebranchList[$tBranch->id] = $tBranch->branch_name;
            }
        }else{
            $tBranch = $this->searchBranch($id);
            $ebranchList[$tBranch->id] = $tBranch->branch_name;
            $tBranchList = DB::table('branch')
                            ->where('id','!=',$id)
                            ->get();
            foreach($tBranchList as $tBranch){
                $ebranchList[$tBranch->id] = $tBranch->branch_name;
            }
        }
        return $ebranchList;
    }

    public function putAccountTitle(){
        return new AccountTitleModel;
    }

    public function searchAccountTitle($id){
        return $id!=NULL?AccountTitleModel::findOrFail($id):AccountTitleModel::all();
    }

    public function searchAccountGroups($id){
        return $id!=NULL?AccountGroupModel::findOrFail($id):AccountGroupModel::all();
    }

    public function searchInvoice($id){
        return $id!=NULL?InvoiceModel::findOrFail($id):InvoiceModel::all();
    }

    public function putInvoice(){
        return new InvoiceModel;
    }

    public function searchReceipt($id){
        return $id!=NULL?PaymentTransactionModel::findOrFail($id):PaymentTransactionModel::all();
    }

    public function putAsset(){
        return new AssetsModel;
    }

    public function searchAsset($id){
        return $id!=NULL?AssetsModel::findOrFail($id):AssetsModel::all();
    }

    public function getAccountsAccountGroups($id){
        $accountGroupsList = array();
        if($id==null){
            $tAccountGroupsList = DB::table('account_groups')
                                    ->get();
            foreach($tAccountGroupsList as $tAccountGroup){
                $accountGroupsList[$tAccountGroup->id] = $tAccountGroup->account_group_name;
            }
        }else{
            $tAccountGroup = AccountGroupModel::findOrFail($id);
            $accountGroupsList[$tAccountGroup->id] = $tAccountGroup->account_group_name;
            $tAccountGroupsList = DB::table('account_groups')
                                    ->where('id','!=',$id)
                                    ->get();
            foreach($tAccountGroupsList as $tAccountGroup){
                $accountGroupsList[$tAccountGroup->id] = $tAccountGroup->account_group_name;
            }
        }
        return $accountGroupsList;
    }



    public function populateListOfToInsertItems($data,$groupName,$foreignKeyId,$foreignValue,$type){
        $count = 0;
        $toInsertItems = array();
        $eIncomeAccountTitlesList = array();
        $eRecord = $this->getLastRecord($type,array('id'=> $foreignValue));
        $incomeAccountTitlesList = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>$groupName));
        $tArrayStringList = explode(",",$data);
        foreach ($incomeAccountTitlesList->accountTitles as $tIncomeAccountTitle) {
            $eIncomeAccountTitlesList[$tIncomeAccountTitle->account_title_name] = $tIncomeAccountTitle->id;
        }

        foreach ($tArrayStringList as $tString) {
            ++$count;
            if($count==1){
                $title = $tString;
            }else if($count==2){
                $amount = $tString;
                $count = 0;
                $toInsertItems[] = array('account_title_id' => $eIncomeAccountTitlesList[trim($title)],
                                            'amount' => $amount,
                                            $foreignKeyId => $foreignValue,
                                            'created_at' => $eRecord->created_at,
                                            'updated_at'=>  date('Y-m-d'),
                                            'created_by' => Auth::user()->id,
                                            'updated_by' => Auth::user()->id);
            }
        }
        return $toInsertItems;
    }

    

    public function removeKeys($data,$isInsert,$hasCreatedBy){
        if(array_key_exists('_token', $data))
            unset($data['_token']);
        if(array_key_exists('action', $data))
            unset($data['action']);
        if(array_key_exists('_method', $data))
            unset($data['_method']);
        if(array_key_exists('branchNumber', $data))
            unset($data['branchNumber']);
        if(array_key_exists('main_office', $data))
            $data['main_office'] = $data['main_office'] === 'on'?1:0;
        if($isInsert)
            $data['created_at'] = date('Y-m-d h:i:sa');
        $data['updated_at'] = date('Y-m-d h:i:sa');
        if($hasCreatedBy){
            if($isInsert)
                $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
        }
        return $data;
    }

    

    /*
    * @Author:      Kristopher N. Veraces
    * @Description: Create Journal Entry
    */
    public function createJournalEntry($dataList,$typeName,$foreignKey,$foreignValue,$description,$amount){
        $count = 0;
        $dataCreated;
        $journalEntryList = array();
        $accountReceivableTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Accounts Receivable'));
        $cashTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Cash'));
        if($typeName=='Invoice'){
            foreach ($dataList as $data) {
                if($count==0){
                         $journalEntryList[] = array($foreignKey=>$foreignValue,
                                            'type' => $typeName,
                                            'debit_title_id'=> $accountReceivableTitle->id,
                                            'credit_title_id'=> null,
                                            'debit_amount' => $amount,
                                            'credit_amount'=> 0.00,
                                            'description'=> $description,
                                            'created_at' => $data['created_at'],
                                            'updated_at' => date('Y-m-d'),
                                            'created_by' => Auth::user()->id,
                                            'updated_by' => Auth::user()->id);
                }

                $journalEntryList[] = array($foreignKey=>$foreignValue,
                                            'type' => $typeName,
                                            'debit_title_id'=> null,
                                            'credit_title_id'=> $data['account_title_id'],
                                            'debit_amount' => 0.00,
                                            'credit_amount'=> $data['amount'],
                                            'description'=> $description,
                                            'created_at' => $data['created_at'],
                                            'updated_at' => date('Y-m-d'),
                                            'created_by' => Auth::user()->id,
                                            'updated_by' => Auth::user()->id);
            }
        }else if($typeName=='Expense'){
            foreach ($dataList as $data) {
                $dataCreated = $data['created_at'];
                //for debit in journal
                $journalEntryList[] = array($foreignKey=>$foreignValue,
                                            'type' => $typeName,
                                            'debit_title_id'=> $data['account_title_id'],
                                            'credit_title_id'=> null,
                                            'debit_amount' => $data['amount'],
                                            'credit_amount'=> 0.00,
                                            'description'=> $description,
                                            'created_at' => $data['created_at'],
                                            'updated_at' => date('Y-m-d'),
                                            'created_by' => Auth::user()->id,
                                            'updated_by' => Auth::user()->id);  
            }
            $journalEntryList[] = array($foreignKey=>$foreignValue,
                                        'type' => $typeName,
                                        'debit_title_id'=> null,
                                        'credit_title_id'=> $cashTitle->id,
                                        'debit_amount' => 0.00,
                                        'credit_amount'=> $amount,
                                        'description'=> $description,
                                        'created_at' => $dataCreated,
                                        'updated_at' => date('Y-m-d'),
                                        'created_by' => Auth::user()->id,
                                        'updated_by' => Auth::user()->id);
        }else{
            //for debit in journal
            $journalEntryList[] = array($foreignKey=>$foreignValue,
                                    'type' => $typeName,
                                    'debit_title_id'=>$cashTitle->id,
                                    'credit_title_id'=>null,
                                    'debit_amount' => $amount,
                                    'credit_amount'=>0.00,
                                    'description'=> $description,
                                    'created_at' => date('Y-m-d'),
                                    'updated_at' => date('Y-m-d'),
                                    'created_by' => Auth::user()->id,
                                    'updated_by' => Auth::user()->id);

            //for credit in journal
            $journalEntryList[] = array($foreignKey=>$foreignValue,
                                    'type' => $typeName,
                                    'debit_title_id'=>null,
                                    'credit_title_id'=>$accountReceivableTitle->id,
                                    'debit_amount' => 0.00,
                                    'credit_amount'=> $amount,
                                    'description'=> $description,
                                    'created_at' => date('Y-m-d'),
                                    'updated_at' => date('Y-m-d'),
                                    'created_by' => Auth::user()->id,
                                    'updated_by' => Auth::user()->id);
        }
       
        return $journalEntryList;
    }

    public function getLastRecord($modelName,$whereClause){
        if($modelName==='BranchModel'){
            return BranchModel::orderBy('id', 'desc')->first();
        }elseif($modelName==='StudentModel'){
            return StudentModel::orderBy('id', 'desc')->first();
        }elseif($modelName==='AccountGroupModel'){
            return AccountGroupModel::where($whereClause)
                                        ->orderBy('id', 'desc')
                                        ->first();
        }elseif($modelName==='InvoiceModel'){
            return $whereClause==NULL? InvoiceModel::orderBy('id', 'desc')->first():
                                        InvoiceModel::where($whereClause)
                                        ->orderBy('id', 'desc')
                                        ->first();
        }elseif($modelName==='AccountTitleModel'){
            return AccountTitleModel::where($whereClause)
                                        ->orderBy('id', 'desc')
                                        ->first();
        }elseif($modelName==='ReceiptModel'){
            return $whereClause==NULL? PaymentTransactionModel::orderBy('id', 'desc')->first():
                                        PaymentTransactionModel::where($whereClause)
                                        ->orderBy('id', 'desc')
                                        ->first();
        }
        return null;
    }

    public function getRecords($modelName,$whereClause){
        if($modelName==='InvoiceModel'){
            return $whereClause==NULL? InvoiceModel::orderBy('id', 'desc')->get():
                                        InvoiceModel::where($whereClause)
                                        ->orderBy('id', 'asc')
                                        ->get();
        }elseif($modelName==='AccountTitleModel'){
            return AccountTitleModel::where($whereClause)
                                        ->orderBy('id', 'desc')
                                        ->get();
        }elseif($modelName==='ReceiptModel'){
            return $whereClause==NULL? PaymentTransactionModel::orderBy('id', 'desc')->first():
                                        PaymentTransactionModel::where($whereClause)
                                        ->orderBy('id', 'asc')
                                        ->get();
        }elseif($modelName==='JournalModel'){
            $value = Auth::user()->branch_id;
            $query = JournalModel::whereYear('created_at','=',date('Y'));
            if(!(is_null($value))){
                $query->whereHas('created_by',function($q) use ($value){
                            $q->where('branch_id','=',$value);
                        });
            }
            return $query->get();
        }
        return null;
    }

    public function getItemsAmountList($arrayToProcessList,$typeOfData){
        $data = array();
        // if($typeOfData == 'Equity'){
        //     $accountGroup =  AccountGroupModel::where('account_group_name', 'like', '%'.$typeOfData.'%')
        //                                         ->get();
        //     foreach ($accountGroup as $accountGrp) {
        //         foreach ($accountGrp->accountTitles as $accountTitle) {
        //             $data[$accountTitle->account_title_name] = $accountTitle->opening_balance;
        //         }
        //     }
        // }else if(is_null($typeOfData)){
        //     $accountGroup =  $this->getAccountGroups(null);
        //     foreach ($accountGroup as $accountGrp) {
        //         foreach ($accountGrp->accountTitles as $accountTitle) {
        //             $data[$accountTitle->account_title_name] = $accountTitle->opening_balance;
        //         }
        //     }
        // }

        if(!empty($arrayToProcessList)){
            foreach ($arrayToProcessList as $arrayToProcess) {
                $typeOfData = $arrayToProcess->credit_title_id == NULL ? $arrayToProcess->debit->group->account_group_name : $arrayToProcess->credit->group->account_group_name;
                $amount = ($arrayToProcess->debit_amount - $arrayToProcess->credit_amount);
                $accountTitle = $arrayToProcess->credit_title_id == NULL ? $arrayToProcess->debit->account_title_name : $arrayToProcess->credit->account_title_name;

                if(array_key_exists($accountTitle,$data)){
                    $data[$accountTitle] += (strpos($typeOfData, 'Revenues') !== false || strpos($typeOfData, 'Equity') | strpos($typeOfData, 'Liabilities') ? 
                                                ($amount * -1)  : $amount);
                }else{
                    $data[$accountTitle] = $typeOfData == 'Revenues' ? ($amount * -1)  : $amount;
                }
            }
        }
        return $data;
    }

    public function insertRecords($tableName,$data,$isBulk){
        if($isBulk)
            return DB::table($tableName)->insert($data);
        else
            return DB::table($tableName)->insertGetId($data);
    }

    public function updateRecords($tableName,$idList,$data){
        return DB::table($tableName)
                    ->where('id', $idList)
                    ->update($data);
    }

    public function deleteRecords($tableName,$whereClause){
        return DB::table($tableName)
                    ->where($whereClause)
                    ->delete();
    }

    public function getTotalSum($arrayData){
        return count($arrayData)>0?array_sum($arrayData):0;
    }
}