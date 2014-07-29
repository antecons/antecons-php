<?php

/**
 * Antecons suggestion.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Antecons;

/**
 * An enum like class that specifies the different possible values to suggest 
 * for.
 */
abstract class SuggestionFor
{
    const PRODUCT = 'product';
}

/**
 * Suggestion resource class
 */
class Suggestion extends Resource
{
    const URL = '/datasource/%s/suggestion';

    public static function get($datasource_id, $for, $forId, $limit = 3)
    {
        $url = sprintf(self::URL, $datasource_id);
        $params = array(
            'for' => $for,
            'for_id' => $forId,
            'limit' => $limit
        );
        $url .= '?' . http_build_query($params);
        $resp = Client::request(Client::GET, $url);
        return new static($resp);
    }
}
