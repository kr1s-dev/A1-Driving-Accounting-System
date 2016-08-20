<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$insertUserList = array();
        $insertUserList[] = array('email'=>'admin_user@a1driving.com',
			        				'first_name'=>'I',
			        				'last_name'=>'admin',
			        				'mobile_number'=>'0929819201',
			        				'password'=>bcrypt('testadmin12345'),
			        				'user_type_id'=>1,
			        				'created_at'=>date('m/d/y'),
			        				'updated_at'=>date('m/d/y'),
			                        'is_active'=>1,
			                        'created_by'=>null,
			                        'updated_by'=>null);

        $insertUserList[] = array('email'=>'accountant_user@a1driving.com',
			        				'first_name'=>'I',
			        				'last_name'=>'Accountant',
			        				'mobile_number'=>'0929819201',
			        				'password'=>bcrypt('testadmin12345'),
			        				'user_type_id'=>2,
			        				'created_at'=>date('m/d/y'),
			        				'updated_at'=>date('m/d/y'),
			                        'is_active'=>1,
			                        'created_by'=>null,
			                        'updated_by'=>null);
    	DB::table('users')->insert($insertUserList);
    }
}
