
<div class="row">
  <div class="input-field col s12 m6 l6">
    <select name="account_title_id">
      @if(empty($accountGroupList))
        <option value="" disabled>Select Type of Asset</option>
      @else
        @foreach($accountGroupList as $key=>$value)
          <option value="{{$key}}">{{$value}}</option>
        @endforeach
      @endif
    </select>
    <label for="first_name">Fixed Asset Group</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="desc" type="text" name="asset_name" value="{{count($errors)>0?old('asset_name'):$asset->asset_name}}">
    <label for="desc">Asset Name</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="desc" type="text" name="asset_desc" value="{{count($errors)>0?old('asset_desc'):$asset->asset_desc}}">
    <label for="desc">Description</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="vendor" type="text" name="asset_vendor" value="{{count($errors)>0?old('asset_vendor'):$asset->asset_vendor}}">
    <label for="vendor">Vendor</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="acquired" type="date" class="datepicker" name="asset_date_acquired" value="{{count($errors)>0?old('asset_date_acquired'):$asset->asset_date_acquired}}">
    <label for="acquired">Date Acquired</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="cost" type="number" step="0.01" min="1" name="asset_original_cost" value="{{count($errors)>0?old('asset_original_cost'):$asset->asset_original_cost}}">
    <label for="cost">Original Cost (₱)</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input id="cost" type="number" step="0.01" min="1" max="100" name="asset_salvage_percentage" value="{{count($errors)>0?old('asset_salvage_percentage'):$asset->asset_salvage_percentage}}">
    <label for="cost">Salvage Percent (%)</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="acquired" type="number" min="0" name="asset_lifespan" value="{{count($errors)>0?old('asset_lifespan'):$asset->asset_lifespan}}">
    <label for="acquired">Asset Lifespan (mos)</label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <select name="asset_mode_of_acq">
      <option value="" disabled> Select type of Acquisition </option>
      <option value="Cash"> Cash </option>
      <option value="Payable"> Payabale </option>
      <option value="Both"> Both </option>
    </select>
    <label for="acquired">Mode of Acquisition</label>
  </div>
  <div class="input-field col s12 m6 l6" style="display: none;" id="downPayment">
    <input id="acquired" type="number" min="0" name="asset_down_payment" value="{{count($errors)>0?old('asset_down_payment'):$asset->asset_down_payment}}">
    <label for="acquired" class="active" id="labelDownP">Downpayment</label>
  </div>
</div>

<!--div class="row">
  <div class="input-field col s12 m6 l6">
    <p>
    <input type="checkbox" id="depreciation">
    <label for="depreciation">Subject to Depreciation?</label>
    </p>
  </div>
  <div class="input-field col s12 m6 l6">
    <div class="percentage-wrapper" style="display: none;">
      <input id="percentage" type="number">
      <label for="percentage">Depreciation Percentage</label>
    </div>
  </div>
</div-->
<div class="row">
  <div class="input-field col s12">
    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">
      {{$submitButton}}
      <i class="mdi-content-send right"></i>
    </button>
  </div>
</div>