<?php

namespace App\Http\Controllers\RegisterVerifier;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\UtilityHelper;

class RegisterVerifierController extends Controller
{
    use UtilityHelper;
    public function getVerifier($confirmationCode){
        if(is_null($confirmationCode)){
            return view('errors.503');
        }

        try{
            $user = $this->getLastRecord('User',array('confirmation_code'=>$confirmationCode));
            
            if(empty($user)){
                return redirect('/login');
            }else{
                return view('auth.verify',
                                compact('user'));
            }    
        }catch(\Exception $ex){
            return view('errors.503');
        }

        
    }

    public function postVerifier(Request $request){
        try{
            $this->validate($request, [
                'password' => 'required|
                                min:8|
                                confirmed',
            ]);
            $toUpdateItems = array('confirmation_code'=>null,
                                    'password'=>bcrypt($request->input('password')),
                                    'is_active'=>1);
            $this->updateRecords('users',array($request->input('id')),$toUpdateItems);
            flash()->success('User successfully verified. Log in to continue.');
            return redirect('/login');    
        }catch(\Exception $ex){
            return view('errors.503');
        }
        
    }
}
