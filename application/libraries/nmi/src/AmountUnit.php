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
 * The amount is in major units.
 */
define('AmountUnit_Major', 'Major');

/**
 * The amount is in minor units.
 */
define('AmountUnit_Minor', 'Minor');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['AmountUnitValues'] = array(
	AmountUnit_Major,
	AmountUnit_Minor,
);

/**
 * The AmountUnit is used to describe the units with which an amount in a request
 * is supplied to the CardEase platform.
 * <p>
 * For example, 1 GBP can be specified as 1 Major or 100 Minor.
 *
 * @author Creditcall Ltd
 */
class AmountUnit {

	/**
	 * Converts a amount unit into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The amount unit to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['AmountUnitValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('IllegalArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}

?>
