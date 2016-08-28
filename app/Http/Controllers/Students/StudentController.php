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
            return view('errors.503');
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
            $student->stud_date_of_birth = date('d F, Y');
            $lastInsertedBranch = $this->getControlNo('students');
            $branchList = $this->getUsersBranch(null);
            $studentNumber = $lastInsertedBranch->AUTO_INCREMENT;
            return view('students.create_student',
                            compact('title',
                                    'student',
                                    'studentNumber',
                                    'branchList'));    
        }catch(\Exception $ex){
            return view('errors.503');
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
            $input['stud_date_of_birth'] = date('Y-d-m',strtotime($input['stud_date_of_birth']));
            $studentId = $this->insertRecords('students',$input,false);
            $this->createSystemLogs('Created New Student Record');
            flash()->success('Record successfully created');
            return redirect('students/'.$studentId);    
        }catch(\Exception $ex){
            return view('errors.503');
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
                return view('errors.503');
            }
        }catch(\Exception $ex){
            return view('errors.503');
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
                return view('students.edit_student',
                                compact('title',
                                        'student',
                                        'studentNumber',
                                        'branchList'));
            }else{
                return view('errors.503');
            }
        }catch(\Exception $ex){
            return view('errors.503');
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
            $input['stud_date_of_birth'] = date('Y-m-d',strtotime($input['stud_date_of_birth']));
            $this->updateRecords('students',array($id),$input);
            $this->createSystemLogs('Updated an Existing Student Record');
            flash()->success('Record successfully Updated');
            return redirect('students/'.$id);    
        }catch(\Exception $ex){
            return view('errors.503');
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
}
