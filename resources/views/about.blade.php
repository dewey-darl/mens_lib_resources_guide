
@extends('layouts.app')

@section('content')

<div class="col-xs-12 col-md-10 col-md-offset-1">
	<h1>Welcome to the MensLib resources for men guide!</h1>
	Here you'll find a collection of resources geared towards men in a variety of situatoins and with a variate of backgrounds.
	<br/><br/>
	{!! link_to_action('ResourceController@create', 'Click here') !!} to add resources to the database.
	<h3>Searching for Resources</h3>
	<p>
	This resources guide uses a tag-based search system. On the home page, click the button that says "Search for Resources".
	You'll see a search box appear, along with a group of tags beneath it. Click tags to add or remove them from the search box.
	</p>
	<p>
	Bellow the group of tags, you'll see two buttons. One says "Get Resources With Any of These Tags". The other says 
	"Get Resources With All of These Tags". Clicking the first one will show you resources that match any one of the tags in the search bar. Clicking the second will show you resources that have all of the tags in the search bar.
	</p>
	<p>
	You'll also see a text box for text-based searching.
	</p>
	<h3>Questions and Comments</h3>
	Feel free to get in touch with the creator of the site <a href="https://www.reddit.com/message/compose/?to=dewey_darl" target="_blank">here</a>.
	You can also check out the code for the site on <a href="https://github.com/dewey-darl/mens_lib_resources_guide">github</a>.
</div>

@endsection