<?php

namespace App\Http\Controllers\AdminDashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class AdminDashboardController extends Controller
{
	use UtilityHelper;
    public function getAdminDashboard(){
    	return $this->generateIncomeStatement(null,null);
    }


    public function generateIncomeStatement($monthFilter,$yearFilter){
    	$title = '';
    	$yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);
    	$incomePerMonth = array();
    	$expensePerMonth = array();
    	$incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',$monthFilter,$yearFilter);
    	$expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',$monthFilter,$yearFilter);

    	foreach (range(1, 12) as $month) {
    		$incomePerMonth[date('F',strtotime('2015-'.$month))] = 0;
    		$expensePerMonth[date('F',strtotime('2015-'.$month))] = 0;
    	}
    	//print_r($incomePerMonth);	

    	foreach ($incStatementItemsList as $incStatementItem) {
    		$incomePerMonth[date('F',strtotime($incStatementItem->created_at))]+=($incStatementItem->credit_amount-$incStatementItem->debit_amount);
    	}

    	foreach ($expStatementItemsList as $expStatementItems) {
    		$expensePerMonth[date('F',strtotime($expStatementItems->created_at))]+=($expStatementItems->debit_amount-$expStatementItems->credit_amount);
    	}
    	return view('admin-dashboard.admin_dashboard',
    					compact('title',
    							'incomePerMonth',
    							'expensePerMonth'));

    }
}
