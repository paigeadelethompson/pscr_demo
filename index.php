<?php

define('PSCR_LIB_ROOT', './');

define('PSCR_PROJECT_ROOT', './');


require_once('vendor/autoload.php');

\pscr\lib\logging\logger::_()->info("-----------------------------------------new request------------------------------------------", isset($_SERVER['REQUEST_URI']))
    ? $_SERVER['REQUEST_URI']
    : $_SERVER['argv'];

if (substr(php_sapi_name(), 0, 3) == 'cgi') {
    http_request_handler();
}
else if (php_sapi_name() == 'fpm-fcgi') {
    http_request_handler();
}
else if (php_sapi_name() == 'cli-server') {
    http_request_handler();
}
else if (php_sapi_name() == "cli") {
    (new pscr\lib\management\arguments())->execute($_SERVER['argv'][0],
        array_slice($_SERVER['argv'], 1));
}
else {
    \pscr\lib\logging\logger::_()->info("MAIN", "BUG: php_sapi_name unhandled or null");
}

\pscr\lib\logging\logger::_()->info("-----------------------------------------finished request------------------------------------------", isset($_SERVER['REQUEST_URI']))
    ? $_SERVER['REQUEST_URI']
    : $_SERVER['argv'];

