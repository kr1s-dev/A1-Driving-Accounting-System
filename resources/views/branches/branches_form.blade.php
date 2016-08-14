<div class="row">
  <div class="input-field col s12 m6 l6">
    <input disabled="disabled" name="branchNumber" id="name" type="text" value="{{sprintf("%'.07d", count($errors)>0?$branchNumber:$branchNumber)}}">
    <label for="first_name">Branch No.</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="text" name="branch_name" value="{{count($errors)>0?old('branch_name'):$branch->branch_name}}">
    <label for="first_name">Branch Name</label>
    </div>
  </div>
<div class="row">
  <div class="input-field col s12 m12 l12">
    <input id="number" type="text" name="branch_address" value="{{count($errors)>0?old('branch_address'):$branch->branch_address}}">
    <label for="email">Address</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m12 l12">
    <input id="number" type="text" name="branch_tel_number" value="{{count($errors)>0?old('branch_tel_number'):$branch->branch_tel_number}}">
    <label for="email">Branch Telephone Number</label>
  </div>
</div>
<div class="row">
  <div class=" col s12 m12 l12">
    <p>
      @if($branch->main_office)
        <input type="checkbox" id="main-branch" name="main_office" checked>
      @else
        <input type="checkbox" id="main-branch" name="main_office">
      @endif
      <label for="main-branch">Is this branch the main office?</label>
    </p>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
    <i class="mdi-content-send right"></i>
    </button>
  </div>
</div>