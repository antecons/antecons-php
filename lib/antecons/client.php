<?php

/**
 * Antecons client.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Antecons;

/**
 * Antecons client class
 */
class Client
{
    const BASE_URL = 'https://api.antecons.net';
    const API_VERSION = '0.1';

    const GET = 'GET';
    const POST = 'POST';

    public static $apiKey,
                  $apiSecret;


    private static function userAgent()
    {
        return 'PHP-Antecons/' . self::API_VERSION;
    }

    /**
     * Creates a request to Antecons.
     *
     * Automatically adds authentication and appropriate headers.
     *
     */
    public static function request($method, $url, $data = null)
    {
        if (!self::$apiKey || !self::$apiSecret) {
            throw new Exception('apiKey or apiSecret have not been set.');
        }

        // Create the full URI.
        $full_uri = self::BASE_URL . $url;

        // Initialize curl.
        $ch = curl_init($full_uri);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $headers = array(
            'Accept: application/json'
        );

        // Set the request method.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Return the data result instead of true/false
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Do not allow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

        // Check common name and verify that it matches.
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        // Set basic authentication
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ':' . self::$apiSecret);

        // Set the user agent.
        curl_setopt($ch, CURLOPT_USERAGENT, self::userAgent());

        // When POST'ing, set a few extra options.
        if ($method == self::POST && !is_null($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            array_push($headers, 'Content-Type: application/json',
                                 'Content-Length: ' . strlen($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $resp = curl_exec($ch);

        return $resp;
    }
}
