<?php

use App\UserTypeModel;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypeName = array('Adminstrator','Accountant');
        $userTypeList = array();
    	for ($i=0; $i < count($userTypeName); $i++) { 
    	    $userTypeList[] = array('type' => $userTypeName[$i]);
    	}
    	UserTypeModel::insert($userTypeList);
    }
}
