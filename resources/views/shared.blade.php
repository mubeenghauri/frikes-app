<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>themelock.com - Chain Responsive Bootstrap3 Admin</title>

        <link href="css/style.default.css" rel="stylesheet">

        @yield('css-links')
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    @yield('css')

    <style type="text/css">
        .logo{
            color: white;
            font-size: 25px;
            font: bolder;
        }
    </style>

    <body>

       <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="index.html" class="logo">
                        
                        FRIKES
                    </a>
                    <div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
            </div><!-- headerwrapper -->
        </header>

        <section>
            <div class="mainwrapper">
                <div class="leftpanel">
                    
                    
                    <h5 class="leftpanel-title">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ url('/item') }}"><span class="pull-right badge"></span><i class="fa fa-envelope-o"></i> <span>Items</span></a></li>
                        <li ><a href="{{ url('/products') }}"><i class="fa fa-suitcase"></i> <span>Products</span></a></li>
                        <li ><a href=""><i class="fa fa-edit"></i> <span>Closing (coming soon) </span></a>
                            {{-- <ul class="children">
                                <li><a href="code-editor.html">Code Editor</a></li>
                                <li><a href="general-forms.html">General Forms</a></li>
                                <li><a href="form-layouts.html">Layouts</a></li>
                                <li><a href="wysiwyg.html">Text Editor</a></li>
                                <li><a href="form-validation.html">Validation</a></li>
                                <li><a href="form-wizards.html">Wizards</a></li>
                            </ul> --}}
                        </li>
                        <li ><a href="{{ url('/pos') }}"><i class="fa fa-bars"></i> <span>POS - NEW - DEMO</span></a>
                            {{-- <ul class="children">
                                <li><a href="basic-tables.html">Basic Tables</a></li>
                                <li><a href="data-tables.html">Data Tables</a></li>
                            </ul> --}}
                        </li>
                        <li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Maps</span></a></li>
                        <li class="parent"><a href=""><i class="fa fa-file-text"></i> <span>Pages</span></a>
                            <ul class="children">
                                <li><a href="notfound.html">404 Page</a></li>
                                <li><a href="blank.html">Blank Page</a></li>
                                <li><a href="calendar.html">Calendar</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="locked.html">Locked Screen</a></li>
                                <li><a href="media-manager.html">Media Manager</a></li>
                                <li><a href="people-directory.html">People Directory</a></li>
                                <li><a href="profile.html">Profile</a></li>                                
                                <li><a href="search-results.html">Search Results</a></li>
                                <li><a href="signin.html">Sign In</a></li>
                                <li><a href="signup.html">Sign Up</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                </div><!-- leftpanel -->
        
                @yield('pageContent')
            </div><!-- mainwrapper -->
        </section>
        
       
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        <script src="js/custom.js"></script>
        
        @yield('js')



    </body>
</html>
