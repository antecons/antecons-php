<?php

/**
 * Antecons PHP client.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

if (!function_exists('curl_init')) {
    throw new Exception('Antecons needs the curl PHP extension.');
}

if (!function_exists('json_decode')) {
    throw new Exception('Antecons needs the JSON PHP extension.');
}

// Antecons Client.
require_once(dirname(__FILE__) . '/antecons/client.php');

// API resources
require_once(dirname(__FILE__) . '/antecons/resource.php');
require_once(dirname(__FILE__) . '/antecons/datasource.php');
require_once(dirname(__FILE__) . '/antecons/transaction.php');
require_once(dirname(__FILE__) . '/antecons/suggestion.php');
