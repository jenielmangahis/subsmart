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
 * The format of the ICC value data is ASCII Hex. For example, FF00.
 */
define('ICCTagValueType_AsciiHex', 'AsciiHex');

/**
 * The format of the ICC value data is a String. For example, REQ01.
 */
define('ICCTagValueType_String', 'String');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ICCTagValueTypeValues'] = array(
	ICCTagValueType_AsciiHex,
	ICCTagValueType_String,
);

/**
 * A class to represent the type of value data held in an EMV ICC tag.
 * The possible values are AsciiHex and String.
 * @author Creditcall Ltd
 */
class ICCTagValueType {

	/**
	 * Converts a ICC tag value type into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The type of the value data held in the ICC tag. This must not
	 *	be null.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['ICCTagValueTypeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
