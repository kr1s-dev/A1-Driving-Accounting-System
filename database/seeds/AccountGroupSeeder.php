<?php

use Illuminate\Database\Seeder;

class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountGoupNames = array('Current Assets',
                                    'Non-Current Assets',
                                    'Current Liabilities',
                                    'Non-Current Liabilities',
                                    'Revenues',
                                    'Expenses',
                                    'Owners Equity');
        $accountGroupsList = array();
    	for ($i=0; $i < count($accountGoupNames) ; $i++) { 
    	    $accountGroupsList[] = array('account_group_name' => $accountGoupNames[$i],
                                            'created_at' => date('Y-m-d h:i:sa'),
                                            'updated_at' => date('Y-m-d h:i:sa'));
    	}
    	DB::table('account_groups')->insert($accountGroupsList);

        $accountAssetTitles = array();
        $accountAssetTitles[] = array('account_group_id'=>1,
                                        'account_title_name'=>'Accounts Receivable',
                                        'created_at' => date('Y-m-d h:i:sa'),
                                        'updated_at' => date('Y-m-d h:i:sa'));
        $accountAssetTitles[] = array('account_group_id'=>1,
                                        'account_title_name'=>'Cash',
                                        'created_at' => date('Y-m-d h:i:sa'),
                                        'updated_at' => date('Y-m-d h:i:sa'));
        $accountAssetTitles[] = array('account_group_id'=>6,
                                        'account_title_name'=>'Depreciation Expense',
                                        'created_at' => date('Y-m-d h:i:sa'),
                                        'updated_at' => date('Y-m-d h:i:sa'));
        DB::table('account_titles')->insert($accountAssetTitles);
    }
}
