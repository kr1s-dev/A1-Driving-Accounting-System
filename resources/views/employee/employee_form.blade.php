<div class="row">
	<div class="input-field col s12 m6 l6">
      <input id="name" type="text" name="employee_first_name" value="{{count($errors)>0?old('employee_first_name'):$employee->employee_first_name}}">
      <label for="account_title_name">Employee First Name</label>
   </div>
   <div class="input-field col s12 m6 l6">
      <input id="name" type="text" name="employee_middle_name" value="{{count($errors)>0?old('employee_middle_name'):$employee->employee_middle_name}}">
      <label for="account_title_name">Employee Middle Name</label>
   </div>
</div>
<div class="row">
	<div class="input-field col s12 m6 l6">
      <input id="name" type="text" name="employee_last_name" value="{{count($errors)>0?old('employee_last_name'):$employee->employee_last_name}}">
      <label for="account_title_name">Employee Last Name</label>
   </div>
   <div class="input-field col s12 m6 l6">
      <input id="name" type="text" name="employee_email" value="{{count($errors)>0?old('employee_email'):$employee->employee_email}}">
      <label for="account_title_name">Employee Email</label>
   </div>
</div>
<div class="row">
  
</div>
<div class="row">
	<div class="input-field col s12 m6 l6">
      <input id="name" type="text" name="employee_position" value="{{count($errors)>0?old('employee_position'):$employee->employee_position}}">
      <label for="account_title_name">Employee Position</label>
   </div>
   <div class="input-field col s12 m6 l6">
      <input id="name" type="number" min="0" max="99999999" name="employee_salary" value="{{count($errors)>0?old('employee_salary'):$employee->employee_salary}}">
      <label for="account_title_name">Employee Salary(monthly)</label>
   </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="added_source_of_salary_taxable" value="{{count($errors)>0?old('added_source_of_salary_taxable'):$employee->added_source_of_salary_taxable}}">
    <label for="account_title_name">Added Source of Salary (Taxable)</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="added_source_of_salary_non_taxable" value="{{count($errors)>0?old('added_source_of_salary_non_taxable'):$employee->added_source_of_salary_non_taxable}}">
    <label for="account_title_name">Added Source of Salary (Non-Taxable)</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="employee_sss_deduction" value="{{count($errors)>0?old('employee_sss_deduction'):$employee->employee_sss_deduction}}">
    <label for="account_title_name">SSS deductions</label>
   </div>
   <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="employee_philhealth_deduction" value="{{count($errors)>0?old('employee_philhealth_deduction'):$employee->employee_philhealth_deduction}}">
    <label for="account_title_name">Philhealth Deductions</label>
   </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="employee_pagibig_deduction" value="{{count($errors)>0?old('employee_pagibig_deduction'):$employee->employee_pagibig_deduction}}">
    <label for="account_title_name">PagIbig Deductions</label>
   </div>
   <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" max="99999999" name="other_deduction" value="{{count($errors)>0?old('other_deduction'):$employee->other_deduction}}">
    <label for="account_title_name">Other Deductions</label>
   </div>
</div>
<div class="row">
	<div class="input-field col s12 m6 l6">
      	<select name="tax_status">
           	@foreach($statusList as $stat)
              <option value="{{$stat}}" >{{$stat}}</option>
            @endforeach
        </select>
      <label for="account_title_name">Employee Status</label>
   </div>
</div>
<div class="row right-align">
 	<div class="col l12 m12 s12">
   		<button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
    		<i class="mdi-content-send right"></i>
    	</button>
 	</div>
</div>