<?php

namespace App\Http\Controllers\Assets;

use Illuminate\Http\Request;

use App\AccountTitleModel;
use App\Http\Requests;
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
        $title = 'Assets';
        $asset = $this->putAsset();
        $accountGroupList = $this->getAssetAccountTitles(null);
        return view('assets.create_asset',
        				compact('title',
        						'asset',
        						'accountGroupList'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetRequest $request)
    {
        $input = $this->removeKeys($request->all(),true,true);
        $input['net_value'] =  $input['asset_original_cost'];
        $input['monthly_depreciation'] = ($input['net_value']-$input['asset_salvage_value']) / $input['asset_lifespan'];  
        $assetId = $this->insertRecords('asset_items',$input,false);
        return redirect('asset/'.$assetId);
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
        $asset = $this->searchAsset($id);
        return view('assets.show_asset',
        			compact('title',
        					'asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Assets';
        $asset = $this->searchAsset($id);
        $asset->asset_date_acquired = date('d F, Y',strtotime($asset->asset_date_acquired));
        $accountGroupList = $this->getAssetAccountTitles($asset->account_title_id);
        return view('assets.edit_asset',
        			compact('title',
        					'asset',
        					'accountGroupList'));
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
    	$input = $this->removeKeys($request->all(),false,true);
    	$input['net_value'] =  $input['asset_original_cost'];
        $input['monthly_depreciation'] = ($input['net_value']-$input['asset_salvage_value']) / $input['asset_lifespan'];
        $input['asset_date_acquired'] = date('Y-m-d',strtotime($input['asset_date_acquired']));
        $this->updateRecords('asset_items',array($id),$input);
        return redirect('asset/'.$id);
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
    	$value = '%fixed asset%';
    	$accountTitles = array();
        if($id==null){
        	$tAccountTitles = AccountTitleModel::whereHas('group',function($q) use ($value){
        											$q->where('account_group_name','like',$value);
        											})
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
        										->get();
            foreach($tAccountTitles as $tAccountTitle){
                $accountTitles[$tAccountTitle->id] = $tAccountTitle->account_title_name;
            }
        }
        return $accountTitles;
    }
}