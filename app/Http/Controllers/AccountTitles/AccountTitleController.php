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
        try{
            $title = 'Account Titles';
            $taccountGroupList = $this->searchAccountGroups(null);
            return view('accounttitles.show_account_title_list',
                            compact('taccountGroupList',
                                    'title'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
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
        }catch(\Exception $ex){
            return view('errors.404');
        }
        


    }

    public function createWithParent($id)
    {
        try{
            $title = 'Account Title';
            $eAccountTitle = $this->searchAccountTitle($id);
            $accountGroupsList = $this->getAccountsAccountGroups(null);
            $accountTitle = $this->putAccountTitle();
            return view('accounttitles.create_account_title',
                            compact('accountGroupsList',
                                    'eAccountTitle',
                                    'accountTitle',
                                    'title'));
        }catch(\Exception $ex){
            echo $ex->getMessage();
            //return view('errors.404');
        }
    }

    /**
     * Show the form for creating a new resource with Account Group Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithGroupParent($id){
        try{
            $title = 'Account Title';
            $accountGroupsList = AccountGroupModel::findOrFail($id);
            $eAccountTitle = $this->putAccountTitle();
            $accountTitle = $this->putAccountTitle();
            return view('accounttitles.create_account_title',
                            compact('accountGroupsList',
                                    'eAccountTitle',
                                    'accountTitle',
                                    'title'));
        }catch(\Exception $ex){
            echo $ex->getMessage();
            //return view('errors.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountTitleRequest $request)
    {
        try{
            $input = $this->removeKeys($request->all(),true,true);
            if(array_key_exists('parent_account_title_name', $input)){
                unset($input['parent_account_title_name']);
            }

            if(array_key_exists('account_group_name', $input)){
                unset($input['account_group_name']);
            }
            $id = $this->insertRecords('account_titles',$input,false);
            $this->createSystemLogs('Created New Account Title');
            flash()->success('Record successfully created');
            return redirect('accounttitle/' . $id);
        }catch(\Exception $ex){
            return view('errors.404');
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
        try{
            $title = 'Account Title';
            $eAccountTitle = $this->searchAccountTitle($id);
            $itemList = $this->getRecords('InvExpItemModel',array('account_title_id'=>$id));
            return view('accounttitles.show_account_title',
                            compact('title',
                                    'eAccountTitle',
                                    'itemList'));
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
            $title = 'Account Title';
            $accountTitle = $this->searchAccountTitle($id);
            $eAccountTitle = $this->putAccountTitle();  
            $accountGroupsList = $this->getAccountsAccountGroups($accountTitle->account_group_id);
            return view('accounttitles.edit_account_title',
                            compact('accountTitle',
                                    'eAccountTitle',
                                    'accountGroupsList',
                                    'title'));    
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
    public function update(AccountTitleRequest $request, $id)
    {
        try{
            $input = $this->removeKeys($request->all(),false,true);
            $this->updateRecords('account_titles',array($id),$input);
            $this->createSystemLogs('Updated Account Title');
            flash()->success('Record successfully Updated');
            return redirect('accounttitle/' . $id);
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
        try{
            $this->deleteRecords('account_titles',array('id'=>$id));
            redirect('accounttitle');
        }catch(\Exception $ex){
            return view('errors.404');
        }
    }
}
