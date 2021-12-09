<?php


/**
 * No reason supplied.
 */
define('TransactionReason_Empty', 'Empty');

/**
 * The transaction is unscheduled.
 */
define('TransactionReason_Unscheduled', 'Unscheduled');

/**
 * The transaction is part of a installment.
 */
define('TransactionReason_Installment', 'Installment');

/**
 * The transaction is part of a prearranged schedule.
 */
define('TransactionReason_Recurring', 'Recurring');

/**
 * The transaction is part of a incremental payment plan.
 */
define('TransactionReason_Incremental', 'Incremental');

/**
 * The transaction is being resubmitted.
 */
define('TransactionReason_Resubmission', 'Resubmission');

/**
 * The charge was delayed.
 */
define('TransactionReason_DelayedCharge', 'DelayedCharge');

/**
 * The transaction is a reauthorization.
 */
define('TransactionReason_ReAuth', 'ReAuth');

/**
 * The Cardholder did not show up.
 */
define('TransactionReason_NoShow', 'NoShow');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['TransactionReasonValues'] = array(
    TransactionReason_Empty,
    TransactionReason_Unscheduled,
    TransactionReason_Installment,
    TransactionReason_Recurring,
    TransactionReason_Incremental,
    TransactionReason_Resubmission,
    TransactionReason_DelayedCharge,
    TransactionReason_ReAuth,
    TransactionReason_NoShow
);

/**
 * Reasons a merchant or cardholder may perform a transaction.
 * @author Creditcall Ltd
 */
class TransactionReason {

    /**
     * Converts a transaction reason type into an enumerated type.
     * @private
     * @static
     * @param code
     *	The type of reason a transaction was performed. This must not be null.
     * @return string The resultant enumerated type.
     */
    function parse($code) {

        foreach ($GLOBALS['TransactionReasonValues'] as $value) {
            if (strcasecmp($code, $value) === 0) {
                return $value;
            }
        }

        trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
    }
}
?>
