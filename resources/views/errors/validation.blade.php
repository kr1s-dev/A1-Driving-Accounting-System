@if (count($errors) > 0)
	<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		@foreach ($errors->all() as $error)
            <p align="center">{{ $error }}</p>
        @endforeach
	</div>
@endif