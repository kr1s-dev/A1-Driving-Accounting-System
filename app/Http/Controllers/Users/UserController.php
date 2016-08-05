<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use App\Http\Controllers\Utility\UtilityHelper;

class UserController extends Controller
{
    use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Users';
        $userList = $this->searchUser(null);
        return view('users.show_user_list',
                        compact('title',
                                'userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Users';
        $user = $this->putUser();
        $isCreate = 1;
        $userTypesList = $this->getUsersUserType(null);
        $branchList = $this->getUsersBranch(null);;
        return view('users.create_user',
                        compact('title',
                                'user',
                                'isCreate',
                                'userTypesList',
                                'branchList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $this->removeKeys($request->all(),true);
        $this->insertRecords('users',$input,false);
        return redirect('user');
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
        $title = 'Users';
        $user = $this->searchUser($id);
        $isCreate = 0;
        $userTypesList = $this->getUsersUserType($user->user_type_id);
        $branchList = $this->getUsersBranch($user->branch_id);;
        return view('users.edit_user',
                        compact('title',
                                'user',
                                'isCreate',
                                'userTypesList',
                                'branchList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $this->removeKeys($request->all(),false);
        $this->updateRecords('users',array($id),$input);
        return redirect('user');
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
