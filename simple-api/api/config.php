<?php

// change to your base api url
$base_url   =   '/simple-api/api/';

// change to reflect where your mainest is
$manifest = "https://raw.github.com/alex-perfilov-reisys/central/gh-pages/manifest.json";



error_reporting(E_ALL);
ini_set('display_errors', 1);




//don't change
define('API_ROOT_PATH', __DIR__.'/');
define('API_ROOT_URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_SCHEME).'://'.$_SERVER["HTTP_HOST"].$base_url);

