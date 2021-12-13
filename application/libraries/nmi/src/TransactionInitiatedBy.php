<?php

/**
 * The cardholder started the transaction.
 */
define('TransactionInitiatedBy_CardHolder', 'CardHolder');

/**
 * The merchant started the transaction.
 */
define('TransactionInitiatedBy_Merchant', 'Merchant');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['TransactionInitiatedByValues'] = array(
    TransactionInitiatedBy_CardHolder,
    TransactionInitiatedBy_Merchant
);

/**
 * Entities that may perform a transaction.
 * @author Creditcall Ltd
 */
class TransactionInitiatedBy {

    /**
     * Converts a transaction initiated by type into an enumerated type.
     * @private
     * @static
     * @param code
     *	The type of entity that performed the transaction. This must not be null.
     * @return string The resultant enumerated type.
     */
    function parse($code) {

        foreach ($GLOBALS['TransactionInitiatedByValues'] as $value) {
            if (strcasecmp($code, $value) === 0) {
                return $value;
            }
        }

        trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
    }
}
?>