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
 * A home phone number.
 */
define('PhoneNumberType_Home', 'Home');

/**
 * A mobile phone number.
 */
define('PhoneNumberType_Mobile', 'Mobile');

/**
 * A phone number that does not match any other category.
 */
define('PhoneNumberType_Other', 'Other');

/**
 * A work phone number.
 */
define('PhoneNumberType_Work', 'Work');

/**
 * A phone number with an unknown type.
 */
define('PhoneNumberType_Unknown', 'Unknown');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['PhoneNumberTypeValues'] = array(
	PhoneNumberType_Home,
	PhoneNumberType_Mobile,
	PhoneNumberType_Other,
	PhoneNumberType_Work,
	PhoneNumberType_Unknown,
);

/**
 * A class to represent type of phone number.
 * @author Creditcall Ltd
 */
class PhoneNumberType {

	/**
	 * Converts a phone number type into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The type of the phone number. This must not be null.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['PhoneNumberTypeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
