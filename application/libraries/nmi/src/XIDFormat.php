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
 * The format of the value data is ASCII. For example, =XYZ.
 */
define('XIDFormat_Ascii', 'Ascii');

/**
 * The format of the value data is ASCII Hex. For example, FF00.
 */
define('XIDFormat_AsciiHex', 'AsciiHex');

/**
 * The format of the value data is Base64.
 */
define('XIDFormat_Base64', 'Base64');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['XIDFormatValues'] = array(
	XIDFormat_Ascii,
	XIDFormat_AsciiHex,
	XIDFormat_Base64,
);

/**
 * The format of the XID property
 * @author Creditcall Ltd
 * @see Request
 */
class XIDFormat {

	/**
	 * Converts data format into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The data format to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['XIDFormatValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
