<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class Parameters
{
    var $internalMap = array();
    /**
     * Adds the value with the specified key.
     *
     * @param key Key.
     * @param value Value.
     */
    function add($key, $value)
    {
        $this->internalMap[$key] = $value;
    }

    /**
     * Removes the value with the specified key.
     *
     * @param key Key.
     */
    function remove($key)
    {
        unset($this->internalMap[$key]);
    }

    /**
     * The number of items held.
     *
     * @return size of the data structure.
     */
    function count()
    {
        return count($this->internalMap);
    }

    /**
     * Determines whether the {@link Parameters} contains any items.
     *
     * @return true if empty.
     */
    function isEmpty()
    {
        return (count($this->internalMap) == 0);
    }

    /**
     * Determines whether the {@link Parameters} contains the specified key.
     *
     * @param key Key value
     * @return true if the key is held within the data structure.
     */
    function containsKey($key) {
        return isset($this->internalMap[$key]);
    }

    /**
     * . Gets the value associated with the specified key.{@link ParameterKeys} for possible key values.
     *
     * @param key value
     * @return string of the value if contained within {@link Parameters}, else null.
     */
    function getValue($key) {
        return $this->containsKey($key) ? $this->internalMap[$key] : null;
    }
}

?>