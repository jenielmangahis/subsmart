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
 * No error code.
 */
define('ErrorCode_Empty', '-1');

/**
 * The specified amount in the request is invalid.
 */
define('ErrorCode_AmountInvalid', '1241');

/**
 * The request does not contain an amount.
 */
define('ErrorCode_AmountMissing', '1240');

/**
 * The specified amount in the request is too large.
 */
define('ErrorCode_AmountTooLarge', '1243');

/**
 * The specified amount in the request is too small.
 */
define('ErrorCode_AmountTooSmall', '1242');

/**
 * The specified card in the request has been banned.
 */
define('ErrorCode_CardBanned', '1005');

/**
 * The card details referenced by the CardReference and CardHash
 * could not be found.
 */
define('ErrorCode_CardDetailsNotFound', '2111');

/**
 * The card details referenced by the CardReference and CardHash
 * are unavailable.
 */
define('ErrorCode_CardDetailsUnavailable', '2110');

/**
 * The specified CardEase reference in the request is invalid.
 */
define('ErrorCode_CardEaseReferenceInvalid', '2101');

/**
 * The request does not contain a CardEase reference.
 */
define('ErrorCode_CardEaseReferenceMissing', '2100');

/**
 * The specified card hash in the request is not valid.
 */
define('ErrorCode_CardHashInvalid', '1236');

/**
 * The specified card reference in the request is not valid.
 */
define('ErrorCode_CardReferenceInvalid', '1235');

/**
 * The specified card scheme in the request is not supported.
 */
define('ErrorCode_CardSchemeNotSupported', '1003');

/**
 * The specified card usage in the request has been exceeded.
 */
define('ErrorCode_CardUsageExceeded', '1004');

/**
 * The specified card in the request has expired.
 */
define('ErrorCode_ExpiredCard', '1001');

/**
 * The specified expiry date in the request is invalid.
 */
define('ErrorCode_ExpiryDateInvalid', '1211');

/**
 * The request does not contain an expiry date.
 */
define('ErrorCode_ExpiryDateMissing', '1210');

/**
 * An invalid piece of information was sent in the request.
 */
define('ErrorCode_InvalidData', '8004');

/**
 * The specified request type is invalid.
 */
define('ErrorCode_InvalidMessageType', '8002');

/**
 * The request XML is invalid.
 */
define('ErrorCode_InvalidXMLRequest', '8001');

/**
 * The specified issue number in the request is invalid.
 */
define('ErrorCode_IssueNoInvalid', '1231');

/**
 * The request does not contain an issue number.
 */
define('ErrorCode_IssueNoMissing', '1230');

/**
 * The specified transaction in the request is not allowed.
 */
define('ErrorCode_NotAllowed', '1006');

/**
 * The message type in the request is missing.
 */
define('ErrorCode_MessageTypeMissing', '1250');

/**
 * The specified message type in the request is invalid.
 */
define('ErrorCode_MessageTypeInvalid', '1251');

/**
 * The specified PAN in the request fails the Luhn check.
 */
define('ErrorCode_PANFailsLuhnCheck', '1204');

/**
 * The specified PAN in the request is invalid.
 */
define('ErrorCode_PANInvalid', '1201');

/**
 * The request does not contain a PAN.
 */
define('ErrorCode_PANMissing', '1200');

/**
 * The specified PAN in the request is too long.
 */
define('ErrorCode_PANTooLong', '1202');

/**
 * The specified PAN in the request is too short.
 */
define('ErrorCode_PANTooShort', '1203');

/**
 * The specified card in the request is not yet effective.
 */
define('ErrorCode_PreValidCard', '1002');

/**
 * The specified start date in the request is invalid.
 */
define('ErrorCode_StartDateInvalid', '1221');

/**
 * The request does not contain a start date.
 */
define('ErrorCode_StartDateMissing', '1220');

/**
 * The CardEase platform is temporarily unavailable.
 */
define('ErrorCode_TemporarilyUnavailable', '7000');

/**
 * The specified terminal id in the request is disabled.
 */
define('ErrorCode_TerminalIDDisabled', '2004');

/**
 * The specified terminal id in the request is invalid.
 */
define('ErrorCode_TerminalIDInvalid', '2003');

/**
 * The request does not contain a terminal id.
 */
