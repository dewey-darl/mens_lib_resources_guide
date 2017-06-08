@extends('layouts.app')

@section('content')
	@foreach($users as $user)
		<div class="row">
			<div class="col-xs-12 panel">
				<h3 class="col-xs-12">{{$user->username}}</h3>
				<div class="col-xs-8">
					<button data-toggle="collapse" data-target="#user-{{$user->id}}-resources" class="btn btn-info">
						Show/Hide Submitted Resources ({{$user->resources()->count()}})
					</button>
				</div>
				<div class="col-xs-4">
					{!! Form::open(['action' => ['UserController@destroy', $user], 'method' => 'delete']) !!}
						<button type="button" class="btn btn-danger delete-btn">Delete User</button>
						<div class="delete-decision">
							<div>Are you sure?</div>
							<button type="submit" class="btn btn-danger delete-confirm-btn">Yes</button>
							<button type="button" class="btn btn-default delete-cancel-btn">No</button>
						</div>
					{!! Form::close() !!}
				</div>
				<br/>
				<div id="user-{{$user->id}}-resources" class="collapse col-xs-12">
						@foreach($user->resources()->get() as $resource)
							@include('templates.resource', ['resource' => $resource])
						@endforeach
					</div>
				<div>&nbsp;</div>
			</div>
		</div>
	@endforeach
	<script>
		$(".delete-decision").hide();
		$(".delete-btn").click(function(){
			//Show confirm and cancel buttons
			$(this).parent().find(".delete-decision").fadeIn();
		});
		$(".delete-cancel-btn").click(function(){
			$(this).parent().fadeOut();
		});
	</script>
@endsection