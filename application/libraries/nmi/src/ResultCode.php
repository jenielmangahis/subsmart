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
 * No result code.
 */
define('ResultCode_Empty', '-1');

/**
 * The requested transaction was approved.
 */
define('ResultCode_Approved', '0');

/**
 * The requested transaction was declined.
 */
define('ResultCode_Declined', '1');

/**
 * The requested transaction has been referred.
 * The operator must call the bank, otherwise transaction is considered declined.
 */
define('ResultCode_VoiceReferralRequired', '2');

/**
 * The requested test transaction was successful.
 */
define('ResultCode_TestOK', '99');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ResultCodeValues'] = array(
	ResultCode_Empty,
	ResultCode_Approved,
	ResultCode_Declined,
	ResultCode_VoiceReferralRequired,
	ResultCode_TestOK,
);

/**
 * The result code that can be obtained from the CardEase platform when it
 * processes a CardEaseXML request.
 *
 * @author Creditcall Ltd
 */
class ResultCode {

	/**
	 * Converts a result code into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The result code to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	static function parse($code) {

		foreach ($GLOBALS['ResultCodeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
