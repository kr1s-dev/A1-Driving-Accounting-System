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
        $accountGroupList = $this->searchAccountGroups(null);
        $incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',null,$yearFilter);
        $expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',null,$yearFilter);
        $incomeItemsList = $this->getItemsAmountList($incStatementItemsList,'Income');
        $incTotalSum = $this->getTotalSum($incomeItemsList);
        $expenseItemsList = $this->getItemsAmountList($expStatementItemsList,'Expense');
        $arBalance = 0;
        $expenseList = array();
        $investmentList = array();
        $financingList = array();
        $totalCashInHand = array();

        if($yearFilter == date('Y')){
            $aTitleItemsList = $this->getJournalEntryRecordsWithFilter(null,null,$yearFilter);
            $eBalanceSheetItemsList = $this->getItemsAmountList($aTitleItemsList,null);
            foreach ($accountGroupList as $accountGroup) {
                if(strrpos($accountGroup->account_group_name, 'Assets') || strrpos($accountGroup->account_group_name, 'Liabilities')){
                    foreach ($accountGroup->accountTitles as $actTitle) {
                        if(array_key_exists($actTitle->account_title_name, $eBalanceSheetItemsList))
                            $actTitle->opening_balance += $eBalanceSheetItemsList[$actTitle->account_title_name];
                        if($actTitle->account_title_name=='Accounts Receivable')
                            $arBalance = $actTitle->opening_balance;
                    }
                }
            }
            foreach ($accountGroupList as $accountGroup) {
                if($accountGroup->account_group_name === 'Non-Current Assets'){
                    foreach ($accountGroup->accountTitles as $actTitle) {
                        $investmentList[$actTitle->account_title_name] = $actTitle->opening_balance;
                        foreach ($actTitle->assetsInfo as $astItem) {
                            if($astItem->mode_of_acquisition == 'Payable'){
                                $investmentList[$actTitle->account_title_name] -= $astItem->asset_original_cost;
                            }else if($astItem->mode_of_acquisition == 'Both'){
                                $investmentList[$actTitle->account_title_name] -= $astItem->asset_down_payment;
                            }
                        }
                    }
                }

                if($accountGroup->account_group_name === 'Owners Equity'){
                    foreach ($accountGroup->accountTitles as $actTitle) {
                        $financingList[$actTitle->account_title_name] = $actTitle->opening_balance;
                    }
                }
                foreach ($accountGroup->accountTitles as $actTitle) {
                    if(strrpos($actTitle->account_title_name,'Loans')){
                        $financingList[$actTitle->account_title_name] = $actTitle->opening_balance;
                    }
                }

            }
            $expenseList = $this->getOperationalExpense($expenseItemsList,$accountGroupList);
        }else{

        }

        $totalCashInHand = ($incTotalSum - $arBalance) - ($this->getTotalSum($expenseList)) - ($this->getTotalSum($investmentList)) + ($this->getTotalSum($financingList));

        return PDF::loadView('pdf.statement_of_cash_flow_pdf',
                        compact('incTotalSum',
                                'arBalance',
                                'expenseList',
                                'yearFilter',
                                'investmentList',
                                'financingList',
                                'totalCashInHand'));

    }

    public function getOperationalExpense($expenseItemsList,$accountGroupList){
        $expPayableList;
        foreach ($accountGroupList as $accountGroup) {
            if($accountGroup->account_group_name == 'Current Liabilities'){
                $expPayableList = $accountGroup->accountTitles;
            }
        }

        foreach ($expenseItemsList as $key=>$value) {
            foreach ($expPayableList as $exPpay) {
                $tTitle = str_replace(strpos($key, 'Expense')?'Expense':'Expenses', '', $key);
                if(strcmp($exPpay->account_title_name,$tTitle) > 1){
                    $expenseItemsList[$key] -= $exPpay->opening_balance;
                    break;
                }
            }
        }
        return $expenseItemsList;
    }
}
