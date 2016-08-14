<?php

namespace App\Http\Controllers\Journal;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class JournalEntryController extends Controller
{
	use UtilityHelper;

    public function index(){
        $title = 'Journal';
        $journalEntryList = $this->getRecords('JournalModel',null);
        return view('journal.show_journal_entries',
                        compact('title',
                                'journalEntryList'));
    }

    public function create(){
    	$title = 'Journal';
    	$accountTitlesList = $this->searchAccountTitle(null);
        return view('journal.create_journal_entry',
                        compact('accountTitlesList',
                        		'title'));
    }

    public function store(Request $request){
    	try{
            //print_r($this->createJouralEntry($request->input('data')));
            $this->insertRecords('journal_entry',
                                    $this->createJouralEntry($request->input('data')),
                                    true);
            echo 'done';
        }catch(\Exception $ex){
            echo $ex.getMessage();
        }
    }

    public function createJouralEntry($data){
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
                                                'description'=>$description);
                }else if($type=='2'){
                    $toInsertItems[] = array('created_by' => Auth::user()->id,
                                                'updated_by' => Auth::user()->id,
                                                'created_at' => date('Y-m-d h:i:sa'),
                                                'updated_at'=>  date('Y-m-d h:i:sa'),
                                                'debit_title_id'=>NULL,
                                                'debit_amount'=>0.00,
                                                'credit_title_id'=>$accountTitleId,
                                                'credit_amount'=>$amount,
                                                'description'=>$description);
                }
            }
        }
        return $toInsertItems;
    }
}
