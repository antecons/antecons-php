<?php

/**
 * Antecons base resource.
 *
 * @copyright   Copyright (c) 2014 Antecons
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Antecons;

/**
 * Base resource
 */
abstract class Resource implements \ArrayAccess, \Iterator
{
    private $position = 0;
    private $data = array();

    public function __construct($data = null) {
        if (!is_null($data)) {
            if (is_string($data)) {
                $data = json_decode($data, true);
            }
            $this->data = $data;
        }
    }

    /**
     * Make data properties available for direct reference,
     * i.e. $Resource->Property
     */
    public function &__get($name) {
        // (The ampersand '&' makes the get by reference instead of by value)
        
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * Make data properties available for direct reference,
     * i.e. $Resource->Property = 1
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    // --- Functions for implementing ArrayAccess
    //
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    // --- Functions for implementing Iterator
    //
    public function current() {
        return $this[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function valid() {
        return isset($this[$this->position]);
    }

    // --- Other functions.
    public function __toString() {
        return print_r($this->data);
    }

    protected function prepareData() {
        return json_encode($this->data);
    }

    protected function prepareDataArray() {
        // Wrap the data in an outer array.
        $data = array(
            $this->data
        );
        return json_encode($data);
    }
}
