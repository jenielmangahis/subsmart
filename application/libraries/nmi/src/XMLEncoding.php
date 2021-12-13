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
 * US-ASCII encoding.
 */
define('XMLEncoding_US_ASCII', 'US-ASCII');

/**
 * UTF-16 encoding.
 */
define('XMLEncoding_UTF_16', 'UTF-16');

/**
 * UTF-8 encoding.
 */
define('XMLEncoding_UTF_8', 'UTF-8');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['XMLEncodingValues'] = array(
	XMLEncoding_US_ASCII,
	XMLEncoding_UTF_16,
	XMLEncoding_UTF_8,
);

/**
 * Supported XML encodings for communication with the CardEase platform.
 *
 * @author Creditcall Ltd
 */
class XMLEncoding {

	/**
	 * Converts a xml encoding into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The xml encoding to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['XMLEncodingValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
