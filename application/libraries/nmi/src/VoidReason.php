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
 * Internal use to indicate no void reason is known.
 */
define('VoidReason_Empty', '-1');

/**
 * A communication failure has occurred.
 */
define('VoidReason_CommunicationFailure', '05');

/**
 * The terminal failed to print a receipt.
 */
define('VoidReason_PrintFailure', '02');

/**
 * A reset or power failure has occurred.
 */
define('VoidReason_ResetOrPowerFailure', '04');

/**
 * A transaction has failed to complete.
 */
define('VoidReason_TransactionFailure', '01');

/**
 * The terminal failed to vend the product.
 */
define('VoidReason_VendFailure', '03');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['VoidReasonValues'] = array(
	VoidReason_Empty,
	VoidReason_CommunicationFailure,
	VoidReason_PrintFailure,
	VoidReason_ResetOrPowerFailure,
	VoidReason_TransactionFailure,
	VoidReason_VendFailure,
);

/**
 * The reason for which a void request is being made.
 * This must be specified for a void request to be valid.
 * @author Creditcall Ltd
 */
class VoidReason {

	/**
	 * Converts a void reason into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The void reason to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['VoidReasonValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}

}
?>
