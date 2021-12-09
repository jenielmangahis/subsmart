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
 * Internal use to indicate no CardHolder Enrollment is known.
 */
define('ThreeDSecureCardHolderEnrolled_Empty', '-1');

/**
 * The card holder is not enrolled.
 */
define('ThreeDSecureCardHolderEnrolled_No', 'No');

/**
 * The 3-D Secure enrollment check did not return anything.
 */
define('ThreeDSecureCardHolderEnrolled_None', 'None');

/**
 * The 3-D Secure enrollment check returned 'unknown' or 'unable'.
 */
define('ThreeDSecureCardHolderEnrolled_Unknown', 'Unknown');

/**
 * The card holder is enrolled.
 */
define('ThreeDSecureCardHolderEnrolled_Yes', 'Yes');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ThreeDSecureCardHolderEnrolledValues'] = array(
	ThreeDSecureCardHolderEnrolled_Empty,
	ThreeDSecureCardHolderEnrolled_No,
	ThreeDSecureCardHolderEnrolled_None,
	ThreeDSecureCardHolderEnrolled_Unknown,
	ThreeDSecureCardHolderEnrolled_Yes,
);

/**
 * The result returned from a 3-D Secure enrollment checking.
 *
 * @author Creditcall Ltd
 * @see Request
 */
class ThreeDSecureCardHolderEnrolled {

	/**
	 * Converts a 3-D Secure card holder enrollment into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The 3-D Secure card holder enrollment to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['ThreeDSecureCardHolderEnrolledValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
