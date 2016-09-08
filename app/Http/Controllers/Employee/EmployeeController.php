<?php

namespace App\Http\Controllers\Employee;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Controllers\Utility\UtilityHelper;

class EmployeeController extends Controller
{
    use UtilityHelper;
    public function index()
    {
        try{
            $title='Employee';
            $employeeList = $this->searchEmployee(null);
            return view('employee.show_employee_list',
                            compact('employeeList',
                                    'title'));
        }catch(\Exception $ex){
            return view('errors.404');
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
            $title = 'Employee';
            $employee = $this->putEmployee();
            $statusList = $this->generateTaxStatusList(null);
            return view('employee.create_employee',
                            compact('title',
                                    'employee',
                                    'statusList'));
        }catch(\Exception $ex){

            return view('errors.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try{
            $input = $this->removeKeys($request->all(),true,true);
            $input['employee_withholding_tax'] = $this->computeTax($input['tax_status'],
                                                                    ($input['employee_salary']+$input['added_source_of_salary_taxable'])-($input['employee_sss_deduction']+$input['employee_philhealth_deduction']+$input['employee_pagibig_deduction']+$input['other_deduction']));
            $employeeId = $this->insertRecords('employee',$input,false);
            return redirect('employee/'.$employeeId);
        }catch(\Exception $ex){
            return view('errors.404');
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
            $title = 'Employee';
            $employee = $this->searchEmployee($id);
            return view('employee.show_employee',
                            compact('title',
                                    'employee'));
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
            $title = 'Employee';
            $employee = $this->searchEmployee($id);
            $statusList = $this->generateTaxStatusList($employee->tax_status);
            return view('employee.update_employee',
                            compact('title',
                                    'employee',
                                    'statusList'));
        }catch(\Exception $ex){
            return view('errors.404');
        }
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
     
    public function update(EmployeeRequest $request, $id)
    {
        
        try{
            $input = $this->removeKeys($request->all(),false,true); 
            $input['employee_withholding_tax'] = $this->computeTax($input['tax_status'],
                                                                    ($input['employee_salary']+$input['added_source_of_salary_taxable'])-($input['employee_sss_deduction']+$input['employee_philhealth_deduction']+$input['employee_pagibig_deduction']+$input['other_deduction']));
            $this->updateRecords('employee',array($id),$input);
            return redirect('employee/'.$id);
        }catch(\Exception $ex){
            echo $ex->getMessage();
            return view('errors.404');
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
            $employee = $this->searchEmployee($id);
            $employee->is_active=0;
            $employee->save();
            return redirect('employee');
        }catch(\Exception $ex){
            return view('errors.404');
        }
    }


    private function computeTax($status,$taxableSalary){
        echo $taxableSalary;
        if($status==='Z'){
            if($taxableSalary<833){
                return 0;
            }elseif($taxableSalary>= 833 && $taxableSalary<2500){
                return 41.67 + (($taxableSalary-833)*.10);
            }elseif($taxableSalary>= 2500 && $taxableSalary<5833){
                return 208.33 + (($taxableSalary-2500)*.15);
            }elseif($taxableSalary>= 5833 && $taxableSalary<11667){
                return 708.33 + (($taxableSalary-5833)*.20);
            }elseif($taxableSalary>= 11667 && $taxableSalary<20833){
                return 1875 + (($taxableSalary-11667)*.25);
            }elseif($taxableSalary>= 20833 && $taxableSalary<41667){
                echo 'hi';
                return 4166.67 + (($taxableSalary-20833)*.30);
            }elseif($taxableSalary>41667){
                return 10416.67 + (($taxableSalary-41667)*.32);
            }
        }elseif($status==='S/ME'){
            if($taxableSalary>= 1 && $taxableSalary<4167){
                return 0;
            }elseif($taxableSalary>= 4167 && $taxableSalary<5000){
                return 0 + (($taxableSalary-4167)*.05);
            }elseif($taxableSalary>= 5000 && $taxableSalary<6667){
                return 41.67 + (($taxableSalary-5000)*.10);
            }elseif($taxableSalary>= 6667 && $taxableSalary<10000){
                return 208.33 + (($taxableSalary-6667)*.15);
            }elseif($taxableSalary>= 10000 && $taxableSalary<15883){
                return 708.33 + (($taxableSalary-10000)*.20);
            }elseif($taxableSalary>= 15833 && $taxableSalary<25000){
                return 1875 + (($taxableSalary-15833)*.25);
            }elseif($taxableSalary>= 25000 && $taxableSalary<45833){
                return 4166.67 + (($taxableSalary-25000)*.30);
            }elseif($taxableSalary>45833){
                return 10416.67 + (($taxableSalary-45833)*.32);
            }
        }elseif('ME1/S1'){
            if($taxableSalary>= 1 && $taxableSalary<6250){
                return 0;
            }elseif($taxableSalary>= 6250 && $taxableSalary<7083){
                return 0 + (($taxableSalary-6250)*.05);
            }elseif($taxableSalary>= 7083 && $taxableSalary<8750){
                return 41.67 + (($taxableSalary-7083)*.10);
            }elseif($taxableSalary>= 8750 && $taxableSalary<12083){
                return 208.33 + (($taxableSalary-8750)*.15);
            }elseif($taxableSalary>= 12083 && $taxableSalary<17917){
                return 708.33 + (($taxableSalary-12083)*.20);
            }elseif($taxableSalary>= 17917 && $taxableSalary<27083){
                return 1875 + (($taxableSalary-17917)*.25);
            }elseif($taxableSalary>= 27083 && $taxableSalary<47917){
                return 4166.67 + (($taxableSalary-27083)*.30);
            }elseif($taxableSalary>47917){
                return 10416.67 + (($taxableSalary-47917)*.32);
            }
        }elseif('ME2/S2'){
            if($taxableSalary>= 1 && $taxableSalary<8333){
                return 0;
            }elseif($taxableSalary>= 8333 && $taxableSalary<9167){
                return 0 + (($taxableSalary-8333)*.05);
            }elseif($taxableSalary>= 9167 && $taxableSalary<10833){
                return 41.67 + (($taxableSalary-9167)*.10);
            }elseif($taxableSalary>= 10833 && $taxableSalary<14167){
                return 208.33 + (($taxableSalary-10833)*.15);
            }elseif($taxableSalary>= 14167 && $taxableSalary<20000){
                return 708.33 + (($taxableSalary-14167)*.20);
            }elseif($taxableSalary>= 20000 && $taxableSalary<29167){
                return 1875 + (($taxableSalary-20000)*.25);
            }elseif($taxableSalary>= 29167 && $taxableSalary<50000){
                return 4166.67 + (($taxableSalary-29167)*.30);
            }elseif($taxableSalary>50000){
                return 10416.67 + (($taxableSalary-50000)*.32);
            }
        }elseif('ME3/S3'){
            if($taxableSalary>= 1 && $taxableSalary<10417){
                return 0;
            }elseif($taxableSalary>= 10417 && $taxableSalary<11250){
                return 0 + (($taxableSalary-10417)*.05);
            }elseif($taxableSalary>= 11250 && $taxableSalary<12917){
                return 41.67 + (($taxableSalary-11250)*.10);
            }elseif($taxableSalary>= 12917 && $taxableSalary<16250){
                return 208.33 + (($taxableSalary-12917)*.15);
            }elseif($taxableSalary>= 16250 && $taxableSalary<22083){
                return 708.33 + (($taxableSalary-16250)*.20);
            }elseif($taxableSalary>= 22083 && $taxableSalary<31250){
                return 1875 + (($taxableSalary-22083)*.25);
            }elseif($taxableSalary>= 31250 && $taxableSalary<52083){
                return 4166.67 + (($taxableSalary-31250)*.30);
            }elseif($taxableSalary>52083){
                return 10416.67 + (($taxableSalary-52083)*.32);
            }
        }elseif('ME4/S4'){
            if($taxableSalary>= 1 && $taxableSalary<12500){
                return 0;
            }elseif($taxableSalary>= 12500 && $taxableSalary<13333){
                return 0 + (($taxableSalary-12500)*.05);
            }elseif($taxableSalary>= 13333 && $taxableSalary<15000){
                return 41.67 + (($taxableSalary-13333)*.10);
            }elseif($taxableSalary>= 15000 && $taxableSalary<18333){
                return 208.33 + (($taxableSalary-15000)*.15);
            }elseif($taxableSalary>= 18333 && $taxableSalary<24167){
                return 708.33 + (($taxableSalary-18333)*.20);
            }elseif($taxableSalary>= 24167 && $taxableSalary<33333){
                return 1875 + (($taxableSalary-24167)*.25);
            }elseif($taxableSalary>= 33333 && $taxableSalary<54167){
                return 4166.67 + (($taxableSalary-33333)*.30);
            }elseif($taxableSalary>54167){
                return 10416.67 + (($taxableSalary-54167)*.32);
            }
        }
    }

    public function generateTaxStatusList($currentStatus){
        $taxStatusList = array('Z','S/ME','ME1/S1','ME2/S2','ME3/S3','ME4/S4');
        $tTaxStatusList = array();
        if(!is_null($currentStatus)){
            $tTaxStatusList[] = $currentStatus;
            foreach ($taxStatusList as $gen) {
               if($currentStatus !== $gen)
                    $tTaxStatusList[] = $gen;
            }
            return $tTaxStatusList;
        }else{
            return $taxStatusList;
        }
    }
}
