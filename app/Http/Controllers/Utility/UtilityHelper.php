<?php

namespace App\Http\Controllers\Utility;

use DB;
use Auth;
use App\User;
use App\BranchModel;
use App\UserTypeModel;
use App\StudentModel;
use App\AccountGroupModel;
use App\InvoiceModel;
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


    public function populateListOfToInsertItems($data,$groupName,$foreignKeyId,$foreignValue,$type){
        $count = 0;
        $toInsertItems = array();
        $eIncomeAccountTitlesList = array();
        $eRecord = $this->getLastRecord($type,array('id'=> $foreignValue));
        $incomeAccountTitlesList = $this->getLastRecord('AccountGroupModel',array('account_group_name'=>$groupName));
        $tArrayStringList = explode(",",$data);
        foreach ($incomeAccountTitlesList->accountTitles as $tIncomeAccountTitle) {
            $eIncomeAccountTitlesList[$tIncomeAccountTitle->account_sub_group_name] = $tIncomeAccountTitle->id;
        }

        foreach ($tArrayStringList as $tString) {
            ++$count;
            if($count==1){
                $title = $tString;
            }else if($count==2){
                $amount = $tString;
                $count = 0;
                $toInsertItems[] = array('account_title_id' => $eIncomeAccountTitlesList[trim($title)],
                                            'remarks' => $desc,
                                            'amount' => $amount,
                                            $foreignKeyId => $foreignValue,
                                            'created_at' => $eRecord->created_at,
                                            'updated_at'=>  date('Y-m-d'),
                                            'created_by' => $this->getLogInUserId(),
                                            'updated_by' => $this->getLogInUserId());
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
        }
    	return null;
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
}
