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
 * Internal use to indicate no Transaction Status is known.
 */
define('ThreeDSecureTransactionStatus_Empty', '-1');

/**
 * The 3-D Secure authentication returned 'attempted'.
 * All associated ECI, CAVV/AAV and XID data should also be sent.
 */
define('ThreeDSecureTransactionStatus_Attempted', 'Attempted');

/**
 * The 3-D Secure authentication returned 'failure'.
 */
define('ThreeDSecureTransactionStatus_Failed', 'Failed');

/**
 * The 3-D Secure authentication did not return a value.
 */
define('ThreeDSecureTransactionStatus_None', 'None');

/**
 * The 3-D Secure authentication returned 'success'.
 * All associated ECI, CAVV/AAV and XID data should also be sent.
 */
define('ThreeDSecureTransactionStatus_Successful', 'Successful');

/**
 * The 3-D Secure authentication returned 'unknown' or 'unable'.
 */
define('ThreeDSecureTransactionStatus_Unknown', 'Unknown');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ThreeDSecureTransactionStatusValues'] = array(
	ThreeDSecureTransactionStatus_Empty,
	ThreeDSecureTransactionStatus_Attempted,
	ThreeDSecureTransactionStatus_Failed,
	ThreeDSecureTransactionStatus_None,
	ThreeDSecureTransactionStatus_Successful,
	ThreeDSecureTransactionStatus_Unknown,
);

/**
 * The result returned from a 3-D Secure authentication.
 *
 * @author Creditcall Ltd
 * @see Request
 */
class ThreeDSecureTransactionStatus {

	/**
	 * Converts a 3-D Secure result into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The 3-D Secure result to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['ThreeDSecureTransactionStatusValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
