<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Bcrypt;
use App\Http\Requests;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Utility\UtilityHelper;

class UserController extends Controller
{
    use UtilityHelper;

    /**
     * Check if user is logged in
     * Check the usertype of logged in user
     *
    */
    public function __construct(){
        $this->middleware('user.type:users');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $title = 'Users';
            $userList = $this->searchUser(null);
            return view('users.show_user_list',
                            compact('title',
                                    'userList'));    
        }catch(\Exception $ex){
            return view('errors.500');
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
        }catch(\Exception $ex){
            return view('errors.500');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            $confirmation_code = array('confirmation_code'=>str_random(30));
            $input = $this->removeKeys($request->all(),true,true);
            $input['confirmation_code'] = $confirmation_code['confirmation_code'];
            $this->createSystemLogs('Created New User Record');
            flash()->success('Record successfully created');
            $this->insertRecords('users',$input,false);   
            $this->sendEmailVerification($input['email'],
                                        $input['first_name'] . ' ' . $input['last_name'],
                                        $confirmation_code);
            return redirect('/user'); 
        }catch(\Exception $ex){
            return view('errors.500');
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
            $title = 'Users';
            $user = $this->searchUser($id);
            return view('users.show_user',
                            compact('user',
                                    'title'));
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
    public function update(UserRequest $request, $id)
    {
        try{
            $input = $this->removeKeys($request->all(),false,true);
            $this->updateRecords('users',array($id),$input);
            $this->createSystemLogs('Updated an Existing Student Record');
            flash()->success('Record successfully Updated');
            return redirect('user');    
        }catch(\Exception $ex){
            return view('errors.500');
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
            $this->deactivateUser($id);  
            return redirect('user');   
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    public function sendUserResetLinkEmail($id){
        try{
            $user = $this->searchUser($id);
            $this->sendResetLinkEmail($user->email);  
            return redirect('user');   
        }catch(\Exception $ex){
            return view('errors.500');
        }       
    }


    public function getChangePassword($id){
        try{
            $title = 'Change Password';
            $user = $this->searchUser($id);
            return view('users.change_password',
                            compact('title',
                                    'user'));
        }catch(\Exception $ex){
            return view('errors.404');
        }       
    }

    public function postChangePassword(Request $request){
        try{
             $this->validate($request, [
                'old_password' => 'required|min:6|max:255',
                'new_password' => 'required|confirmed|min:6|max:255',
            ]);
            $user = $this->searchUser(Auth::user()->id);
            if(Hash::check($request->input('old_password'), $user->password)){
                if($request->input('old_password') === $request->input('new_password')){
                    return redirect()
                        ->back()
                        ->withError(['new_password'=>'Can\'t used old password again']);
                }else{
                    $user->password = bcrypt($request->input('new_password'));
                    $user->save();
                    $this->createSystemLogs('User: ' . $user->first_name . ' ' , $user->last_name . ', Changed Password.');
                    flash()->success('Successfully Changed Password')->important(); 
                    return redirect('user/'.$user->id);
                }
            }else{
                return redirect()
                        ->back()
                        ->withError(['old_password'=>'Old Password doesn\'t Match']);
            }

        }catch(\Exception $ex){
            return view('errors.500');
        }       
    }


    /**
    * Deactivate User
    * @param  int  $id
    * @return \Illuminate\Http\Response
    **/
    public function deactivateUser($id){
        try{
            $user = $this->searchUser($id);
            $user->is_active = 0;
            $user->save();
            $this->createSystemLogs('Deactivated an Active User');
            flash()->success('User succesfully deactivated')->important();
               
        }catch(\Exception $ex){
            return view('errors.500');
        }
        
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail($email)
    {
        $broker = null;
        $response = Password::broker($broker)->sendResetLink(
            array('email'=>$email),
            $this->resetEmailBuilder()
        );
        // switch ($response) {
        //     case Password::RESET_LINK_SENT:
        //         return $this->getSendResetLinkEmailSuccessResponse($response);
        //     case Password::INVALID_USER:
        //     default:
        //         return $this->getSendResetLinkEmailFailureResponse($response);
        // }
    }

    /**
     * Get the Closure which is used to build the password reset email message.
     *
     * @return \Closure
     */
    protected function resetEmailBuilder()
    {
        return function (Message $message) {
            $message->subject($this->getEmailSubject());
        };
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }
}
