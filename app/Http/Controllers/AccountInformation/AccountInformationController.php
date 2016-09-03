<?php

namespace App\Http\Controllers\AccountInformation;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class AccountInformationController extends Controller
{
	use UtilityHelper;

    public function index(){
        try{
            $title = 'Account Details';
            $dateToday = date('F', mktime(0, 0, 0, 1, 10)) . ' ' . date('Y');
            $dateNextYear =  date('F', mktime(0, 0, 0, 12, 10)) . ' ' . date('Y',strtotime('+1 years'));
            $journalEntryList = $this->getRecords('JournalModel',null);
            $accountTitleGroupList = $this->searchAccountGroups(null);
            $accountTitlesList =  $this->searchAccountTitle(null);
            $fBalanceSheetItemsList = array();
            $expenseTotal=0;
            $incomeTotal=0;
            $assetTotal=0;
            $liabilitiesTotal=0;

            foreach ($accountTitleGroupList as $accountTitleGroup) {
                if(!array_key_exists($accountTitleGroup->account_group_name,$fBalanceSheetItemsList)){
                    $fBalanceSheetItemsList[$accountTitleGroup->account_group_name] = array();
                }
            }

            $eBalanceSheetItemsList = $this->getItemsAmountList($journalEntryList,null);
            foreach ($accountTitlesList as $accountTitle) {
                if (array_key_exists($accountTitle->account_title_name,$eBalanceSheetItemsList)) {
                    if(array_key_exists($accountTitle->group->account_group_name,$fBalanceSheetItemsList)){
                        $tArray = $fBalanceSheetItemsList[$accountTitle->group->account_group_name];
                        $tArray[$accountTitle->account_title_name] =  $eBalanceSheetItemsList[$accountTitle->account_title_name];
                        $fBalanceSheetItemsList[$accountTitle->group->account_group_name] = $tArray;
                    }
                }
            }

            foreach(array_keys($fBalanceSheetItemsList) as $key) {
                if(strpos($key, 'Assets')){
                    $assetTotal+= ($this->getTotalSum($fBalanceSheetItemsList[$key]));
                }elseif(strpos($key, 'Liabilities')){
                    $liabilitiesTotal+= ($this->getTotalSum($fBalanceSheetItemsList[$key]));
                }elseif(strpos($key, 'Revenue') || $key=='Revenues'){
                    $incomeTotal+=($this->getTotalSum($fBalanceSheetItemsList[$key]));
                }elseif(strpos($key, 'Expense') || $key=='Expenses'){
                    $expenseTotal+=($this->getTotalSum($fBalanceSheetItemsList[$key]));
                }
            }

            return view('accounts.show_account_information',
                            compact('assetTotal',
                                    'liabilitiesTotal',
                                    'incomeTotal',
                                    'expenseTotal',
                                    'title',
                                    'dateToday',
                                    'dateNextYear'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
    	

    }
}
