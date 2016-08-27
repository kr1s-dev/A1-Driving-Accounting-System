<div class="row">
  <div class="input-field col s12 m6 l6">
    <input disabled="disabled" id="name" type="text" value="{{sprintf("%'.07d\n", count($errors)>0?$itemNumber:$itemNumber)}}">
    <label for="first_name">Control No.</label>
  </div>
  <div class="input-field col s12 m6 l6">
    <input type="hidden" name = "account_title_id" value="{{$eAccountTitle->id}}">
    <input disabled="disabled" id="name" type="text" value="{{ count($errors) > 0?$eAccountTitle->account_title_name:$eAccountTitle->account_title_name }}">
    <label for="first_name">Account Title</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="text" name="item_name" value="{{ count($errors) > 0? old('item_name'):($item->item_name) }}">
    <label for="first_name">Item Name</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <input id="name" type="number" min="0" name="default_value" value="{{ count($errors) > 0? old('default_value'):($item->default_value) }}">
    <label for="first_name">Default Value</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12 m6 l6">
    <textarea class="materialize-textarea" name="remarks" id="desc" cols="30" rows="10">{{ count($errors) > 0? old('remarks'):($item->remarks) }}</textarea>
    <label for="first_name">Description</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
      <i class="mdi-content-send right"></i>
    </button>
  </div>
</div>
