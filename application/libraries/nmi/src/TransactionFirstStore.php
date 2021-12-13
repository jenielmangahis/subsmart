<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

/**
 * TransactionFirstStore will, by default, be determined based on whether card details are provided.
 * When tokenized card details are provided (CardHash and CardReference) it is assumed that this is not
 * a first store transaction. When  tokenized card details are not provided, but instead a PAN, etc. it is
 * assumed that this is a first store transaction.
 */
define('TransactionFirstStore_Default', '0');

/**
 * Used to override the default behaviour and indicate that this is not a first store transaction, rather than
 * determine the indicator based upon the way the card details are provided.
 */
define('TransactionFirstStore_True', '1');

/**
 * Used to override the default behaviour and indicate that this is not a first store transaction, rather than
 * determine the indicator based upon the way the card details are provided.
 */
define('TransactionFirstStore_False', '2');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['TransactionFirstStore'] = array(
    TransactionFirstStore_Default,
    TransactionFirstStore_True,
    TransactionFirstStore_False
);


/**
 * Optional indicator as to whether this transaction is from a stored card. This is needed when using your
 * own card store and sending card details in each transaction instead of a token.
 * @author Creditcall Ltd
 */
class TransactionFirstStore
{

    /**
     * Converts the TransactionFirstStore type into an enumerated type.
     * @private
     * @static
     * @param code
     *    Optional indicator as to whether this transaction is from a stored card. This is needed when using your
     *    own card store and sending card details in each transaction instead of a token.
     * @return string The resultant enumerated type.
     */
    function parse($code)
    {
        foreach ($GLOBALS['TransactionFirstStore'] as $value) {
            if (strcasecmp($code, $value) === 0) {
                return $value;
            }
        }
        trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
    }
}
?>