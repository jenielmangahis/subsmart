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
 * The verification result is unknown.
 */
define('VerificationResult_Empty', '-1');

/**
 * The specified information matches the issuer records.
 */
define('VerificationResult_Matched', 'Matched');

/**
 * The specified information was not checked against issuer records.
 */
define('VerificationResult_NotChecked', 'NotChecked');

/**
 * The specified information did not match the issuer records.
 */
define('VerificationResult_NotMatched', 'NotMatched');

/**
 * The specified information was not supplied for checking.
 */
define('VerificationResult_NotSupplied', 'NotSupplied');

/**
 * The specified information partially matched the issuer records.
 */
define('VerificationResult_PartialMatch', 'PartialMatch');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['VerificationResultValues'] = array(
	VerificationResult_Empty,
	VerificationResult_Matched,
	VerificationResult_NotChecked,
	VerificationResult_NotMatched,
	VerificationResult_NotSupplied,
	VerificationResult_PartialMatch,
);

/**
 * The verification result that can be obtained from the CardEase platform when
 * it verifies certain components during a CardEaseXML request.
 * The components can include address, security code and zip code/post code.
 * @author Creditcall Ltd
 */
class VerificationResult {

	/**
	 * Converts a verification result into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The verification result to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	 function parse($code) {

		foreach ($GLOBALS['VerificationResultValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
