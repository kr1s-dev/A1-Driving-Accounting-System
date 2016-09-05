<?php

namespace App\Http\Controllers\Assets;

use Auth;
use App\Http\Requests;
use App\AccountTitleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Assets\AssetRequest;
use App\Http\Controllers\Utility\UtilityHelper;

class AssetController extends Controller
{
    use UtilityHelper;
    public function index()
    {
        $title = 'Assets';
        $assetList = $this->searchAsset(null);
        return view('assets.show_asset_list',
                        compact('title',
                                'assetList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $title = 'Assets';
            $asset = $this->putAsset();
            $accountGroupList = $this->getAssetAccountTitles(null);
            return view('assets.create_asset',
                            compact('title',
                                    'asset',
                                    'accountGroupList'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetRequest $request)
    {
        try{
            $input = $this->removeKeys($request->all(),true,true);
            $input['net_value'] =  $input['asset_original_cost'];
            $input['monthly_depreciation'] = ($input['net_value']-$input['asset_salvage_value']) / $input['asset_lifespan'];  
            $toConvertData = explode(' ',$input['asset_date_acquired']);
            $input['asset_date_acquired'] = str_replace(',',' ',$toConvertData[1]) . $toConvertData[0] . ' ,' . $toConvertData[2];
            $input['asset_date_acquired'] = date('Y-m-d',strtotime($input['asset_date_acquired']));
            $input['next_depreciation_date'] = date('Y-m-d',strtotime('+1 Month'));
            $assetId = $this->insertRecords('asset_items',$input,false);


            $this->insertRecords('journal_entry',
                                    $this->toInsertJournalEntry($input,$assetId,true),
                                    true);
            $this->createSystemLogs('Created New Asset Record');
            flash()->success('Record successfully created');
            return redirect('asset/'.$assetId);    
        }catch(\Exception $ex){
            echo $ex->getmessage();
            //return view('errors.404');
        }
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Assets';
        try{
            $asset = $this->searchAsset($id);
            if($asset != NULL){
                return view('assets.show_asset',
                        compact('title',
                                'asset'));
            }else{
                return view('errors.404');
            }
        }catch(\Exception $ex){
            return view('errors.404');
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $title = 'Assets';
            $asset = $this->searchAsset($id);
            if($asset != NULL){
                $asset->asset_date_acquired = date('d F, Y',strtotime($asset->asset_date_acquired));
                $accountGroupList = $this->getAssetAccountTitles($asset->account_title_id);
                return view('assets.edit_asset',
                            compact('title',
                                    'asset',
                                    'accountGroupList'));
            }else{
                return view('errors.404');
            }    
        }catch(\Exception $ex){
            return view('errors.404');
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssetRequest $request, $id)
    {
        try{
            $input = $this->removeKeys($request->all(),false,true);
            $input['net_value'] =  $input['asset_original_cost'];
            $input['monthly_depreciation'] = ($input['net_value']-$input['asset_salvage_value']) / $input['asset_lifespan'];
            $toConvertData = explode(' ',$input['asset_date_acquired']);
            $input['asset_date_acquired'] = str_replace(',',' ',$toConvertData[1]) . $toConvertData[0] . ' ,' . $toConvertData[2];
            $input['asset_date_acquired'] = date('Y-m-d',strtotime($input['asset_date_acquired']));
            $this->updateRecords('asset_items',array($id),$input);

            //Delete Journal Entry Records
            $this->deleteRecords('journal_entry',array('asset_id'=>$id));

            //Insert again
            $this->insertRecords('journal_entry',
                                    $this->toInsertJournalEntry($input,$id,true),
                                    true);
            $this->createSystemLogs('Updated an Existing Asset Record');
            flash()->success('Record successfully Updated');
            return redirect('asset/'.$id);    
        }catch(\Exception $ex){
            return view('errors.404');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function getAssetAccountTitles($id){
        $value = '%Non-current asset%';
        $accountTitles = array();
        if($id==null){
            $tAccountTitles = AccountTitleModel::whereHas('group',function($q) use ($value){
                                                    $q->where('account_group_name','like',$value);
                                                    })
                                                ->where('account_title_id','=',NULL)
                                                ->get();
            foreach($tAccountTitles as $tAccountTitle){
                $accountTitles[$tAccountTitle->id] = $tAccountTitle->account_title_name;
            }
        }else{
            $tAccountTitle = $this->searchAccountTitle($id);
            $accountTitles[$tAccountTitle->id] = $tAccountTitle->account_title_name;
            $tAccountTitles = AccountTitleModel::whereHas('group',function($q) use ($value){
                                                    $q->where('account_group_name','like',$value);
                                                    })
                                                ->where('id','!=',$id)
                                                ->where('account_title_id','=',NULL)
                                                ->get();
            foreach($tAccountTitles as $tAccountTitle){
                $accountTitles[$tAccountTitle->id] = $tAccountTitle->account_title_name;
            }
        }
        return $accountTitles;
    }

    public function toInsertJournalEntry($data,$assetId,$isInsert){
        $journalEntryList = array();
        $eAsset = $this->searchAsset($assetId);
        $description = 'Bought item ' . $data['asset_name']  . ' from ' . $data['asset_vendor'];
        $cashAccountTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Cash'));
        if(is_null($cashAccountTitle)){
            $this->insertNewAccountTitle('Cash',null);
            $this->insertRecords('account_titles',$newAcctTitle,false);
            $cashAccountTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Cash'));
        }

        $journalEntryList[] = $this->populateJournalEntry('asset_id',$assetId,'Asset',
                                                            $data['account_title_id'],null,$data['asset_original_cost'],
                                                            0.00,$description,$isInsert?date('Y-m-d'):$asset->created_at,
                                                            date('Y-m-d'));
        if($data['asset_mode_of_acq']==='Cash'){
            $journalEntryList[] = $this->populateJournalEntry('asset_id',$assetId,'Asset',
                                                                null,$cashAccountTitle->id,0.00,
                                                                $data['asset_original_cost'],$description,$isInsert?date('Y-m-d'):$asset->created_at,
                                                                date('Y-m-d'));
        }else{
            $accountsPayableAccounTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Notes Payable'));
            if(is_null($accountsPayableAccounTitle)){
                $this->insertNewAccountTitle('Notes Payable',null);
                $accountsPayableAccounTitle = $this->getLastRecord('AccountTitleModel',array('account_title_name'=>'Notes Payable'));
            }
            if($data['asset_mode_of_acq']==='Both'){
                $journalEntryList[] = $this->populateJournalEntry('asset_id',$assetId,'Asset',
                                                                null,$cashAccountTitle->id,0.00,
                                                                $data['asset_down_payment'],$description,$isInsert?date('Y-m-d'):$asset->created_at,
                                                                date('Y-m-d'));

                $journalEntryList[] = $this->populateJournalEntry('asset_id',$assetId,'Asset',
                                                                null,$accountsPayableAccounTitle->id,0.00,
                                                                $data['asset_original_cost'] - $data['asset_down_payment'],$description,$isInsert?date('Y-m-d'):$asset->created_at,
                                                                date('Y-m-d'));
            }else{
                $journalEntryList[] = $this->populateJournalEntry('asset_id',$assetId,'Asset',
                                                                null,$accountsPayableAccounTitle->id,0.00,
                                                                $data['asset_original_cost'],$description,$isInsert?date('Y-m-d'):$asset->created_at,
                                                                date('Y-m-d'));
            }
        }
        return $journalEntryList;
    }
}