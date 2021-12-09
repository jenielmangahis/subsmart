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
 * Internal use to indicate no frequency is known.
 */
define('Frequency_Empty', '-1');

/**
 * The transaction should occur on an ad hoc basic.
 */
define('Frequency_AdHoc', 'AdHoc');

/**
 * The transaction should occur daily.
 */
define('Frequency_Daily', 'Daily');

/**
 * The transaction should occur weekly.
 */
define('Frequency_Weekly', 'Weekly');

/**
 * The transaction should occur fortnightly.
 */
define('Frequency_Fortnightly', 'Fortnightly');

/**
 * The transaction should occur monthly.
 */
define('Frequency_Monthly', 'Monthly');

/**
 * The transaction should occur quarterly.
 */
define('Frequency_Quarterly', 'Quarterly');

/**
 * The transaction should occur half yearly.
 */
define('Frequency_HalfYearly', 'HalfYearly');

/**
 * The transaction should occur yearly.
 */
define('Frequency_Yearly', 'Yearly');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['FrequencyValues'] = array(
	Frequency_Empty,
	Frequency_AdHoc,
	Frequency_Daily,
	Frequency_Weekly,
	Frequency_Fortnightly,
	Frequency_Monthly,
	Frequency_Quarterly,
	Frequency_HalfYearly,
	Frequency_Yearly,
);

/**
 * Frequencies that can be used for recurring transactions.
 *
 * @author Creditcall Ltd
 * @see FrequencyRounding
 */
class Frequency {

	/**
	 * Converts a frequency into an enumerated type.
	 *
	 * @private
	 * @static
	 * @param code
	 * 	The frequency to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['FrequencyValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('IllegalArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}

?>
