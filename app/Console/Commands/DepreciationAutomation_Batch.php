<?php

namespace App\Console\Commands;

use DB;
use Auth;
use App\AssetsModel;
use App\AccountTitleModel;
use Illuminate\Console\Command;
use App\Http\Controllers\Utility\UtilityHelper;


class DepreciationAutomation_Batch extends Command
{
    use UtilityHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'begin:depreciation {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Computes Fixed Assets Depreciation per Month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tJournalEntry = array();
        $toInsertJournalEntry = array();
        $updateIds = array();
        $toUpdateAssets = array();
        $userAdmin = $this->getLastRecord('User',array('user_type_id'=>1));
        $command = $this->option('run');
        try{
            if($command=='1'){
                $eAssetItemsList = AssetsModel::where('created_at','LIKE','%'.date('Y-m-d').'%')
                                ->where('asset_lifespan','>',0)
                                ->get();
            }else{
                $eAssetItemsList = AssetsModel::where('next_depreciation_date','=',date('Y-m-d'))
                                ->where('asset_lifespan','>',0)
                                ->get();
            }
            
            if(!empty($eAssetItemsList)){
                foreach ($eAssetItemsList as $eAssetItem) {
                    $description = 'Depreciation of ' . $eAssetItem->item_name . ' for the month of ' . date('F');
                    $eAssetItem->next_depreciation_date = date('Y-m-d',strtotime($eAssetItem->next_depreciation_date . '+1 month'));
                    $eAssetItem->asset_lifespan = ($eAssetItem->asset_lifespan-1);
                    $eAssetItem->net_value = str_replace(",","", number_format($eAssetItem->net_value-$eAssetItem->monthly_depreciation,2));
                    $eAssetItem->accumulated_depreciation = str_replace(",","", number_format($eAssetItem->accumulated_depreciation+$eAssetItem->monthly_depreciation,2)) ;
                    $eAssetItem->updated_at = date('Y-m-d');
                    \Log::info($eAssetItem->accumulated_depreciation);
                    \Log::info($eAssetItem->net_value);
                    $eAssetItem->save(); //Think of a better way
                    $tJournalEntry[] = $this->createJournalEntry($eAssetItem->accountTitleInfo->account_title_name,'Asset','asset_id',$eAssetItem->id,$description,$eAssetItem->monthly_depreciation,$userAdmin->id);
                }
                // debit depreciation expense
                // credit accumulated depreciation
                if(!empty($tJournalEntry)){
                    foreach ($tJournalEntry as $key => $value) {
                        foreach ($value as $key => $val) {
                            $toInsertJournalEntry[] = $val;
                        }
                    }
                    $this->insertRecords('journal_entry',$toInsertJournalEntry,true);
                }
                DB::table('system_logs')->insert($this->createSystemLogs('Done Depreciating of Assets',$userAdmin));
                \Log::info('Success');
            }
            
        }catch(\Excetion $ex){
            DB::table('system_logs')->insert($this->createSystemLogs('Error in Updating Assets with error log: ' . $ex.getMessage(),$userAdmin));
        }
    }

    public function createJournalEntry($accountTitleName,$typeName,$foreignKey,$foreignValue,$description,$amount,$adminId){
        $journalEntryList = array();
        $acctTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>$accountTitleName));
        $accountDepExp = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Depreciation Expense'));
        if(is_null($accountDepExp)){
            $newAcctTitle = array('account_title_name'=>'Depreciation Expense',
                                    'created_by'=>$adminId,
                                    'updated_by'=>$adminId,
                                    'created_at'=>date('Y-m-d h:i:sa'),
                                    'updated_at'=>date('Y-m-d h:i:sa'));
            $this->insertRecords('account_titles',$newAcctTitle,false);
            $accountDepExp = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Depreciation Expense'));
        }
        $accountAccExp = DB::table('account_titles')
                                ->where('account_title_name','LIKE','%Accumulated Depreciation - '.$accountTitleName.'%')
                                ->first();
        if(is_null($accountAccExp)){
            $newAcctTitle = array('account_title_name'=>'Accumulated Depreciation - ' . $accountTitleName,
                                    'account_title_id'=>$acctTitle->id,
                                    'created_by'=>$adminId,
                                    'updated_by'=>$adminId,
                                    'created_at'=>date('Y-m-d h:i:sa'),
                                    'updated_at'=>date('Y-m-d h:i:sa'),
                                    'account_group_id'=>2);
            $this->insertRecords('account_titles',$newAcctTitle,false);
            $accountAccExp = DB::table('account_titles')
                                ->where('account_title_name','LIKE','%Accumulated Depreciation - '.$accountTitleName.'%')
                                ->first();
        }

        if(!(is_null($accountDepExp )) && !(is_null($accountAccExp))){
            $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                            $accountDepExp->id,null,$amount,
                                                            0.00,$description,date('Y-m-d'),
                                                            date('Y-m-d'),$adminId); 

            $journalEntryList[] = $this->populateJournalEntry($foreignKey,$foreignValue,$typeName,
                                                                null,$accountAccExp->id,0.00,
                                                                $amount,$description,date('Y-m-d'),
                                                                date('Y-m-d'),$adminId);
        }
        
        return $journalEntryList;
    }

    public function createSystemLogs($action,$user){
        return array('created_by'=>$user->id,
                        'updated_by'=>$user->id,
                        'action'=>$action,
                        'created_at' => date('Y-m-d H:i:sa'),
                        'updated_at' => date('Y-m-d H:i:sa'));
    }

    public function populateJournalEntry($foreignKey,$foreignVal,$typeValue,
                                            $debitTitleIdValue,$creditTitleIdValue,$debitAmountValue,
                                            $creditAmountValue,$descriptionValue,$createdAtValue,
                                            $updatedAtValue,$adminId){
        return array($foreignKey=>$foreignVal,
                        'type' => $typeValue,
                        'debit_title_id'=>$debitTitleIdValue,
                        'credit_title_id'=>$creditTitleIdValue,
                        'debit_amount' => $debitAmountValue,
                        'credit_amount'=> $creditAmountValue,
                        'description'=> $descriptionValue,
                        'created_at' => $createdAtValue,
                        'updated_at' => $updatedAtValue,
                        'created_by' => $adminId,
                        'updated_by' => $adminId);
    }
}
