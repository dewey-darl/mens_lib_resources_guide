<div class="row">
	<div class="col-xs-12 panel">
		<h3 class="col-xs-12">{{$user->username}}</h3>
		<div class="col-xs-12">User since {{ date('F jS, Y', strtotime($user->created_at)) }}</div>
		<hr class="col-xs-12"/>
		<div class="col-xs-12">
			<button data-toggle="collapse" data-target="#user-{{$user->id}}-resources" class="btn btn-info collapse-btn">
				<span class="text">
					Show Submitted Resources&nbsp;@include('templates.glyphicon', ['type' => 'chevron-right'])
				</span> 
				<span class="text" style="display:none;">
					Hide Submitted Resources&nbsp;@include('templates.glyphicon', ['type' => 'chevron-down'])
				</span> 
				({{$user->resources()->count()}})
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
			<button data-toggle="collapse" data-target="#user-{{$user->id}}-tags" class="btn btn-info collapse-btn">
				<span class="text">
					Show Submitted Tags&nbsp;@include('templates.glyphicon', ['type' => 'chevron-right'])
				</span> 
				<span class="text"  style="display:none;">
					Hide Submitted Tags&nbsp;@include('templates.glyphicon', ['type' => 'chevron-down'])
				</span> 
				({{$user->tags()->count()}})
			</button>
		</div>
		<script>
			$(".collapse-btn").click(function(){
				$(this).find('.text').toggle();
			});
		</script>
		<div>&nbsp;</div>
		<div id="user-{{$user->id}}-tags" class="collapse col-xs-12">
			<br/>
			@include('templates.tag_cloud', ['tags' => $user->tags()->get(), 'columns', 6])
		</div>
		<div>&nbsp;</div>
		<div class="col-xs-12">
			@include('templates.safe_delete_form', ['model' => $user, 'buttonText' => 'Delete Account'])
		</div>
		<br/>
	</div>
</div>