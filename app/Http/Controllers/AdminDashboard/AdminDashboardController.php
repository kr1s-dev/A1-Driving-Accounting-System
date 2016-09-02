<?php

namespace App\Http\Controllers\AdminDashboard;

use Auth;
use App\JournalModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class AdminDashboardController extends Controller
{
	use UtilityHelper;
    public function getAdminDashboard(){

        try{
            return $this->generateIncomeStatement(null,null);
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    public function postAdminDashboard(Request $request){
        $title = '';
        $startDate;
        $endDate = Date('Y-m-d' ,strtotime('+1 days'));
        $incomePerMonth = array();
        $expensePerMonth = array();
        switch ($request->input('category')) {
            case 'Last 7 Days':
                $startDate = Date('Y-m-d',strtotime('-6 days'));
                break;
            case 'Last 30 Days':
                $startDate = Date('Y-m-d',strtotime('-29 days'));
                break;
            case 'This Month':
                $startDate = Date('Y-m-01', strtotime($endDate));
                $endDate = Date('Y-m-t',strtotime($startDate));
                break;
            case 'Last Month':
                $startDate = Date('Y-m-01', strtotime($endDate . '-1 Month'));
                $endDate = Date('Y-m-t',strtotime($startDate));
                break;
            case 'Custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
            case 'Current Year':
                return $this->generateIncomeStatement(null,null);
                break;
            case 'Last Year':
                return $this->generateIncomeStatement(null,date('Y',strtotime('-1 year')));
                break;
            default:
                break;
        }
        $incomePerMonth[date('F/d',strtotime($startDate))] = 0;
        $expensePerMonth[date('F/d',strtotime($startDate))] = 0;
        $incStatementItemsList = $this->customGenerationOfIncomeStatement($startDate,$endDate,'5');
        $expStatementItemsList = $this->customGenerationOfIncomeStatement($startDate,$endDate,'6');

        while (strtotime($startDate) < strtotime($endDate . '-1 day')) {
            $startDate = date ("Y-m-d", strtotime("+1 day", strtotime($startDate)));
            $incomePerMonth[date('F/d',strtotime($startDate))] = 0;
            $expensePerMonth[date('F/d',strtotime($startDate))] = 0;
        }
        
        foreach ($incStatementItemsList as $incStatementItem) {
            $incomePerMonth[date('F/d',strtotime($incStatementItem->created_at))]+=($incStatementItem->credit_amount-$incStatementItem->debit_amount);
        }

        foreach ($expStatementItemsList as $expStatementItems) {
            $expensePerMonth[date('F/d',strtotime($expStatementItems->created_at))]+=($expStatementItems->debit_amount-$expStatementItems->credit_amount);
        }
        $filterList = $this->generateFilter($request->input('category'));
        return view('admin-dashboard.admin_dashboard',
                        compact('title',
                                'incomePerMonth',
                                'expensePerMonth',
                                'filterList'));
    }


    public function generateIncomeStatement($monthFilter,$yearFilter){
    	$title = '';
    	$yearFilter = $yearFilter==NULL?date('Y'):date($yearFilter);
    	$incomePerMonth = array();
    	$expensePerMonth = array();
        $filterList = $this->generateFilter('Current Year');
    	$incStatementItemsList = $this->getJournalEntryRecordsWithFilter('5',$monthFilter,$yearFilter);
    	$expStatementItemsList = $this->getJournalEntryRecordsWithFilter('6',$monthFilter,$yearFilter);

    	foreach (range(1, 12) as $month) {
    		$incomePerMonth[date('F/Y',strtotime($yearFilter .'-'.$month))] = 0;
    		$expensePerMonth[date('F/Y',strtotime($yearFilter .'-'.$month))] = 0;
    	}
    	//print_r($incomePerMonth);	

    	foreach ($incStatementItemsList as $incStatementItem) {
    		$incomePerMonth[date('F/Y',strtotime($incStatementItem->created_at))]+=($incStatementItem->credit_amount-$incStatementItem->debit_amount);
    	}

    	foreach ($expStatementItemsList as $expStatementItems) {
    		$expensePerMonth[date('F/Y',strtotime($expStatementItems->created_at))]+=($expStatementItems->debit_amount-$expStatementItems->credit_amount);
    	}

        
    	return view('admin-dashboard.admin_dashboard',
    					compact('title',
    							'incomePerMonth',
    							'expensePerMonth',
                                'filterList'));
    }

    public function customGenerationOfIncomeStatement($startDate,$endDate,$accountGroupId){
        $query = null;
        if(Auth::user()->branch_id != NULL && !(Auth::user()->branchInfo->main_office) && Auth::user()->userType->type != 'Administrator'){
            $query = JournalModel::whereHas('userCreateInfo',function($q){
                                            $q->where('branch_id','!=',NULL)
                                            ->where('branch_id','=',Auth::user()->branch_id);
                                            });
        }

        if($query==NULL){
            $query = JournalModel::where(function($query) use ($accountGroupId){
                                                $query->whereHas('credit',function($q) use ($accountGroupId){
                                                    $q->where('account_group_id', '=', $accountGroupId);
                                                })
                                                ->orWhereHas('debit',function($q) use ($accountGroupId){
                                                    $q->where('account_group_id', '=', $accountGroupId);
                                                });
                                            });
            }else{
                $query->where(function($query) use ($accountGroupId){
                                $query->whereHas('credit',function($q) use ($accountGroupId){
                                    $q->where('account_group_id', '=', $accountGroupId);
                                })
                                ->orWhereHas('debit',function($q) use ($accountGroupId){
                                    $q->where('account_group_id', '=', $accountGroupId);
                                });
                            });
            }

        return $query->whereBetween('created_at',array($startDate,$endDate))->get();
    }



    public function generateFilter($filter){
        $filterList = array('Last 7 Days','Last 30 Days','This Month','Last Month','Current Year','Last Year');
        $retFilt = array();
        if($filter!=NULL){
            array_diff($filterList,array($filter));
            array_unshift($filterList,$filter);
        }
        return $filterList;
    }
}
