<!DOCTYPE HTML>
<html>

<head>
    <title>@yield('title', 'simplestyle_blue_trees')</title>
    
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}" />
</head>

<body>
    <div id="main">
        <div id="header">
            <div id="logo">
                <div id="logo_text">
                    <h1><a href="{{ url('/') }}">simple<span class="logo_colour">style_blue_trees</span></a></h1>
                    <h2>Simple. Contemporary. Website Template.</h2>
                </div>
            </div>
            <div id="menubar">
                <ul id="menu">
                    <li class="{{ Request::is('/') ? 'selected' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li class="{{ Request::is('examples') ? 'selected' : '' }}"><a href="{{ url('/examples') }}">Examples</a></li>
                    <li class="{{ Request::is('page') ? 'selected' : '' }}"><a href="{{ url('/page') }}">A Page</a></li>
                    <li class="{{ Request::is('another-page') ? 'selected' : '' }}"><a href="{{ url('/another-page') }}">Another Page</a></li>
                    <li class="{{ Request::is('contact') ? 'selected' : '' }}"><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
        
        <div id="content_header"></div>
        
        <div id="site_content">
            <div id="banner">
                {{-- <img src="{{ asset('images/banner-image.jpg') }}" alt=""> --}}
            </div>
            
            <div id="sidebar_container">
                @section('sidebar')
                <div class="sidebar">
                    <div class="sidebar_top"></div>
                    <div class="sidebar_item">
                        <h3>Latest News</h3>
                        <h4>New Website Launched</h4>
                        <h5>February 1st, 2014</h5>
                        <p>2014 sees the redesign of our website. Take a look around and let us know what you think.<br /><a href="#">Read more</a></p>
                    </div>
                    <div class="sidebar_base"></div>
                </div>
                <div class="sidebar">
                    <div class="sidebar_top"></div>
                    <div class="sidebar_item">
                        <h3>Useful Links</h3>
                        <ul>
                            <li><a href="#">link 1</a></li>
                            <li><a href="#">link 2</a></li>
                            <li><a href="#">link 3</a></li>
                            <li><a href="#">link 4</a></li>
                        </ul>
                    </div>
                    <div class="sidebar_base"></div>
                </div>
                <div class="sidebar">
                    <div class="sidebar_top"></div>
                    <div class="sidebar_item">
                        <h3>Search</h3>
                        <form method="post" action="#" id="search_form">
                            <p>
                                <input class="search" type="text" name="search_field" value="Enter keywords....." />
                                <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="{{ asset('style/search.png') }}" alt="Search" title="Search" />
                            </p>
                        </form>
                    </div>
                    <div class="sidebar_base"></div>
                </div>
                @show
            </div>
            
            <div id="content">
                @yield('content')
            </div>
        </div>
        
        <div id="content_footer"></div>
        
        <div id="footer">
            <p>
                <a href="{{ url('/') }}">Home</a> | 
                <a href="{{ url('/examples') }}">Examples</a> | 
                <a href="{{ url('/page') }}">A Page</a> | 
                <a href="{{ url('/another-page') }}">Another Page</a> | 
                <a href="{{ url('/contact') }}">Contact Us</a>
            </p>
            <p>Copyright &copy; simplestyle_blue_trees | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.html5webtemplates.co.uk">design from HTML5webtemplates.co.uk</a></p>
        </div>
    </div>
</body>
</html>