<?php

/**
 * A class used to hold Feature Token information.
 */
class FeatureToken
{
    /**
     * Feature Token value.
     * @private
     */
    var $m_value = null;

    /**
     * Creates a new Feature Token with the fields.
     *
     * @param value
     *            The value of the Feature Token.
     */

    function FeatureToken(
        $value = null)
    {
        $this->m_value = $value;
    }

    /**
     * Gets the value associated with the Feature Token
     *
     * @return The value found in the Feature Token within the response. This
     *               will be null if no value was found in this response.
     */
    function getValue(){
        return $this->m_value;
    }
}