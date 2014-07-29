Antecons PHP
====================

PHP binding for the [Antecons API](https://api.antecons.net).

Requirements
------------

PHP 5

Installation and setup
----------------------

Download latest version:

    git clone https://github.com/antecons/antecons-php.git

Setup Antecons in your PHP script:

    require_once('/path/to/antecons-php/lib/antecons.php');
    Antecons\Client::$apiKey = 'abc';
    Antecons\Client::$apiSecret = 'def';

Usage example
-------------

Fetch all your datasources:
    
    $datasources = Antecons\Datasource::get();
    echo $datasources;

Fetch a specific datasource:

    $datasource = Antecons\Datasource::get('test');
    echo $datasource;

Demonstration
-------------

This library is used in the [Antecons demo webshop](https://demo.antecons.net).
