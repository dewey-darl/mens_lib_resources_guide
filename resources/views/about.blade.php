
@extends('layouts.app')

@section('content')

<div class="col-xs-12 col-md-10 col-md-offset-1">
	<h1>Welcome to the Men's Lib resources guide!</h1>
	Here you'll find a vast array of resources geared towards men in a variety of situatoins with a variate of backgrounds.
	<br/><br/>
	@if (!Auth::user())
		If you'd like to help the cause and add some resources of your own, 
		<a href="/register">sign up</a> or <a href="/login">log in</a>.
	@else
		<a href="/resources/create">Click here</a> to add resources to the database.
	@endif
	<h3>Searching for Resources</h3>
	<p>
	This resources guide uses a tag-based search system. On the home page, click the button that says "Search for Resources".
	You'll see a search box appear, along with a group of tags beneath it. Click tags to add or remove them from the search box.
	</p>
	<p>
	Bellow the group of tags, you'll see two buttons. One says "Get Resources With Any of These Tags". The other says 
	"Get Resources With All of These Tags". Clicking the first one will show you resources that match any one of the tags in the search bar. Clicking the second will show you resources that have all of the tags in the search bar.
	</p>
</div>

@endsection