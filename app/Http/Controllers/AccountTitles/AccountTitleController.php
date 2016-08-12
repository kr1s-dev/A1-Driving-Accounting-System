<?php

namespace App\Http\Controllers\AccountTitles;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountTitles\AccountTitleRequest;
use App\Http\Controllers\Utility\UtilityHelper;

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
        $accountGroupsList = $this->getAccountsAccountGroups(null);
        return view('accounttitles.create_account_title',
                        compact('accountTitle',
                                'accountGroupsList',
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
        //
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
