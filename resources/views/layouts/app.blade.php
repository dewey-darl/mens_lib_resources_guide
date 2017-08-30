<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico">

    <title>Mens Lib Resources Guide @yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/js/serializeObject.js"></script>    
    <script src="/js/js-cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    MensLib Resources Guide
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {!! link_to_action('ResourceController@index', 'Resources') !!}
                    </li>
                    <li>
                        {!! link_to_action('ResourceController@create', 'Add Resources') !!}
                    </li>
                    @if (Auth::user() && Auth::user()->isAdmin())
                        <li>
                            <?php
                                $unpublishedLinkText = 'Unpublished Resources';
                                $count = \App\Resource::unpublished()->count();
                                if ($count > 0){
                                    $unpublishedLinkText .= "&nbsp;<span class='red notice'>$count</span>";
                                }
                            ?>
                            <a href="<?= action('ResourceController@getUnpublished');?>">
                                <?= $unpublishedLinkText; ?>
                            </a>
                        </li>
                        <li>
                            {!! link_to_action('TagController@index', 'Tags') !!}
                        </li>
                        <li>
                            {!! link_to_action('UserController@index', 'Users') !!}
                        </li>
                    @endif
                    <li>
                        <a href="/resources/about">About</a>
                    </li>
                    @if (Auth::user())    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    {!! link_to_action('UserController@show', 'My Account', [Auth::user()]) !!}
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="col-xs-12 col-md-10 col-md-offset-1" id="main">
            @include('common.flash_messages')
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        MensLib Resources for Men Guide&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="https://reddit.com/r/menslib" target="_blank">Subreddit</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="https://www.reddit.com/message/compose/?to=dewey_darl" target="_blank">Contact Creator</a>
    </footer>
</body>