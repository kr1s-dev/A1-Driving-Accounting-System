<?php

namespace App\Http\Controllers\PDF;

use PDF;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class PDFController extends Controller
{
    use UtilityHelper;

    public function postGeneratePDF(Request $request){
    	$category = $request->input('category');
    	$recordId = $request->input('recordId');
    	$monthFilter = $request->input('month_filter');
    	$yearFilter = $request->input('year_filter');
        $type = $request->input('type');
        try{
            switch ($category) {
                case 'invoice':
                    return $this->generateInvoicePDF($recordId)->stream('invoice_'. date('m_d_y') .'.pdf');
                    break;
                case 'receipt':
                    return $this->generateReceiptPDF($recordId)->stream('receipt_'. date('m_d_y') .'.pdf');
                    break;
                case 'expense':
                    return $this->generateExpensePDF($recordId)->stream('expense_'. date('m_d_y') .'.pdf');
                    break;
                case 'income_statement_report':
                    return $this->generateIncomeStatement($monthFilter,$yearFilter)->stream('income_statement_'. date('m_d_y') .'.pdf');
                    break;
                case 'owners_equity_report':
                	return $this->generateOwnersEquityStatement($monthFilter,$yearFilter)->stream('owners_equity_'. date('m_d_y') .'.pdf');
                    break;
                case 'balance_sheet_report':
                	return $this->generateBalanceSheet($monthFilter,$yearFilter)->stream('balance_sheet_'. date('m_d_y') .'.pdf');
                    break;
                case 'asset_registry_report':
                    return $this->genearateAssetRegistry()->setPaper('a4', 'landscape')->stream('asset_registry_report_'. date('m_d_y').'.pdf');
                    break;
                case 'statement_of_cash_flow_report':
                    return $this->generateCashFlow($yearFilter)->stream('statement_of_cash_flow_'. date('m_d_y').'.pdf');
                    break;
                default:
                    return view('errors.404');
                    break;
            }    
        }catch(\Exception $ex){
            echo $ex->getMessage() . ' ' . $ex->getLine();
        }
	}

	private function generateInvoicePDF($id){
		$invoice = $this->searchInvoice($id);
		return PDF::loadView('pdf.invoice_pdf',
								compact('invoice'));
	}

	private function generateReceiptPDF($id){
		$receipt = $this->searchReceipt($id);
		return PDF::loadView('pdf.receipt_pdf',
								compact('receipt'));
	}

	private function generateExpensePDF($id){
		$expense = $this->searchExpense($id);
		return PDF::loadView('pdf.expense_pdf',
								compact('expense'));
	}

    private function genearateAssetRegistry(){
        $assetItemList = $this->searchAsset(null);
        return PDF::loadView('pdf.asset_registry',
                                compact('assetItemList'));
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

		return PDF::loadView('pdf.income_statement_pdf',
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
    	return PDF::loadView('pdf.statement_of_owners_equity_pdf',
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
        return PDF::loadView('pdf.balance_sheet_pdf',
		                        compact('yearFilter',
		                                'monthFilter',
		                                'title',
		                                'fBalanceSheetItemsList',
		                                'totalAssets',
		                                'totalEquity',
		                                'totalLiability'));
    }

    public function generateCashFlow($yearFilter){
        $yearFilter = $yearFilter==NULL?date('Y'):$yearFilter;
        $accountGroupList = $this->searchAccountGroups(null);
        $totalProfit = 0;
        $depreciationValue = 0;
        $totalCashInHand = 0;
        $totalOperationCash = 0;
        $totalInvestmentCash = 0;
        $totalFinancingCash = 0;
        $lastYearsBalanceSht = array();
        $thisYearsBalanceSht = array();
        $accountTitleList = array();
        $incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',null,$yearFilter);
        $expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',null,$yearFilter);

        $incomeItemsList = $this->getItemsAmountList($incStatementItemsList,'Income');
        $expenseItemsList = $this->getItemsAmountList($expStatementItemsList,'Expense');

        $incTotalSum = $this->getTotalSum($incomeItemsList);
        $expTotalSum = $this->getTotalSum($expenseItemsList);
        $totalProfit = ($incTotalSum  - $expTotalSum);
        $tLastYearsBalanceSht = $this->getJournalEntryRecordsWithFilter(null,null,$yearFilter - 1);
        $tThisYearsBalanceSht = $this->getJournalEntryRecordsWithFilter(null,null,$yearFilter);
        //echo count($tThisYearsBalanceSht);  
        $lastYearsBalanceSht = $this->getItemsAmountList($tLastYearsBalanceSht,null);
        $thisYearsBalanceSht = $this->getItemsAmountList($tThisYearsBalanceSht,null);

        foreach ($thisYearsBalanceSht as $key => $value) {
            if(array_key_exists($key, $lastYearsBalanceSht))
                $thisYearsBalanceSht[$key] -= $lastYearsBalanceSht[$key];
        }

        foreach ($expenseItemsList as $key => $value) {
            if(strrpos('x'.$key,'Depreciation'))
                $depreciationValue += $value;
        }

        foreach ($accountGroupList as $accountGrp) {
            $accountTitleList[$accountGrp->account_group_name] = $accountGrp->accountTitles;
        }

        foreach ($accountTitleList as $key => $value) {
            foreach ($value as $val) {
                if(array_key_exists($val->account_title_name, $thisYearsBalanceSht)){
                    $val->opening_balance = $thisYearsBalanceSht[$val->account_title_name];
                }
            }
        }
        

        foreach ($accountTitleList as $key => $value) {
            if($key == 'Current Assets'){
                foreach ($value as $val) {
                    if($val->account_title_name != 'Cash'){
                        if(strrpos($key, 'Asset')){
                            $totalOperationCash-=$val->opening_balance;
                        }else{
                            $totalOperationCash+=$val->opening_balance;
                        }
                    }
                }
            }
        } 
        //For Acquiring Asset via Cash
        foreach ($tThisYearsBalanceSht as $key) {
            if($key->asset_id != NULL){
                if($key->credit_title_id != NULL && $key->credit->account_title_name == 'Cash'){
                    $totalInvestmentCash += $key->credit_amount;
                }
            }
        }

        //echo '<strong>Cash flows from financing activities</strong>' . '<br/>';
        foreach ($accountTitleList as $key => $value) {
            if(strpos('x' . $key, 'Non-Current Liabilities')){
                foreach ($value as $val) {
                    if(strrpos('x'.$val->account_title_name,'Loans')){
                        $totalFinancingCash+=$val->opening_balance;
                    }
                }
            }
        }

        foreach ($accountTitleList as $key => $value) {
            if(strpos('x' . $key, 'Equity')){
                foreach ($value as $val) {
                    $totalFinancingCash+=$val->opening_balance;
                }
            }
        }

        return PDF::loadView('pdf.statement_of_cash_flow_pdf',
                        compact('totalProfit',
                                'depreciationValue',
                                'accountTitleList',
                                'totalOperationCash',
                                'totalInvestmentCash',
                                'totalFinancingCash',
                                'tThisYearsBalanceSht',
                                'yearFilter'));

    }

    
}
