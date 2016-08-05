<?php

namespace App\Http\Controllers\Branches;

use Illuminate\Http\Request;

use App\BranchModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;
use App\Http\Requests\Branch\BranchRequest;

class BranchController extends Controller
{
	use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    	$input = $this->removeKeys($request->all(),true);
        $this->insertRecords('branch',$input,false);
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
        $input = $this->removeKeys($request->all(),false);
        $this->updateRecords('branch',array($id),$input);
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
