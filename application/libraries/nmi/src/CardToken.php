<?php

/**
 * A class used to hold Card Token information.
 */
class CardToken
{
    /**
     * Card Token algorithm.
     * @private
     */
    var $m_algorithm = null;

    /**
     * Card Token key.
     * @private
     */
    var $m_key = null;

    /**
     * Card Token value.
     * @private
     */
    var $m_value = null;

    /**
     * Creates a new Card Token with the following fields.
     *
     * @param cardReference The reference to an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
     * @param cardHash The hash of an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
     * @param pan The PAN (Primary Account Number) associated with the card.
     */
    function CardToken(
        $algorithm = null,
        $key = null,
        $value = null)
    {
        $this->m_algorithm = $algorithm;
        $this->m_key = $key;
        $this->m_value = $value;
    }

    /**
     * Gets the algorithm associated with the Card Token
     *
     * @return The algorithm found in the Card Token within the response. This
     *               will be null if no algorithm was found in this response.
     */

    function getAlgorithm(){
        return $this->m_algorithm;
    }

    /**
     * Gets the key associated with the Card Token
     *
     * @return The key found in the Card Token within the response. This
     *               will be null if no key was found in this response.
     */
    function getKey(){
        return $this->m_key;
    }

    /**
     * Gets the value associated with the Card Token
     *
     * @return The value found in the Card Token within the response. This
     *               will be null if no value was found in this response.
     */

    function getValue(){
        return $this->m_key;
    }

    function toString(){
        $tokenString = "[Key: ";
        $tokenString .= $this->m_key;
        $tokenString .= " Algorithm: ";
        $tokenString .= $this->m_algorithm;
        $tokenString .= " Value: ";
        $tokenString .= $this->m_value;
        $tokenString .= "]";
        return $tokenString;
    }
}