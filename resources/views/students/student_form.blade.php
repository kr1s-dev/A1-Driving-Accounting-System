<div class="row">
  <div class="input-field col s12 m6 l6">
    <input disabled="disabled" id="name" type="text" value="{{sprintf("%'.07d\n", count($errors)>0?$studentNumber:$studentNumber)}}">
    <label for="first_name">Student No.</label>
  </div>
</div>
<div class="row">
  <!--div class="input-field col s12 m6 l6">
      <select name>
        <option value="" disabled selected>Select Branch</option>
        <option value="1">SM Marilao</option>
        <option value="2">SM Valenzuela</option>
        <option value="3">SM North</option>
        <option value="3">SM Megamall</option>
        <option value="3">SM Mall of Asia</option>
      </select>
      <label>Branch Enrolled</label>
  </div-->
  <div class="input-field col s12 m6 l6">
      <select name="training_station_id">
        @foreach($branchList as $key => $value)
          <option value="{{$key}}">{{$value}}</option>
        @endforeach
      </select>
      <label>Training Station</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="text" name="stud_first_name" value="{{count($errors)>0?old('stud_first_name'):$student->stud_first_name}}">
    <label for="first_name">First Name</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="name" type="text" name="stud_last_name" value="{{count($errors)>0?old('stud_last_name'):$student->stud_last_name}}">
    <label for="first_name">Last Name</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_mobile_no" name="stud_mobile_no" value="{{count($errors)>0?old('stud_mobile_no'):$student->stud_mobile_no}}">
    <label for="email">Mobile No.</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_tel_no" value="{{count($errors)>0?old('stud_tel_no'):$student->stud_tel_no}}">
    <label for="email">Tel No.</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m12 l12">
    <input id="name" type="text" name="stud_address" value="{{count($errors)>0?old('stud_address'):$student->stud_address}}">
    <label for="first_name">Address</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="number" type="email" name="stud_email" value="{{count($errors)>0?old('stud_email'):$student->stud_email}}">
    <label for="email">Email</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_vehicle" value="{{count($errors)>0?old('stud_vehicle'):$student->stud_vehicle}}">
    <label for="email">Vehicle</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="vehicle_plate_no" value="{{count($errors)>0?old('vehicle_plate_no'):$student->vehicle_plate_no}}">
    <label for="email">Vehicle Plate No.</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="vehicle_engine_no" value="{{count($errors)>0?old('vehicle_engine_no'):$student->vehicle_engine_no}}">
    <label for="email">Vehicle Engine No.</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input type="date" class="datepicker" name="stud_date_of_birth" value="{{count($errors)>0?old('stud_date_of_birth'):date('d F, Y',strtotime($student->stud_date_of_birth))}}">
    <label for="birthday">Date of Birth</label>
  </div>

  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_birth_place" value="{{count($errors)>0?old('stud_birth_place'):$student->stud_birth_place}}">
    <label for="email">Birthplace</label>
  </div>
</div>
<div class="row">
  <!--div class="input-field col s12 m6 l6">
    <input id="number" type="number" name="stud_age">
    <label for="email">Age</label>
  </div-->
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_nationality" value="{{count($errors)>0?old('stud_nationality'):$student->stud_nationality}}">
    <label for="email">Nationality</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
      <select name="stud_marital_status" >
        @foreach($maritalStatus as $maritalStat)
          @if(empty($maritalStat))
            <option value="" disabled selected>Choose marital status</option>
          @endif
          <option value="{{$maritalStat}}">{{$maritalStat}}</option>
        @endforeach
        
        
        <!-- <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Widowed">Widowed</option>
        <option value="Divorced">Divorced</option>
        <option value="Annuled">Annuled</option> -->
      </select>
      <label>Select Marital Status</label>
  </div>
  <div class="input-field col s12 m6 l6">
      <select name="stud_gender" >
        @foreach($genderList as $gen)
          @if(empty($gen))
            <option value="" disabled selected>Choose gender</option>
          @endif
          <option value="{{$gen}}">{{$gen}}</option>
        @endforeach
        <!-- <option value="" disabled selected>Choose gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option> -->
      </select>
      <label>Gender</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_occupation" value="{{count($errors)>0?old('stud_occupation'):$student->stud_occupation}}">
    <label for="email">Occupation</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_company" value="{{count($errors)>0?old('stud_company'):$student->stud_company}}">
    <label for="email">Company</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_company_tel_no" value="{{count($errors)>0?old('stud_company_tel_no'):$student->stud_company_tel_no}}">
    <label for="email">Company Tel No.</label>
  </div>
</div>
<h4 class="header2">In Case of Emergency, Contact:</h4>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_contact_name" value="{{count($errors)>0?old('stud_contact_name'):$student->stud_contact_name}}">
    <label for="email">Name</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_contact_mobile_no" value="{{count($errors)>0?old('stud_contact_mobile_no'):$student->stud_contact_mobile_no}}">
    <label for="email">Mobile No.</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="number" type="text" name="stud_contact_tel_no" value="{{count($errors)>0?old('stud_contact_tel_no'):$student->stud_contact_tel_no  }}">
    <label for="email">Tel No.</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12">
    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
      <i class="mdi-content-send right"></i>
    </button>
  </div>
</div>
