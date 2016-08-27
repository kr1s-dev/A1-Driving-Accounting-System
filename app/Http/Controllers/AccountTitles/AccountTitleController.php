<?php

namespace App\Http\Controllers\AccountTitles;

use Illuminate\Http\Request;

use App\AccountGroupModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;
use App\Http\Requests\AccountTitles\AccountTitleRequest;


class AccountTitleController extends Controller
{
    use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Account Titles';
        $taccountGroupList = $this->searchAccountGroups(null);
        return view('accounttitles.show_account_title_list',
                        compact('taccountGroupList',
                                'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Account Title';
        $accountTitle = $this->putAccountTitle();
        $accountTitle->opening_balance=0;
        $eAccountTitle = $this->putAccountTitle();
        $accountGroupsList = $this->getAccountsAccountGroups(null);
        return view('accounttitles.create_account_title',
                        compact('accountTitle',
                                'eAccountTitle',
                                'accountGroupsList',
                                'title'));


    }

    public function createWithParent($id)
    {
        //
        $title = 'Account Title';
        $eAccountTitle = $this->searchAccountTitle($id);
        $accountGroupsList = $this->getAccountsAccountGroups(null);
        $accountTitle = $this->putAccountTitle();
        return view('accountTitles.create_account_title',
                        compact('accountGroupsList',
                                'eAccountTitle',
                                'accountTitle',
                                'title'));
    }

    /**
     * Show the form for creating a new resource with Account Group Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithGroupParent($id){
        $title = 'Account Title';
        $accountGroupsList = AccountGroupModel::findOrFail($id);
        $eAccountTitle = $this->putAccountTitle();
        $accountTitle = $this->putAccountTitle();
        return view('accountTitles.create_account_title',
                        compact('accountGroupsList',
                                'eAccountTitle',
                                'accountTitle',
                                'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountTitleRequest $request)
    {
        $input = $this->removeKeys($request->all(),true,true);
        if(array_key_exists('parent_account_title_name', $input)){
            unset($input['parent_account_title_name']);
        }

        if(array_key_exists('account_group_name', $input)){
            unset($input['account_group_name']);
        }
        $this->insertRecords('account_titles',$input,false);
        return redirect('accounttitle');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $title = 'Account Title';
            $eAccountTitle = $this->searchAccountTitle($id);
            $itemList = $this->getRecords('InvExpItemModel',array('account_title_id'=>$id));
            return view('accounttitles.show_account_title',
                            compact('title',
                                    'eAccountTitle',
                                    'itemList'));
        }catch(\Exception $ex){
            return view('errors.503');
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
        $title = 'Account Title';
        $accountTitle = $this->searchAccountTitle($id);
        $accountGroupsList = $this->getAccountsAccountGroups($accountTitle->account_group_id);
        return view('accounttitles.create_account_title',
                        compact('accountTitle',
                                'accountGroupsList',
                                'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountTitleRequest $request, $id)
    {
        $input = $this->removeKeys($request->all(),false,true);
        $this->updateRecords('account_titles',array($id),$input);
        return redirect('accounttitle');
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
}
