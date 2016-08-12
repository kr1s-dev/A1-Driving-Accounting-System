
<div class="row">
   <div class="input-field col s12 m12 l12">
      <select name="account_group_id">
         <option value="" disabled selected>Parent Group</option>
         @foreach($accountGroupsList as $key=>$value)
            <option value="{{$key}}">{{$value}}</option>
         @endforeach
      </select>
      <label>Account Group</label>
   </div>
</div>
<div class="row">
	<div class="input-field col s12 m12 l12">
      <input id="name" type="text" name="account_title_name" value="{{count($errors)>0?old('account_title_name'):$accountTitle->account_title_name}}">
      <label for="account_title_name">Account Title</label>
   </div>
</div>
<div class="row">
   <div class="input-field col s12 m12 l12">
      <input id="opening_balance" type="number" step="0.01" min="0" name="opening_balance" value="{{count($errors)>0?old('opening_balance'):$accountTitle->opening_balance}}">
      <label for="opening_balance">Opening Balance</label>
   </div>
   <div class="input-field col s12 m12 l12">
      <textarea class="materialize-textarea" name="description" id="desc" cols="30" rows="10">{{count($errors)>0?old('description'):$accountTitle->description}}</textarea>
      <label for="desc">Description</label>
   </div>
</div>
<div class="row right-align">
 <div class="col l12 m12 s12">
   <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{$submitButton}}
    <i class="mdi-content-send right"></i>
    </button>
 </div>
</div>
                                 