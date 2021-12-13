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
 * An authorisation request. This is a request for payment. This can include
 * manual, magnetic stripe and EMV transactions.
 * <p>
 * EMV transactions will be processed and any ICC data provided by the
 * issuer will be returned as part of the response data.
 */
define('RequestType_Auth', 'Auth');

/**
 * A confirmation request. This is the second stage to an authorisation
 * request in which the authorisation obtained is confirmed. This is
 * required before settlement can be achieved.
 * <p>
 * The specification of the amount is optional and if required can be less
 * than the authorised amount.
 * <p>
 * In the case of an EMV request, all of the ICC tags that have changed
 * since authorisation are required in settlement. These typically include:
 * <ul>
 * <li>Application cryptogram
 * <li>Cryptogram information data
 * <li>Application transaction counter
 * <li>Issuer application data
 * <li>Terminal verification results
 * <li>Transaction status information
 * <li>Issuer script results
 * </ul>
 * It should be noted that there is no ICC tag ID allocated for the Issuer
 * Script Results. It is up to the EMV Kernel/Terminal Integrator to
 * allocate their own. Therefore when the terminal must send the script
 * results they must set the tag ID of the ICCTag to the value
 * 'IssuerScriptResults'.
 * <p>
 * The response to the confirmation request is an acknowledgement of
 * receiving the request.
 *
 * @see ICCTag
 */
define('RequestType_Conf', 'Conf');

/**
 * An ICC management request. This is used to perform ICC management
 * functionality. For example, aquire a list of public keys.
 */
define('RequestType_ICCManagement', 'ICCManagement');

/**
 * An offline request. This is used to settle an EMV transaction using the
 * ICC data provided where the card has approved a transaction offline.
 * <p>
 * Any ICC data provided by the issuer will be returned as part of the
 * response data.
 *
 * @see ICCTag
 */
define('RequestType_Offline', 'Offline');

/**
 * A PayPal request.  The is a request for CardEaseXml to contact the
 * PayPal servers in order to process a payment.
 * <p>
 * A SubType must be specified for this.
 */
define('RequestType_PayPal', 'PayPal');

/**
 * A pre-authorisation request. This is a small request for payment to
 * confirm that the card details are valid. This can include manual,
 * magnetic stripe and EMV transactions.
 * <p>
 * EMV transactions will be processed and any ICC data provided by the
 * issuer will be returned as part of the response data.
 */
define('RequestType_PreAuth', 'PreAuth');

/**
 * A query request.
 * <p>
 * A SubType must be specified for this.
 *
 * @see SubType
 */
define('RequestType_Query', 'Query');

/**
 * A recurring transaction request. This is a request that can be used for
 * the setup and scheduling of recurring transactions. This can include an
 * initial amount, regular payments and a final amount.
 * <p>
 * A SubType must be specified for this. For example, setup a new schedule.
 *
 * @see SubType
 */
define('RequestType_Recurring', 'Recurring');

/**
 * A refund request. This is used to refund a transaction that has
 * previously been settled. A CardEaseReference obtained from the previous
 * transaction is required.
 */
define('RequestType_Refund', 'Refund');

/**
 * A test request. This is used to test connectivity to CardEaseXML. This
 * functionality should be used infrequently as excessive misuse may be
 * interpreted as being a Denial-Of-Service attack causing the sender to be
 * blocked from the CardEaseXML servers.
 */
define('RequestType_Test', 'Test');

/**
 * An update request.  This is used to update details relating to the original
 * transaction.
 * <p>
 * A CardEaseReference obtained from the previous transaction is required.
 */
define('RequestType_Update', 'Update');

/**
 * A voice referral request. This is the second stage to an authorisation
 * when the result returned by the acquirer is a Referral. For a referral
 * an operator must call their acquiring bank regarding the transaction.
 * They will authorise of decline the transaction over the phone and provide
 * an AuthCode if the transaction is authorised. This message type is used
 * to convey the response to CardEaseXML so that a transaction is completed
 * for settlement.
 * <p>
 * A CardEaseReference obtained from the previous transaction is required.
 * A new CardEaseReference is provided in the response, this is the transaction
 * that will be settled.  The original transaction will never settled.
 */
define('RequestType_VoiceReferralNotification', 'VoiceReferralNotification');

/**
 * A void request. This is used to void the original transaction.
 * <p>
 * The response to the void request is an acknowledgement of whether the
 * void was approved or declined.
 */
define('RequestType_Void', 'Void');

/**
 * A list of the values for 'quicker' parsing.
 * @private
 * @static
 */
$GLOBALS['RequestTypeValues'] = array(
	RequestType_Auth,
	RequestType_Conf,
	RequestType_Offline,
	RequestType_PreAuth,
	RequestType_Refund,
	RequestType_Test,
	RequestType_Void,
);

/**
 * The type of CardEaseXML request to be processed.
 *
 * @author Creditcall Ltd
 * @see Request
 * @see Response
 */
class RequestType {

	/**
	 * Converts a request type into an enumerated type.
	 * @private
	 * @static
	 * @param code
	 *	The request type to convert into an enumerated type.
	 * @return string The resultant enumerated type.
	 */
	function parse($code) {

		foreach ($GLOBALS['RequestTypeValues'] as $value) {
			if (strcasecmp($code, $value) === 0) {
				return $value;
			}
		}

		trigger_error('InvalidArgument: Unknown code: ' . $code, E_USER_ERROR);
	}
}
?>
