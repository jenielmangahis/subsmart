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
 * A home email address.
 */
define('EmailAddressType_Home', 'Home');

/**
 * An email address that does not fit another category.
 */
define('EmailAddressType_Other', 'Other');

/**
 * A work email address.
 */
define('EmailAddressType_Work', 'Work');

/**
 * An email address with an unknown type.
 */
define('EmailAddressType_Unknown', 'Unknown');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['EmailAddressTypeValues'] = array(
	EmailAddressType_Home,
	EmailAddressType_Other,
	EmailAddressType_Work,
	EmailAddressType_Unknown,
);

/**
 * A class to represent type of email address.
 * @author Creditcall Ltd
 */
class EmailAddressType {

	/**
	 * Converts an email address type into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The type of the email address. This must not
	 *	be null.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['EmailAddressTypeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
