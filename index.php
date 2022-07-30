<?php

if(array_key_exists('PSCR_LIB_ROOT', $_ENV))
  define('PSCR_LIB_ROOT', $_ENV['PSCR_LIB_ROOT']);
else
  define('PSCR_LIB_ROOT', './');
if(array_key_exists('PSCR_PROJECT_ROOT', $_ENV))
   define('PSCR_PROJECT_ROOT', $_ENV['PSCR_PROJECT_ROOT']);
else
  define('PSCR_PROJECT_ROOT', './');

require_once('vendor/autoload.php');

function http_request_handler() {
    $response = "";
    try {
        $response = \pscr\lib\router\router::_()
                  ->get_route($_SERVER['REQUEST_URI'])
                  ->get_renderer()
                  ->render_to_response();
    }
    catch(\pscr\lib\exceptions\route_not_found_exception $ex) {
        \pscr\lib\logging\logger::_()->error("page not found exception ", $ex);
        $response = \pscr\lib\router\router::_()
                  ->get_route('/404')
                  ->get_renderer()
                  ->render_to_response();
    }
    catch(\pscr\lib\exceptions\pscr_exception $ex) {
        \pscr\lib\logging\logger::_()->error("caught pscr exception ", $ex);
        $response = \pscr\lib\router\router::_()
                  ->get_route('/500')
                  ->get_renderer()
                  ->render_to_response();
    }
    catch(Exception $ex) {
        \pscr\lib\logging\logger::_()->error("caught general exception ", $ex);
        $response = \pscr\lib\router\router::_()
                  ->get_route('/500')
                  ->get_renderer()
                  ->render_to_response();
    }
    finally {
        if(is_object($response))
            $response->send_to_client();
    }
}

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
