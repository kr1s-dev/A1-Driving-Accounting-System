<?php

namespace App\Http\Controllers\Branches;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;
use App\Http\Requests\Branch\BranchRequest;

class BranchController extends Controller
{
	use UtilityHelper;

    /**
     * Check if user is logged in
     * Check the usertype of logged in user
     *
    */
    public function __construct(){
        $this->middleware('user.type:branch');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $title = 'Branches';
            $branchList = $this->searchBranch(null);
            return view('branches.show_branch_list',
                            compact('branchList',
                                    'title'));    
        }catch(\Exception $ex){
            return view('errors.503');
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
            $title = 'Branches';
            $lastInsertedBranch = $this->getLastRecord('BranchModel',null);
            $branchNumber = count($lastInsertedBranch)===0?'1':($lastInsertedBranch->id)+1;
            $mainBranch = $this->getLastRecord('BranchModel',array('main_office'=>1));
            $branch = $this->putBranch();
            return view('branches.create_branches',
                            compact('title',
                                    'branchNumber',
                                    'branch',
                                    'mainBranch'));    
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        try{
            $input = $this->removeKeys($request->all(),true,false);
            $branchId = $this->insertRecords('branch',$input,false);
            $this->createSystemLogs('Created New Branch Record');
            flash()->success('Record successfully created');
            return redirect('branches/' . $branchId);    
        }catch(\Exception $ex){
            return view('errors.503');
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
            $title = 'Branches';
            $branch = $this->searchBranch($id);
            return view('branches.show_branch_info',
                            compact('branch',
                                    'title'));    
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
        try{
            $title = 'Branches';
            $branch = $this->searchBranch($id);
            $branchNumber = $id;
            $mainBranch = NULL;
            if(!($branch->main_office)){
                $mainBranch = $this->getLastRecord('BranchModel',array('main_office'=>1));
            }
            return view('branches.edit_branches',
                            compact('title',
                                    'branchNumber',
                                    'branch',
                                    'mainBranch'));    
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        try{
            $input = $this->removeKeys($request->all(),false,false);
            if(!(array_key_exists('main_office', $input))){
                $input['main_office'] = 0;
            }
            $this->updateRecords('branch',array($id),$input);
            $this->createSystemLogs('Updated an Existing Branch');
            flash()->success('Record successfully Updated');
            return redirect('branches/' . $id);    
        }catch(\Exception $ex){
            return view('errors.503');
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
}
