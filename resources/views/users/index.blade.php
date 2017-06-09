@extends('layouts.app')

@section('content')
	@foreach($users as $user)
		<div class="row">
			<div class="col-xs-12 panel">
				<h3 class="col-xs-12">{{$user->username}}</h3>
				<div class="col-xs-12">User since {{ date('F jS, Y', strtotime($user->created_at)) }}</div>
				<hr class="col-xs-12"/>
				<div class="col-xs-12">
					<button data-toggle="collapse" data-target="#user-{{$user->id}}-resources" class="btn btn-info">
						Show/Hide Submitted Resources ({{$user->resources()->count()}})
					</button>
				</div>
				<div id="user-{{$user->id}}-resources" class="collapse col-xs-12">
					<br/>
					@foreach($user->resources()->get() as $resource)
						@include('templates.resource', ['resource' => $resource])
					@endforeach
				</div>
				<div>&nbsp;</div>
				<div class="col-xs-12">
					<button data-toggle="collapse" data-target="#user-{{$user->id}}-tags" class="btn btn-info">
						Show/Hide Submitted Tags ({{$user->tags()->count()}})
					</button>
				</div>
				<div>&nbsp;</div>
				<div id="user-{{$user->id}}-tags" class="collapse col-xs-12">
					<br/>
					@include('templates.tag_cloud', ['tags' => $user->tags()->get()])
				</div>
				<div>&nbsp;</div>
				<div class="col-xs-12">
					@include('templates.safe_delete_form', ['model' => $user])
				</div>
				<br/>
			</div>
		</div>
	@endforeach
@endsection