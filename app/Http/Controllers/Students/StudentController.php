<?php

namespace App\Http\Controllers\Students;

use App\PaymentTransactionModel;
use Illuminate\Http\Request;
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
        $title = 'Students';
        $studentList = $this->searchStudent(null);
        return view('students.show_students_list',
                        compact('studentList',
                                'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Students';
        $student = $this->putStudent();
        $lastInsertedBranch = $this->getLastRecord('StudentModel',null);
        $branchList = $this->getUsersBranch(null);
        $studentNumber = count($lastInsertedBranch)===0?'1':($lastInsertedBranch->id)+1;
        return view('students.create_student',
                        compact('title',
                                'student',
                                'studentNumber',
                                'branchList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $input = $this->removeKeys($request->all(),true,true);
        $studentId = $this->insertRecords('students',$input,false);
        return redirect('students/'.$studentId);
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
        $student = $this->searchStudent($id);
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
        $student = $this->searchStudent($id);
        $branchList = $this->getUsersBranch($student->training_station_id);
        $studentNumber = $id;
        return view('students.edit_student',
                        compact('title',
                                'student',
                                'studentNumber',
                                'branchList'));
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
        $input = $this->removeKeys($request->all(),false,true);
        $this->updateRecords('students',array($id),$input);
        return redirect('students/'.$id);
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
