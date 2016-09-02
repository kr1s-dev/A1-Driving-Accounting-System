<?php

namespace App\Http\Controllers\Journal;

use Illuminate\Http\Request;

use Auth;
use App\JournalModel;
use App\Http\Requests;
use App\AccountTitleModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class JournalEntryController extends Controller
{
	use UtilityHelper;

    public function index(){
        try{
            $title = 'Journal';
            $journalEntryList = $this->getRecords('JournalModel',null);
            return view('journal.show_journal_entries',
                            compact('title',
                                    'journalEntryList'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
    }

    public function getJournalEntry(){
        try{
        	$title = 'Journal';
            $type = 'Journal Entry';
        	$accountTitlesList = $this->searchAccountTitle(null);
            return view('journal.create_journal_entry',
                            compact('accountTitlesList',
                                    'type',
                            		'title'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
    }

    public function getAdjustmenstEntry(){
        try{
            $title = 'Adjustment';
            $type = 'Adjustment Entry';
            $accountTitleId = array();
            $journalEntryList = JournalModel::whereYear('created_at','=',date('Y'))->get();
            foreach ($journalEntryList as $journalEntry) {
                $id = $journalEntry->credit_title_id!=NULL?$journalEntry->credit_title_id:$journalEntry->debit_title_id;
                if(!(in_array($id, $accountTitleId)))
                    $accountTitleId[] = $id;
            }
            $accountTitlesList = AccountTitleModel::whereIn('id',$accountTitleId)->get();
            return view('journal.create_journal_entry',
                            compact('accountTitlesList',
                                    'title',
                                    'type'));    
        }catch(\Exception $ex){
            return view('errors.404');
        }
        

    }

    public function store(Request $request){
    	try{
            $this->insertRecords('journal_entry',
                                    $this->createJouralEntry($request->input('data'),$request->input('type')),
                                    true);
            $this->createSystemLogs('Created New ' . $request->input('type') . ' Record');
            flash()->success('Record successfully created');
        }catch(\Exception $ex){
            echo $ex.getMessage();
        }
    }

    public function createJouralEntry($data,$journalType){
        $count = 0;
        $dataToInsertList = explode(',',$data);
        $toInsertItems = array();
        foreach($dataToInsertList as $dataToInsert){
            ++$count;
            if($count==1){
                $type = $dataToInsert;
            }else if($count==2){
                $accountTitleId = $dataToInsert;
            }else if($count==3){
                $description = $dataToInsert;
            }else if($count==4){
                $amount = $dataToInsert;
                $count = 0;
                if($type=='1'){
                    $toInsertItems[] = array('created_by' => Auth::user()->id,
                                                'updated_by' => Auth::user()->id,
                                                'created_at' => date('Y-m-d h:i:sa'),
                                                'updated_at'=>  date('Y-m-d h:i:sa'),
                                                'credit_title_id'=>NULL, 
                                                'credit_amount'=>0.00,
                                                'debit_title_id'=>$accountTitleId,
                                                'debit_amount'=>$amount,
                                                'description'=>$description,
                                                'type'=>$journalType);
                }else if($type=='2'){
                    $toInsertItems[] = array('created_by' => Auth::user()->id,
                                                'updated_by' => Auth::user()->id,
                                                'created_at' => date('Y-m-d h:i:sa'),
                                                'updated_at'=>  date('Y-m-d h:i:sa'),
                                                'debit_title_id'=>NULL,
                                                'debit_amount'=>0.00,
                                                'credit_title_id'=>$accountTitleId,
                                                'credit_amount'=>$amount,
                                                'description'=>$description,
                                                'type'=>$journalType);
                }
            }
        }
        return $toInsertItems;
    }
}
