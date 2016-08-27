<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class ReportController extends Controller
{
	use UtilityHelper;
    public function getGenerateIncomeStatement(){
        try{
            return $this->generateIncomeStatement(null,null);
        }catch(\Exception $ex){
            return view('errors.503');
        }
    }

    public function postGenerateIncomeStatement(Request $request){
        try{
            $monthFilter = $request->input('month_filter');
            $yearFilter = $request->input('year_filter');
            return $this->generateIncomeStatement($monthFilter,$yearFilter);
        }catch(\Exception $ex){
            return view('errors.503');
        }
	}

	public function getGenerateOwnersEquityStatement(){
        try{
            return $this->generateOwnersEquityStatement(null,null);
        }catch(\Exception $ex){
            return view('errors.503');
        }
    }

    public function postGenerateOwnersEquityStatement(Request $request){
        try{
            $monthFilter = $request->input('month_filter');
            $yearFilter = $request->input('year_filter');
            return $this->generateOwnersEquityStatement($monthFilter,$yearFilter);
        }catch(\Exception $ex){
            return view('errors.503');
        }
	}

	public function getGenerateBalanceSheet(){
        try{
            return $this->generateBalanceSheet(null,null);    
        }catch(\Exception $ex){
        	echo $ex->getMessage() . ' ' . $ex->getLine();
            //return view('errors.503');
        }    
    }

    public function postGenerateBalanceSheet(Request $request){
        try{
            $monthFilter = $request->input('month_filter');
            $yearFilter = $request->input('year_filter');
            return $this->generateBalanceSheet($monthFilter,$yearFilter);    
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }

    public function getGenerateAssetRegistry(){
        try{
            $title = 'Reports';
            $assetItemList = $this->searchAsset(null);
            return view('reports.asset_registry',
                            compact('assetItemList',
                                    'title'));    
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }



    public function generateIncomeStatement($monthFilter,$yearFilter){
    	$title = 'Reports';
    	$yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);

    	$incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',$monthFilter,$yearFilter);
    	$expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',$monthFilter,$yearFilter);

    	$incomeItemsList = $this->getItemsAmountList($incStatementItemsList,'Income');
    	$expenseItemsList = $this->getItemsAmountList($expStatementItemsList,'Expense');

    	$incTotalSum = $this->getTotalSum($incomeItemsList);
    	$expTotalSum = $this->getTotalSum($expenseItemsList);

		return view('reports.income_statements',
						compact('incomeItemsList',
								'expenseItemsList',
								'incTotalSum',
								'expTotalSum',
								'yearFilter',
								'monthFilter',
								'title'));
    }

    public function generateOwnersEquityStatement($monthFilter,$yearFilter){
    	$title = 'Reports';
    	$yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);

    	$incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',$monthFilter,$yearFilter);
        $expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',$monthFilter,$yearFilter);

        $incomeItemsList = $this->getItemsAmountList($incStatementItemsList,'Income');
        $expenseItemsList = $this->getItemsAmountList($expStatementItemsList,'Expense');

        $incTotalSum = $this->getTotalSum($incomeItemsList);
        $expTotalSum = $this->getTotalSum($expenseItemsList);

    	$totalProfit = ($incTotalSum  - $expTotalSum);

    	$ownerEquityItemsList = $this->getJournalEntryRecordsWithFilter('7',$monthFilter,$yearFilter);

    	$equityItemsList = $this->getItemsAmountList($ownerEquityItemsList,'Equity');

    	$eqTotalSum = ($this->getTotalSum($equityItemsList)) + $totalProfit ;

    	//print_r($equityItemsList);
    	return view('reports.statement_of_owners_equity',
    					compact('yearFilter',
    							'monthFilter',
    							'eqTotalSum',
    							'equityItemsList',
    							'totalProfit',
    							'title'));
    }

    public function generateBalanceSheet($monthFilter,$yearFilter){
    	$title = 'Reports';
        $yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);
        $accountTitlesList =  $this->searchAccountTitle(null);
        $accountTitleGroupList = $this->searchAccountGroups(null);
        $fBalanceSheetItemsList = array();
        $totalAssets = 0;
        $totalEquity = 0;
        $totalLiability = 0;

        $incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',$monthFilter,$yearFilter);
        $expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',$monthFilter,$yearFilter);

        $incomeItemsList = $this->getItemsAmountList($incStatementItemsList,'Income');
        $expenseItemsList = $this->getItemsAmountList($expStatementItemsList,'Expense');

        $incTotalSum = $this->getTotalSum($incomeItemsList);
        $expTotalSum = $this->getTotalSum($expenseItemsList);

        $totalProfit = ($incTotalSum  - $expTotalSum);

        $aTitleItemsList = $this->getJournalEntryRecordsWithFilter(null,$monthFilter,$yearFilter);
        //print_r($aTitleItemsList);
        $eBalanceSheetItemsList = $this->getItemsAmountList($aTitleItemsList,null);


        foreach ($accountTitleGroupList as $accountTitleGroup) {
            if(!array_key_exists($accountTitleGroup->account_group_name,$fBalanceSheetItemsList)){
                $fBalanceSheetItemsList[$accountTitleGroup->account_group_name] = array();
            }
        }
        //print_r($eBalanceSheetItemsList);
        foreach ($accountTitlesList as $accountTitle) {
            if (array_key_exists($accountTitle->account_title_name,$eBalanceSheetItemsList)) {
                if(array_key_exists($accountTitle->group->account_group_name,$fBalanceSheetItemsList)){
                    $tArray = $fBalanceSheetItemsList[$accountTitle->group->account_group_name];
                    $tArray[$accountTitle->account_title_name] = strpos($accountTitle->account_title_name, 'Capital') || $accountTitle->account_title_name === 'Capital'? 
                                                                        ($eBalanceSheetItemsList[$accountTitle->account_title_name] + $totalProfit) 
                                                                            : $eBalanceSheetItemsList[$accountTitle->account_title_name];
                    $fBalanceSheetItemsList[$accountTitle->group->account_group_name] = $tArray;
                }
            }
        }

        //print_r($fBalanceSheetItemsList);
        if(count($fBalanceSheetItemsList['Owners Equity'])<=0){
        	$fBalanceSheetItemsList['Owners Equity'] = array('Capital'=> $totalProfit);
        }else{
        	foreach (array_keys($fBalanceSheetItemsList['Owners Equity']) as $eKey) {
	    		if(strpos(strtolower($eKey), 'capital')){
	    			$fBalanceSheetItemsList['Owners Equity'] = array('Capital'=> $totalProfit);
	    		}
	    	}
        }
        

        foreach (array_keys($fBalanceSheetItemsList) as $key) {
            if(strpos($key, 'Assets')){
                $totalAssets+= ($this->getTotalSum($fBalanceSheetItemsList[$key]));
            }else if(strpos($key, 'Equity')){
            	
                $totalEquity+= ($this->getTotalSum($fBalanceSheetItemsList[$key]));
            }else if(strpos($key, 'Liabilities')){
                $totalLiability+= ($this->getTotalSum($fBalanceSheetItemsList[$key]));
            }
        }
        //echo $totalAssets;
        //print_r($fBalanceSheetItemsList);
        return view('reports.balance_sheet',
                        compact('yearFilter',
                                'monthFilter',
                                'title',
                                'fBalanceSheetItemsList',
                                'totalAssets',
                                'totalEquity',
                                'totalLiability'));
    }
}
