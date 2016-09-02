@extends('master_layout.master_page_layout')
@section('content')
<div class="container">
  	<div class="section">
    	<div class="row">
        
      	<!--div class="input-field col s12 m6 l2">
         		<h5>Filter Date</h5>
      	</div-->
        {!! Form::open(['url'=>'admin-dashboard','method'=>'POST','class'=>'col s12']) !!}
        	<div class="input-field col s12 m6 l3 right">
           	<button class="btn red darken-2 waves-effect waves-light" type="submit" name="action" style="margin-left:10px;">
              	<i class="material-icons left">filter_list</i> Filter
          	</button>
          </div>
          <div id="customFilter" style="display:none;">
            <div class="input-field col s12 m6 l3 right">
                <input id="start-date" name="end_date" type="date" class="datepicker">
                <label for="start-date">End Date</label>
            </div>
            <div class="input-field col s12 m6 l3 right">
                <input id="end-date" name="start_date" type="date" class="datepicker">
                <label for="end-date">Start Date</label>
            </div>
          </div>
          <div class="input-field col s12 m6 l3 right">
            <select id="filterCat" name="category">
              @foreach($filterList as $filter)
                <option value="{{$filter}}">{{$filter}}</option>
              @endforeach
            </select>
          </div>
        {!! Form::close() !!}
        
    	</div>
      <canvas id="myChart" width="500" height="200"></canvas>
  	</div>
</div>
@endsection