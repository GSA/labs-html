<?php
header("X-FRAME-OPTIONS: DENY");
if (isset($_SERVER["SERVER_NAME"])) {
    if (!isset($_GET['noredirect'])) {
        switch (true) {
            case (bool)strpos($_SERVER["SERVER_NAME"],'ata-labs-dev'):
                header('Location: http://dev-datagov.reisys.com/labs', true, 301);
                exit;
            case (bool)strpos($_SERVER["SERVER_NAME"],'-staging.data'):
                header('Location: https://staging.data.gov/labs', true, 301);
                exit;
            case (bool)strpos($_SERVER["SERVER_NAME"],'cal.labs.data'):
                header('Location: http://local.data.gov/labs', true, 301);
                exit;
            default:
                header('Location: https://www.data.gov/labs', true, 301);
                exit;
        }
    }
} else {
    header('Location: https://www.data.gov/labs', true, 301);
    exit;
}
?><!DOCTYPE html>
<html style=""
      class=" js no-flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths js no-flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"
      lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Labs.Data.Gov</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="index_files/q-a-plus.css" media="screen">
    <link rel="stylesheet" href="index_files/css.css">
    <link rel="stylesheet" href="index_files/main.css">
    <link rel="stylesheet" href="index_files/rei.css">
    <script type="text/javascript" src="index_files/flowplayer-3.js"></script>
    <script type="text/javascript" src="index_files/jquery_002.js"></script>
    <script>window.jQuery || document.write('<script src="//data.gov/wp-content/themes/roots-nextdatagov/assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script type="text/javascript" src="index_files/smartpaginator.js"></script>
    <script type="text/javascript" src="index_files/jquery-tablesorter-min.js"></script>
    <script type="text/javascript" src="index_files/jsapi.txt"></script>
    <script type="text/javascript" src="index_files/modernizr-2.js"></script>
    <!-- Q & A -->
    <noscript>
        <link rel="stylesheet" type="text/css"
              href="//data.gov/wp-content/plugins/q-and-a/css/q-a-plus-noscript.css?ver=1.0.6.2"/>
    </noscript>
    <!-- Q & A -->
    <link rel="canonical" href="//data.gov/">
    <link rel="alternate" type="application/rss+xml" title="Data.Gov 2.0 Feed" href="//data.gov/feed/">
    <link href="index_files/favicon.ico" rel="shortcut icon">
    <link rel="icon" type="image/png" href="favicon-120.png" sizes="120x120">
</head>
<body class="home page">
<!-- <div class="banner disclaimer">
    <p></p><center>This is a demonstration site exploring the future of Data.gov. <span id="stop-disclaimer"> Give us your feedback on <a href="//twitter.com/usdatagov">Twitter</a>, <a href="//quora.com/">Quora</a></span>, <a href="//github.com/GSA/datagov-design/">Github</a>, or <a href="//data.gov/contact-us">contact us</a></center><p></p>
</div> -->
<!--[if lt IE 8]>
<div class="alert alert-warning">
    You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to
    improve your experience.
</div>
<![endif]-->
<header>
    <div class="banner navbar navbar-default navbar-static-top" role="banner">
        <div class="container">
            <div class="searchbox-row skip-navigation">
                <div class="skip-link">
                    <a href="#content" title="">Jump to Content</a>
                </div>
                <div>
                    <form class="search-form form-inline navbar-right navbar-nav  col-sm-6 col-md-6 col-lg-6"
                          method="get" role="search" action="//catalog.data.gov/dataset">
                        <div class="input-group">
                            <label for="search-header" class="hide">Search for:</label>
                            <input type="search" placeholder="Search Data.Gov" class="search-field form-control"
                                   name="q" value="Search Data.Gov" id="search-header"
                                   onblur="if(value=='') value = 'Search Data.Gov'"
                                   onfocus="if(value=='Search Data.Gov') value = ''">
                <span class="input-group-btn">
                <button type="submit" class="search-submit btn btn-default">
                    <img alt="search" src="index_files/search-icon.png" height="15px" width="15px">
                    <span class="sr-only">Search</span>
                </button>
                </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="//www.data.gov">Data.Gov 2.0</a>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
                <ul id="menu-primary-navigation" class="nav navbar-nav navbar-right">
                </ul>
            </nav>
        </div>
    </div>
    <div class="header banner page-heading">
        <div class="container">
            <div class="page-header">
                <h1>
                    LABS.DATA.GOV </h1>
            </div>
        </div>
    </div>
</header>
<div role="document">
    <div class="content">
        <main class="main" role="main">
            <div class="wrap container">
                <div class="gutter inner clearfix">
                    <div class="content clearfix">
                        <!-- static content begin -->
                        <p style="margin-left:0px;">Welcome
                            to Labs.Data.gov, a repository of shared services to prototype and
                            provide developer resources to government agencies. Each tool uses web
                            services and lightweight, open source code to provide powerful
                            functionality. Agencies are encouraged to improve any project and
                            submit pull requests in order to share the improvements with others.</p>
                        <!-------------------------------Catalog Generator----------------------------------->
                        <h2 style="font-size:25px;">Catalog Generator<a name="generator"></a></h2>

                        <p>Generate an agency's data.json file.</p>
                        <ul>
                            <li><a href="//github.com/project-open-data/catalog-generator">Source Code and
                                    Documentation</a></li>
                            <li><a href="//project-open-data.github.com/catalog-generator/">Hosted Tool</a></li>
                        </ul>
                        <!-----------------------------Catalog Validator------------------------------------->
                        <h2 style="font-size:25px;">Catalog Validator<a name="validator"></a></h2>

                        <p>Validate the agency's data.json file.</p>
                        <ul>
                            <li><a href="//github.com/project-open-data/json-validator">Source Code and
                                    Documentation</a></li>
                            <li><a href="//project-open-data.github.com/json-validator/">Hosted Tool</a></li>
                        </ul>
                        <!-------------------------------CSV-to-API----------------------------------->
                        <h2 style="font-size:25px;">CSV-to-API<a name="csv-to-api"></a></h2>

                        <p>Dynamically generate RESTful APIs from static CSVs. Provides JSON, XML, and HTML.</p>
                        <ul>
                            <li><a href="//github.com/project-open-data/csv-to-api">Source Code and Documentation</a>
                            </li>
                            <li><a href="/csv-to-api/">Hosted Tool</a></li>
                        </ul>
                        <!--------------------------------DataBeam---------------------------------->
                        <h2 style="font-size:25px;">DataBeam<a name="data-beam"></a></h2>

                        <p>
                            Dynamically generate RESTful APIs from the contents of database tables or CSV files.
                            Provides JSON, XML, CSV, and HTML output and autogenerated documentation. Supports most
                            popular databases.
                        </p>
                        <ul>
                            <li><a href="//github.com/GSA-OCSIT/DataBeam">Source Code and Documentation</a></li>
                            <li><a href="//www.databeam.org/">Remote Hosted Tool</a></li>
                            <li><a href="/databeam/">Hosted Tool</a></li>
                        </ul>
                        <!------------------------------DB-to-API------------------------------------>
                        <h2 style="font-size:25px;">DB-to-API<a name="db-to-api"></a></h2>

                        <p>Turns a Database into a Secure, RESTful API.</p>
                        <ul>
                            <li><a href="//github.com/project-open-data/db-to-api">Source Code and Documentation</a>
                            </li>
                            <li><a href="/db-to-api/readme.md">Hosted Tool</a></li>
                        </ul>
                        <!--------------------------------PDF-Filler---------------------------------->
                        <h2 style="font-size:25px;">PDF-Filler<a name="pdf-filler"></a></h2>

                        <p>PDF Filler is a RESTful service
                            (API) to aid in the completion of existing PDF-based forms and empowers
                            web developers to use browser-based forms and modern web standards to
                            facilitate the collection of information.</p>
                        <ul>
                            <li><a href="//github.com/project-open-data/pdf-filler">Source Code and Documentation</a>
                            </li>
                            <li><a href="/pdf-filler/">Hosted Tool</a></li>
                        </ul>
                        <!-------------------------------Simple API----------------------------------->
                        <h2 style="font-size:25px;">Simple API<a name="simple-api"></a></h2>

                        <p>
                            Simple API is about empowering a controlled group with the ability to deploy simple APIs,
                            without deploying any infrastructure. Users can select from a pre-defined set of API
                            designs.
                            Each API design lives as a Github repository and uses a JSON file as a data store. The API
                            design is generated using Swagger. Each repository contains a JSON data store, Swagger API
                            definition and a home page to view and interact with API through its documentation.
                        </p>
                        <ul>
                            <li><a href="//github.com/simple-api">Source Code and Documentation</a></li>
                            <li><a href="//simple-api.github.io/api-offices/">Remote Hosted Tool</a></li>
                        </ul>
                    </div>
                    <!-- /main-wrapper -->
                </div>
                <!--/.container-->      </div>
        </main>
        <!-- /.main -->
    </div>
    <!-- /.content -->
</div>
<!-- /.wrap -->
<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">
            <!--
            <div class="col-lg-4">
                    <p>&copy; 2013 Data.Gov 2.0</p>
    </div>
    -->
            <div class="col-md-4 col-lg-4">
                <form action="//catalog.data.gov/dataset" class="search-form form-inline" method="get" role="search">
                    <div class="input-group">
                        <label for="search-header" class="hide">Search for:</label>
                        <input type="search" placeholder="Search Data.Gov" class="search-field form-control" name="q"
                               value="Search Data.Gov" id="search-header"
                               onblur="if(value=='') value = 'Search Data.Gov'"
                               onfocus="if(value=='Search Data.Gov') value = ''">
      <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default">
          <img alt="search" src="index_files/search-icon.png" height="15px" width="15px">
          <span class="sr-only">Search</span>
      </button>
    </span>
                    </div>
                </form>
                <div class="footer-logo">
                    <a class="logo-brand" href="//data.gov/">Data.Gov 2.0</a>
                </div>
            </div>
            <nav class="col-md-2 col-lg-2" role="navigation">
                <ul id="menu-primary-navigation-1" class="nav">
                </ul>
            </nav>
            <nav class="col-md-2 col-lg-2" role="navigation">
                <ul class="nav" id="menu-footer">
                </ul>
            </nav>
            <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 social-nav">
                <nav role="navigation">
                    <ul id="menu-social_navigation" class="nav">
                        <li><a href="//twitter.com/usdatagov"><!-- <i class="fa fa-twitter"></i> --><img
                                    src="index_files/twitter.png"><span>Twitter</span></a></li>
                        <li><a href="//github.com/GSA/data.gov/"><img
                                    src="index_files/github.png"><span>Github</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="index_files/q-a-plus.js"></script>
</body>
<script type="text/javascript">
    (function ($) {
        var url = '//www.data.gov/wp-content/plugins/datagov-custom/wp_download_links.php?callback=?';
        $.ajax({
            type: 'GET',
            url: url,
            async: false,
            jsonpCallback: 'jsonCallback',
            contentType: "application/json",
            dataType: 'jsonp',
            success: function (json) {
                var menus = [];
                var topmenus = [];
                var topsecondarys = [];
                var bottommenus = [];
                $.each(json.Footer, function (i, menu) {
                    menus.push('<li><a href="' + menu.link + '">' + menu.name + '</a></li>');
                    if (menu.name == 'Log In') {
                        menus.push('<li style="display:none;"><a href="' + menu.link + '">' + menu.link + '">' + menu.name + '</a></li>');
                    }
                });
                $.each(json.Primary, function (i, topmenu) {
                    if (!topmenu.parent_id) {
                        if (topmenu.name == 'Topics') {
                            topmenus.push('<li class="dropdown yamm-fw menu-topics"><a data-toggle="dropdown" class="dropdown-toggle">Topics<b class="caret"></b></a><ul class="dropdown-menu topics"></ul></li>');
                        }
                        else if (topmenu.name == 'Data') {
                            topmenus.push('<li class=""><a href="//catalog.data.gov/dataset">' + topmenu.name + '</a></li>');
                        }
                        else {
                            topmenus.push('<li><a href="' + topmenu.link + '">' + topmenu.name + '</a></li>');
                        }
                    }
                });
                $.each(json.Primary, function (i, topsecondary) {
                    if (topsecondary.parent_id) {
                        var Menuclass = topsecondary.name;
                        Menuclass = Menuclass.toLowerCase();
                        topsecondarys.push('<li class="menu-' + Menuclass + '"><a href="' + topsecondary.link + '"><i></i><span>' + topsecondary.name + '</span></a></li>');
                    }
                });
                $.each(json.Primary, function (i, bottommenu) {
                    if (!bottommenu.parent_id) {
                        if (bottommenu.name == 'Topics') {
                            bottommenus.push('<li class="dropdown menu-topics"><a data-toggle="dropdown" class="dropdown-toggle">Topics<b class="caret"></b></a><ul class="dropdown-menu"></ul></li>');
                        }
                        else if (bottommenu.name == 'Data') {
                            bottommenus.push('<li class=""><a href="//catalog.data.gov/dataset">' + bottommenu.name + '</a></li>');
                        }
                        else {
                            bottommenus.push('<li><a href="' + bottommenu.link + '">' + bottommenu.name + '</a></li>');
                        }
                    }
                });
                $('#menu-primary-navigation').append(topmenus.join(''));
                $('#menu-primary-navigation .dropdown-menu').append(topsecondarys.join(''));
                $('#menu-primary-navigation-1').append(bottommenus.join(''));
                $('#menu-footer').prepend(menus.join(''));
                $('#menu-primary-navigation-1 .dropdown-menu').append(topsecondarys.join(''));
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    })(jQuery);
    // fix for dynamic menu to check current domain and assign menu
    jQuery(window).load(function () {
        if (window.location.hostname === 'labs.data.gov') {
            var linkRewriter = function (a, b) {
                $('a[href*="' + a + '"]').each(function () {
                    $(this).attr('href', $(this).attr('href').replace(a, b));
                });
            }
            linkRewriter("next.data.gov", "data.gov");
        }
    });
    jQuery(function ($) {
        jQuery(window).load(function () {
            /* $("#menu-primary-navigation .dropdown").click(function () {
             $("#menu-primary-navigation .dropdown-menu").toggle();
             });
             $("#menu-primary-navigation-1 .dropdown").click(function () {
             $("#menu-primary-navigation-1 .dropdown-menu").toggle();
             });*/
            jQuery("#menu-primary-navigation .dropdown-toggle").click(function () {
                var X = jQuery("#menu-primary-navigation .dropdown-toggle").attr('id');
                $("#menu-primary-navigation .dropdown-toggle").css("border-bottom", "5px solid #DDE5ED");
                if (X == 1) {
                    jQuery("#menu-primary-navigation .dropdown-menu").hide();
                    jQuery("#menu-primary-navigation .dropdown-toggle").attr('id', '0');
                }
                else {
                    jQuery("#menu-primary-navigation .dropdown-menu").show();
                    jQuery("#menu-primary-navigation .dropdown-toggle").attr('id', '1');
                }
            });
//Mouse click on sub menu
            jQuery("#menu-primary-navigation .dropdown-menu").click(function () {
                return false
            });
//Mouse click on my account link
            jQuery("#menu-primary-navigation .dropdown-toggle").mouseup(function () {
                return false
            });
//Document Click
            jQuery(document).mouseup(function () {
                jQuery("#menu-primary-navigation .dropdown-menu").hide();
                jQuery("#menu-primary-navigation .dropdown-toggle").css("border-bottom", "0");
                jQuery("#menu-primary-navigation .dropdown-toggle").attr('id', '');
            });
            jQuery("#menu-primary-navigation-1 .dropdown-toggle").click(function () {
                var X = jQuery("#menu-primary-navigation-1 .dropdown-toggle").attr('id');
                if (X == 1) {
                    jQuery("#menu-primary-navigation-1 .dropdown-menu").hide();
                    jQuery("#menu-primary-navigation-1 .dropdown-toggle").attr('id', '0');
                }
                else {
                    jQuery("#menu-primary-navigation-1 .dropdown-menu").show();
                    jQuery("#menu-primary-navigation-1 .dropdown-toggle").attr('id', '1');
                }
            });
//Mouse click on sub menu
            jQuery("#menu-primary-navigation-1 .dropdown-menu").click(function () {
                return false
            });
//Mouse click on my account link
            jQuery("#menu-primary-navigation-1 .dropdown-toggle").mouseup(function () {
                return false
            });
//Document Click
            jQuery(document).mouseup(function () {
                jQuery("#menu-primary-navigation-1 .dropdown-menu").hide();
                jQuery("#menu-primary-navigation-1 .dropdown-toggle").attr('id', '');
            });
        });
    });
</script>
</html>
