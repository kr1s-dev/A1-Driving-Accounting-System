<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create users Table in DB if it doesn't exist
        if(!Schema::hasTable('students')){
            Schema::create('students', function (Blueprint $table) {
                $table->increments('id');
                $table->Integer('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users');
                $table->Integer('updated_by')->unsigned()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');
                $table->Integer('training_station_id')->unsigned()->nullable();
                $table->foreign('training_station_id')->references('id')->on('branch');
                $table->string('stud_first_name',255);
                $table->string('stud_last_name',255);
                $table->string('stud_mobile_no',13);
                $table->string('stud_tel_no',11);
                $table->longtext('stud_address');
                $table->string('stud_email',255)->unique();
                $table->string('stud_vehicle',255);
                $table->timestamp('stud_date_of_birth');
                $table->string('stud_birth_place');
                $table->string('stud_nationality',255);
                $table->string('stud_marital_status',255);
                $table->string('stud_gender',255);
                $table->string('stud_occupation',255);
                $table->string('stud_company',255);
                $table->string('stud_company_tel_no',255);
                $table->string('stud_contact_name',255);
                $table->string('stud_contact_mobile_no',255);
                $table->string('stud_contact_tel_no',11);
                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop Table of users if exist
        Schema::dropIfExists('students');
    }
}
