<?php

namespace App\Http\Controllers\Utility;

use DB;
use Auth;
use Mail;
use App\User;
use App\AssetsModel;
use App\BranchModel;
use App\StudentModel;
use App\InvoiceModel;
use App\ExpenseModel;
use App\JournalModel;
use App\UserTypeModel;
use App\InvExpItemModel;
use App\AccountGroupModel;
use App\AccountTitleModel;
use App\PaymentTransactionModel;
trait UtilityHelper
{
    public function searchUser($id){
        if(Auth::check()){
            if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
                return $id!=NULL?User::findOrFail($id):User::all();
            }
        }
        return null;
    }

    public function searchUserNotLogin($id){
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
        if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
            return $id!=NULL?StudentModel::findOrFail($id):StudentModel::all();
        }elseif(Auth::user()->branch_id!=NULL){
            $value = Auth::user()->branch_id;
            $query=StudentModel::whereHas('userCreateInfo',function($q) use ($value){
                                            $q->where('branch_id','=',$value);
                                        });
            return $id!=NULL?
                        $query->where('id','=',$id)->first():$query->get();
        }
        return null;
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
        if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
            return $id!=NULL?InvoiceModel::findOrFail($id):InvoiceModel::all();
        }elseif(Auth::user()->branch_id!=NULL){
            $query=InvoiceModel::whereHas('userCreateInfo',function($q){
                                            $q->where('branch_id','=',Auth::user()->branch_id);
                                            });
            return $id!=NULL?$query->findOrFail($id):$query->get();
        }
        return null;
    }

    public function putInvoice(){
        return new InvoiceModel;
    }

    public function searchExpense($id){
        if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
            return $id!=NULL?ExpenseModel::findOrFail($id):ExpenseModel::all();
        }elseif(Auth::user()->branch_id!=NULL){
            $query=ExpenseModel::whereHas('userCreateInfo',function($q){
                                                $q->where('branch_id','=',Auth::user()->branch_id);
                                            });
            return $id!=NULL?$query->findOrFail($id):$query->get();
        }
        return null;
    }

    public function putExpense(){
        return new ExpenseModel;
    }

    public function searchReceipt($id){
        if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
            return $id!=NULL?PaymentTransactionModel::findOrFail($id):PaymentTransactionModel::all();
        }elseif(Auth::user()->branch_id!=NULL){
            $query=PaymentTransactionModel::whereHas('userCreateInfo',function($q){
                                                $q->where('branch_id','=',Auth::user()->branch_id);
                                            });
            return $id!=NULL?$query->findOrFail($id):$query->get();
        }
        return null;
    }

    public function putAsset(){
        return new AssetsModel;
    }

    public function searchAsset($id){
        if(Auth::user()->userType->type === 'Administrator' ||
                (Auth::user()->branch_id!=NULL && Auth::user()->branchInfo->main_office)){
            return $id!=NULL?AssetsModel::findOrFail($id):AssetsModel::all();
        }elseif(Auth::user()->branch_id!=NULL){
            $query=AssetsModel::whereHas('userCreateInfo',function($q){
                                            $q->where('branch_id','=',Auth::user()->branch_id);
                                            });
            return $id!=NULL?$query->findOrFail($id):$query->get();
        }
        return null;
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

    public function setItem(){
        return new InvExpItemModel;
    }

    public function searchItem($id){
        return $id!=NULL?InvExpItemModel::findOrFail($id):InvExpItemModel::all();
    }



    public function populateListOfToInsertItems($data,$groupName,$foreignKeyId,$foreignValue,$type){
        $count = 0;
        $toInsertItems = array();
        $itemList = array();
        $eRecord = $this->getLastRecord($type,array('id'=> $foreignValue));
        $accountTitlesList = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>$groupName));
        $tArrayStringList = explode(",",$data);
        foreach ($accountTitlesList->accountTitles as $accountTitle) {
            foreach ($accountTitle->items as $item) {
                $itemList[$item->item_name] = $item->id;
            }
        }
        // foreach ($incomeAccountTitlesList->accountTitles as $tIncomeAccountTitle) {
        //     $eIncomeAccountTitlesList[$tIncomeAccountTitle->account_title_name] = $tIncomeAccountTitle->id;
        // }
        
        foreach ($tArrayStringList as $tString) {
            ++$count;
            if($count==1){
                $title = $tString;
            }else if($count==2){
                $amount = $tString;
                $count = 0;
                $toInsertItems[] = array('item_id' => $itemList[trim($title)],
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
        $itemList = array();
        $tDataHolder = array();
        $journalEntryList = array();
        $accountReceivableTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Accounts Receivable'));
        $cashTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Cash'));
        $eAccountGrp = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>($typeName=='Invoice'?'Revenues':'Expenses')));//get account titles
        foreach ($eAccountGrp->accountTitles as $accountTitle) {
            foreach ($accountTitle->items as $item) {
                $itemList[$item->id] = $accountTitle->id;
            }
        }

        if($typeName=='Invoice'){
            foreach ($dataList as $data) {
                if($count==0){
                        $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                    $accountReceivableTitle->id,null,$amount,
                                                    0.00,$description,$data['created_at'],
                                                    date('Y-m-d'));
                }
                $dataCreated = $data['created_at'];
                if(!(array_key_exists($itemList[$data['item_id']], $tDataHolder)))
                    $tDataHolder[$itemList[$data['item_id']]] = 0;
                $tDataHolder[$itemList[$data['item_id']]] += $data['amount'];
                $count++;
            }
            foreach ($tDataHolder as $key => $value) {
                $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                            null,$key,0.00,
                                            $value,$description,$dataCreated,
                                            date('Y-m-d'));
            }

        }else if($typeName=='Expense'){
            foreach ($dataList as $data) {
                $dataCreated = $data['created_at'];
                //for debit in journal
                // $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                //                                     $data['account_title_id'],null,$data['amount'],
                //                                     0.00,$description,$data['created_at'],
                //                                     date('Y-m-d'));
                $dataCreated = $data['created_at'];
                if(!(array_key_exists($itemList[$data['item_id']], $tDataHolder)))
                    $tDataHolder[$itemList[$data['item_id']]] = 0;
                $tDataHolder[$itemList[$data['item_id']]] += $data['amount'];
            }
            
            foreach ($tDataHolder as $key => $value) {
                $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                            $key,null,$value,
                                            0.00,$description,$dataCreated,
                                            date('Y-m-d'));
            }

            $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                    null,$cashTitle->id,0.00,
                                                    $amount,$description,$dataCreated,
                                                    date('Y-m-d'));
        }else{
            //for debit in journal
            $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                                $cashTitle->id,null,$amount,
                                                                0.00,$description,date('Y-m-d'),
                                                                date('Y-m-d'));

            //for credit in journal

            $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                                null,$accountReceivableTitle->id,0.00,
                                                                $amount,$description,date('Y-m-d'),
                                                                date('Y-m-d'));
        }
       
        return $journalEntryList;
    }

    public function populateJournalEntry($foreignKey,$foreignVal,$typeValue,
                                            $debitTitleIdValue,$creditTitleIdValue,$debitAmountValue,
                                            $creditAmountValue,$descriptionValue,$createdAtValue,
                                            $updatedAtValue){
        return array($foreignKey=>$foreignVal,
                        'type' => $typeValue,
                        'debit_title_id'=>$debitTitleIdValue,
                        'credit_title_id'=>$creditTitleIdValue,
                        'debit_amount' => $debitAmountValue,
                        'credit_amount'=> $creditAmountValue,
                        'description'=> $descriptionValue,
                        'created_at' => $createdAtValue,
                        'updated_at' => $updatedAtValue,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id);
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
        }elseif($modelName==='ExpenseModel'){
            return $whereClause==NULL? ExpenseModel::orderBy('id', 'desc')->first():
                                        ExpenseModel::where($whereClause)
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
                $query->whereHas('userCreateInfo',function($q) use ($value){
                            $q->where('branch_id','=',$value);
                        });
            }
            return $query->get();
        }elseif($modelName=='InvExpItemModel'){
            return InvExpItemModel::where($whereClause)->get();
        }
        return null;
    }

    public function getItemsAmountList($arrayToProcessList,$typeOfData){
        $data = array();
        if($typeOfData == 'Equity'){
            $accountGroup =  AccountGroupModel::where('account_group_name', 'like', '%'.$typeOfData.'%')
                                                ->get();
            foreach ($accountGroup as $accountGrp) {
                foreach ($accountGrp->accountTitles as $accountTitle) {
                    $data[$accountTitle->account_title_name] = $accountTitle->opening_balance;
                }
            }
        }else if(is_null($typeOfData)){
            $accountGroup =  $this->searchAccountGroups(null);
            foreach ($accountGroup as $accountGrp) {
                foreach ($accountGrp->accountTitles as $accountTitle) {
                    $data[$accountTitle->account_title_name] = $accountTitle->opening_balance;
                }
            }
        }

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

    public function getControlNo($tableName){
        return DB::table('INFORMATION_SCHEMA.TABLES')  
                        ->where('TABLE_SCHEMA','=','a1_accounting_system')
                        ->where('TABLE_NAME','=',$tableName)
                        ->first();
    }


    public function sendEmailVerification($toAddress,$name,$confirmation_code){
        Mail::send('emails.user_verifier',$confirmation_code, function($message) use ($toAddress, $name){
            $message->from('do_not_reply@a1driving.com','User Verification');
            $message->to($toAddress, $name)
                        ->subject('Verify your Account');
        });

    }

    public function getJournalEntryRecordsWithFilter($accountGroupId,$monthFilter,$yearFilter){
        $yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);
        $query = null;
        if(!is_null($accountGroupId)){
            $query = JournalModel::orWhere(function($query) use ($accountGroupId){
                                                    $query->whereHas('credit',function($q) use ($accountGroupId){
                                                        $q->where('account_group_id', '=', $accountGroupId);
                                                    })
                                                    ->orWhereHas('debit',function($q) use ($accountGroupId){
                                                        $q->where('account_group_id', '=', $accountGroupId);
                                                    });
                                                });
        }

        if(empty($monthFilter)){
            $query  = $query==NULL? JournalModel::whereYear('created_at','=',$yearFilter) : 
                            $query->whereYear('created_at','=',$yearFilter);
        }else{
            $monthFilter = $monthFilter==NULL?date('m'):date($monthFilter); 
            $query  = $query==NULL? JournalModel::whereYear('created_at','=',$yearFilter)
                                                        ->whereMonth('created_at','=',$monthFilter) : 
                                                            $query->whereYear('created_at','=',$yearFilter)
                                                                    ->whereMonth('created_at','=',$monthFilter);
        }
        return $query->get();
    }
}