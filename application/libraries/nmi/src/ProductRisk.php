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
 * The product has very low risk.
 */
define('ProductRisk_VeryLow', 'VeryLow');

/**
 * The product has low risk.
 */
define('ProductRisk_Low', 'Low');

/**
 * The product has medium risk.
 */
define('ProductRisk_Medium', 'Medium');

/**
 * The product has high risk.
 */
define('ProductRisk_High', 'High');

/**
 * The product has very high risk.
 */
define('ProductRisk_VeryHigh', 'VeryHigh');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ProductRiskValues'] = array(
	ProductRisk_VeryLow,
	ProductRisk_Low,
	ProductRisk_Medium,
	ProductRisk_High,
	ProductRisk_VeryHigh,
);

/**
 * A class to represent the risk that a particular product holds.
 * <p>
 * For example, a high value product may have a higher risk, and a
 * low value product a lower risk.
 *
 * @author Creditcall Ltd
 */
class ProductRisk {

	/**
	 * Converts a product risk into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The product risk to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	static function parse($code) {

		foreach ($GLOBALS['ProductRiskValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
