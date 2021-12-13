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
 * The frequency should be rounded down. If a regular monthly payment starts
 * on the 31st March when it occurs in February it will be rounded to 30th
 * April.
 */
define('FrequencyRounding_Down', 'Down');

/**
 * The frequency should be rounded up. If a regular monthly payment starts
 * on the 31st March when it occurs in February it will be rounded to 1st
 * May.
 */
define('FrequencyRounding_Up', 'Up');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['FrequencyRoundingValues'] = array(
	FrequencyRounding_Down,
	FrequencyRounding_Up,
);

/**
 * The rounding to apply to the frequency calculations on boundaries. Used to
 * control the management of dates in boundary situations. For example, if a
 * regular monthly payment starts on the 31st March when it occurs in February
 * should it be rounded to the 30th April (down) or to 1st May (up).
 * @author Creditcall Ltd
 * @see Frequency
 */
class FrequencyRounding {

	/**
	 * Converts a frequency rounding into an enumerated type.
	 *
	 * @private
	 * @static
	 * @param code
	 *		The frequency rounding to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['FrequencyRoundingValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('IllegalArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}

?>
