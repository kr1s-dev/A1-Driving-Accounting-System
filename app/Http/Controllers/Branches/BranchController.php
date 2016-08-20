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
        $title = 'Branches';
        $branchList = $this->searchBranch(null);
        return view('branches.show_branch_list',
                        compact('branchList',
                                'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Branches';
        $lastInsertedBranch = $this->getLastRecord('BranchModel',null);
        $branchNumber = count($lastInsertedBranch)===0?'1':($lastInsertedBranch->id)+1;
        $branch = $this->putBranch();
        return view('branches.create_branches',
        				compact('title',
        						'branchNumber',
        						'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
    	$input = $this->removeKeys($request->all(),true,false);
        $branchId = $this->insertRecords('branch',$input,false);
        return redirect('branches/' . $branchId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Branches';
        $branch = $this->searchBranch($id);
        return view('branches.show_branch_info',
                        compact('branch',
                                'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Branches';
        $branch = $this->searchBranch($id);
        $branchNumber = $id;
        return view('branches.edit_branches',
        				compact('title',
        						'branchNumber',
        						'branch'));
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
        $input = $this->removeKeys($request->all(),false,false);
        $this->updateRecords('branch',array($id),$input);
        return redirect('branches/' . $id);
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
