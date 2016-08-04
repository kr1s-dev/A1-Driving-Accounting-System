<?php

namespace App\Http\Controllers\Utility;

use App\User;

trait UtilityHelper
{
    public function searchUser($id){
    	return $id!=NULL?User::findOrFail($id):User::all();
    }
}