define('ErrorCode_TerminalIDMissing', '2001');

/**
 * The specified terminal id in the request is unknown.
 */
define('ErrorCode_TerminalIDUnknown', '2002');

/**
 * The specified terminal id usage in the request has been exceeded.
 */
define('ErrorCode_TerminalUsageExceeded', '2005');

/**
 * The transaction has already been refunded in full.
 */
define('ErrorCode_TransactionAlreadyRefunded', '2203');

/**
 * The specified transaction in the request has already been settled.
 */
define('ErrorCode_TransactionAlreadySettled', '2201');

/**
 * The specified transaction in the request has already been voided.
 */
define('ErrorCode_TransactionAlreadyVoided', '2202');

/**
 * The specified transaction key in the request is incorrect.
 */
define('ErrorCode_TransactionKeyIncorrect', '2023');

/**
 * The specified transaction key in the request is invalid.
 */
define('ErrorCode_TransactionKeyInvalid', '2022');

/**
 * The specified transaction key in the request is missing.
 */
define('ErrorCode_TransactionKeyMissing', '2021');

/**
 * The specified transaction in the request was not found.
 */
define('ErrorCode_TransactionNotFound', '2200');

/**
 * The specified transaction in the request was originally declined.
 */
define('ErrorCode_TransactionOriginallyDeclined', '2204');

/**
 * It is not possible to decrypt the XML.
 */
define('ErrorCode_XMLDecryptionError', '8005');

/**
 * The request does not contain all of the expected XML elements.
 */
define('ErrorCode_XMLElementMissing', '8003');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['ErrorCodeValues'] = array(
	ErrorCode_Empty,
	ErrorCode_AmountInvalid,
	ErrorCode_AmountMissing,
	ErrorCode_AmountTooLarge,
	ErrorCode_AmountTooSmall,
	ErrorCode_CardBanned,
	ErrorCode_CardDetailsNotFound,
	ErrorCode_CardDetailsUnavailable,
	ErrorCode_CardEaseReferenceInvalid,
	ErrorCode_CardEaseReferenceMissing,
	ErrorCode_CardHashInvalid,
	ErrorCode_CardReferenceInvalid,
	ErrorCode_CardSchemeNotSupported,
	ErrorCode_CardUsageExceeded,
	ErrorCode_ExpiredCard,
	ErrorCode_ExpiryDateInvalid,
	ErrorCode_ExpiryDateMissing,
	ErrorCode_InvalidData,
	ErrorCode_InvalidMessageType,
	ErrorCode_InvalidXMLRequest,
	ErrorCode_IssueNoInvalid,
	ErrorCode_IssueNoMissing,
	ErrorCode_MessageTypeMissing,
	ErrorCode_MessageTypeInvalid,
	ErrorCode_NotAllowed,
	ErrorCode_PANFailsLuhnCheck,
	ErrorCode_PANInvalid,
	ErrorCode_PANMissing,
	ErrorCode_PANTooLong,
	ErrorCode_PANTooShort,
	ErrorCode_PreValidCard,
	ErrorCode_StartDateInvalid,
	ErrorCode_StartDateMissing,
	ErrorCode_TemporarilyUnavailable,
	ErrorCode_TerminalIDDisabled,
	ErrorCode_TerminalIDInvalid,
	ErrorCode_TerminalIDMissing,
	ErrorCode_TerminalIDUnknown,
	ErrorCode_TerminalUsageExceeded,
	ErrorCode_TransactionAlreadyRefunded,
	ErrorCode_TransactionAlreadySettled,
	ErrorCode_TransactionAlreadyVoided,
	ErrorCode_TransactionKeyIncorrect,
	ErrorCode_TransactionKeyMissing,
	ErrorCode_TransactionKeyInvalid,
	ErrorCode_TransactionNotFound,
	ErrorCode_TransactionOriginallyDeclined,
	ErrorCode_XMLDecryptionError,
	ErrorCode_XMLElementMissing,
);

/**
 * The possible error codes that can be returned from a CardEaseXML request.
 *
 * @author Creditcall Ltd
 */
class ErrorCode {

	/**
	 * Converts a error code into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The error code to convert into an enumerated type.
	 * @return string ErrorCode_The resultant enumerated type.
	 */
	static function parse($code) {

		foreach ($GLOBALS['ErrorCodeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}

?>
