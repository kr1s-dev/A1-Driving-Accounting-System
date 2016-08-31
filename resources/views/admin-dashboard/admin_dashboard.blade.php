@extends('master_layout.master_page_layout')
@section('content')
<div class="container">
  	<div class="section">
    	<div class="row">
        	<div class="input-field col s12 m6 l2">
           		<h5>Filter Date</h5>
        	</div>
        	<div class="input-field col s12 m6 l3">
            	<input id="start-date" type="date" class="datepicker">
            	<label for="start-date">Start Date</label>
        	</div>
        	<div class="input-field col s12 m6 l3">
            	<input id="end-date" type="date" class="datepicker">
            	<label for="end-date">End Date</label>
        	</div>
        	<div class="input-field col s12 m6 l3">
             	<button class="btn red darken-2 waves-effect waves-light" type="submit" name="action" style="margin-left:10px;">
                	<i class="material-icons left">filter_list</i> Filter
            	</button>
        	</div>
    	</div>
      	<canvas id="myChart" width="500" height="200"></canvas>
  	</div>
</div>
@endsection