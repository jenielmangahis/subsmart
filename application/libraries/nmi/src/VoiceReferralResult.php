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
 * Internal use to indicate no result set.
 */
define('VoiceReferralResult_Empty', '-1');

/**
 * Transaction was approved by the acquirer over the phone.
 * An AuthCode will have been supplied which should be sent in the
 * AuthCode property.
 */
define('VoiceReferralResult_Approved', 'Approved');

/**
 * Transaction was declined by the acquirer over the phone.
 */
define('VoiceReferralResult_Declined', 'Declined');

/**
 * Transaction was approved by the merchant without calling their
 * acquiring bank.
 */
define('VoiceReferralResult_ApprovedOffline', 'ApprovedOffline');

/**
 * Transaction was declined by the merchant without calling their
 * acquiring bank.
 */
define('VoiceReferralResult_DeclinedOffline', 'DeclinedOffline');

/**
 * Transaction was cancelled by the merchant.
 */
define('VoiceReferralResult_Cancelled', 'Cancelled');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['VoiceReferralResultValues'] = array(
	VoiceReferralResult_Empty,
	VoiceReferralResult_Approved,
	VoiceReferralResult_Declined,
	VoiceReferralResult_ApprovedOffline,
	VoiceReferralResult_DeclinedOffline,
	VoiceReferralResult_Cancelled,
);

/**
 * The format of the voice referral result property
 * @author Creditcall Ltd
 * @see Request
 */
class VoiceReferralResult {

	/**
	 * Converts data format into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The data format to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['VoiceReferralResultValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
