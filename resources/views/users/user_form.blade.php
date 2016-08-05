<div class="row">
  <div class="input-field col s12">
    <select name="branch_id">
      @if($isCreate)
        <option value="" disabled selected>Choose User Branch</option>
      @endif
      
      @if(count($branchList)>0)
        @foreach($branchList as $key => $value)
          <option value="{{$key}}">{{$value}}</option>
        @endforeach
      @endif
    </select>
    <label>Select User Branch</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="name" type="text" name="first_name" value="{{count($errors)>0?old('first_name'):$user->first_name}}">
    <label for="first_name">First Name</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="name" type="text" name="last_name" value="{{count($errors)>0?old('last_name'):$user->last_name}}">
    <label for="first_name">Last Name</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="name" type="text" name="address" value="{{count($errors)>0?old('address'):$user->address}}">
    <label for="first_name">Address</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="number" type="text" name="telephone_number" value="{{count($errors)>0?old('telephone_number'):$user->telephone_number}}">
    <label for="email">Tel No.</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="number" type="text" name="mobile_number" value="{{count($errors)>0?old('mobile_number'):$user->mobile_number}}">
    <label for="email">Mobile No.</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <input id="number" type="email" name="email" value="{{count($errors)>0?old('email'):$user->email}}">
    <label for="email">Email</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <select name="user_type_id">
      @if($isCreate)
        <option value="" disabled selected>Choose user type</option>
      @endif
      @if(count($userTypesList)>0)
        @foreach($userTypesList as $key => $value)
          <option value="{{$key}}">{{$value}}</option>
        @endforeach
      @endif
    </select>
    <label>Select User Type</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
      <i class="mdi-content-send right"></i>
    </button>
  </div>
</div>
<br>
<div class="row">
  <div class="divider"></div>
</div>
@if($isCreate)
  <div class="row center-align">
    <h6>A verification email will be sent to the given email.</h6>
  </div>
@endif
