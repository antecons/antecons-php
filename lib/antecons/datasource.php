<?php

/**
 * Antecons datasource.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Antecons;

/**
 * Antecons dataource.
 */
class Datasource extends Resource
{
    const URL = '/datasource';

    public static function get($id = null)
    {
        $url = self::URL;
        if (!is_null($id)) {
            $url = $url . '/' . $id;
        }
        $resp = Client::request(Client::GET, $url);
        return new static($resp);
    }
}
