<?php

/**
 * Antecons transaction.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Antecons;

/**
 * An enum like class that specifies the different possible values for a 
 * transaction source.
 */
abstract class TransactionSource
{
    const ORDER = 'o';
    const PAGE_VIEW = 'pv';
}

/**
 * Transaction resource class.
 */
class Transaction extends Resource
{
    const URL = '/datasource/%s/transaction';

    private static function getUrl($datasource_id)
    {
        return sprintf(self::URL, $datasource_id);
    }

    public function save($datasource_id)
    {
        $url = self::getUrl($datasource_id);
        $data = $this->prepareDataArray();
        Client::request(Client::POST, $url, $data);
    }

    public static function get($datasource_id)
    {
        $url = self::getUrl($datasource_id);
        $resp = Client::request(Client::GET, $url);
        return new static($resp);
    }
}
