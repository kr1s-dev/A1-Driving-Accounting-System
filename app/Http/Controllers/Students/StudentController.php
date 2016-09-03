<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\PaymentTransactionModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StudentRequest;
use App\Http\Controllers\Utility\UtilityHelper;


class StudentController extends Controller
{
    use UtilityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $title = 'Students';
            $studentList = $this->searchStudent(null);
            return view('students.show_students_list',
                            compact('studentList',
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
            $title = 'Students';
            $student = $this->putStudent();
            $student->stud_date_of_birth = date('d F, Y',strtotime('-2 days'));
            $lastInsertedBranch = $this->getControlNo('students');
            $branchList = $this->getUsersBranch(null);
            $studentNumber = $lastInsertedBranch->AUTO_INCREMENT;
            $maritalStatus = $this->generateMaritalStatus(null);
            $genderList = $this->generateGender(null);
            return view('students.create_student',
                            compact('title',
                                    'student',
                                    'studentNumber',
                                    'branchList',
                                    'maritalStatus',
                                    'genderList'));    
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
    public function store(StudentRequest $request)
    {
        try{
            $input = $this->removeKeys($request->all(),true,true);
            $toConvertData = explode(' ',$input['stud_date_of_birth']);
            $input['stud_date_of_birth'] = str_replace(',',' ',$toConvertData[1]) . $toConvertData[0] . ' ,' . $toConvertData[2];
            $input['stud_date_of_birth'] = date('Y-m-d',strtotime($input['stud_date_of_birth']));
            $studentId = $this->insertRecords('students',$input,false);
            $this->createSystemLogs('Created New Student Record');
            flash()->success('Record successfully created');
            return redirect('students/'.$studentId);    
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
        $title = 'Students';
        try{
            $student = $this->searchStudent($id);
            if($student != NULL){
                $invoiceIds = array();
                $studInvoiceList = $this->getRecords('InvoiceModel',array('student_id'=>$id));
                if(count($studInvoiceList)>0){
                    foreach ($studInvoiceList as $key) {
                        $invoiceIds[] = $key->id;
                    }
                }
                $receiptList = PaymentTransactionModel::whereIn('payment_id',$invoiceIds)->get();
                return view('students.show_student',
                                compact('title',
                                        'student',
                                        'receiptList'));
            }else{
                return view('errors.404');
            }
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
        $title = 'Students';
        try{
            $student = $this->searchStudent($id);
            if($student != NULL){
                $branchList = $this->getUsersBranch($student->training_station_id);
                $studentNumber = $id;
                $maritalStatus = $this->generateMaritalStatus($student->stud_marital_status);
                $genderList = $this->generateGender($student->stud_gender);
                return view('students.edit_student',
                                compact('title',
                                        'student',
                                        'studentNumber',
                                        'branchList',
                                        'maritalStatus',
                                        'genderList'));
            }else{
                return view('errors.404');
            }
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
    public function update(StudentRequest $request, $id)
    {
        try{
            $input = $this->removeKeys($request->all(),false,true);
            $toConvertData = explode(' ',$input['stud_date_of_birth']);
            $input['stud_date_of_birth'] = str_replace(',',' ',$toConvertData[1]) . $toConvertData[0] . ' ,' . $toConvertData[2];
            $input['stud_date_of_birth'] = date('Y-m-d',strtotime($input['stud_date_of_birth']));
            $this->updateRecords('students',array($id),$input);
            $this->createSystemLogs('Updated an Existing Student Record');
            flash()->success('Record successfully Updated');
            return redirect('students/'.$id);    
        }catch(\Exception $ex){
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
        //
    }

    public function generateMaritalStatus($chosen){
        $maritalStatusList = array('Single','Married','Widowed','Divorced','Annuled');
        $maritalStatus = array();
        if(is_null($chosen)){
            $maritalStatus[] = $chosen;
            foreach ($maritalStatusList as $marStat) {
               if($chosen !== $marStat)
                    $maritalStatus[] = $marStat;
            }
            return $maritalStatus;
        }else{
            return $maritalStatusList;
        }
    }


    public function generateGender($chosen){
        $genderDefaultList = array('Male','Female');
        $genderList = array();
        if(is_null($chosen)){
            $genderList[] = $chosen;
            foreach ($genderDefaultList as $gen) {
               if($chosen !== $gen)
                    $genderList[] = $gen;
            }
            return $genderList;
        }else{
            return $genderDefaultList;
        }
    }
}
