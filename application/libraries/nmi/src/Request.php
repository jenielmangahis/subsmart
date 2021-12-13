<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

// This code is compatible with PHP4 and PHP5.  The cross compatibility means
// that if E_STRICT is enabled in the error_reporting directive some errors
// are reported.  The following line hides those errors.
if (defined('E_STRICT')) ini_set('error_reporting', ini_get('error_reporting') & ~E_STRICT);

require_once('Address.php');
require_once('AmountUnit.php');
require_once('CredentialOnFile.php');
require_once('EmailAddress.php');
require_once('EmailAddressType.php');
require_once('ExtendedProperty.php');
require_once('Frequency.php');
require_once('FrequencyRounding.php');
require_once('IAVFormat.php');
require_once('ICCTag.php');
require_once('ICCTagValueType.php');
require_once('Name.php');
require_once('PhoneNumber.php');
require_once('PhoneNumberType.php');
require_once('Product.php');
require_once('ProductRisk.php');
require_once('RequestType.php');
require_once('SubType.php');
require_once('ThreeDSecureCardHolderEnrolled.php');
require_once('ThreeDSecureTransactionStatus.php');
require_once('TransactionInitiatedBy.php');
require_once('TransactionReason.php');
require_once('TransactionFirstStore.php');
require_once('VoiceReferralResult.php');
require_once('VoidReason.php');
require_once('XIDFormat.php');
require_once('FeatureToken.php');
require_once('Parameters.php');
require_once('ParameterKeys.php');
require_once('ParameterValues.php');
require_once('TerminalCapabilities.php');
require_once('TerminalCapabilitiesGeneric.php');
require_once('TerminalCapabilitiesCardInput.php');
require_once('TerminalCapabilitiesThreeDSecure.php');
require_once('TerminalCapabilitiesCatLevel.php');
require_once('TerminalCapabilitiesCardholderAuthentication.php');
require_once('TerminalCapabilitiesContactEmv.php');
require_once('TerminalCapabilitiesContactless.php');
require_once('TerminalCapabilitiesEcomCnp.php');
require_once('TerminalCapabilitiesFeatures.php');

/**
 * A class holding all of the data that constitutes a request to CardEaseXML.
 * The necessary components of the request should be specified (using the
 * 'setters'). The request can then be submitted to the Client in order to
 * obtain a Response.
 * <p>
 * For each request there are a number of optional and mandatory components
 * depending upon the type of the request.
 * <p>
 * In brief, these rules are:
 * <ul>
 * <li>All requests:
 * <ul>
 * <li>RequestType - the type of the request
 * <li>SoftwareName - the name of the software using the SDK
 * <li>SoftwareVersion - the version of the software using the SDK
 * <li>TerminalID - the ID of the terminal making the request
 * <li>TransactionKey - the transaction key allocated to a terminal or set of
 * terminals
 * </ul>
 * <li>Auth requests:
 * <ul>
 * <li>Amount - the transaction amount
 * <li>ICCTags or ManualType or Track2 - to specify the card details
 * </ul>
 * <li>Conf requests:
 * <ul>
 * <li>CardEaseReference - the reference of the transaction being confirmed
 * </ul>
 * <li>Offline requests:
 * <ul>
 * <li>Amount - the transaction amount
 * <li>ICCTags or ManualType or Track2 - to specify the card details
 * </ul>
 * <li>Recurring requests:
 * <ul>
 * <li>RegularAmount and RegularFrequency - for setup requests
 * <li>CardEaseReference - for adhoc and cancel requests
 * </ul>
 * <li>Refund requests:
 * <ul>
 * <li>CardEaseReference - the reference of the transaction being refunded
 * <li>ICCTags or ManualType or Track2 - to specify the card details
 * </ul>
 * <li>Void requests:
 * <ul>
 * <li>CardEaseReference - the reference of the transaction being made void
 * <li>VoidReason - the reason for which this transaction is being made void
 * </ul>
 * </ul>
 * If a manual request is being made the PAN, expiry date and expiry date
 * format should be present as a minimum.
 * @author Creditcall Ltd
 * @see Client
 * @see Response
 */
class Request {

	/**
	 * The 3-D Secure Card Holder Enrollment.
	 * @private
	 */
	var $m_3DSecureCardHolderEnrolled = ThreeDSecureCardHolderEnrolled_Empty;

	/**
	 * The 3-D Secure Electronic Commerce Indicator.
	 * @private
	 */
	var $m_3DSecureECI = null;

	/**
	 * The 3-D Secure Directory Server Transaction ID.
	 * This is required for 3-D Secure Version 2.
	 * This is formatted as a GUID.
 	 * @private
 	 */ 
	var $m_3DSecureDirectoryServerTransactionId = null;
	
	/**
	 * The 3-D Secure Authentication Verification Value.
	 * @private
	 */
	var $m_3DSecureIAV = null;

	/**
	 * The 3-D Secure Authentication Verification algorithm.
	 * @private
	 */
	var $m_3DSecureIAVAlgorithm = null;

	/** 
	 * The 3-D Secure Authentication Verification Value format.
	 * @private
	 */
	var $m_3DSecureIAVFormat = IAVFormat_Base64;
	
	/**
	 * The 3-D Secure Server Transaction ID.
	 * This is formatted as a GUID.
	 * @private
	 */   
	var $m_3DSecureServerTransactionId = null;
	
	/**
	 * The 3-D Secure Transaction Status.
	 * @private
	 */
	var $m_3DSecureTransactionStatus = ThreeDSecureTransactionStatus_Empty;

	/**
	 *
	 * The 3-D Secure version being used.
	 * This value can be retrieved from the 3-D Secure Server.
	 * It is required for 3-D Secure version 2 and above.
	 * @private
	 */
	var $m_3DSecureVersion = null;

	/**
	 * The 3-D Secure Transaction Identifier.
	 * @private
	 */
	var $m_3DSecureXID = null;

	/**
	 * The 3-D Secure Transaction Identifier format.
	 * @private
	 */
	var $m_3DSecureXIDFormat = XIDFormat_Ascii;

	/**
	 * The address used for additional verification.
	 * @private
	 */
	var $m_address = null;

	/**
	 * The transaction amount.
	 * @private
	 */
	var $m_amount = null;

	/**
	 * The units of the transaction amount.
	 * @private
	 */
	var $m_amountUnit = AmountUnit_Minor;

	/**
	 * Auth code for Offline and VoiceReferral requests.
	 */
	var $m_authCode;

	/**
	 * Whether the request is automatically confirmed.
	 * @private
	 */
	var $m_autoConfirm = false;

	/**
	 * An optional batch reference to describe a set of transactions
	 */
	var $m_batchReference = null;

	/**
	 * The CardEase reference that has been obtained during previous
	 * requests.
	 * @private
	 */
	var $m_cardEaseReference = null;

	/**
	 * The version of CardEaseXML that this client adheres to.
	 * @private
	 */
	var $m_cardEaseXMLVersion = '1.2.0';

	/**
	 * The hash of an existing card to use for manual payment in place of
	 * the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardHash = null;

	/**
	 * The cardholder's address.
	 */
	var $m_cardHolderAddress = null; // Cannot initialise here.

	/**
	 * The cardholder's email addresses.
	 */
	var $m_cardHolderEmailAddresses = array();

	/**
	 * The cardholder's name.
	 */
	var $m_cardHolderName = null; // Cannot initialise here.

	/**
	 * The cardholder's phone numbers.
	 */
	var $m_cardHolderPhoneNumbers = array();

	/**
	 * The reference of an existing card to use for manual payment in
	 * place of the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardReference = null;

	/**
	 * Whether the transaction was a contactless transaction.
	 * @private
	 */
	var $m_contactless = false;

	/**
	 * The security code printed on the card.
	 * @private
	 */
	var $m_csc = null;

	/**
	 * The currency code or mnemonic related to the transaction.
	 * @private
	 */
	var $m_currencyCode = null;

	/**
	 * Whether the transaction is a debt repayment. Defaults to false.
	 * @private
	 */
	var $m_debtRepayment = false;

	/**
	 * The delivery address.
	 */
	var $m_deliveryAddress = null; // Cannot initialise here.

	/**
	 * The delivery email addresses.
	 */
	var $m_deliveryEmailAddresses = array();

	/**
	 * The delivery name.
	 */
	var $m_deliveryName = null; // Cannot initialise here.

	/**
	 * The delivery phone numbers.
	 */
	var $m_deliveryPhoneNumbers = array();

	/**
	 * The expiry date associated with the card.
	 * @private
	 */
	var $m_expiryDate = null;

	/**
	 * The format of the expiry date associated with the card.
	 * @private
	 */
	var $m_expiryDateFormat = 'yyMM';

	/**
	 * The list of extended properties associated with this transaction.
	 * @private
	 */
	var $m_extendedProperties = array();

	/**
	 * The list of feature tokens associated with this transaction.
	 * @private
	 */
	var $m_featureTokens = array();

	/**
	 * Whether the transaction was a fallback from EMV to magnetic strip.
	 * @private
	 */
	var $m_iccFallback = false;

	/**
	 * The list of ICC tags associated with the transaction.
	 * @private
	 */
	var $m_iccTags = array();

	/**
	 * The type of ICC transaction.
	 * @private
	 */
	var $m_iccType = 'EMV';

	/**
	 * The invoice address.
	 */
	var $m_invoiceAddress = null; // Cannot initialise here.

	/**
	 * The invoice email addresses.
	 */
	var $m_invoiceEmailAddresses = array();

	/**
	 * The invoice name.
	 */
	var $m_invoiceName = null; // Cannot initialise here.

	/**
	 * The invoice phone numbers.
	 */
	var $m_invoicePhoneNumbers = array();

	/**
	 * The issue number associated with the card.
	 * @private
	 */
	var $m_issueNumber = null;

	/**
	 * The machine reference for this request.
	 * @private
	 */
	var $m_machineReference = null;

	/**
	 * The type of manual transaction.
	 * @private
	 */
	var $m_manualType = 'cnp';

	/**
	 * The date and/or time of the transaction is processed offline.
	 * @private
	 */
	var $m_offlineDateTime = null;

	/**
	 * The format of the date and/or time of the transaction if processed offline.
	 */
	var $m_offlineDateTimeFormat = 'ddMMyy HHmmss';

	/**
	 * The originating IP address of the request.  E.g. client browser.
	 * @private
	 */
	var $m_originatingIPAddress = null;

	/**
	 * The PAN (Primary Account Number) associated with the card.
	 * @private
	 */
	var $m_pan = null;

	/**
	 *  The product list associated with this request.
	 */
	var $m_products = array();

	/**
	 * The date upon which the recurring action should occur.
	 */
	var $m_recurringActionDate = null;

	/**
	 * The format of the date upon which the recurring action should occur.
	 */
	var $m_recurringActionDateFormat = null;

	/**
	 * The final amount that should be taken when a recurring transaction
	 * completes.
	 */
	var $m_recurringFinalAmount = null;

	/**
	 * The units of the final recurring amount.
	 */
	var $m_recurringFinalAmountUnit = AmountUnit_Minor;

	/**
	 * The date upon which the recurring transactions should complete.
	 */
	var $m_recurringFinalDate = null;

	/**
	 * The format of the date upon which the recurring transactions should
	 * complete.
	 */
	var $m_recurringFinalDateFormat = null;

	/**
	 * The initial amount that should be taken before a recurring transaction
	 * starts.
	 */
	var $m_recurringInitialAmount = null;

	/**
	 * The units of the initial recurring amount.
	 */
	var $m_recurringInitialAmountUnit = AmountUnit_Minor;

	/**
	 * The date upon which the recurring transactions should be initialised.
	 */
	var $m_recurringInitialDate = null;

	/**
	 * The format of the date upon which the recurring transactions should be
	 * initialised.
	 */
	var $m_recurringInitialDateFormat = null;

	/**
	 * The regular amount that should be taken when a recurring transaction
	 * occurs.
	 */
	var $m_recurringRegularAmount = null;

	/**
	 * The units of the regular recurring amount.
	 */
	var $m_recurringRegularAmountUnit = AmountUnit_Minor;

	/**
	 * The date upon which the recurring transactions should end.
	 */
	var $m_recurringRegularEndDate = null;

	/**
	 * The format of the date upon which the recurring transactions should end.
	 */
	var $m_recurringRegularEndDateFormat = null;

	/**
	 * The frequency of the recurring transaction.
	 */
	var $m_recurringRegularFrequency = Frequency_Empty;

	/**
	 * The rounding to apply to the frequency calculations on boundaries.
	 */
	var $m_recurringRegularFrequencyRounding = FrequencyRounding_Down;

	/**
	 * The maximum number of regular payments.
	 */
	var $m_recurringRegularMaximumPayments = 0;

	/**
	 * The date upon which the recurring transactions should start.
	 */
	var $m_recurringRegularStartDate = null;

	/**
	 * The format of the date upon which the recurring transactions should
	 * start.
	 */
	var $m_recurringRegularStartDateFormat = null;

	/**
	 * The type of the request.
	 * @private
	 */
	var $m_requestType = RequestType_Auth;

	/**
	 * The name of the software using the SDK.
	 * @private
	 */
	var $m_softwareName = null;

	/**
	 * The version of the software using the SDK.
	 * @private
	 */
	var $m_softwareVersion = null;

	/**
	 * The start date associated with the card.
	 * @private
	 */
	var $m_startDate = null;

	/**
	 * The format of the start date associated with the card.
	 * @private
	 */
	var $m_startDateFormat = 'yyMM';

	/**
	 * The sub type of the request.
	 */
	var $m_subType = null;

	/**
	 * The terminal ID associated with the transaction.
	 * @private
	 */
	var $m_terminalID = null;

	/**
	 * The terminal capabilities associated with the terminal.
	 * @private
	 */
	var $m_terminalCapabilities = null;

	/**
	 * The track1 associated with the card.
	 * @private
	 */
	var $m_track1 = null;

	/**
	 * The track2 associated with the card.
	 * @private
	 */
	var $m_track2 = null;

	/**
	 * The track3 associated with the card.
	 * @private
	 */
	var $m_track3 = null;

	/**
	 * The transaction key associated with the transaction.
	 * @private
	 */
	var $m_transactionKey = null;

	/**
	 * An optional user reference.
	 * @private
	 */
	var $m_userReference = null;

	/**
	 * The result of a voice referral call.
	 */
	var $m_voiceReferralResult = VoiceReferralResult_Empty;

	/**
	 * The reason for which a void request is being made.
	 * @private
	 */
	var $m_voidReason = VoidReason_Empty;

	/**
	 * The zip code associated with the card.
	 * @private
	 */
	var $m_zipCode = null;

	/**
	 * The Credential-on-File associated with the request.
	 */
	var $m_credentialOnFile = null;

	/**
	 * The merchants API key.
	 */
	var $m_apiKey = null;

	/**
	 * The application Identifier.
	 */
	var $m_applicationId = null;

	/**
	 * The payment gateway transaction ID.
	 */
	var $m_transactionId = null;

	/**
	 * Used to uniquely identify the terminal in use for this merchant account.
	 */
	var $m_laneId = null;

	/**
	 * Used to uniquely identify the terminal in use for this merchant account.
	 */
	var $m_merchantProcessorId = null;

	/**
	 * Customer Vault command.
	 */
	var $m_customerVaultCommand = null;

	/**
	 * ID of the Customer Vault.
	 */
	var $m_customerVaultId = null;

	var $m_omniSale = null;

	/**
	 * Constructs a Request and initialises variables.
	 */
	function Request() {
		$this->m_3DSecureCardHolderEnrolled = ThreeDSecureCardHolderEnrolled_Empty;
		$this->m_3DSecureECI = null;
		$this->m_3DSecureIAV = null;
		$this->m_3DSecureIAVAlgorithm = null;
		$this->m_3DSecureIAVFormat = IAVFormat_Base64;
		$this->m_3DSecureTransactionStatus = ThreeDSecureTransactionStatus_Empty;
		$this->m_3DSecureXID = null;
		$this->m_3DSecureXIDFormat = XIDFormat_Ascii;
		$this->m_address = null;
		$this->m_amount = null;
		$this->m_amountUnit = AmountUnit_Minor;
		$this->m_authCode = null;
		$this->m_autoConfirm = false;
		$this->m_batchReference = null;
		$this->m_cardEaseReference = null;
		$this->m_cardEaseXMLVersion = '1.2.0';
		$this->m_cardHash = null;
		$this->m_cardHolderAddress = new Address();
		$this->m_cardHolderEmailAddresses = array();
		$this->m_cardHolderName = new Name();
		$this->m_cardHolderPhoneNumbers = array();
		$this->m_cardReference = null;
		$this->m_contactless = false;
		$this->m_csc = null;
		$this->m_currencyCode = null;
		$this->m_credentialOnFile = null;
		$this->m_debtRepayment = false;
		$this->m_deliveryAddress = new Address();
		$this->m_deliveryEmailAddresses = array();
		$this->m_deliveryName = new Name();
		$this->m_deliveryPhoneNumbers = array();
		$this->m_expiryDate = null;
		$this->m_expiryDateFormat = 'yyMM';
		$this->m_extendedProperties = array();
		$this->m_featureTokens = array();
		$this->m_iccFallback = false;
		$this->m_iccTags = array();
		$this->m_iccType = 'EMV';
		$this->m_invoiceAddress = new Address();
		$this->m_invoiceEmailAddresses = array();
		$this->m_invoiceName = new Name();
		$this->m_invoicePhoneNumbers = array();
		$this->m_issueNumber = null;
		$this->m_machineReference = null;
		$this->m_manualType = 'cnp';
		$this->m_offlineDateTime = null;
		$this->m_offlineDateTimeFormat = 'ddMMyy HHmmss';
		$this->m_originatingIPAddress = null;
		$this->m_pan = null;
		$this->m_products = array();
		$this->m_recurringActionDate = null;
		$this->m_recurringActionDateFormat = null;
		$this->m_recurringFinalAmount = null;
		$this->m_recurringFinalAmountUnit = AmountUnit_Minor;
		$this->m_recurringFinalDate = null;
		$this->m_recurringFinalDateFormat = null;
		$this->m_recurringInitialAmount = null;
		$this->m_recurringInitialAmountUnit = AmountUnit_Minor;
		$this->m_recurringInitialDate = null;
		$this->m_recurringInitialDateFormat = null;
		$this->m_recurringRegularAmount = null;
		$this->m_recurringRegularAmountUnit = AmountUnit_Minor;
		$this->m_recurringRegularEndDate = null;
		$this->m_recurringRegularEndDateFormat = null;
		$this->m_recurringRegularFrequency = Frequency_Empty;
		$this->m_recurringRegularFrequencyRounding = FrequencyRounding_Down;
		$this->m_recurringRegularMaximumPayments = 0;
		$this->m_recurringRegularStartDate = null;
		$this->m_recurringRegularStartDateFormat = null;
		$this->m_requestType = RequestType_Auth;
		$this->m_softwareName = null;
		$this->m_softwareVersion = null;
		$this->m_startDate = null;
		$this->m_startDateFormat = 'yyMM';
		$this->m_subType = null;
		$this->m_terminalID = null;
		$this->m_terminalCapabilities = null;
		$this->m_track1 = null;
		$this->m_track2 = null;
		$this->m_track3 = null;
		$this->m_transactionKey = null;
		$this->m_userReference = null;
		$this->m_voiceReferralResult = VoiceReferralResult_Empty;
		$this->m_voidReason = VoidReason_Empty;
		$this->m_zipCode = null;
	}

	/**
	 * Adds an email address to the list of email addresses associated with the cardholder.
	 * @param emailAddress The email address to add.  Should not be null.
	 * @see getCardHolderEmailAddresses()
	 * @see setCardHolderEmailAddresses()
	 * @see EmailAddress
	 */
	function addCardHolderEmailAddress($emailAddress) {

		if ($this->m_cardHolderEmailAddresses === null) {
			$this->m_cardHolderEmailAddresses = array();
		}

		$this->m_cardHolderEmailAddresses[] = $emailAddress;
	}

	/**
	 * Adds a phone number to the list of phone numbers associated with the cardholder.
	 * @param phoneNumber The phone number to add.  Should not be null.
	 * @see getCardHolderPhoneNumbers()
	 * @see setCardHolderPhoneNumbers()
	 * @see PhoneNumber
	 */
	function addCardHolderPhoneNumber($phoneNumber) {

		if ($this->m_cardHolderPhoneNumbers === null) {
			$this->m_cardHolderPhoneNumbers = array();
		}

		$this->m_cardHolderPhoneNumbers[] = $phoneNumber;
	}

	/**
	 * Adds an email address to the list of email addresses associated with the delivery address.
	 * @param emailAddress The email address to add.  Should not be null.
	 * @see getDeliveryEmailAddresses()
	 * @see setDeliveryEmailAddresses()
	 * @see EmailAddress
	 */
	function addDeliveryEmailAddress($emailAddress) {

		if ($this->m_deliveryEmailAddresses === null) {
			$this->m_deliveryEmailAddresses = array();
		}

		$this->m_deliveryEmailAddresses[] = $emailAddress;
	}

	/**
	 * Adds a phone number to the list of phone numbers associated with the delivery address.
	 * @param phoneNumber The phone number to add.  Should not be null.
	 * @see getDeliveryPhoneNumbers()
	 * @see setDeliveryPhoneNumbers()
	 * @see PhoneNumber
	 */
	function addDeliveryPhoneNumber($phoneNumber) {

		if ($this->m_deliveryPhoneNumbers === null) {
			$this->m_deliveryPhoneNumbers = array();
		}

		$this->m_deliveryPhoneNumbers[] = $phoneNumber;
	}

	/**
	 * Adds an extended property to the list of extended properties associated with this request.
	 *
	 * @param extendedProperty The extended property to add to the list of extended properties associated with this request.  Should not be null.
	 * @see getExtendedProperties()
	 * @see setExtendedProperties()
	 * @see ExtendedProperty
	 */
	function addExtendedProperty($extendedProperty) {

		if ($this->m_extendedProperties === null) {
			$this->m_extendedProperties = array();
		}

		$this->m_extendedProperties[] = $extendedProperty;
	}

	/**
	 * Adds an extended property to the list of extended properties associated with this request.
	 *
	 * @param featureToken The featureToken to add to the list of feature tokens associated with this request.
	 * 			This should not be null.
	 * @see getFeatureTokens()
	 * @see setFeatureTokens()
	 * @see FeatureToken
	 */
	function addFeatureToken($featureToken) {

		if ($this->m_featureTokens === null) {
			$this->m_featureTokens = array();
		}

		$this->m_featureTokens[] = $featureToken;
	}

	/**
	 * Adds an ICC tag to the list of ICC tags associated with this
	 * request. Each ICC tag has an id, type and value. For example, a tag
	 * of 0x9f02/AsciiHex/000000000100 is using to specify the transaction
	 * amount. These are mandatory for an EMV transaction.
	 *
	 * @param iccTag
	 *	The ICC tag to add to the list of ICC tags associated with
	 *	this request. This should not be null.
	 * @see ICCTag
	 * @see getICCTags()
	 * @see setICCTags()
	 */
	function addICCTag($iccTag) {

		if ($this->m_iccTags === null) {
			$this->m_iccTags = array();
		}

		$this->m_iccTags[] = $iccTag;
	}

	/**
	 * Adds an email address to the list of email addresses associated with the invoice address.
	 * @param emailAddress The email address to add.  Should not be null.
	 * @see getInvoiceEmailAddresses()
	 * @see setInvoiceEmailAddresses()
	 * @see EmailAddress
	 */
	function addInvoiceEmailAddress($emailAddress) {

		if ($this->m_invoiceEmailAddresses === null) {
			$this->m_invoiceEmailAddresses = array();
		}

		$this->m_invoiceEmailAddresses[] = $emailAddress;
	}

	/**
	 * Adds a phone number to the list of phone numbers associated with the invoice address.
	 * @param phoneNumber The phone number to add.  Should not be null.
	 * @see getInvoicePhoneNumbers()
	 * @see setInvoicePhoneNumbers()
	 * @see PhoneNumber
	 */
	function addInvoicePhoneNumber($phoneNumber) {

		if ($this->m_invoicePhoneNumbers === null) {
			$this->m_invoicePhoneNumbers = array();
		}

		$this->m_invoicePhoneNumbers[] = $phoneNumber;
	}

	/**
	 * Adds a product to the list of products associated with this request.
	 * @param product The product to add.  Should not be null.
	 * @see getProducts()
	 * @see setProducts()
	 * @see Product
	 */
	function addProduct($product) {

		if ($this->m_products === null) {
			$this->m_products = array();
		}

		$this->m_products[] = $product;
	}

	function generateRecurringXml(&$writer) {

		if ($this->m_recurringActionDate === null && $this->m_recurringActionDateFormat === null
				&& $this->m_recurringFinalAmount === null && $this->m_recurringFinalDate === null
				&& $this->m_recurringFinalDateFormat === null && $this->m_recurringInitialAmount === null
				&& $this->m_recurringInitialDate === null && $this->m_recurringInitialDateFormat === null
				&& $this->m_recurringRegularAmount === null && $this->m_recurringRegularEndDate === null
				&& $this->m_recurringRegularEndDateFormat === null && $this->m_recurringRegularFrequency === Frequency_Empty
				&& $this->m_recurringRegularMaximumPayments === 0 && $this->m_recurringRegularStartDate === null
				&& $this->m_recurringRegularStartDateFormat === null) {
			return;
		}

		$writer->writeStartElement('Recurring');

		if ($this->m_recurringActionDate !== null || $this->m_recurringActionDateFormat !== null) {
			$writer->writeStartElement('ActionDate');
			$writer->writeAttributeString('format', $this->m_recurringActionDateFormat);
			$writer->writeString($this->m_recurringActionDate);
			$writer->writeEndElement(); // ActionDate
		}

		if ($this->m_recurringInitialAmount !== null || $this->m_recurringInitialDate !== null
				|| $this->m_recurringInitialDateFormat !== null) {
			$writer->writeStartElement('Initial');

			if ($this->m_recurringInitialAmount !== null) {
				$writer->writeStartElement('Amount');
				$writer->writeAttributeString('unit', $this->m_recurringInitialAmountUnit);
				$writer->writeString($this->m_recurringInitialAmount);
				$writer->writeEndElement(); // Amount
			}

			if ($this->m_recurringInitialDate !== null && $this->m_recurringInitialDateFormat !== null) {
				$writer->writeStartElement('Date');
				$writer->writeAttributeString('format', $this->m_recurringInitialDateFormat);
				$writer->writeString($this->m_recurringInitialDate);
				$writer->writeEndElement(); // Date
			}

			$writer->writeEndElement(); // Initial
		}

		if ($this->m_recurringRegularAmount !== null || $this->m_recurringRegularEndDate !== null
				|| $this->m_recurringRegularEndDateFormat !== null || $this->m_recurringRegularFrequency !== Frequency_Empty
				|| $this->m_recurringRegularMaximumPayments !== 0 || $this->m_recurringRegularStartDate !== null
				|| $this->m_recurringRegularStartDateFormat !== null) {
			$writer->writeStartElement('Regular');

			if ($this->m_recurringRegularAmount !== null) {
				$writer->writeStartElement('Amount');
				$writer->writeAttributeString('unit', $this->m_recurringRegularAmountUnit);
				$writer->writeString($this->m_recurringRegularAmount);
				$writer->writeEndElement(); // Amount
			}

			if ($this->m_recurringRegularEndDate !== null && $this->m_recurringRegularEndDateFormat !== null) {
				$writer->writeStartElement('EndDate');
				$writer->writeAttributeString('format', $this->m_recurringRegularEndDateFormat);
				$writer->writeString($this->m_recurringRegularEndDate);
				$writer->writeEndElement(); // EndDate
			}

			if ($this->m_recurringRegularFrequency !== Frequency_Empty) {
				$writer->writeStartElement('Frequency');
				$writer->writeAttributeString('rounding', $this->m_recurringRegularFrequencyRounding);
				$writer->writeString($this->m_recurringRegularFrequency);
				$writer->writeEndElement(); // Frequency
			}

			if ($this->m_recurringRegularMaximumPayments !== 0) {
				$writer->writeElementString('MaximumPayments', $this->m_recurringRegularMaximumPayments);
			}

			if ($this->m_recurringRegularStartDate !== null && $this->m_recurringRegularStartDateFormat !== null) {
				$writer->writeStartElement('StartDate');
				$writer->writeAttributeString('format', $this->m_recurringRegularStartDateFormat);
				$writer->writeString($this->m_recurringRegularStartDate);
				$writer->writeEndElement(); // StartDate
			}

			$writer->writeEndElement(); // Regular
		}

		if ($this->m_recurringFinalAmount !== null || $this->m_recurringFinalDate !== null
				|| $this->m_recurringFinalDateFormat !== null) {
			$writer->writeStartElement('Final');

			if ($this->m_recurringFinalAmount !== null) {
				$writer->writeStartElement('Amount');
				$writer->writeAttributeString('unit', $this->m_recurringFinalAmountUnit);
				$writer->writeString($this->m_recurringFinalAmount);
				$writer->writeEndElement(); // Amount
			}

			if ($this->m_recurringFinalDate !== null && $this->m_recurringFinalDateFormat !== null) {
				$writer->writeStartElement('Date');
				$writer->writeAttributeString('format', $this->m_recurringFinalDateFormat);
				$writer->writeString($this->m_recurringFinalDate);
				$writer->writeEndElement(); // Date
			}

			$writer->writeEndElement(); // Final
		}

		$writer->writeEndElement(); // Recurring
	}

	/**
	 * Generates the XML that represents the content of this request.
	 * @private
	 * @param writer
	 *	The target of the XML data. This must not be null.
	 * @throws E_USER_ERROR
	 *	If the request data is not valid.
	 */
	function generateRequestXml(XMLWriterCreditcall $writer)
	{
		$writer->writeStartDocument(true);
		$writer->writeStartElement('Request');
		$writer->writeAttributeString('type', 'CardEaseXML');

		if ($this->m_cardEaseXMLVersion !== null)
		{
			$writer->writeAttributeString('version', $this->m_cardEaseXMLVersion);
		}
		// TransactionDetails
		$writer->writeStartElement('TransactionDetails');

		$writer->writeStartElement('MessageType');

		if ($this->m_autoConfirm)
		{
			$writer->writeAttributeString('autoconfirm', 'true');
		}

		if ($this->m_omniSale)
		{
			$writer->writeAttributeString('omniSale', 'true');
		}

        if ($this->m_subType !== null) {
			$writer->writeAttributeString('subtype', $this->m_subType);
		}

		$writer->writeString($this->m_requestType);
		$writer->writeEndElement(); // MessageType

        if ($this->m_offlineDateTime !== null)
        {
            $writer->WriteStartElement('OfflineDateTime');

            if ($this->m_offlineDateTimeFormat !== null)
            {
                $writer->WriteAttributeString('format', $this->m_offlineDateTimeFormat);
            }

            $writer->WriteString($this->m_offlineDateTime);
            $writer->WriteEndElement(); // OfflineDateTime
        }

		$this->generateRecurringXml($writer);

		if ($this->m_originatingIPAddress !== null)
		{
			$writer->writeElementString('OriginatingIP', $this->m_originatingIPAddress);
		}

		if ($this->m_userReference !== null)
		{
			$writer->writeElementString('Reference', $this->m_userReference);
		}

		// DeliveryAddress
		if (($this->m_deliveryAddress !== null && !$this->m_deliveryAddress->isEmpty()) ||
			($this->m_deliveryEmailAddresses !== null && count($this->m_deliveryEmailAddresses) !== 0) ||
			($this->m_deliveryName !== null && !$this->m_deliveryName->isEmpty()) ||
			($this->m_deliveryPhoneNumbers !== null && count($this->m_deliveryPhoneNumbers) !== 0))
		{
			$writer->writeStartElement('Delivery');

			if ($this->m_deliveryAddress !== null && !$this->m_deliveryAddress->isEmpty())
			{
				$writer->writeStartElement('Address');

				$writer->writeAttributeString('format', 'standard');

				if ($this->m_deliveryAddress->getRecipient() !== null)
				{
					$recipient = $this->m_deliveryAddress->getRecipient();

					for ($id = 0; $id < count($recipient); $id++)
					{
						$writer->writeStartElement('Recipient');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($recipient[$id]);
						$writer->writeEndElement(); // Recipient
					}

					unset($recipient);
				}

				if ($this->m_deliveryAddress->getLines() !== null)
				{
					$lines = $this->m_deliveryAddress->getLines();

					for ($id = 0; $id < count($lines); $id++)
					{
						$writer->writeStartElement('Line');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($lines[$id]);
						$writer->writeEndElement(); // Line
					}

					unset($lines);
				}

				if ($this->m_deliveryAddress->getCity() !== null)
				{
					$writer->writeElementString('City', $this->m_deliveryAddress->getCity());
				}

				if ($this->m_deliveryAddress->getState() !== null)
				{
					$writer->writeElementString('State', $this->m_deliveryAddress->getState());
				}

				if ($this->m_deliveryAddress->getZipCode() !== null)
				{
					$writer->writeElementString('ZipCode', $this->m_deliveryAddress->getZipCode());
				}

				if ($this->m_deliveryAddress->getCountry() !== null)
				{
					$writer->writeElementString('Country', $this->m_deliveryAddress->getCountry());
				}

				$writer->writeEndElement(); // Address
			}

			// DeliveryName
			if (($this->m_deliveryEmailAddresses !== null && count($this->m_deliveryEmailAddresses) !== 0) ||
				($this->m_deliveryName !== null && !$this->m_deliveryName->isEmpty()) ||
				($this->m_deliveryPhoneNumbers !== null && count($this->m_deliveryPhoneNumbers) !== 0))
			{
				$writer->writeStartElement('Contact');

				if ($this->m_deliveryEmailAddresses !== null && count($this->m_deliveryEmailAddresses) !== 0)
				{
					$writer->writeStartElement('EmailAddressList');

					for ($id = 0; $id < count($this->m_deliveryEmailAddresses); $id++)
					{
						$emailAddress = $this->m_deliveryEmailAddresses[$id];

						$writer->writeStartElement('EmailAddress');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $emailAddress->getType());
						$writer->writeString($emailAddress->getAddress());
						$writer->writeEndElement(); // EmailAddress

						unset($emailAddress);
					}

					$writer->writeEndElement(); // EmailAddressList
				}

				if ($this->m_deliveryName !== null && !$this->m_deliveryName->isEmpty())
				{
					$writer->writeStartElement('Name');

					if ($this->m_deliveryName->getTitle() !== null)
					{
						$writer->writeElementString('Title', $this->m_deliveryName->getTitle());
					}

					if ($this->m_deliveryName->getFirstName() !== null)
					{
						$writer->writeElementString('FirstName', $this->m_deliveryName->getFirstName());
					}

					if ($this->m_deliveryName->getInitials() !== null)
					{
						$writer->writeElementString('Initials', $this->m_deliveryName->getInitials());
					}

					if ($this->m_deliveryName->getLastName() !== null)
					{
						$writer->writeElementString('LastName', $this->m_deliveryName->getLastName());
					}

					$writer->writeEndElement(); // Name
				}

				if ($this->m_deliveryPhoneNumbers !== null && count($this->m_deliveryPhoneNumbers) !== 0)
				{
					$writer->writeStartElement('PhoneNumberList');

					for ($id = 0; $id < count($this->m_deliveryPhoneNumbers); $id++)
					{
						$phoneNumber = $this->m_deliveryPhoneNumbers[$id];

						$writer->writeStartElement('PhoneNumber');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $phoneNumber->getType());
						$writer->writeString($phoneNumber->getNumber());
						$writer->writeEndElement(); // PhoneNumber

						unset($phoneNumber);
					}

					$writer->writeEndElement(); // PhoneNumberList
				}

				$writer->writeEndElement(); // Contact
			}

			$writer->writeEndElement(); // Delivery
		}

		// ExtendedPropertyList
		if ($this->m_extendedProperties !== null && count($this->m_extendedProperties) !== 0)
		{
			$writer->writeStartElement('ExtendedPropertyList');

			foreach ($this->m_extendedProperties as $extendedProperty)
			{
				$writer->writeStartElement('ExtendedProperty');
				$writer->writeAttributeString('id', $extendedProperty->getName());
				$writer->writeString($extendedProperty->getValue());
				$writer->writeEndElement(); // ExtendedProperty
			}

			$writer->writeEndElement(); // ExtendedPropertyList
		}

		// Invoice
		if (($this->m_invoiceAddress !== null && !$this->m_invoiceAddress->isEmpty()) ||
			($this->m_invoiceEmailAddresses !== null && count($this->m_invoiceEmailAddresses) !== 0) ||
			($this->m_invoiceName !== null && !$this->m_invoiceName->isEmpty()) ||
			($this->m_invoicePhoneNumbers !== null && count($this->m_invoicePhoneNumbers) !== 0))
		{
			$writer->writeStartElement('Invoice');

			// InvoiceAddress
			if (($this->m_invoiceAddress !== null && !$this->m_invoiceAddress->isEmpty()))
			{
				$writer->writeStartElement('Address');

				$writer->writeAttributeString('format', 'standard');

				if ($this->m_invoiceAddress->getRecipient() !== null)
				{
					$recipient = $this->m_invoiceAddress->getRecipient();

					for ($id = 0; $id < count($recipient); $id++)
					{
						$writer->writeStartElement('Recipient');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($recipient[$id]);
						$writer->writeEndElement(); // Recipient
					}

					unset($recipient);
				}

				if ($this->m_invoiceAddress->getLines() !== null)
				{
					$lines = $this->m_invoiceAddress->getLines();

					for ($id = 0; $id < count($lines); $id++)
					{
						$writer->writeStartElement('Line');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($lines[$id]);
						$writer->writeEndElement(); // Line
					}

					unset($lines);
				}

				if ($this->m_invoiceAddress->getCity() !== null)
				{
					$writer->writeElementString('City', $this->m_invoiceAddress->getCity());
				}

				if ($this->m_invoiceAddress->getState() !== null)
				{
					$writer->writeElementString('State', $this->m_invoiceAddress->getState());
				}

				if ($this->m_invoiceAddress->getZipCode() !== null)
				{
					$writer->writeElementString('ZipCode', $this->m_invoiceAddress->getZipCode());
				}

				if ($this->m_invoiceAddress->getCountry() !== null)
				{
					$writer->writeElementString('Country', $this->m_invoiceAddress->getCountry());
				}

				$writer->writeEndElement(); // Address
			}

			// InvoiceName
			if (($this->m_invoiceEmailAddresses !== null && count($this->m_invoiceEmailAddresses) !== 0) ||
				($this->m_invoiceName !== null && !$this->m_invoiceName->isEmpty()) ||
				($this->m_invoicePhoneNumbers !== null && count($this->m_invoicePhoneNumbers) !== 0))
			{
				$writer->writeStartElement('Contact');

				if ($this->m_invoiceEmailAddresses !== null && count($this->m_invoiceEmailAddresses) !== 0)
				{
					$writer->writeStartElement('EmailAddressList');

					for ($id = 0; $id < count($this->m_invoiceEmailAddresses); $id++)
					{
						$emailAddress = $this->m_invoiceEmailAddresses[$id];

						$writer->writeStartElement('EmailAddress');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $emailAddress->getType());
						$writer->writeString($emailAddress->getAddress());
						$writer->writeEndElement(); // EmailAddress

						unset($emailAddress);
					}

					$writer->writeEndElement(); // EmailAddressList
				}

				if ($this->m_invoiceName !== null && !$this->m_invoiceName->isEmpty())
				{
					$writer->writeStartElement('Name');

					if ($this->m_invoiceName->getTitle() !== null)
					{
						$writer->writeElementString('Title', $this->m_invoiceName->getTitle());
					}

					if ($this->m_invoiceName->getFirstName() !== null)
					{
						$writer->writeElementString('FirstName', $this->m_invoiceName->getFirstName());
					}

					if ($this->m_invoiceName->getInitials() !== null)
					{
						$writer->writeElementString('Initials', $this->m_invoiceName->getInitials());
					}

					if ($this->m_invoiceName->getLastName() !== null)
					{
						$writer->writeElementString('LastName', $this->m_invoiceName->getLastName());
					}

					$writer->writeEndElement(); // Name
				}

				if ($this->m_invoicePhoneNumbers !== null && count($this->m_invoicePhoneNumbers) !== 0)
				{
					$writer->writeStartElement('PhoneNumberList');

					for ($id = 0; $id < count($this->m_invoicePhoneNumbers); $id++)
					{
						$phoneNumber = $this->m_invoicePhoneNumbers[$id];

						$writer->writeStartElement('PhoneNumber');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $phoneNumber->getType());
						$writer->writeString($phoneNumber->getNumber());
						$writer->writeEndElement(); // PhoneNumber

						unset($phoneNumber);
					}

					$writer->writeEndElement(); // PhoneNumbers
				}

				$writer->writeEndElement(); // Contact
			}

			$writer->writeEndElement(); // Invoice
		}

		// Product List
		if ($this->m_products !== null && count($this->m_products) !== 0)
		{
			$writer->writeStartElement('ProductList');

			for ($id = 0; $id < count($this->m_products); $id++)
			{
				$writer->writeStartElement('Product');
				$writer->writeAttributeString('id', $id + 1);

				$product = $this->m_products[$id];

				if ($product->getAmount() !== null)
				{
					$writer->writeStartElement('Amount');

					// Default is minor
					if ($product->getAmountUnit() === AmountUnit_Major)
					{
						$writer->writeAttributeString('unit', 'major');
					}

					$writer->writeString($product->getAmount());
					$writer->writeEndElement(); // Amount
				}

				if ($product->getCategory() !== null)
				{
					$writer->writeElementString('Category', $product->getCategory());
				}

				if ($product->getCode() !== null)
				{
					$writer->writeElementString('Code', $product->getCode());
				}

				if ($product->getDescription() !== null)
				{
					$writer->writeElementString('Description', $product->getDescription());
				}

				if ($product->getCurrencyCode() !== null)
				{
					$writer->writeElementString('CurrencyCode', $product->getCurrencyCode());
				}

				if ($product->getName() !== null)
				{
					$writer->writeElementString('Name', $product->getName());
				}

				if ($product->getQuantity() !== null)
				{
					$writer->writeElementString('Quantity', $product->getQuantity());
				}

				if ($product->getRisk() !== null)
				{
					$writer->writeElementString('Risk', $product->getRisk());
				}

				if ($product->getType() !== null)
				{
					$writer->writeElementString('Type', $product->getType());
				}

				$writer->writeEndElement(); // Product

				unset($product);
			}

			$writer->writeEndElement(); // ProductList
		}

        if ($this->m_batchReference !== null)
        {
            $writer->writeElementString('BatchReference', $this->m_batchReference);
        }

		if ($this->m_cardEaseReference !== null)
		{
			$writer->writeElementString('CardEaseReference', $this->m_cardEaseReference);
		}

		if ($this->m_amount !== null)
		{
			$writer->writeStartElement('Amount');

			// Default is minor
			if ($this->m_amountUnit === AmountUnit_Major)
			{
				$writer->writeAttributeString('unit', 'major');
			}

			$writer->writeString($this->m_amount);
			$writer->writeEndElement(); // Amount
		}

		if ($this->m_currencyCode !== null)
		{
			$writer->writeElementString('CurrencyCode', $this->m_currencyCode);
		}

        if ($this->m_requestType === RequestType_VoiceReferralNotification)
        {
            $writer->WriteElementString('VoiceReferralResult', $this->m_voiceReferralResult);
        }

        if (($this->m_requestType === RequestType_VoiceReferralNotification || $this->m_requestType === RequestType_Offline) && $this->m_authCode !== null)
        {
            $writer->WriteElementString('AuthCode', $this->m_authCode);
        }

		if ($this->m_voidReason !== VoidReason_Empty)
		{
			$writer->writeElementString('VoidReason', $this->m_voidReason);
		}

		if ($this->m_transactionId !== null)
		{
			$writer->writeElementString('GwTransactionId', $this->m_transactionId);
		}

		if ($this->m_customerVaultCommand !== null)
		{
			$writer->writeElementString('GwCustomerVault', $this->m_customerVaultCommand);
		}

		if ($this->m_customerVaultId !== null)
		{
			$writer->writeElementString('GwCustomerVaultId', $this->m_customerVaultId);
		}

		if ($this->m_merchantProcessorId !== null)
		{
			$writer->writeElementString('MerchantProcessorId', $this->m_merchantProcessorId);
		}

		if ($this->m_debtRepayment)
		{
			$writer->WriteElementString("DebtRepayment", "true");
		}

		$writer->writeEndElement(); // TransactionDetails

		// TerminalDetails
		$writer->writeStartElement('TerminalDetails');

		if ($this->m_terminalID !== null)
		{
			$writer->writeElementString('TerminalID', $this->m_terminalID);
		}

		if ($this->m_transactionKey !== null)
		{
			$writer->writeElementString('TransactionKey', $this->m_transactionKey);
		}

		if ($this->m_machineReference !== null)
		{
			$writer->writeElementString('MachineReference', $this->m_machineReference);
		}

		if ($this->m_softwareName !== null)
		{
			$writer->writeStartElement('Software');

			if ($this->m_softwareVersion !== null)
			{
				$writer->writeAttributeString('version', $this->m_softwareVersion);
			}

			$writer->writeString($this->m_softwareName);
			$writer->writeEndElement(); // Software
		}

		if ($this->m_apiKey !== null)
		{
			$writer->writeElementString('ApiKey', $this->m_apiKey);
		}

		if ($this->m_laneId !== null)
		{
			$writer->writeElementString('LaneId', $this->m_laneId);
		}

		if ($this->m_applicationId !== null)
		{
			$writer->writeElementString('ApplicationId', $this->m_applicationId);
		}

		if ($this->m_terminalCapabilities != null) {
			$writer->writeStartElement("TerminalProperties");

			$writer->writeStartElement("TerminalCapabilities");

			if ($this->m_terminalCapabilities->terminalCapabilitiesGeneric != null)
			{
				if ($this->m_terminalCapabilities->terminalCapabilitiesGeneric->attendedType != null)
				{
					$writer->writeStartElement("AttendedType");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesGeneric->attendedType);
					$writer->writeEndElement(); // AttendedType
				}


				if ($this->m_terminalCapabilities->terminalCapabilitiesGeneric->deviceType != null)
				{
					$writer->writeStartElement("DeviceType");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesGeneric->deviceType);
					$writer->writeEndElement(); // DeviceType
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesGeneric->mobilePos != null)
				{
					$writer->writeStartElement("MobilePos");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesGeneric->mobilePos);
					$writer->writeEndElement(); // MobilePos
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesGeneric->premises != null)
				{
					$writer->writeStartElement("Premises");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesGeneric->premises);
					$writer->writeEndElement(); // Premises
				}
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesCatLevel != null)
			{
				$this->addCatLevelsToXML($writer);
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesCardInput != null)
			{
				$writer->writeStartElement("CardInput");
				if ($this->m_terminalCapabilities->terminalCapabilitiesCardInput->keyed != null)
				{
					$writer->writeStartElement("Keyed");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardInput->keyed);
					$writer->writeEndElement(); // Keyed
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardInput->magstripe != null)
				{
					$writer->writeStartElement("Magstripe");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardInput->magstripe);
					$writer->writeEndElement(); // Magstripe
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardInput->contactEMV != null)
				{
					$writer->writeStartElement("ContactEMV");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardInput->contactEMV);
					$writer->writeEndElement(); // ContactEMV
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardInput->contactlessEMV != null)
				{
					$writer->writeStartElement("ContactlessEMV");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardInput->contactlessEMV);
					$writer->writeEndElement(); // ContactlessEMV
				}
				$writer->writeEndElement(); // CardInput
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication != null)
			{
				$writer->writeStartElement("CardholderAuthentication");
				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->signature != null)
				{
					$writer->writeStartElement("Signature");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->signature);
					$writer->writeEndElement(); // Signature
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->onlinePin != null)
				{
					$writer->writeStartElement("OnlinePin");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->onlinePin);
					$writer->writeEndElement(); // OnlinePin
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->pinRetry != null)
				{
					$writer->writeStartElement("PinRetry");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->pinRetry);
					$writer->writeEndElement(); // PinRetry
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->offlinePin != null)
				{
					$writer->writeStartElement("OfflinePin");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->offlinePin);
					$writer->writeEndElement(); // OfflinePin
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->pinBypass != null)
				{
					$writer->writeStartElement("PinBypass");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->pinBypass);
					$writer->writeEndElement(); // PinBypass
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->cdcvm != null)
				{
					$writer->writeStartElement("Cdcvm");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesCardholderAuthentication->cdcvm);
					$writer->writeEndElement(); // Cdcvm
				}
				$writer->writeEndElement(); // CardholderAuthentication
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesContactEmv != null)
			{
				$writer->writeStartElement("ContactEmv");
				if ($this->m_terminalCapabilities->terminalCapabilitiesContactEmv->fallBack != null)
				{
					$writer->writeStartElement("FallBack");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactEmv->fallBack);
					$writer->writeEndElement(); // FallBack
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesContactEmv->emvTerminalCapabilities != null)
				{
					$writer->writeStartElement("EmvTerminalCapabilities");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactEmv->emvTerminalCapabilities);
					$writer->writeEndElement(); // EmvTerminalCapabilities
				}
				$writer->writeEndElement(); // ContactEmv
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesContactless != null)
			{
				$writer->writeStartElement("Contactless");
				if ($this->m_terminalCapabilities->terminalCapabilitiesContactless->emvTerminalCapabilities != null)
				{
					$writer->writeStartElement("EmvTerminalCapabilities");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactless->emvTerminalCapabilities);
					$writer->writeEndElement(); // EmvTerminalCapabilities
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesContactless->fallForward != null)
				{
					$writer->writeStartElement("FallForward");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactless->fallForward);
					$writer->writeEndElement(); // FallForward
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesContactless->singleTap != null)
				{
					$writer->writeStartElement("SingleTap");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactless->singleTap);
					$writer->writeEndElement(); // SingleTap
				}

				if (!empty($this->m_terminalCapabilities->terminalCapabilitiesContactless->cvmCapabilities)) {
					$this->addCvmCapabilitiesToXML($writer);
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesContactless->magstripe != null)
				{
					$writer->writeStartElement("Magstripe");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesContactless->magstripe);
					$writer->writeEndElement(); // Magstripe
				}
				$writer->writeEndElement(); // Contactless
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp != null || $this->isThreeDSecureNodeNeeded())
			{
				$writer->writeStartElement("EcomCnp");
				if ($this->isThreeDSecureNodeNeeded()) {
					$writer->writeStartElement("ThreeDSecure");

					if ($this->isVersionSupportedNodeNeeded()) {
						$writer->writeStartElement("VersionsSupported");

						if ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion1 != null &&
							$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion1 == ParameterValues::$true) {
							$writer->writeStartElement('Version');
							$writer->writeString('1');
							$writer->writeEndElement(); // ThreeDSecureVersion1
						}

						if ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion2 != null &&
							$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion2 == ParameterValues::$true) {
							$writer->writeStartElement('Version');
							$writer->writeString('2');
							$writer->writeEndElement(); // ThreeDSecureVersion2
						}
						$writer->writeEndElement(); // VersionsSupported
					}

					if ($this->isSchemeSupportedNodeNeeded()) {
						$writer->writeStartElement("SchemeSupported");

						if($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->visa == ParameterValues::$true){
							$writer->writeStartElement('Scheme');
							$writer->writeString('Visa');
							$writer->writeEndElement(); // Visa
						}

						if ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->mastercard == ParameterValues::$true){
							$writer->writeStartElement('Scheme');
							$writer->writeString('Mastercard');
							$writer->writeEndElement(); // Mastercard
						}

						if ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->amex == ParameterValues::$true){
							$writer->writeStartElement('Scheme');
							$writer->writeString('Amex');
							$writer->writeEndElement(); // Amex
						}
						$writer->writeEndElement(); // SchemesSupported
					}
					$writer->writeEndElement(); // ThreeDSecure
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp != null)
				{
					if ($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->avs != null)
					{
						$writer->writeStartElement("Avs");
						$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->avs);
						$writer->writeEndElement(); // Avs
					}

					if ($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->csc != null)
					{
						$writer->writeStartElement("Csc");
						$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->csc);
						$writer->writeEndElement(); // Csc
					}

					if ($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->ecomUrl != null)
					{
						$writer->writeStartElement("EcomUrl");
						$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesEcomCnp->ecomUrl);
						$writer->writeEndElement(); // EcomUrl
					}
				}
				$writer->writeEndElement(); // EcomCnp
			}

			if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures != null)
			{
				$writer->writeStartElement("Features");
				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->cardCapture != null)
				{
					$writer->writeStartElement("CardCapture");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->cardCapture);
					$writer->writeEndElement(); // CardCapture
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->dcc != null)
				{
					$writer->writeStartElement("Dcc");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->dcc);
					$writer->writeEndElement(); // Dcc
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->multiCurrency != null)
				{
					$writer->writeStartElement("MultiCurrency");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->multiCurrency);
					$writer->writeEndElement(); // MultiCurrency
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialAuth != null)
				{
					$writer->writeStartElement("PartialAuth");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialAuth);
					$writer->writeEndElement(); // PartialAuth
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialReversal != null)
				{
					$writer->writeStartElement("PartialReversal");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialReversal);
					$writer->writeEndElement(); // PartialReversal
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->voiceReferral != null)
				{
					$writer->writeStartElement("VoiceReferral");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->voiceReferral);
					$writer->writeEndElement(); // VoiceReferral
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->onDeviceTipping != null)
				{
					$writer->writeStartElement("OnDeviceTipping");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->onDeviceTipping);
					$writer->writeEndElement(); // OnDeviceTipping
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->endOfDayTipping != null)
				{
					$writer->writeStartElement("EndOfDayTipping");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->endOfDayTipping);
					$writer->writeEndElement(); // EndOfDayTipping
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->digitalSignature != null)
				{
					$writer->writeStartElement("DigitalSignature");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->digitalSignature);
					$writer->writeEndElement(); // DigitalSignature
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->screen != null)
				{
					$writer->writeStartElement("Screen");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->screen);
					$writer->writeEndElement(); // Screen
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialReversal != null) // repeated?
				{
					$writer->writeStartElement("PartialReversal");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->partialReversal);
					$writer->writeEndElement(); // PartialReversal
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->printer != null)
				{
					$writer->writeStartElement("Printer");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->printer);
					$writer->writeEndElement(); // Printer
				}

				if ($this->m_terminalCapabilities->terminalCapabilitiesFeatures->receipt != null)
				{
					$writer->writeStartElement("Receipt");
					$writer->writeString($this->m_terminalCapabilities->terminalCapabilitiesFeatures->receipt);
					$writer->writeEndElement(); // Receipt
				}
				$writer->writeEndElement(); // Features
			}

			$writer->writeEndElement(); // TerminalCapabilities
			$writer->writeEndElement(); // TerminalProperties
		}

		// FeatureTokensList
		if ($this->m_featureTokens !== null && count($this->m_featureTokens) !== 0)
		{
			$writer->writeStartElement('FeatureTokens');

			foreach ($this->m_featureTokens as $featureToken)
			{
				$writer->writeStartElement('Token');
				$writer->writeString($featureToken->getValue());
				$writer->writeEndElement(); // FeatureToken
			}

			$writer->writeEndElement(); // FeatureTokens
		}

		$writer->writeStartElement('Component');
		$writer->writeAttributeString('version', Client::getCardEaseXMLSDKVersion());
		$writer->writeString(Client::getCardEaseXMLSDKName());
		$writer->writeEndElement(); // Component

		$writer->writeEndElement(); // TerminalDetails

		// CardDetails
		if ($this->isCardDetailsNodeNeeded()){
			$writer->writeStartElement('CardDetails');

			if ($this->m_iccTags !== null && count($this->m_iccTags) !== 0)
			{
				$writer->writeStartElement('ICC');

				if ($this->m_contactless)
				{
					$writer->writeAttributeString('contactless', 'true');
				}

				$writer->writeAttributeString('type', $this->m_iccType);

				foreach ($this->m_iccTags as $tag)
				{
					if ($tag === null)
					{
						continue;
					}

					$writer->writeStartElement('ICCTag');
					$writer->writeAttributeString('tagid', $tag->getID());

					if ($tag->getType() === ICCTagValueType_String)
					{
						$writer->writeAttributeString('type', 'string');
					}

					$writer->writeString($tag->getValue());
					$writer->writeEndElement(); // ICCTag
				}

				$writer->writeEndElement(); // ICC
			}
			else if ($this->m_track2 !== null)
			{
				$writer->writeStartElement('CAT');

				if ($this->m_contactless)
				{
					$writer->writeAttributeString('contactless', 'true');
				}

				if ($this->m_iccFallback)
				{
					$writer->writeAttributeString('fallback', 'true');
				}

				if ($this->m_track1 !== null)
				{
					$writer->writeElementString('Track1', $this->m_track1);
				}

				if ($this->m_track2 !== null)
				{
					$writer->writeElementString('Track2', $this->m_track2);
				}

				if ($this->m_track3 !== null)
				{
					$writer->writeElementString('Track3', $this->m_track3);
				}

				$writer->writeEndElement(); // CAT

			}
			else if ($this->m_pan !== null || $this->m_cardReference !== null)
			{
				$writer->writeStartElement('Manual');

				if ($this->m_manualType !== null)
				{
					$writer->writeAttributeString('type', $this->m_manualType);
				}

				if ($this->m_cardReference !== null)
				{
					$writer->writeElementString('CardReference', $this->m_cardReference);
				}

				if ($this->m_cardHash !== null)
				{
					$writer->writeElementString('CardHash', $this->m_cardHash);
				}

				if ($this->m_pan !== null)
				{
					$writer->writeElementString('PAN', $this->m_pan);
				}

				if ($this->m_expiryDate !== null)
				{
					$writer->writeStartElement('ExpiryDate');

					if ($this->m_expiryDateFormat !== null)
					{
						$writer->writeAttributeString('format',	$this->m_expiryDateFormat);
					}

					$writer->writeString($this->m_expiryDate);
					$writer->writeEndElement(); // ExpiryDate

				}

				if ($this->m_startDate !== null)
				{
					$writer->writeStartElement('StartDate');

					if ($this->m_startDateFormat !== null)
					{
						$writer->writeAttributeString('format', $this->m_startDateFormat);
					}

					$writer->writeString($this->m_startDate);
					$writer->writeEndElement(); // StartDate
				}

				if ($this->m_issueNumber !== null)
				{
					$writer->writeElementString('IssueNumber', $this->m_issueNumber);
				}

				$writer->writeEndElement(); // Manual
			}

			if ($this->m_address !== null || $this->m_csc !== null || $this->m_zipCode !== null)
			{
				$writer->writeStartElement('AdditionalVerification');

				if ($this->m_address !== null)
				{
					$writer->writeElementString('Address', $this->m_address);
				}

				if ($this->m_csc !== null)
				{
					$writer->writeElementString('CSC', $this->m_csc);
				}

				if ($this->m_zipCode !== null)
				{
					$writer->writeElementString('Zip', $this->m_zipCode);
				}

				$writer->writeEndElement(); // AdditionalVerification
			}

			// CardHolderAddress
			if ($this->m_cardHolderAddress !== null && !$this->m_cardHolderAddress->IsEmpty())
			{
				$writer->writeStartElement('Address');

				$writer->writeAttributeString('format', 'standard');

				if ($this->m_cardHolderAddress->getRecipient() !== null)
				{
					$recipient = $this->m_cardHolderAddress->getRecipient();

					for ($id = 0; $id < count($recipient); $id++)
					{
						$writer->writeStartElement('Recipient');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($recipient[$id]);
						$writer->writeEndElement(); // Recipient
					}

					unset($recipient);
				}

				if ($this->m_cardHolderAddress->getLines() !== null)
				{
					$lines = $this->m_cardHolderAddress->getLines();

					for ($id = 0; $id < count($lines); $id++)
					{
						$writer->writeStartElement('Line');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeString($lines[$id]);
						$writer->writeEndElement(); // Line
					}

					unset($lines);
				}

				if ($this->m_cardHolderAddress->getCity() !== null)
				{
					$writer->writeElementString('City', $this->m_cardHolderAddress->getCity());
				}

				if ($this->m_cardHolderAddress->getState() !== null)
				{
					$writer->writeElementString('State', $this->m_cardHolderAddress->getState());
				}

				if ($this->m_cardHolderAddress->getZipCode() !== null)
				{
					$writer->writeElementString('ZipCode', $this->m_cardHolderAddress->getZipCode());
				}

				if ($this->m_cardHolderAddress->getCountry() !== null)
				{
					$writer->writeElementString('Country', $this->m_cardHolderAddress->getCountry());
				}

				$writer->writeEndElement(); // Address
			}

			// CardHolderName
			if (($this->m_cardHolderEmailAddresses !== null && count($this->m_cardHolderEmailAddresses) !== 0) ||
				($this->m_cardHolderName !== null && !$this->m_cardHolderName->isEmpty()) ||
				($this->m_cardHolderPhoneNumbers !== null && count($this->m_cardHolderPhoneNumbers) !== 0))
			{
				$writer->writeStartElement('Contact');

				if ($this->m_cardHolderEmailAddresses !== null && count($this->m_cardHolderEmailAddresses) !== 0)
				{
					$writer->writeStartElement('EmailAddressList');

					for ($id = 0; $id < count($this->m_cardHolderEmailAddresses); $id++)
					{
						$emailAddress = $this->m_cardHolderEmailAddresses[$id];

						$writer->writeStartElement('EmailAddress');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $emailAddress->getType());
						$writer->writeString($emailAddress->getAddress());
						$writer->writeEndElement(); // EmailAddress

						unset($emailAddress);
					}

					$writer->writeEndElement(); // EmailAddressList
				}

				if ($this->m_cardHolderName !== null && !$this->m_cardHolderName->isEmpty())
				{
					$writer->writeStartElement('Name');

					if ($this->m_cardHolderName->getTitle() !== null)
					{
						$writer->writeElementString('Title', $this->m_cardHolderName->getTitle());
					}

					if ($this->m_cardHolderName->getFirstName() !== null)
					{
						$writer->writeElementString('FirstName', $this->m_cardHolderName->getFirstName());
					}

					if ($this->m_cardHolderName->getInitials() !== null)
					{
						$writer->writeElementString('Initials', $this->m_cardHolderName->getInitials());
					}

					if ($this->m_cardHolderName->getLastName() !== null)
					{
						$writer->writeElementString('LastName', $this->m_cardHolderName->getLastName());
					}

					$writer->writeEndElement(); // Name
				}

				if ($this->m_cardHolderPhoneNumbers !== null && count($this->m_cardHolderPhoneNumbers) !== 0)
				{
					$writer->writeStartElement('PhoneNumberList');

					for ($id = 0; $id < count($this->m_cardHolderPhoneNumbers); $id++)
					{
						$phoneNumber = $this->m_cardHolderPhoneNumbers[$id];

						$writer->writeStartElement('PhoneNumber');
						$writer->writeAttributeString('id', $id + 1);
						$writer->writeAttributeString('type', $phoneNumber->getType());
						$writer->writeString($phoneNumber->getNumber());
						$writer->writeEndElement(); // PhoneNumber

						unset($phoneNumber);
					}

					$writer->writeEndElement(); // PhoneNumbers
				}

				$writer->writeEndElement(); // Contact
			}

			// 3-D Secure
			if ($this->m_3DSecureCardHolderEnrolled !== ThreeDSecureCardHolderEnrolled_Empty
				|| $this->m_3DSecureTransactionStatus !== ThreeDSecureTransactionStatus_Empty)
			{
				$writer->writeStartElement('ThreeDSecure');

				if ($this->m_3DSecureVersion !== null) {
					$writer->writeAttributeString('version', $this->m_3DSecureVersion);
				}

				if ($this->m_3DSecureCardHolderEnrolled !== ThreeDSecureCardHolderEnrolled_Empty)
				{
					$writer->writeElementString('CardHolderEnrolled',
						$this->m_3DSecureCardHolderEnrolled);
				}

				if ($this->m_3DSecureDirectoryServerTransactionId !== null) {
					$writer->writeElementString('DirectoryServerTransactionID', $this->m_3DSecureDirectoryServerTransactionId);
				}

				if ($this->m_3DSecureServerTransactionId !== null) {
					$writer->writeElementString('ThreeDSecureServerTransactionID', $this->m_3DSecureServerTransactionId);
				}

				if ($this->m_3DSecureECI !== null)
				{
					$writer->writeElementString('ECI', $this->m_3DSecureECI);
				}

				if ($this->m_3DSecureIAV !== null)
				{
					$writer->writeStartElement('IAV');

					if ($this->m_3DSecureIAVAlgorithm !== null)
					{
						$writer->writeAttributeString('algorithm', $this->m_3DSecureIAVAlgorithm);
					}

					$writer->writeAttributeString('format', $this->m_3DSecureIAVFormat);
					$writer->writeString($this->m_3DSecureIAV);
					$writer->writeEndElement(); // IAV
				}

				if ($this->m_3DSecureTransactionStatus !== ThreeDSecureTransactionStatus_Empty)
				{
					$writer->writeElementString('TransactionStatus', $this->m_3DSecureTransactionStatus);
				}

				if ($this->m_3DSecureXID !== null)
				{
					$writer->writeStartElement('XID');
					$writer->writeAttributeString('format', $this->m_3DSecureXIDFormat);
					$writer->writeString($this->m_3DSecureXID);
					$writer->writeEndElement(); // XID
				}

				$writer->writeEndElement(); // ThreeDSecure
			}

			$writer->writeEndElement(); // CardDetails
		}

		if ($this->m_credentialOnFile !== null){
			$writer->writeStartElement("CredentialOnFile");
			$writer->writeAttributeString("initiatedBy", $this->m_credentialOnFile->getInitiatedBy());

			if ($this->m_credentialOnFile->getInitiatedBy() == TransactionInitiatedBy_Merchant)
			{
				if ($this->m_credentialOnFile->getTransactionReason() == TransactionReason_Empty)
				{
					$writer->writeAttributeString("reason", "NA");
				}
				else{
					$writer->writeAttributeString("reason", $this->m_credentialOnFile->getTransactionReason());
				}
			}
			if ($this->m_credentialOnFile->getCardEaseReference() !== null && strlen($this->m_credentialOnFile->getCardEaseReference()) > 0)
			{
				$writer->writeAttributeString("cardEaseReference", $this->m_credentialOnFile->getCardEaseReference());
			}

			if ($this->m_credentialOnFile->getFirstStore() === TransactionFirstStore_True)
			{
				$writer->writeAttributeString("firstStore", 'true');
			} elseif ($this->m_credentialOnFile->getFirstStore() === TransactionFirstStore_False)
			{
				$writer->writeAttributeString("firstStore", 'false');
			}

			$writer->writeEndElement();//Credential-on-File
		}


		$writer->writeEndElement(); // Request
		$writer->writeEndDocument();
		return $writer->close();
	}

	function getOmniSale(){
		return $this->m_omniSale;
	}

	/**
	 * Get the merchants API Key.
	 *
	 * @return string The API key.
	 * @see setApiKey()
	 */
	function getApiKey(){
		return $this->m_apiKey;
	}

	/**
	 * Gets the identifier for a transaction using the gateway.
	 *
	 * @return string The identifier for a transaction that uses the gateway.
	 * 		   This will be null if the gateway is not used.
	 * @see setTransactionId()
	 */
	function getTransactionId(){
		return $this->m_transactionId;
	}

	/**
	 * Get the applicationID associated with the application.
	 *
	 * @return string The applicationID
	 * @see setApplicationId()
	 */
	function getApplicationId(){
		return $this->m_applicationId;
	}

	/**
	 * Gets the Customer Vault Command associated with this request for the Omni Gateway.
	 * Currently valid values are add-customer or update-customer.
	 *
	 * @return string Customer Vault Command associated with this request.
	 * @see setCustomerVaultCommand()
	 */
	function getCustomerVaultCommand(){
		return $this->m_customerVaultCommand;
	}

	/**
	 * Gets the Customer Vault ID associated with this request for the Omni Gateway.
	 * If the Customer Vault Command is add-customer this is optional, if the Customer Vault ID is not supplied it will be generated.
	 * If the Customer Vault Command is update-customer then this field is mandatory. The value must be one that was
	 * previously used with an add-customer Customer Vault Command.
	 *
	 * @return string Customer Vault ID associated with this request.
	 * @see setCustomerVaultId()
	 */
	function getCustomerVaultId(){
		return $this->m_customerVaultId;
	}

	/**
	 * Gets the Lane ID associated with this request for the Omni Gateway. Multiple merchant processors can be configured
	 * against an Omni Gateway account. This can be used to specify which one of those merchant processors
	 * should be used for this request. This must be a numeric string.
	 *
	 * @return string Lane ID associated with this request.
	 * @see setLaneId()
	 */
	function getLaneId(){
		return $this->m_laneId;
	}

	/**
	 * Gets Merchant Processor ID associated with this request for the Omni Gateway. Multiple merchant processors
	 * can be configured against an account. This can be used to specify which one of those merchant processors
	 * should be used for this request. This must be a numeric string.
	 *
	 * @return string Merchant Processor ID associated with this request.
	 * @see setMerchantProcessorId()
	 */
	function getMerchantProcessorId(){
		return $this->m_merchantProcessorId;
	}

	/**
	 * Gets the 3-D Secure Card Holder Enrollment. This is required
	 * for authorisations in which the liability shift is possible due to
	 * the integration with a 3-D Secure MPI.
	 *
	 * @return string The 3-D Secure Card Holder Enrollment.
	 * @see ThreeDSecureCardHolderEnrolled
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see getThreeDSecureECI()
	 * @see getThreeDSecureIAV()
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureTransactionStatus()
	 * @see getThreeDSecureXID()
	 */


	/**
	 * Supplementary information for both the terminal and integration used to complete this transaction,
	 * such as the device type and card authentication method.  The supply of this information is
	 *  optional for existing integrations and certifications, however newer integrations should populate this data.
	 *
	 */
	function getTerminalCapabilities()
	{
		return $this->m_terminalCapabilities;
	}

	function setTerminalCapabilities($value) {
		$this->m_terminalCapabilities = $value;
	}


	function getThreeDSecureCardHolderEnrolled() {
		return $this->m_3DSecureCardHolderEnrolled;
	}
	
	/**
	 * Gets the 3-D Secure Directory Server Transaction ID.
	 * This is required for 3-D Secure Version 2.
	 * This is formatted as a GUID.
	 *
	 * @return string The 3-D Secure Directory Server Transaction ID.
	 * @see setThreeDSecureDirectoryServerTransactionId()
	 * @see getThreeDSecureServerTransactionId()
	 * @see setThreeDSecureServerTransactionId()
	 * @see getThreeDSecureVersion()
	 * @see setThreeDSecureVersion()
	 */
	function getThreeDSecureDirectoryServerTransactionId() {
		return $this->m_3DSecureDirectoryServerTransactionId;
	}

	/**
	 * Gets the 3-D Secure Electronic Commerce Indicator. This is required
	 * for authorisations in which a liability shift is possible due to the
	 * integration with a 3-D Secure MPI. It is a numeric string with a
	 * length of 2 characters.
	 *
	 * @return string The 3-D Secure Electronic Commerce Indicator.
	 * @see setThreeDSecureECI()
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see getThreeDSecureIAV()
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureTransactionStatus()
	 * @see getThreeDSecureXID()
	 */
	function getThreeDSecureECI() {
		return $this->m_3DSecureECI;
	}

	/**
	 * Gets the 3-D Secure Authentication Verification Value. This is
	 * required for authorisations in which the liability shift is possible
	 * due to the integration with a 3-D Secure MPI. It is an alphanumeric
	 * string with a maximum size of 32 characters.
	 * <p>
	 * With Verified by Visa this is called CAVV.
	 * <p>
	 * With MasterCard SecureCode this is called AAV.
	 *
	 * @return string The 3-D Secure Authentication Verification Value.
	 * @see setThreeDSecureIAV()
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see getThreeDSecureECI()
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureIAVFormat()
	 * @see getThreeDSecureTransactionStatus()
	 * @see getThreeDSecureXID()
	 */
	function getThreeDSecureIAV() {
		return $this->m_3DSecureIAV;
	}

	/**
	 * Gets the 3-D Secure Authentication Verification algorithm. This is
	 * required for authorisations in which the liability shift is possible
	 * due to the integration with a 3-D Secure MPI.
	 *
	 * @return string The 3-D Secure Authentication Verification algorithm.
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureECI()
	 * @see getThreeDSecureIAV()
	 * @see getThreeDSecureIAVFormat()
	 * @see getThreeDSecureTransactionStatus()
	 * @see getThreeDSecureXID()
	 */
	function getThreeDSecureIAVAlgorithm() {
		return $this->m_3DSecureIAVAlgorithm;
	}

	/**
	 * Gets the 3-D Secure Authentication Verification format. This
	 * can be either Base64 or AsciiHex. The default is Base64.
	 *
	 * @return string The 3-D Secure Authentication Verification format.
	 * @see setThreeDSecureIAVFormat()
	 * @see getThreeDSecureIAV()
	 */
	function getThreeDSecureIAVFormat() {
		return $this->m_3DSecureIAVFormat;
	
	}
	
	/** Gets the 3-D Secure Server Transaction ID.
	 * This is formatted as a GUID.
	 *
	 * @return string The 3-D Secure Server Transaction ID.
	 * @see setThreeDSecureServerTransactionId()
	 * @see getThreeDSecureDirectoryServerTransactionId()
	 * @see setThreeDSecureDirectoryServerTransactionId()
	 * @see getThreeDSecureVersion()
	 * @see setThreeDSecureVersion()
	 */
	function getThreeDSecureServerTransactionId() {
		return $this->m_3DSecureServerTransactionId;
	}

	/**
	 * Gets the 3-D Secure Transaction Status. This is required for
	 * authorisations in which the liability shift is possible due to the
	 * integration with a 3-D Secure MPI.
	 *
	 * @return string The 3-D Secure Transaction Status.
	 * @see ThreeDSecureTransactionStatus
	 * @see setThreeDSecureTransactionStatus()
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see getThreeDSecureECI()
	 * @see getThreeDSecureIAV()
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureXID()
	 */
	function getThreeDSecureTransactionStatus() {
		return $this->m_3DSecureTransactionStatus;
	}
	
	/**
	 * Gets the 3-D Secure version being used.
	 * This value can be retrieved from the 3-D Secure Server.
	 * It is required for 3-D Secure version 2 and above.
	 *
	 * @return string The 3-D Secure version.
	 * @see setThreeDSecureVersion(String)
	 * @see getThreeDSecureDirectoryServerTransactionId()
	 * @see setThreeDSecureDirectoryServerTransactionId(String)
	 * @see getThreeDSecureServerTransactionId()
	 * @see setThreeDSecureServerTransactionId(String)
	 */
	function getThreeDSecureVersion() {
		return $this->m_3DSecureVersion;
	}

	/**
	 * Gets the 3-D Secure Transaction Identifier. This is required for
	 * authorisations in which the liability shift is possible due to the
	 * integration with a 3-D Secure MPI. It is an alphanumeric string
	 * with a maximum length of of 28 characters.
	 *
	 * @return string The 3-D Secure Transaction Identifier.
	 * @see setThreeDSecureXID()
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see getThreeDSecureECI()
	 * @see getThreeDSecureIAV()
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see getThreeDSecureTransactionStatus()
	 * @see getThreeDSecureXIDFormat()
	 */
	function getThreeDSecureXID() {
		return $this->m_3DSecureXID;
	}

	/**
	 * Gets the 3-D Secure Transaction Identifier format. This
	 * can be either Base64, Ascii or AsciiHex. The default is Ascii.
	 *
	 * @return string The 3-D Secure Transaction Identifier format.
	 * @see setThreeDSecureXIDFormat()
	 * @see getThreeDSecureXID()
	 */
	function getThreeDSecureXIDFormat() {
		return $this->m_3DSecureXIDFormat;
	}

	/**
	 * Gets the address details associated with the card in this request.
	 * This can be used for additional verification of the card details
	 * with the issuer. The content of this is dependant upon the country
	 * in which authorisation is being performed. Typically it is the
	 * first line of the address where the card is registered. This is an
	 * alphanumeric string. It is optional.
	 *
	 * @return string The address details associated with the card in this
	 *	request. If null is returned the address has not been
	 *	specified.
	 * @see setAddress()
	 */
	function getAddress() {
		return $this->m_address;
	}

	/**
	 * Gets the amount associated with this request. This may be in major
	 * or minor units. For example 1.23 GBP (Major) === 123 GBP (Minor).
	 * The amount is mandatory for Auth and Offline requests.
	 *
	 * @return string The amount associated with this request. If null is
	 *	returned the amount has not been specified.
	 * @see setAmount()
	 * @see setAmount()
	 * @see AmountUnit
	 * @see getAmountUnit()
	 * @see setAmountUnit()
	 */
	function getAmount() {
		return $this->m_amount;
	}

	/**
	 * Gets the units in which the amount associated with this request is
	 * specified. This may be Major or Minor. For example 1.23 GBP (Major)
	 * === 123 GBP (Minor). The default is Minor.
	 *
	 * @return string The units in which the amount associated with this request
	 *	is specified. If null is returned the amount unit for this
	 *	request has not been specified.
	 * @see AmountUnit
	 * @see setAmountUnit()
	 * @see getAmount()
	 * @see setAmount()
	 * @see setAmount()
	 */
	function getAmountUnit() {
		return $this->m_amountUnit;
	}

    /**
     * Gets the AuthCode for a transaction that has been approved by some other means.
     * Optional for Offline requests and VoiceReferral requests where transaction
     * has been approved by the merchant offline.
     * Mandatory for VoiceReferral requests where the transaction has been
     * approved by the acquiring bank over the phone.
	 * @return string The AuthCode for a transaction that has been approved by some other means.
     */
	function getAuthCode() {
		return $this->m_authCode;
	}

	/**
	 * Gets whether an authorisation request is automatically confirmed
	 * without a confirmation request. By default is is false, a
	 * confirmation request will be required for this transaction.
	 *
	 * @return bool Whether an authorisation request is automatically confirmed
	 *	without a confirmation request.
	 * @see setAutoConfirm()
	 */
	function getAutoConfirm() {
		return $this->m_autoConfirm;
	}

    /**
     * Gets the batch reference associated with this request.
     * <p>
     * This allows the user to attach a reference to a transaction
     * to help group similar transactions.
     *
     * @return string The batch reference associated with this request.
     * @see setBatchReference()
     */
    function getBatchReference() {
        return $this->m_batchReference;
    }

	/**
	 * Gets the CardEase reference associated with this request. This is a
	 * unique reference that has been obtained from the CardEase platform
	 * during previous requests. This is an alphanumeric string with a
	 * fixed length of 36 characters. This is mandatory for Conf, Refund
	 * and Void requests.
	 *
	 * @return string The CardEaseXML reference associated with this request. If
	 *	null is returned the CardEase reference has not been specified.
	 * @see setCardEaseReference()
	 */
	function getCardEaseReference() {
		return $this->m_cardEaseReference;
	}

	/**
	 * Gets the version of CardEaseXML that the client supports. The
	 * default is to '1.0.0'. This is mandatory for all requests.
	 *
	 * @return string The version of CardEaseXML that the client supports. If
	 *	null is returned the version has not been specified.
	 */
	function getCardEaseXMLVersion() {
		return $this->m_cardEaseXMLVersion;
	}

	/**
	 * Gets the card hash returned from a previous transaction that
	 * references the card details that should also be used for this
	 * transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 28 characters.
	 * Used in conjunction with the CardReference property. The benefit of
	 * being able to reference a previously used card is that an
	 * integrator need not store actual card details on their system for
	 * repeat transactions. This reduces the risk of card information
	 * being compromised, and reduces the integrators PCI requirements.
	 *
	 * @return string The card hash returned from a previous transaction that
	 *	references the card details that should also be used for this
	 *	transaction.
	 * @see setCardHash()
	 * @see getCardReference()
	 * @see setCardReference()
	 */
	function getCardHash() {
		return $this->m_cardHash;
	}

	/**
	 * Gets the cardholder's address.
	 * @return Address The cardholder's address.
	 */
	function getCardHolderAddress() {
		return $this->m_cardHolderAddress;
	}

	/**
	 * Gets the cardholder's email addresses.
	 * @return Address The cardholder's email addresses.
	 */
	function getCardHolderEmailAddresses() {
		return $this->m_cardHolderEmailAddresses;
	}

	/**
	 * Gets the cardholder's name.
	 * @return Name The cardholder's name.
	 */
	function getCardHolderName() {
		return $this->m_cardHolderName;
	}

	/**
	 * Gets the cardholder's phone numbers.
	 * @return array The cardholder's phone numbers.
	 */
	function getCardHolderPhoneNumbers() {
		return $this->m_cardHolderPhoneNumbers;
	}

	/**
	 * Gets the card reference returned from a previous transaction that
	 * references the card details that should also be used for this
	 * transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 36 characters.
	 * Used in conjunction with the CardHash property. The benefit of being
	 * able to reference a previously used card is that an integrator need
	 * not store actual card details on their system for repeat
	 * transactions. This reduces the risk of card information being
	 * compromised, and reduces the integrators PCI requirements.
	 *
	 * @return string The card reference returned from a previous transaction
	 *	that references the card details that should also be used for
	 *	this transaction.
	 * @see setCardReference()
	 * @see getCardHash()
	 * @see setCardHash()
	 */
	function getCardReference() {
		return $this->m_cardReference;
	}

	/**
	 * Whether the transaction was a contactless transaction.
	 * <p>
	 * Default is false.
	 */
	function getContactless() {
		return $this->m_contactless;
	}
	
	/**
	 * Gets the security code associated with the card in this request.
	 * This can be used for additional verification with the issuer. This
	 * is also referred to as CVV, CVC and CV2. This is an numeric
	 * string with a minimum length of 3 characters and a maximum length of
	 * 4 characters. This is optional.
	 * If the CSC validation fails the authorisation may be automatically declined or may continue to be approved.  If the authorisation is approved the CSC result should be checked.
	 * <p>
	 * On Visa and MasterCard this is the last three digits of the
	 * signature strip.
	 * <p>
	 * On Amex this is the four digits printed above the PAN.
	 *
	 * @return string The security code associated with the card in this request.
	 *	If null is returned the security code has not been specified.
	 * @see setCSC()
	 */
	function getCSC() {
		return $this->m_csc;
	}

	/**
	 * Gets the ISO currency code or mnemonic associated with this request
	 * amount. For example, GBP or USD. If this is not specified the
	 * currency code held against the terminal ID in the CardEase platform
	 * is assumed. This is an alphanumeric string with a fixed length of 3
	 * characters.
	 * <p>
	 * Examples of recognised currency codes and mnemonics:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Currency Code</th>
	 * <th>Mnemonic</th>
	 * <th>Description</th>
	 * </tr>
	 * <tr>
	 * <td>826</td>
	 * <td>GBP</td>
	 * <td>United Kingdom, Pound</td>
	 * </tr>
	 * <tr>
	 * <td>840</td>
	 * <td>USD</td>
	 * <td>United States, Dollar</td>
	 * </tr>
	 * <tr>
	 * <td>978</td>
	 * <td>EUR</td>
	 * <td>European Euro</td>
	 * </tr>
	 * <tr>
	 * <td>124</td>
	 * <td>CAD</td>
	 * <td>Canada, Dollar</td>
	 * </tr>
	 * <tr>
	 * <td>392</td>
	 * <td>JPY</td>
	 * <td>Japan, Yen</td>
	 * </tr>
	 * <tr>
	 * <td>208</td>
	 * <td>DKK</td>
	 * <td>Denmark, Krone</td>
	 * </tr>
	 * <tr>
	 * <td>756</td>
	 * <td>CHF</td>
	 * <td>Switzerland, Franc</td>
	 * </tr>
	 * <tr>
	 * <td>752</td>
	 * <td>SEK</td>
	 * <td>Sweden, Krona</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The ISO currency code or mnemonic associated with this
	 *	request amount. If null is returned the currency code has not
	 *	been specified.
	 * @see setCurrencyCode()
	 */
	function getCurrencyCode() {
		return $this->m_currencyCode;
	}

	/**
	 * Gets whether the transaction is a debt repayment. Defaults to false.
	 * @return bool Whether the transaction is a debt repayment.
	 * @see setDebtRepayment()
	 */
	function getDebtRepayment() {
		return $this->m_debtRepayment;
	}

	/**
	 * Gets the delivery address.
	 * @return Address The delivery address.
	 */
	function getDeliveryAddress() {
		return $this->m_deliveryAddress;
	}

	/**
	 * Gets the delivery email addresses.
	 * @return array The delivery email addresses.
	 */
	function getDeliveryEmailAddresses() {
		return $this->m_deliveryEmailAddresses;
	}

	/**
	 * Gets the delivery name.
	 * @return Name The delivery name.
	 */
	function getDeliveryName() {
		return $this->m_deliveryName;
	}

	/**
	 * Gets the delivery phone numbers.
	 * @return array The delivery phone numbers.
	 */
	function getDeliveryPhoneNumbers() {
		return $this->m_deliveryPhoneNumbers;
	}

	/**
	 * Gets the Credential-on-File associated with the request.
	 * @return The Credential-on-File associated with the request.
	 * @see #setCredentialOnFile(CredentialOnFile)
	 */
	function getCredentialOnFile() {
		return $this->m_credentialOnFile;
	}

	/**
	 * Gets the expiry date associated with the card in this request. This
	 * is a character string with a maximum length of 10 characters.
	 * This is mandatory for manual authorisation requests (such as Card
	 * Not Present). This should match the expiry date format.
	 *
	 * @return string The expiry date associated with the card in this request.
	 *	If null is returned the expiry date has not been specified.
	 * @see setExpiryDate()
	 * @see getExpiryDateFormat()
	 * @see setExpiryDateFormat()
	 * @see getStartDate()
	 * @see setStartDate()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function getExpiryDate() {
		return $this->m_expiryDate;
	}

	/**
	 * Gets the expiry date format associated with the card in this
	 * request. This is a character string with a maximum length of 10
	 * characters. This is mandatory for manual authorisation requests
	 * (such as Card Not Present). By default this is 'yyMM'. This should
	 * match the format of the expiry date and can include separators such
	 * as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The expiry date format associated with the card in this
	 *	request. If null is returned the expiry date has not been
	 *	specified.
	 * @see setExpiryDateFormat()
	 * @see getExpiryDate()
	 * @see setExpiryDate()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function getExpiryDateFormat() {
		return $this->m_expiryDateFormat;
	}

	/**
	 * Gets the list of extended properties associated with this request.
	 *
	 * @return array The list of extended properties associated with this request.
	 * @see addExtendedProperty()
	 * @see setExtendedProperties()
	 */
	function getExtendedProperties() {
		return $this->m_extendedProperties;
	}

	/**
	 * Gets the list of feature tokens associated with this request.
	 *
	 * @return array The list of feature tokens associated with this request.
	 * @see addFeatureToken()
	 * @see setFeatureTokens()
	 */
	function getFeatureTokens() {
		return $this->m_featureTokens;
	}

	/**
	 * Gets whether an ICC fallback has occurred. Default is false.
	 *
	 * @return bool Whether an ICC fallback has occurred.
	 * @see setICCFallback()
	 */
	function getICCFallback() {
		return $this->m_iccFallback;
	}

	/**
	 * Gets the ICC management function associated with an ICCManagement
	 * request. This must be set for an ICCManagement request. It is an
	 * alphanumeric string.  Obsoleted by SubType_
	 *
	 * @return string The ICC management function associated with an ICC
	 *	Management request. If null is returned no management function
	 *	has been specified.
	 * @see setICCManagementFunction()
	 * @see getRequestType()
	 * @see setRequestType()
	 * @deprecated
	 */
	function getICCManagementFunction() {
		return $this->m_subType;
	}

	/**
	 * Gets the list of ICC tags associated with this request. Each ICC tag
	 * has an id, type and value. For example, a tag of
	 * 0x9f02/AsciiHex/000000000100 is using to specify the transaction
	 * amount. These are mandatory for an EMV transaction.
	 *
	 * @return array The list of ICC tags associated with this request. If null
	 *	is returned no ICC tags have been specified.
	 * @see ICCTag
	 * @see addICCTag()
	 * @see setICCTags()
	 * @see getICCType()
	 * @see setICCType()
	 */
	function getICCTags() {
		return $this->m_iccTags;
	}

	/**
	 * Gets the type of ICC transaction associated with this request. This
	 * is an alphanumeric string. This is mandatory for ICC authorisations
	 * and by default is 'EMV'. An ICC transaction must have associated
	 * ICC tags.
	 *
	 * @return string The type of ICC transaction associated with this request.
	 *	If null is returned no ICC transaction type has been specified.
	 * @see setICCType()
	 * @see ICCTag
	 * @see addICCTag()
	 * @see getICCTags()
	 * @see setICCTags()
	 */
	function getICCType() {
		return $this->m_iccType;
	}

	/**
	 * Gets the invoice address.
	 * @return Address The invoice address.
	 */
	function getInvoiceAddress() {
		return $this->m_invoiceAddress;
	}

	/**
	 * Gets the invoice email addresses.
	 * @return string The invoice email addresses.
	 */
	function getInvoiceEmailAddresses() {
		return $this->m_invoiceEmailAddresses;
	}

	/**
	 * Gets the invoice name.
	 * @return Name The invoice name.
	 */
	function getInvoiceName() {
		return $this->m_invoiceName;
	}

	/**
	 * Gets the invoice phone numbers.
	 * @return array The invoice phone numbers.
	 */
	function getInvoicePhoneNumbers() {
		return $this->m_invoicePhoneNumbers;
	}

	/**
	 * Gets the issue number associated with the card in this request.
	 * This is a numeric string with a maximum length of 2 characters. The
	 * requirement for this is dependant upon the card scheme associated
	 * with the card and must be exactly as found on the card (including
	 * any leading 0's).
	 *
	 * @return string The issue number associated with the card in this request.
	 *	If null is returned no issue number has been specified.
	 * @see setIssueNumber()
	 */
	function getIssueNumber() {
		return $this->m_issueNumber;
	}

	/**
	 * Gets the machine reference associated with this request. This is
	 * mandatory if the TerminalID is a Master Terminal ID used to
	 * represent multiple terminals. This is an alphanumeric string with a
	 * maximum length of 50 characters.
	 *
	 * @return string The machine reference associated with this request. If null
	 *	is returned no machine reference has been specified.
	 * @see setMachineReference()
	 * @see getTerminalID()
	 * @see setTerminalID()
	 */
	function getMachineReference() {
		return $this->m_machineReference;
	}

	/**
	 * Gets the type of manual authorisation being used for this request.
	 * By default this is 'cnp' (i.e. Card Not Present). This is an
	 * alphanumeric string. This is mandatory for manual authorisations.
	 *
	 * @return string The type of manual authorisation being used for this
	 *	request. If null is returned no manual authorisation type has
	 *	been specified.
	 * @see setManualType()
	 */
	function getManualType() {
		return $this->m_manualType;
	}

	/**
	 * Gets the date and/or time when the transaction was processed offline.
	 * @return string The date and/or time when the transaction was processed offline.
	 */
	function getOfflineDateTime() {
		return $this->m_offlineDateTime;
	}

	/**
	 * Gets the format of the date and/or time of the transaction if processed offline.
	 * <p>
	 * This is a character string with a maximum length of 16 characters.
     * By default this is 'ddMMyy hhmmss'. This should match the format of the
     * offline date/time and can include separators such as - and /. The available
     * options are shown in the following table:
     *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * <tr>
	 * <td>hh</td>
	 * <td>Hour</td>
	 * <td>12</td>
	 * </tr>
	 * <tr>
	 * <td>mm</td>
	 * <td>Minute</td>
	 * <td>54</td>
	 * </tr>
	 * <tr>
	 * <td>ss</td>
	 * <td>Second</td>
	 * <td>22</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The format of the date and/or time of the transaction if processed offline.
	 * @see setOfflineDateTimeFormat()
	 * @see getOfflineDateTime()
	 * @see setOfflineDateTime()
	 */
	function getOfflineDateTimeFormat() {
		return $this->m_offlineDateTimeFormat;
	}

	/**
	 * Gets the originating IP address of the request.  E.g. client browser.
	 *
	 * @return string The originating IP address of the request.  If null is returned no
	 * IP address has been specified.
	 * @see setOriginatingIPAddress()
	 */
	function getOriginatingIPAddress() {
		return $this->m_originatingIPAddress;
	}

	/**
	 * Gets the PAN (Primary Account Number) associated with the card in
	 * this request. This is a numeric string with a minimum length of 12
	 * characters and a maximum length of 19 characters. This is a
	 * requirement for manual authorisation requests (such as Card Not
	 * Present).
	 *
	 * @return string The PAN (Primary Account Number) associated with the card in
	 *	this request. If null is returned no PAN has been specified.
	 * @see setPAN()
	 */
	function getPAN() {
		return $this->m_pan;
	}

	/**
	 * Gets the list of products.
	 * @return array(Product) The list of products.
	 */
	function getProducts() {
		return $this->m_products;
	}

	/**
	 * Gets the date upon which the recurring action should occur. Applicable to
	 * AdHoc and Cancel requests. If not specified the current date is used. The
	 * CardEaseReference of the recurring transaction must be supplied as an
	 * input.
	 *
	 * @see setRecurringActionDate()
	 * @see getRecurringActionDate()
	 * @see getSubType()
	 * @see getCardEaseReference()
	 * @return string The date upon which the recurring action should occur.
	 */
	function getRecurringActionDate() {
		return $this->m_recurringActionDate;
	}

	/**
	 * Gets the format of the date upon which the recurring action should occur.
	 * This is a character string with a maximum length of 10 characters. This
	 * should match the format of the action date and can include separators
	 * such as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @see getRecurringActionDate()
	 * @see setRecurringActionDateFormat()
	 * @return string The format of the date upon which the recurring action should
	 *         occur.
	 */
	function getRecurringActionDateFormat() {
		return $this->m_recurringActionDateFormat;
	}

	/**
	 * Gets the final amount that should be taken when a recurring transaction
	 * completes. This may be in major or minor units. For example 1.23 GBP
	 * (Major) === 123 GBP (Minor). If not specified the RecurringRegularAmount
	 * is used.
	 *
	 * @see setRecurringFinalAmount()
	 * @see getRecurringFinalAmountUnit()
	 * @see getRecurringFinalDate()
	 * @see getRecurringRegularAmount()
	 * @return string The final amount that should be taken when a recurring
	 *         transaction completes.
	 */
	function getRecurringFinalAmount() {
		return $this->m_recurringFinalAmount;
	}

	/**
	 * Gets the units of the final recurring amount. This may be Major or Minor.
	 * For example 1.23 GBP (Major) === 123 GBP (Minor). The default is Minor.
	 *
	 * @see setRecurringFinalAmountUnit()
	 * @see getRecurringFinalAmount()
	 * @return string The units of the final recurring amount.
	 */
	function getRecurringFinalAmountUnit() {
		return $this->m_recurringFinalAmountUnit;
	}

	/**
	 * Gets the date upon which the recurring transactions should complete and a
	 * final payment taken. If not specified the current date is used.
	 *
	 * @see getRecurringFinalDateFormat()
	 * @see setRecurringFinalDate()
	 * @return string The date upon which the recurring transactions should complete
	 *         and a final payment taken.
	 */
	function getRecurringFinalDate() {
		return $this->m_recurringFinalDate;
	}

	/**
	 * Gets the format of the date upon which the recurring transactions should
	 * complete and a final payment taken. This is a character string with a
	 * maximum length of 10 characters. This should match the format of the
	 * action date and can include separators such as - and /. The available
	 * options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @see getRecurringFinalDate()
	 * @see setRecurringFinalDateFormat()
	 * @return string The format of the date upon which the recurring transactions
	 *         should complete and a final payment taken.
	 */
	function getRecurringFinalDateFormat() {
		return $this->m_recurringFinalDateFormat;
	}

	/**
	 * Gets the initial amount that should be taken before a recurring
	 * transaction starts. This may be in major or minor units. For example 1.23
	 * GBP (Major) === 123 GBP (Minor).
	 *
	 * @see getRecurringInitialAmountUnit()
	 * @see getRecurringInitialDate()
	 * @see setRecurringInitialAmount()
	 * @return string The initial amount that should be taken before a recurring
	 *         transaction starts.
	 */
	function getRecurringInitialAmount() {
		return $this->m_recurringInitialAmount;
	}

	/**
	 * Gets the units of the initial recurring amount. This may be Major or
	 * Minor. For example 1.23 GBP (Major) === 123 GBP (Minor). The default is
	 * Minor.
	 *
	 * @return string The units of the initial recurring amount.
	 * @see getRecurringInitialAmount()
	 * @see setRecurringInitialAmountUnit()
	 */
	function getRecurringInitialAmountUnit() {
		return $this->m_recurringInitialAmountUnit;
	}

	/**
	 * Gets the date upon which the recurring transactions should be initialised
	 * and a initial payment taken. If not specified the current date is used.
	 *
	 * @return string The date upon which the recurring transactions should be
	 *         initialised and a initial payment taken.
	 * @see getRecurringInitialDateFormat()
	 * @see setRecurringInitialDate()
	 */
	function getRecurringInitialDate() {
		return $this->m_recurringInitialDate;
	}

	/**
	 * Gets the format of the date upon which the recurring transactions should
	 * be initialised and a initial payment taken. This is a character string
	 * with a maximum length of 10 characters. This should match the format of
	 * the action date and can include separators such as - and /. The available
	 * options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The format of the date upon which the recurring transactions
	 *         should be initialised and a initial payment taken.
	 * @see getRecurringInitialDate()
	 * @see setRecurringInitialDateFormat()
	 */
	function getRecurringInitialDateFormat() {
		return $this->m_recurringInitialDateFormat;
	}

	/**
	 * Gets the regular amount that should be taken when a recurring transaction
	 * occurs. This may be in major or minor units. For example 1.23 GBP (Major) ==
	 * 123 GBP (Minor).
	 *
	 * @return string The regular amount that should be taken when a recurring
	 *         transaction occurs.
	 * @see getRecurringRegularAmountUnit()
	 * @see getRecurringRegularFrequency()
	 * @see setRecurringRegularAmount()
	 */
	function getRecurringRegularAmount() {
		return $this->m_recurringRegularAmount;
	}

	/**
	 * Gets the units of the regular recurring amount. This may be Major or
	 * Minor. For example 1.23 GBP (Major) === 123 GBP (Minor). The default is
	 * Minor.
	 *
	 * @return string The units of the regular recurring amount.
	 * @see getRecurringRegularAmount()
	 * @see setRecurringRegularAmountUnit()
	 */
	function getRecurringRegularAmountUnit() {
		return $this->m_recurringRegularAmountUnit;
	}

	/**
	 * Gets the date upon which the recurring transactions should end. If not
	 * specified the transactions are taken until the maximum number of payments
	 * is reached, the final date is reached or the recurring transaction is
	 * cancelled.
	 *
	 * @return string The date upon which the recurring transactions should end.
	 * @see getRecurringRegularEndDateFormat()
	 * @see setRecurringRegularEndDate()
	 */
	function getRecurringRegularEndDate() {
		return $this->m_recurringRegularEndDate;
	}

	/**
	 * Gets the format of the date upon which the recurring transactions should
	 * end. This is a character string with a maximum length of 10 characters.
	 * This should match the format of the action date and can include
	 * separators such as - and /. The available options are shown in the
	 * following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The format of the date upon which the recurring transactions
	 *         should end.
	 * @see getRecurringRegularEndDate()
	 * @see setRecurringRegularEndDateFormat()
	 */
	function getRecurringRegularEndDateFormat() {
		return $this->m_recurringRegularEndDateFormat;
	}

	/**
	 * Gets the frequency of the recurring transaction.
	 *
	 * @see Frequency
	 * @see getRecurringRegularFrequencyRounding()
	 * @see setRecurringRegularFrequency()
	 * @return string The frequency of the recurring transaction.
	 */
	function getRecurringRegularFrequency() {
		return $this->m_recurringRegularFrequency;
	}

	/**
	 * Gets the rounding to apply to the frequency calculations on boundaries.
	 * The default is Down.
	 *
	 * @return string The rounding to apply to the frequency calculations on
	 *         boundaries.
	 * @see FrequencyRounding
	 * @see getRecurringRegularFrequency()
	 * @see setRecurringRegularFrequencyRounding()
	 */
	function getRecurringRegularFrequencyRounding() {
		return $this->m_recurringRegularFrequencyRounding;
	}

	/**
	 * Gets the maximum number of regular payments. If specified as 0
	 * transactions will be taken until the end date is reached, the schedule is
	 * cancelled or the final date is reached.
	 *
	 * @return string The maximum number of regular payments.
	 * @see Frequency
	 * @see getRecurringRegularEndDate()
	 * @see getRecurringFinalDate()
	 * @see setRecurringRegularMaximumPayments()
	 */
	function getRecurringRegularMaximumPayments() {
		return $this->m_recurringRegularMaximumPayments;
	}

	/**
	 * Gets the date upon which the recurring transactions should start. If not
	 * specified the current date is used.
	 *
	 * @return string The date upon which the recurring transactions should start.
	 * @see getRecurringRegularStartDateFormat()
	 * @see setRecurringRegularStartDate()
	 */
	function getRecurringRegularStartDate() {
		return $this->m_recurringRegularStartDate;
	}

	/**
	 * Gets the format of the date upon which the recurring transactions should
	 * start. This is a character string with a maximum length of 10 characters.
	 * This should match the format of the action date and can include
	 * separators such as - and /. The available options are shown in the
	 * following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The format of the date upon which the recurring transactions
	 *         should start.
	 * @see getRecurringRegularStartDate()
	 * @see setRecurringRegularStartDateFormat()
	 */
	function getRecurringRegularStartDateFormat() {
		return $this->m_recurringRegularStartDateFormat;
	}

	/**
	 * Gets the type of this request. This can be Auth, Conf, Test and so
	 * on. By default this is 'Auth'. This is mandatory for all requests.
	 *
	 * @return string The type of this request. If null is returned no request
	 *	type has been specified.
	 * @see setRequestType()
	 * @see RequestType
	 */
	function getRequestType() {
		return $this->m_requestType;
	}

	/**
	 * Gets the name of the software/firmware using the CardEaseXML SDK.
	 * This is an alphanumeric string with a maximum length of 50
	 * characters. This is mandatory for all requests.
	 *
	 * @return string The name of the software/firmware using the CardEaseXML
	 *	SDK. If null is returned no software name has been specified.
	 * @see setSoftwareName()
	 */
	function getSoftwareName() {
		return $this->m_softwareName;
	}

	/**
	 * Gets the version of the software/firmware using the CardEaseXML SDK.
	 * This is an alphanumeric string with a maximum length of 20
	 * characters. This is mandatory for all requests.
	 *
	 * @return string The version of the software/firmware using the CardEaseXML
	 *	SDK. If null is returned no software version has been specified.
	 * @see setSoftwareVersion()
	 */
	function getSoftwareVersion() {
		return $this->m_softwareVersion;
	}

	/**
	 * Gets the start date associated with the card in this request. This
	 * is a character string with a maximum length of 10 characters.
	 * This is optional for manual authorisation requests (such as Card Not
	 * Present). This should match the start date format.
	 *
	 * @return string The start date associated with the card in this request. If
	 *	null is returned no start date has been specified.
	 * @see setStartDate()
	 * @see getStartDateFormat()
	 * @see setStartDateFormat()
	 * @see getExpiryDate()
	 * @see setExpiryDate()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function getStartDate() {
		return $this->m_startDate;
	}

	/**
	 * Gets the start date format associated with the card in this request.
	 * This is a character string with a maximum length of 10
	 * characters. This is optional for manual authorisation requests
	 * (such as Card Not Present). By default this is 'yyMM'. This should
	 * match the format of the start date and can include separators such
	 * as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The start date format associated with the card in this
	 *	request. If null is returned no start date format has been
	 *	specified.
	 * @see setStartDateFormat()
	 * @see getStartDate()
	 * @see setStartDate()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function getStartDateFormat() {
		return $this->m_startDateFormat;
	}

	/**
	 * Gets the sub type of the request. Currently applicable to ICCManagement
	 * and Recurring requests.
	 *
	 * @return string The sub type of the request. If null is returned no sub type has
	 *         been specified.
	 * @see setSubType()
	 * @see RequestType
	 */
	function getSubType() {
		return $this->m_subType;
	}

	/**
	 * Gets the terminal ID associated with the machine performing this
	 * request. This is mandatory for all requests and is supplied by
	 * Creditcall Ltd. It is unique across all CardEase
	 * products. It is a numeric string with a fixed length of 8
	 * characters.
	 *
	 * @return string The terminal ID associated with the machine performing this
	 *	request. If null is returned no terminal ID has been specified.
	 * @see setTerminalID()
	 */
	function getTerminalID() {
		return $this->m_terminalID;
	}

	/**
	 * Gets the track 1 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 79 characters. This is optional.
	 *
	 * @return string The track 1 associated with the card in a magnetic stripe
	 *	authorisation. If null is returned no track 1 has been
	 *	specified.
	 * @see setTrack1()
	 */
	function getTrack1() {
		return $this->m_track1;
	}

	/**
	 * Gets the track 2 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 40 characters. This should include start and end sentinels (and
	 * separator character if provided). It is mandatory for magnetic
	 * stripe authorisation.
	 *
	 * @return string The track 2 associated with the card in a magnetic stripe
	 *	authorisation. If null is returned no track 2 has been
	 *	specified.
	 * @see setTrack2()
	 */
	function getTrack2() {
		return $this->m_track2;
	}

	/**
	 * Gets the track 3 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 107 characters. This is optional.
	 *
	 * @return string The track 3 associated with the card in a magnetic stripe
	 *	authorisation. If null is returned no track 3 has been
	 *	specified.
	 * @see setTrack3()
	 */
	function getTrack3() {
		return $this->m_track3;
	}

	/**
	 * Gets the transaction key associated with this request. This is
	 * mandatory for all requests and is supplied by Creditcall
	 * Ltd for a terminal or number of terminals. It must be in
	 * exactly the same case as provided by Creditcall. This is an
	 * alphanumeric string with a maximum length of 20 characters.
	 *
	 * @return string The transaction key associated with this request. If null is
	 *	returned no transaction key has been specified.
	 * @see setTransactionKey()
	 */
	function getTransactionKey() {
		return $this->m_transactionKey;
	}

	/**
	 * Gets the user reference associated with this request. This allows a
	 * user to attach their own reference against a request. This is an
	 * alphanumeric string with a maximum length of 50 characters. This is
	 * optional for all requests.
	 *
	 * @return string The user reference associated with this request. If null is
	 *	returned no user reference has been specified.
	 * @see setUserReference()
	 */
	function getUserReference() {
		return $this->m_userReference;
	}

	/**
	 * Gets the result of a voice referral.
	 * This is mandatory for voice referral requests.
	 * @return string The result of a voice referral.
	 */
	function getVoiceReferralResult() {
		return $this->m_voiceReferralResult;
	}

	/**
	 * Gets the reason for which a void request is being made. This is
	 * mandatory for Void requests.
	 *
	 * @return string The reason for which a void request is being made. If null
	 *	is returned no void reason has been specified.
	 * @see VoidReason
	 * @see setVoidReason()
	 */
	function getVoidReason() {
		return $this->m_voidReason;
	}

	/**
	 * Gets the zip code/post code details associated with the card in this
	 * request. This can be used for additional verification with the
	 * issuer. The content of this is dependant upon the country in which
	 * authorisation is being performed. This is an alphanumeric string. It
	 * is optional.
	 *
	 * @return string The zip code/post code details associated with the card in
	 *	this request. If null is returned no zip code/post code has
	 *	been specified.
	 * @see setZipCode()
	 */
	function getZipCode() {
		return $this->m_zipCode;
	}

	/**
	 * Sets the API Key associated with the Register request. This is mandatory
	 * only for Register requests.
	 * It must be a valid API Key supplied by the payment gateway.
	 * This is a 32 character String.
	 *
	 * @param apiKey
	 *            The apiKey is associated with the merchant.
	 *            If this is null the apiKey is removed.
	 * @see getApiKey()
	 */
	function setApiKey($apiKey){
		$this->m_apiKey = $apiKey;
	}

	/**
	 * Sets the Application ID associated the merchant in this request. This is optional
	 * for all requests and is supplied by Creditcall Ltd.
	 * It is unique across all CardEase products. It is an alphanumeric string without a fixed length.
	 *
	 * @param applicationId
	 *            The applicationId is associated with the merchant.
	 *            If this is null the applicationId is removed.
	 * @see getApplicationId()
	 */
	function setApplicationId($applicationId){
		$this->m_applicationId = $applicationId;
	}

	/**
	 * Sets the Transaction ID associated with this request. This unique
	 * transaction ID is obtained from the CardEase platform as part of the
	 * auth response. This is mandatory for Conf and Void requests using an Api Key.
	 *
	 * @param transactionId
	 *            The Transaction ID associated with this request. If
	 *            this is null the Transaction ID is removed.
	 * @see getTransactionId()
	 */
	function setTransactionId($transactionId){
		$this->m_transactionId = $transactionId;
	}

	/**
	 * Sets the Customer Vault Command associated with this request for the Omni Gateway.
	 * Currently valid values are add-customer or update-customer.
	 *
	 * @param customerVaultCommand
	 * 		The Customer Vault Command associated with this request.
	 *
	 * @see getCustomerVaultCommand()
	 */
	function setCustomerVaultCommand($customerVaultCommand){
		$this->m_customerVaultCommand = $customerVaultCommand;
	}

	/**
	 * Sets the Customer Vault ID associated with this request for the Omni Gateway.
	 * If the Customer Vault Command is add-customer this is optional, if the Customer Vault ID is not supplied it will be generated.
	 * If the Customer Vault Command is update-customer then this field is mandatory. The value must be one that was
	 * previously used with an add-customer Customer Vault Command.
	 *
	 * @param customerVaultId
	 * 		The Customer Vault ID associated with this request.
	 *
	 * @see getCustomerVaultId()
	 */
	function setCustomerVaultId($customerVaultId){
		$this->m_customerVaultId = $customerVaultId;
	}

	/**
	 * Sets Merchant Processor ID associated with this request for the Omni Gateway. Multiple merchant processors
	 * can be configured against an account. This can be used to specify which one of those merchant processors
	 * should be used for this request. This must be a numeric string.
	 *
	 * @param merchantProcessorId
	 * 		The Merchant Processor ID associated with this request.
	 *
	 * @see getMerchantProcessorId()
	 */
	function setMerchantProcessorId($merchantProcessorId){
		$this->m_merchantProcessorId = $merchantProcessorId;
	}

	/**
	 * Sets the Lane ID associated with this request for the Omni Gateway. Multiple merchant processors can be configured
	 * against an Omni Gateway account. This can be used to specify which one of those merchant processors
	 * should be used for this request. This must be a numeric string.
	 *
	 * @param laneId
	 * 		The Lane ID associated with this request.
	 * @see getLaneId()
	 */
	function setLaneId($laneId){
		$this->m_laneId = $laneId;
	}

	function setOmniSale($omniSale){
		$this->m_omniSale = $omniSale;
	}

	/**
	 * Sets the 3-D Secure Card Holder Enrollment. This is required
	 * for authorisations in which the liability shift is possible due to
	 * the integration with a 3-D Secure MPI.
	 *
	 * @param enrolled
	 *	The 3-D Secure Card Holder Enrollment.
	 * @see ThreeDSecureCardHolderEnrolled
	 * @see getThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureECI()
	 * @see setThreeDSecureIAV()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureTransactionStatus()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureCardHolderEnrolled($enrolled) {
		$this->m_3DSecureCardHolderEnrolled = $enrolled;
	}
	
	/**
	 * Sets the 3-D Secure Directory Server Transaction ID.
	 * This is required for 3-D Secure Version 2.
	 * This is formatted as a GUID.
	 *
	 * @param threeDSecureDirectoryServerTransactionId    
	 *               Sets the 3-D Secure Directory Server Transaction ID.
	 *
	 * @see getThreeDSecureDirectoryServerTransactionId()
	 * @see getThreeDSecureServerTransactionId()
	 * @see setThreeDSecureServerTransactionId()
	 * @see getThreeDSecureVersion()
	 * @see setThreeDSecureVersion()
	 */
	function setThreeDSecureDirectoryServerTransactionId($treeDSecureDirectoryServerTransactionId) {
		$this->m_3DSecureDirectoryServerTransactionId = $treeDSecureDirectoryServerTransactionId;
	}

	/**
	 * Sets the 3-D Secure Electronic Commerce Indicator. This is required
	 * for authorisations in which a liability shift is possible due to the
	 * integration with a 3-D Secure MPI. It is a numeric string with a
	 * length of 2 characters.
	 *
	 * @param eci
	 *	The 3-D Secure Electronic Commerce Indicator.
	 *
	 * @see getThreeDSecureECI()
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureIAV()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureTransactionStatus()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureECI($eci) {
		$this->m_3DSecureECI = $eci;
	}

	/**
	 * Sets the 3-D Secure Authentication Verification Value. This is
	 * required for authorisations in which the liability shift is possible
	 * due to the integration with a 3-D Secure MPI. It is an alphanumeric
	 * string with a maximum size of 32 characters.
	 * <p>
	 * With Verified by Visa this is called CAVV.
	 * <p>
	 * With MasterCard SecureCode this is called AAV.
	 *
	 * @param iav
	 *	The 3-D Secure Authentication Verification Value.
	 *
	 * @see getThreeDSecureIAV()
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureECI()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureIAVFormat()
	 * @see setThreeDSecureTransactionStatus()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureIAV($iav) {
		$this->m_3DSecureIAV = $iav;
	}
	
	/**
	 * Sets the 3-D Secure Authentication Verification algorithm. This is
	 * required for authorisations in which the liability shift is possible
	 * due to the integration with a 3-D Secure MPI.
	 *
	 * @param iavAlgorithm
	 *	The 3-D Secure Authentication Verification algorithm.
	 *
	 * @see getThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureECI()
	 * @see setThreeDSecureIAV()
	 * @see setThreeDSecureIAVFormat()
	 * @see setThreeDSecureTransactionStatus()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureIAVAlgorithm($iavAlgorithm) {
		$this->m_3DSecureIAVAlgorithm = $iavAlgorithm;
	}

	/**
	 * Sets the 3-D Secure Authentication Verification format. This
	 * can be either Base64 or AsciiHex. The default is Base64.
	 *
	 * @param format
	 *	The 3-D Secure Authentication Verification format.
	 * @see getThreeDSecureIAVFormat()
	 * @see setThreeDSecureIAV()
	 */
	function setThreeDSecureIAVFormat($format) {
		$this->m_3DSecureIAVFormat = $format;
	}
	
	/**
	 * Sets the 3-D Secure Server Transaction ID.
	 * This is formatted as a GUID.
	 *
	 * @param threeDSecureServerTransactionID
	 *            The 3-D Secure Server Transaction ID.
	 *            
	 * @see getThreeDSecureServerTransactionId()
	 * @see getThreeDSecureDirectoryServerTransactionId()
	 * @see setThreeDSecureDirectoryServerTransactionId()
	 * @see getThreeDSecureVersion()
	 * @see setThreeDSecureVersion()
	 */
	function setThreeDSecureServerTransactionId($threeDSecureServerTransactionId) {
		$this->m_3DSecureServerTransactionId = $threeDSecureServerTransactionId;
	}
	
	/**
	 * Sets the 3-D Secure Transaction Status. This is required for
	 * authorisations in which the liability shift is possible due to the
	 * integration with a 3-D Secure MPI.
	 *
	 * @param status
	 *	The 3-D Secure Transaction Status.
	 *
	 * @see ThreeDSecureTransactionStatus
	 * @see getThreeDSecureTransactionStatus()
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureECI()
	 * @see setThreeDSecureIAV()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureTransactionStatus($status) {
		$this->m_3DSecureTransactionStatus = $status;
	}
	
	/**
	 * Sets the 3-D Secure version being used.
	 * This value can be retrieved from the 3-D Secure Server.
	 * It is required for 3-D Secure version 2 and above.
	 *
	 * @param threeDSecureVersion
	 *            The 3-D Secure Version.
	 *            
	 * @see getThreeDSecureVersion()
	 * @see getThreeDSecureDirectoryServerTransactionId()
	 * @see setThreeDSecureDirectoryServerTransactionId(String)
	 * @see getThreeDSecureServerTransactionId()
	 * @see setThreeDSecureServerTransactionId(String)
	 */
	function setThreeDSecureVersion($threeDSecureVersion) {
		$this->m_3DSecureVersion = $threeDSecureVersion;
	}

	/**
	 * Sets the 3-D Secure Transaction Identifier. This is required for
	 * authorisations in which the liability shift is possible due to the
	 * integration with a 3-D Secure MPI. It is an alphanumeric string
	 * with a maximum length of of 28 characters.
	 *
	 * @param xid
	 *	The 3-D Secure Transaction Identifier.
	 *
	 * @see getThreeDSecureXID()
	 * @see setThreeDSecureCardHolderEnrolled()
	 * @see setThreeDSecureECI()
	 * @see setThreeDSecureIAV()
	 * @see setThreeDSecureIAVAlgorithm()
	 * @see setThreeDSecureTransactionStatus()
	 * @see setThreeDSecureXIDFormat()
	 */
	function setThreeDSecureXID($xid) {
		$this->m_3DSecureXID = $xid;
	}

	/**
	 * Sets the 3-D Secure Transaction Identifier format. This
	 * can be either Base64, Ascii or AsciiHex. The default is Ascii.
	 *
	 * @param format
	 *	The 3-D Secure Transaction Identifier format.
	 * @see getThreeDSecureXIDFormat()
	 * @see setThreeDSecureXID()
	 */
	function setThreeDSecureXIDFormat($format) {
		$this->m_3DSecureXIDFormat = $format;
	}

	/**
	 * Sets the address details associated with the card in this request.
	 * This can be used for additional verification of the card details
	 * with the issuer. The content of this is dependant upon the country
	 * in which authorisation is being performed. Typically it is the
	 * first line of the address where the card is registered. This is an
	 * alphanumeric string. It is optional.
	 *
	 * @param address
	 *	The address details associated with the card in this request.
	 *	If this is null the address is removed.
	 * @see getAddress()
	 */
	function setAddress($address) {
		$this->m_address = $address;
	}

	/**
	 * Sets the amount associated with this request. This may be in major
	 * or minor units. For example 1.23 GBP (Major) === 123 GBP (Minor).
	 * The amount is mandatory for Auth and Offline requests.
	 *
	 * @param amount
	 *	The amount associated with this request.
	 * @see getAmount()
	 * @see setAmount()
	 */
	function setAmount($amount) {
		$this->m_amount = $amount;
	}

	/**
	 * Sets the units in which the amount associated with this request is
	 * specified. This may be Major or Minor. For example 1.23 GBP (Major)
	 * === 123 GBP (Minor). The default is Minor.
	 *
	 * @param amountUnit
	 *	The units in which the amount associated with this request is
	 *	specified. If this is null the amount unit is removed.
	 * @see AmountUnit
	 * @see getAmountUnit()
	 */
	function setAmountUnit($amountUnit) {
		$this->m_amountUnit = $amountUnit;
	}

	/**
     * Sets the AuthCode for a transaction that has been approved by some other means.
     * Optional for Offline requests and VoiceReferral requests where transaction
     * has been approved by the merchant offline.
     * Mandatory for VoiceReferral requests where the transaction has been
     * approved by the acquiring bank over the phone.
	 * @param authCode The AuthCode for a transaction that has been approved by some other means.
     */
	function setAuthCode($authCode) {
		$this->m_authCode = $authCode;
	}

	/**
	 * Sets whether an authorisation request is automatically confirmed
	 * without a confirmation request. By default is is false, a
	 * confirmation request will be required for this transaction.
	 *
	 * @param autoConfirm
	 *	Whether an authorisation request is automatically confirmed
	 *	without a confirmation request.
	 * @see getAutoConfirm()
	 */
	function setAutoConfirm($autoConfirm) {
		$this->m_autoConfirm = $autoConfirm;
	}

    /**
     * Sets the batch reference associated with this request.
     * <p>
     * This allows the user to attach a reference to a transaction
     * to help group similar transactions.
     *
     * @param batchReference The batch reference associated with this request.
     * @see getBatchReference()
     */
    function setBatchReference($batchReference) {
        $this->m_batchReference = $batchReference;
    }

	/**
	 * Sets the CardEase reference associated with this request. This is a
	 * unique reference that has been obtained from the CardEase platform
	 * during previous requests. This is an alphanumeric string with a fixed
	 * length of 36 characters. This is mandatory for Conf, Refund and Void
	 * requests.
	 *
	 * @param cardEaseReference
	 *	The CardEaseXML reference associated with this request. If
	 *	this is null the CardEase reference is removed.
	 * @see getCardEaseReference()
	 */
	function setCardEaseReference($cardEaseReference) {
		$this->m_cardEaseReference = $cardEaseReference;
	}

	/**
	 * Sets the card hash returned from a previous transaction that
	 * references the card details that should also be used for this
	 * transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 28 characters.
	 * Used in conjunction with the CardReference property. The benefit of
	 * being able to reference a previously used card is that an integrator
	 * need not store actual card details on their system for repeat
	 * transactions. This reduces the risk of card information being
	 * compromised, and reduces the integrators PCI requirements.
	 *
	 * @param cardHash The card hash returned from a previous transaction
	 *	that references the card details that should also be used for
	 *	this transaction.
	 * @see getCardHash()
	 * @see getCardReference()
	 * @see setCardReference()
	 */
	function setCardHash($cardHash) {
		$this->m_cardHash = $cardHash;
	}

	/**
	 * Sets the cardholder's address.
	 * @param cardHolderAddress The cardholder's address.
	 */
	function setCardHolderAddress($cardHolderAddress) {
		$this->m_cardHolderAddress = $cardHolderAddress;
	}

	/**
	 * Sets the cardholder's email address.
	 * @param cardHolderEmailAddresses The cardholder's email addresses.
	 */
	function setCardHolderEmailAddresses($cardHolderEmailAddresses) {
		$this->m_cardHolderEmailAddresses = $cardHolderEmailAddresses;
	}

	/**
	 * Sets the cardholder's name.
	 * @param cardHolderName The cardholder's name.
	 */
	function setCardHolderName($cardHolderName) {
		$this->m_cardHolderName = $cardHolderName;
	}

	/**
	 * Sets the cardholder's phone numbers.
	 * @param cardHolderPhoneNumbers The cardholder's phone numbers.
	 */
	function setCardHolderPhoneNumbers($cardHolderPhoneNumbers) {
		$this->m_cardHolderPhoneNumbers = $cardHolderPhoneNumbers;
	}

	/**
	 * Gets the card reference returned from a previous transaction that
	 * references the card details that should also be used for this
	 * transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 36 characters.
	 * Used in conjunction with the CardHash property. The benefit of being
	 * able to reference a previously used card is that an integrator need
	 * not store actual card details on their system for repeat
	 * transactions. This reduces the risk of card information being
	 * compromised, and reduces the integrators PCI requirements.
	 *
	 * @param cardReference The card reference returned from a previous
	 *	transaction that references the card details that should also
	 *	be used for this transaction.
	 * @see getCardReference()
	 * @see getCardHash()
	 * @see setCardHash()
	 */
	function setCardReference($cardReference) {
		$this->m_cardReference = $cardReference;
	}

	/**
	 * Whether the transaction was a contactless transaction.
	 * <p>
	 * Default is false.
	 */
	function setContactless($contactless) {
		$this->m_contactless = $contactless;
	}
	
	/**
	 * Sets the security code associated with the card in this request.
	 * This can be used for additional verification with the issuer. This
	 * is also referred to as CVV, CVC and CV2. This is an numeric
	 * string with a minimum length of 3 characters and a maximum length
	 * of 4 characters. This is optional.
	 * If the CSC validation fails the authorisation may be automatically declined or may continue to be approved.  If the authorisation is approved the CSC result should be checked.
	 * <p>
	 * On Visa and MasterCard this is the last three digits of the
	 * signature strip.
	 * <p>
	 * On Amex this is the four digits printed above the PAN.
	 *
	 * @param csc
	 *	The security code associated with the card in this request. If
	 *	this is null the security code is removed.
	 * @see getCSC()
	 */
	function setCSC($csc) {
		$this->m_csc = $csc;
	}

	/**
	 * Sets the ISO currency code or mnemonic associated with this request
	 * amount. For example, GBP or USD. If this is not specified the
	 * currency code held against the terminal ID in the CardEase platform
	 * is assumed. This is an alphanumeric string with a fixed length of 3
	 * characters.
	 * <p>
	 * Recognised currency codes and mnemonics:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Currency Code</th>
	 * <th>Mnemonic</th>
	 * <th>Description</th>
	 * </tr>
	 * <tr>
	 * <td>826</td>
	 * <td>GBP</td>
	 * <td>United Kingdom, Pound</td>
	 * </tr>
	 * <tr>
	 * <td>840</td>
	 * <td>USD</td>
	 * <td>United States, Dollar</td>
	 * </tr>
	 * <tr>
	 * <td>978</td>
	 * <td>EUR</td>
	 * <td>European Euro</td>
	 * </tr>
	 * <tr>
	 * <td>124</td>
	 * <td>CAD</td>
	 * <td>Canada, Dollar</td>
	 * </tr>
	 * <tr>
	 * <td>392</td>
	 * <td>JPY</td>
	 * <td>Japan, Yen</td>
	 * </tr>
	 * <tr>
	 * <td>208</td>
	 * <td>DKK</td>
	 * <td>Denmark, Krone</td>
	 * </tr>
	 * <tr>
	 * <td>756</td>
	 * <td>CHF</td>
	 * <td>Switzerland, Franc</td>
	 * </tr>
	 * <tr>
	 * <td>752</td>
	 * <td>SEK</td>
	 * <td>Sweden, Krona</td>
	 * </tr>
	 * </table>
	 *
	 * @param currencyCode
	 *	The ISO currency code or mnemonic associated with this request
	 *	amount. If this is null the currency code is removed.
	 *
	 * @see getCurrencyCode()
	 */
	function setCurrencyCode($currencyCode) {
		$this->m_currencyCode = $currencyCode;
	}

	/**
	 * Sets whether the transaction is a debt repayment. Defaults to false.
	 * @param debtRepayment whether the transaction is a debt repayment.
	 * @see getDebtRepayment()
	 */
	function setDebtRepayment($debtRepayment) {
		$this->m_debtRepayment = $debtRepayment;
	}

	/**
	 * Sets the delivery address.
	 * @param deliveryAddress The delivery address.
	 */
	function setDeliveryAddress($deliveryAddress) {
		$this->m_deliveryAddress = $deliveryAddress;
	}

	/**
	 * Sets the delivery email addresses.
	 * @param deliveryEmailAddresses The delivery email addresses.
	 */
	function setDeliveryEmailAddresses($deliveryEmailAddresses) {
		$this->m_deliveryEmailAddresses = $deliveryEmailAddresses;
	}

	/**
	 * Sets the delivery name.
	 * @param deliveryName The delivery name.
	 */
	function setDeliveryName($deliveryName) {
		$this->m_deliveryName = $deliveryName;
	}

	/**
	 * Sets the delivery phone numbers.
	 * The delivery phone numbers.
	 */
	function setDeliveryPhoneNumbers($deliveryPhoneNumbers) {
		$this->m_deliveryPhoneNumbers = $deliveryPhoneNumbers;
	}

	/**
	 * Sets the Credential-on-File associated with the request.
	 * @param m_credentialOnFile
	 *            The Credential-on-File associated with the request.
	 * @see #getCredentialOnFile()
	 */
	function setCredentialOnFile($credentialOnFile) {
		$this->m_credentialOnFile = $credentialOnFile;
	}

	/**
	 * Sets the expiry date associated with the card in this request. This
	 * is a character string with a maximum length of 10 characters.
	 * This is mandatory for manual authorisation requests (such as Card
	 * Not Present). This should match the expiry date format.
	 *
	 * @param expiryDate
	 *	The expiry date associated with the card in this request. If
	 *	this is null the expiry date is removed.
	 * @see getExpiryDate()
	 * @see getExpiryDateFormat()
	 * @see setExpiryDateFormat()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function setExpiryDate($expiryDate) {
		$this->m_expiryDate = $expiryDate;
	}

	/**
	 * Sets the expiry date format associated with the card in this
	 * request. This is a character string with a maximum length of 10
	 * characters. This is mandatory for manual authorisation requests
	 * (such as Card Not Present). By default this is 'yyMM'. This should
	 * match the format of the expiry date and can include separators such
	 * as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param expiryDateFormat
	 *	The expiry date format associated with the card in this
	 *	request. If this is null the expiry date format is removed.
	 * @see getExpiryDateFormat()
	 * @see getExpiryDate()
	 * @see setExpiryDate()
	 */
	function setExpiryDateFormat($expiryDateFormat) {
		$this->m_expiryDateFormat = $expiryDateFormat;
	}

	/**
	 * Sets the list of extended properties associated with this request.
	 *
	 * @param extendedProperties The list of extended properties associated with this request.
	 * @see addExtendedProperty()
	 * @see getExtendedProperties()
	 */
	function setExtendedProperties($extendedProperties) {
		$this->m_extendedProperties = $extendedProperties;
	}

	/**
	 * Sets the list of feature tokens associated with this request.
	 *
	 * @param featureTokens The list of feature tokens associated with this request.
	 * @see addFeatureToken()
	 * @see getFeatureTokens()
	 */
	function setFeatureTokens($featureTokens) {
		$this->m_featureTokens = $featureTokens;
	}

	/**
	 * Sets whether an ICC fallback has occurred. Default is false.
	 *
	 * @param iccFallback
	 *	Whether an ICC fallback has occurred.
	 * @see getICCFallback()
	 */
	function setICCFallback($iccFallback) {
		$this->m_iccFallback = $iccFallback;
	}

	/**
	 * Sets the ICC management function associated with an ICCManagement
	 * request. This must be set for an ICCManagement request. It is an
	 * alphanumeric string.  Obsoleted by SubType_
	 *
	 * @param iccManagementFunction
	 *	The ICC management function associated with an ICC Management
	 *	request. If this is null the ICC management function is
	 *	removed.
	 * @see getICCManagementFunction()
	 * @see getRequestType()
	 * @see setRequestType()
	 * @deprecated
	 */
	function setICCManagementFunction($iccManagementFunction) {
		$this->m_subType = $iccManagementFunction;
	}

	/**
	 * Sets the list of ICC tags associated with this request. Each ICC tag
	 * has an id, type and value. For example, a tag of
	 * 0x9f02/AsciiHex/000000000100 is using to specify the transaction
	 * amount. These are mandatory for an EMV transaction.
	 *
	 * @param iccTags
	 *	The list of ICC tags associated with this request. If this is
	 *	null the list of ICC tags is removed.
	 * @see ICCTag
	 * @see addICCTag()
	 * @see getICCTags()
	 * @see getICCType()
	 * @see setICCType()
	 */
	function setICCTags($iccTags) {
		$this->m_iccTags = $iccTags;
	}

	/**
	 * Sets the type of ICC transaction associated with this request. This
	 * is an alphanumeric string. This is mandatory for ICC authorisations
	 * and by default is 'EMV'. An EMV transaction must have associated
	 * ICC tags.
	 *
	 * @param iccType
	 *	The type of ICC transaction associated with this request. If
	 *	this is null the ICC type is removed.
	 * @see getICCType()
	 * @see ICCTag
	 * @see addICCTag()
	 * @see getICCTags()
	 * @see setICCTags()
	 */
	function setICCType($iccType) {
		$this->m_iccType = $iccType;
	}

	/**
	 * Sets the invoice address.
	 * @param invoiceAddress The invoice address.
	 */
	function setInvoiceAddress($invoiceAddress) {
		$this->m_invoiceAddress = $invoiceAddress;
	}

	/**
	 * Sets the invoice email addresses.
	 * @param invoiceEmailAddresses The invoice email addresses.
	 */
	function setInvoiceEmailAddresses($invoiceEmailAddresses) {
		$this->m_invoiceEmailAddresses = $invoiceEmailAddresses;
	}

	/**
	 * Sets the invoice name.
	 * @param invoiceName The invoice name.
	 */
	function setInvoiceName($invoiceName) {
		$this->m_invoiceName = $invoiceName;
	}

	/**
	 * Sets the invoice phone numbers.
	 * @param invoicePhoneNumbers The invoice phone numbers.
	 */
	function setInvoicePhoneNumbers($invoicePhoneNumbers) {
		$this->m_invoicePhoneNumbers = $invoicePhoneNumbers;
	}

	/**
	 * Sets the issue number associated with the card in this request.
	 * This is a numeric string with a maximum length of 2 characters. The
	 * requirement for this is dependant upon the card scheme associated
	 * with the card and must be exactly as found on the card (including
	 * any leading 0's).
	 *
	 * @param issueNumber
	 *	The issue number associated with the card in this request. If
	 *	this is null the issue number is removed.
	 * @see getIssueNumber()
	 */
	function setIssueNumber($issueNumber) {
		$this->m_issueNumber = $issueNumber;
	}

	/**
	 * Sets the machine reference associated with this request. This is
	 * mandatory if the TerminalID is a Master Terminal ID used to
	 * represent multiple terminals. This is an alphanumeric string with a
	 * maximum length of 50 characters.
	 *
	 * @param machineReference
	 *	The machine reference associated with this request. If this is
	 *	null the machine reference is removed.
	 * @see getMachineReference()
	 * @see getTerminalID()
	 * @see setTerminalID()
	 */
	function setMachineReference($machineReference) {
		$this->m_machineReference = $machineReference;
	}

	/**
	 * Sets the type of manual authorisation being used for this request.
	 * By default this is 'cnp' (i.e. Card Not Present). This is an
	 * alphanumeric string. This is mandatory for manual authorisations.
	 *
	 * @param manualType
	 *	The type of manual authorisation being used for this request.
	 *	If this is null the manual type is removed.
	 * @see getManualType()
	 */
	function setManualType($manualType) {
		$this->m_manualType = $manualType;
	}

	/**
	 * Sets the date and/or time when the transaction was processed offline.
	 * @param offlineDateTime The date and/or time when the transaction was processed offline.
	 */
	function setOfflineDateTime($offlineDateTime) {
		$this->m_offlineDateTime = $offlineDateTime;
	}

	/**
	 * Sets the format of the date and/or time of the transaction if processed offline.
	 * <p>
	 * This is a character string with a maximum length of 16 characters.
     * By default this is 'ddMMyy hhmmss'. This should match the format of the
     * offline date/time and can include separators such as - and /. The available
     * options are shown in the following table:
     *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * <tr>
	 * <td>hh</td>
	 * <td>Hour</td>
	 * <td>12</td>
	 * </tr>
	 * <tr>
	 * <td>mm</td>
	 * <td>Minute</td>
	 * <td>54</td>
	 * </tr>
	 * <tr>
	 * <td>ss</td>
	 * <td>Second</td>
	 * <td>22</td>
	 * </tr>
	 * </table>
	 *
	 * @param offlineDateTimeFormat The format of the date and/or time of the transaction if processed offline.
	 * @see getOfflineDateTimeFormat()
	 * @see getOfflineDateTime()
	 * @see setOfflineDateTime()
	 */
	function setOfflineDateTimeFormat($offlineDateTimeFormat) {
		$this->m_offlineDateTimeFormat = $offlineDateTimeFormat;
	}

	/**
	 * Gets the originating IP address of the request.  E.g. client browser.
	 *
	 * @param $originatingIPAddress string The originating IP address of the request.
	 * If this is null the originating IP address is removed.
	 * @see getOriginatingIPAddress()
	 */
	function setOriginatingIPAddress($originatingIPAddress) {
		$this->m_originatingIPAddress = $originatingIPAddress;
	}

	/**
	 * Sets the PAN (Primary Account Number) associated with the card in
	 * this request. This is a numeric string with a minimum length of 12
	 * characters and a maximum length of 19 characters. This is a
	 * requirement for manual authorisation requests (such as Card Not
	 * Present).
	 *
	 * @param pan
	 *	The PAN (Primary Account Number) associated with the card in
	 *	this request. If this is null the pan is removed.
	 * @see getPAN()
	 */
	function setPAN($pan) {
		$this->m_pan = $pan;
	}

	/**
	 * Sets the list of products.
	 * @param products The list of products.
	 */
	function setProducts($products) {
		$this->m_products = $products;
	}

	/**
	 * Sets the date upon which the recurring action should occur. Applicable to
	 * AdHoc and Cancel requests. If not specified the current date is used. The
	 * CardEaseReference of the recurring transaction must be supplied as an
	 * input.
	 *
	 * @param recurringActionDate
	 *            The date upon which the recurring action should occur.
	 * @see setRecurringActionDate()
	 * @see getSubType()
	 * @see setSubType()
	 * @see setCardEaseReference()
	 * @see getRecurringActionDate()
	 */
	function setRecurringActionDate($recurringActionDate) {
		$this->m_recurringActionDate = $recurringActionDate;
	}

	/**
	 * Sets the format of the date upon which the recurring action should occur.
	 * This is a character string with a maximum length of 10 characters. This
	 * should match the format of the action date and can include separators
	 * such as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param recurringActionDateFormat
	 *            The format of the date upon which the recurring action should
	 *            occur.
	 * @see setRecurringActionDate()
	 * @see getRecurringActionDateFormat()
	 */
	function setRecurringActionDateFormat($recurringActionDateFormat) {
		$this->m_recurringActionDateFormat = $recurringActionDateFormat;
	}

	/**
	 * Sets the final amount that should be taken when a recurring transaction
	 * completes. This may be in major or minor units. For example 1.23 GBP
	 * (Major) === 123 GBP (Minor). If not specified the RecurringRegularAmount
	 * is used.
	 *
	 * @param recurringFinalAmount
	 *            The final amount that should be taken when a recurring
	 *            transaction completes.
	 * @see setRecurringFinalAmountUnit()
	 * @see setRecurringFinalDate()
	 * @see setRecurringRegularAmount()
	 * @see getRecurringFinalAmount()
	 */
	function setRecurringFinalAmount($recurringFinalAmount) {
		$this->m_recurringFinalAmount = $recurringFinalAmount;
	}

	/**
	 * Sets the units of the final recurring amount. This may be Major or Minor.
	 * For example 1.23 GBP (Major) === 123 GBP (Minor). The default is Minor.
	 *
	 * @param recurringFinalAmountUnit
	 *            The units of the final recurring amount.
	 * @see setRecurringFinalAmount()
	 * @see getRecurringFinalAmountUnit()
	 */
	function setRecurringFinalAmountUnit($recurringFinalAmountUnit) {
		$this->m_recurringFinalAmountUnit = $recurringFinalAmountUnit;
	}

	/**
	 * Sets the date upon which the recurring transactions should complete and a
	 * final payment taken. If not specified the current date is used.
	 *
	 * @param recurringFinalDate
	 *            The date upon which the recurring transactions should complete
	 *            and a final payment taken.
	 * @see setRecurringFinalDateFormat()
	 * @see getRecurringFinalDate()
	 */
	function setRecurringFinalDate($recurringFinalDate) {
		$this->m_recurringFinalDate = $recurringFinalDate;
	}

	/**
	 * Sets the format of the date upon which the recurring transactions should
	 * complete and a final payment taken. This is a character string with a
	 * maximum length of 10 characters. This should match the format of the
	 * action date and can include separators such as - and /. The available
	 * options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param recurringFinalDateFormat
	 *            The format of the date upon which the recurring transactions
	 *            should complete and a final payment taken.
	 * @see setRecurringFinalDate()
	 * @see getRecurringFinalDateFormat()
	 */
	function setRecurringFinalDateFormat($recurringFinalDateFormat) {
		$this->m_recurringFinalDateFormat = $recurringFinalDateFormat;
	}

	/**
	 * Sets the initial amount that should be taken before a recurring
	 * transaction starts. This may be in major or minor units. For example 1.23
	 * GBP (Major) === 123 GBP (Minor).
	 *
	 * @param recurringInitialAmount
	 *            The initial amount that should be taken before a recurring
	 *            transaction starts.
	 * @see setRecurringInitialAmountUnit()
	 * @see setRecurringInitialDate()
	 * @see getRecurringInitialAmount()
	 */
	function setRecurringInitialAmount($recurringInitialAmount) {
		$this->m_recurringInitialAmount = $recurringInitialAmount;
	}

	/**
	 * Sets the units of the initial recurring amount. This may be Major or
	 * Minor. For example 1.23 GBP (Major) === 123 GBP (Minor). The default is
	 * Minor.
	 *
	 * @param recurringInitialAmountUnit
	 *            The units of the initial recurring amount.
	 * @see setRecurringInitialAmount()
	 * @see getRecurringInitialAmountUnit()
	 */
	function setRecurringInitialAmountUnit($recurringInitialAmountUnit) {
		$this->m_recurringInitialAmountUnit = $recurringInitialAmountUnit;
	}

	/**
	 * Sets the date upon which the recurring transactions should be initialised
	 * and a initial payment taken. If not specified the current date is used.
	 *
	 * @param recurringInitialDate
	 *            The date upon which the recurring transactions should be
	 *            initialised and a initial payment taken.
	 * @see setRecurringInitialDateFormat()
	 * @see getRecurringInitialDate()
	 */
	function setRecurringInitialDate($recurringInitialDate) {
		$this->m_recurringInitialDate = $recurringInitialDate;
	}

	/**
	 * Sets the format of the date upon which the recurring transactions should
	 * be initialised and a initial payment taken. This is a character string
	 * with a maximum length of 10 characters. This should match the format of
	 * the action date and can include separators such as - and /. The available
	 * options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param recurringInitialDateFormat
	 *            The format of the date upon which the recurring transactions
	 *            should be initialised and a initial payment taken.
	 * @see setRecurringInitialDate()
	 * @see getRecurringInitialDateFormat()
	 */
	function setRecurringInitialDateFormat($recurringInitialDateFormat) {
		$this->m_recurringInitialDateFormat = $recurringInitialDateFormat;
	}

	/**
	 * Sets the regular amount that should be taken when a recurring transaction
	 * occurs. This may be in major or minor units. For example 1.23 GBP (Major) ==
	 * 123 GBP (Minor).
	 *
	 * @param recurringRegularAmount
	 *            The regular amount that should be taken when a recurring
	 *            transaction occurs.
	 * @see setRecurringRegularAmountUnit()
	 * @see setRecurringRegularFrequency()
	 * @see getRecurringRegularAmount()
	 */
	function setRecurringRegularAmount($recurringRegularAmount) {
		$this->m_recurringRegularAmount = $recurringRegularAmount;
	}

	/**
	 * Sets the units of the regular recurring amount. This may be Major or
	 * Minor. For example 1.23 GBP (Major) === 123 GBP (Minor). The default is
	 * Minor.
	 *
	 * @param recurringRegularAmountUnit
	 *            The units of the regular recurring amount.
	 * @see setRecurringRegularAmount()
	 * @see getRecurringRegularAmountUnit()
	 */
	function setRecurringRegularAmountUnit($recurringRegularAmountUnit) {
		$this->m_recurringRegularAmountUnit = $recurringRegularAmountUnit;
	}

	/**
	 * Sets the date upon which the recurring transactions should end. If not
	 * specified the transactions are taken until the maximum number of payments
	 * is reached, the final date is reached or the recurring transaction is
	 * cancelled.
	 *
	 * @param recurringRegularEndDate
	 *            The date upon which the recurring transactions should end.
	 * @see setRecurringRegularEndDateFormat()
	 * @see getRecurringRegularEndDate()
	 */
	function setRecurringRegularEndDate($recurringRegularEndDate) {
		$this->m_recurringRegularEndDate = $recurringRegularEndDate;
	}

	/**
	 * Sets the format of the date upon which the recurring transactions should
	 * end. This is a character string with a maximum length of 10 characters.
	 * This should match the format of the action date and can include
	 * separators such as - and /. The available options are shown in the
	 * following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param recurringRegularEndDateFormat
	 *            The format of the date upon which the recurring transactions
	 *            should end.
	 * @see setRecurringRegularEndDate()
	 * @see getRecurringRegularEndDateFormat()
	 */
	function setRecurringRegularEndDateFormat($recurringRegularEndDateFormat) {
		$this->m_recurringRegularEndDateFormat = $recurringRegularEndDateFormat;
	}

	/**
	 * Sets the frequency of the recurring transaction.
	 *
	 * @param recurringRegularFrequency
	 *            The frequency of the recurring transaction.
	 * @see Frequency
	 * @see setRecurringRegularFrequencyRounding()
	 * @see getRecurringRegularFrequency()
	 */
	function setRecurringRegularFrequency($recurringRegularFrequency) {
		$this->m_recurringRegularFrequency = $recurringRegularFrequency;
	}

	/**
	 * Sets the rounding to apply to the frequency calculations on boundaries.
	 * The default is Down.
	 *
	 * @param recurringRegularFrequencyRounding
	 *            The rounding to apply to the frequency calculations on
	 *            boundaries.
	 * @see FrequencyRounding
	 * @see setRecurringRegularFrequency()
	 */
	function setRecurringRegularFrequencyRounding($recurringRegularFrequencyRounding) {
		$this->m_recurringRegularFrequencyRounding = $recurringRegularFrequencyRounding;
	}

	/**
	 * Sets the maximum number of regular payments. If specified as 0
	 * transactions will be taken until the end date is reached, the schedule is
	 * cancelled or the final date is reached.
	 *
	 * @param recurringRegularMaximumPayments
	 *            The maximum number of regular payments.
	 * @see Frequency
	 * @see setRecurringRegularEndDate()
	 * @see setRecurringFinalDate()
	 * @see getRecurringRegularMaximumPayments()
	 */
	function setRecurringRegularMaximumPayments($recurringRegularMaximumPayments) {
		$this->m_recurringRegularMaximumPayments = $recurringRegularMaximumPayments;
	}

	/**
	 * Sets the date upon which the recurring transactions should start. If not
	 * specified the current date is used.
	 *
	 * @param recurringRegularStartDate
	 *            The date upon which the recurring transactions should start.
	 * @see setRecurringRegularStartDateFormat()
	 * @see getRecurringRegularStartDate()
	 */
	function setRecurringRegularStartDate($recurringRegularStartDate) {
		$this->m_recurringRegularStartDate = $recurringRegularStartDate;
	}

	/**
	 * Sets the format of the date upon which the recurring transactions should
	 * start. This is a character string with a maximum length of 10 characters.
	 * This should match the format of the action date and can include
	 * separators such as - and /. The available options are shown in the
	 * following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param recurringRegularStartDateFormat
	 *            The format of the date upon which the recurring transactions
	 *            should start.
	 * @see setRecurringRegularStartDate()
	 * @see getRecurringRegularStartDateFormat()
	 */
	function setRecurringRegularStartDateFormat($recurringRegularStartDateFormat) {
		$this->m_recurringRegularStartDateFormat = $recurringRegularStartDateFormat;
	}

	/**
	 * Sets the type of this request. This can be Auth, Conf, Test and so
	 * on. By default this is 'Auth'. This is mandatory for all requests.
	 *
	 * @param requestType
	 *	The type of this request. If this is null the request type is
	 *	removed.
	 * @see getRequestType()
	 * @see RequestType
	 */
	function setRequestType($requestType) {
		$this->m_requestType = $requestType;
	}

	/**
	 * Sets the name of the software/firmware using the CardEaseXML SDK.
	 * This is an alphanumeric string with a maximum length of 50
	 * characters. This is mandatory for all requests.
	 *
	 * @param softwareName
	 *	The name of the software/firmware using the CardEaseXML SDK.
	 *	If this is null the software/firmware name is removed.
	 * @see getSoftwareName()
	 */
	function setSoftwareName($softwareName) {
		$this->m_softwareName = $softwareName;
	}

	/**
	 * Sets the version of the software/firmware using the CardEaseXML SDK.
	 * This is an alphanumeric string with a maximum length of 20
	 * characters. This is mandatory for all requests.
	 *
	 * @param softwareVersion
	 *	The version of the software/firmware using the CardEaseXML
	 *	SDK. If this is null the software/firmware version is removed.
	 * @see getSoftwareVersion()
	 */
	function setSoftwareVersion($softwareVersion) {
		$this->m_softwareVersion = $softwareVersion;
	}

	/**
	 * Sets the start date associated with the card in this request. This
	 * is a character string with a maximum length of 10 characters.
	 * This is optional for manual authorisation requests (such as Card
	 * Not Present). This should match the start date format.
	 *
	 * @param startDate
	 *	The start date associated with the card in this request. If
	 *	this is null the start date is removed.
	 * @see getStartDate()
	 * @see getStartDateFormat()
	 * @see setStartDateFormat()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function setStartDate($startDate) {
		$this->m_startDate = $startDate;
	}

	/**
	 * Sets the start date format associated with the card in this request.
	 * This is a character string with a maximum length of 10
	 * characters. This is optional for manual authorisation requests
	 * (such as Card Not Present). By default this is 'yyMM'. This should
	 * match the format of the start date and can include separators such
 	 * as - and /. The available options are shown in the following table:
	 *
	 * <table border=1>
	 * <tr>
	 * <th>Format</th>
	 * <th>Description</th>
	 * <th>Example</th>
	 * </tr>
	 * <tr>
	 * <td>yyyy</td>
	 * <td>Year with century</td>
	 * <td>2004</td>
	 * </tr>
	 * <tr>
	 * <td>yy</td>
	 * <td>Year without century</td>
	 * <td>04</td>
	 * </tr>
	 * <tr>
	 * <td>MM</td>
	 * <td>Month of year</td>
	 * <td>01</td>
	 * </tr>
	 * <tr>
	 * <td>dd</td>
	 * <td>Day of month</td>
	 * <td>27</td>
	 * </tr>
	 * </table>
	 *
	 * @param startDateFormat
	 *	The start date format associated with the card in this
	 *	request. If this is null the start date format is removed.
	 * @see getStartDateFormat()
	 * @see getStartDate()
	 * @see setStartDate()
	 * @see getManualType()
	 * @see setManualType()
	 */
	function setStartDateFormat($startDateFormat) {
		$this->m_startDateFormat = $startDateFormat;
	}

	/**
	 * Sets the sub type of the request. Currently applicable to ICCManagement
	 * and Recurring requests.
	 *
	 * @param subType
	 *            The sub type of the request.
	 * @see RequestType
	 * @see getSubType()
	 */
	function setSubType($subType) {
		$this->m_subType = $subType;
	}

	/**
	 * Sets the terminal ID associated with the machine performing this
	 * request. This is mandatory for all requests and is supplied by
	 * Creditcall Ltd. It is unique across all CardEase
	 * products. It is a numeric string with a fixed length of 8
	 * characters.
	 *
	 * @param terminalID
	 *	The terminal ID associated with the machine performing this
	 *	request. If this is null the terminal ID is removed.
	 * @see getTerminalID()
	 */
	function setTerminalID($terminalID) {
		$this->m_terminalID = $terminalID;
	}

	/**
	 * Sets the track 1 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 79 characters. This is optional.
	 *
	 * @param track1
	 *	The track 1 associated with the card in a magnetic stripe
	 *	authorisation. If this is null the track 1 is removed.
	 * @see getTrack1()
	 */
	function setTrack1($track1) {
		$this->m_track1 = $track1;
	}

	/**
	 * Sets the track 2 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 40 characters. This should include start and end sentinels (and
	 * separator character if provided). It is mandatory for magnetic
	 * stripe authorisation.
	 *
	 * @param track2
	 *	The track 2 associated with the card in a magnetic stripe
	 *	authorisation. If this is null the track 2 is removed.
	 * @see getTrack2()
	 */
	function setTrack2($track2) {
		$this->m_track2 = $track2;
	}

	/**
	 * Sets the track 3 associated with the card in a magnetic stripe
	 * authorisation. This is an alphanumeric string with a maximum length
	 * of 107 characters. This is optional.
	 *
	 * @param track3
	 *	The track 3 associated with the card in a magnetic stripe
	 *	authorisation. If this is null the track 3 is removed.
	 * @see getTrack3()
	 */
	function setTrack3($track3) {
		$this->m_track3 = $track3;
	}

	/**
	 * Sets the transaction key associated with this request. This is
	 * mandatory for all requests and is supplied by Creditcall
	 * Ltd for a terminal or number of terminals. It must be in
	 * exactly the same case as provided by Creditcall. This is an
	 * alphanumeric string with a maximum length of 20 characters.
	 *
	 * @param transactionKey
	 *	The transaction key associated with this request. If this is
	 *	null the transaction key is removed.
	 * @see getTransactionKey()
	 */
	function setTransactionKey($transactionKey) {
		$this->m_transactionKey = $transactionKey;
	}

	/**
	 * Sets the user reference associated with this request. This allows a
	 * user to attach their own reference against a request. This is an
	 * alphanumeric string with a maximum length of 50 characters. This is
	 * optional for all requests.
	 *
	 * @param userReference
	 *	The user reference associated with this request. If this is
	 *	null the user reference is removed.
	 * @see setUserReference()
	 */
	function setUserReference($userReference) {
		$this->m_userReference = $userReference;
	}

	/**
	 * Sets the result of a voice referral.
	 * This is mandatory for voice referral requests.
	 * @param voiceReferralResult The result of a voice referral.
	 */
	function setVoiceReferralResult($voiceReferralResult) {
		$this->m_voiceReferralResult = $voiceReferralResult;
	}

	/**
	 * Sets the reason for which a void request is being made. This is
	 * mandatory for Void requests.
	 *
	 * @param voidReason
	 *	The reason for which a void request is being made. If this is
	 *	null the void reason is removed.
	 * @see VoidReason
	 * @see setVoidReason()
	 */
	function setVoidReason($voidReason) {
		$this->m_voidReason = $voidReason;
	}

	/**
	 * Sets the zip code/post code details associated with the card in this
	 * request. This can be used for additional verification with the
	 * issuer. The content of this is dependant upon the country in which
	 * authorisation is being performed. This is an alphanumeric string.
	 * It is optional.
	 *
	 * @param zipCode
	 *	The zip code/post code details associated with the card in
	 *	this request. If this is null the zip code is removed.
	 * @see getZipCode()
	 */
	function setZipCode($zipCode) {
		$this->m_zipCode = $zipCode;
	}

	function isCardDetailsNodeNeeded(){
		return !(($this->m_iccTags == null || count($this->m_iccTags) == 0) &&
			$this->m_contactless == false &&
			$this->m_iccFallback == false &&
			empty($this->m_track1) &&
			empty($this->m_track2) &&
			empty($this->m_track3) &&
			empty($this->m_pan) &&
			empty($this->m_cardReference) &&
			empty($this->m_cardHash) &&
			empty($this->m_expiryDate) &&
			empty($this->m_startDate) &&
			empty($this->m_issueNumber) &&
			empty($this->m_address) &&
			empty($this->m_csc) &&
			empty($this->m_zipCode) &&
			($this->m_cardHolderAddress == null || $this->m_cardHolderAddress->isEmpty()) &&
			($this->m_cardHolderEmailAddresses == null || count($this->m_cardHolderEmailAddresses) == 0) &&
			($this->m_cardHolderName == null || $this->m_cardHolderName->isEmpty()) &&
			($this->m_cardHolderPhoneNumbers == null || count($this->m_cardHolderPhoneNumbers) == 0) &&
			($this->m_3DSecureCardHolderEnrolled == null || $this->m_3DSecureCardHolderEnrolled == ThreeDSecureCardHolderEnrolled_Empty) &&
			($this->m_3DSecureTransactionStatus == null || $this->m_3DSecureCardHolderEnrolled == ThreeDSecureTransactionStatus_Empty) &&
			empty($this->m_3DSecureVersion) &&
			empty($this->m_3DSecureServerTransactionId) &&
			empty($this->m_3DSecureDirectoryServerTransactionId) &&
			empty($this->m_3DSecureServerTransactionId) &&
			empty($this->m_3DSecureECI) &&
			empty($this->m_3DSecureIAV) &&
			empty($this->m_3DSecureXID));
	}

	/**
	 * Method that checks if at least 1 ThreeDSecure version has been initialised and if so,
	 * that the both values are not set to false. This stops an empty XML node being included in the request.
	 */
	private function isThreeDSecureNodeNeeded() {
		if ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure == null) {
			return false;
		}
		return $this->isVersionSupportedNodeNeeded() || $this->isSchemeSupportedNodeNeeded();
	}

	private function isVersionSupportedNodeNeeded() {
		return ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion1 != null &&
				$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion1 == ParameterValues::$true ||
				$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion2 != null &&
						$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->threeDSecureVersion2 == ParameterValues::$true);
	}

	private function isSchemeSupportedNodeNeeded() {
		return ($this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->visa != null &&
						$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->visa == ParameterValues::$true ||
				$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->mastercard != null &&
						$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->mastercard == ParameterValues::$true ||
				$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->amex != null &&
						$this->m_terminalCapabilities->terminalCapabilitiesThreeDSecure->amex == ParameterValues::$true);
	}

	private function addCatLevelsToXML($writer) {
		if (array_search(ParameterValues::$true, $this->m_terminalCapabilities->terminalCapabilitiesCatLevel->catLevelMap) != false) {
			$writer->writeStartElement("CardholderActivatedTerminal");
			$writer->writeStartElement("Level");
			$sb = '';

			foreach($this->m_terminalCapabilities->terminalCapabilitiesCatLevel->catLevelMap as $key => $catLevelValue) {
				if ($catLevelValue == ParameterValues::$true) {
					$sb .= $key . ' ';
				}
			}

			$sb = substr($sb, 0, strlen($sb) - 1);
			$writer->writeString($sb);
			$writer->writeEndElement(); // Level
			$writer->writeEndElement(); // CardholderActivatedTerminal
		}
	}

	/**
	 * Method that checks if at least 1 CvmCapability is set to true and adds all true Keys to a string. This string is then parsed to XML
	 */
	private function addCvmCapabilitiesToXML($writer) {
		if ($this->areCvmCapabilitiesAdded()) {
			$writer->writeStartElement("CvmCapabilities");
			$sb = '';

			foreach($this->m_terminalCapabilities->terminalCapabilitiesContactless->cvmCapabilities as $key => $cvmCapabilityValue) {
				if ($cvmCapabilityValue == ParameterValues::$true) {
					$sb .= $key . ' ';
				}
			}

			$sb = substr($sb, 0, strlen($sb) - 1);
			$writer->writeString($sb);
			$writer->writeEndElement(); // CvmCapabilities
		}
	}

	private function isContactlessNodeNeeded() {
		if ($this->m_terminalCapabilities->terminalCapabilitiesContactless == null) {
			return false;
		}

		return !(($this->m_terminalCapabilities->terminalCapabilitiesContactless->emvTerminalCapabilities == null) &&
				($this->m_terminalCapabilities->terminalCapabilitiesContactless->fallForward == null) &&
				($this->m_terminalCapabilities->terminalCapabilitiesContactless->singleTap == null) &&
				($this->m_terminalCapabilities->terminalCapabilitiesContactless->magstripe == null) &&
				(!$this->areCvmCapabilitiesAdded()));
	}

	private function areCvmCapabilitiesAdded() {
		if (array_search(ParameterValues::$true, $this->m_terminalCapabilities->terminalCapabilitiesContactless->cvmCapabilities) != false) {
			return true;
		}
		return false;
	}


	/**
	 * Gets a string version of this requests details.
	 *
	 * @return string A string version of this requests details.
	 */
	function toString() {
		$eol = '<br>'."\n";

		$str = '';
		$str .= 'REQUEST:';
		$str .= $eol;
		$str .= '3DSecureCardHolderEnrolled: ';
		$str .= htmlentities($this->m_3DSecureCardHolderEnrolled, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureECI: ';
		$str .= htmlentities($this->m_3DSecureECI, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureIAV: ';
		$str .= htmlentities($this->m_3DSecureIAV, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureIAVAlgorithm: ';
		$str .= htmlentities($this->m_3DSecureIAVAlgorithm, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureIAVFormat: ';
		$str .= htmlentities($this->m_3DSecureIAVFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureTransactionStatus: ';
		$str .= htmlentities($this->m_3DSecureTransactionStatus, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureXID: ';
		$str .= htmlentities($this->m_3DSecureXID, ENT_QUOTES);
		$str .= $eol;
		$str .= '3DSecureXIDFormat: ';
		$str .= htmlentities($this->m_3DSecureXIDFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Address: ';
		$str .= htmlentities($this->m_address, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Amount: ';
		$str .= htmlentities($this->m_amount, ENT_QUOTES);
		$str .= $eol;
		$str .= 'AmountUnit: ';
		$str .= htmlentities($this->m_amountUnit, ENT_QUOTES);
		$str .= $eol;
		$str .= 'AutoConfirm: ';
		$str .= htmlentities($this->m_autoConfirm, ENT_QUOTES);
		$str .= $eol;
		$str .= 'BatchReference: ';
		$str .= htmlentities($this->m_batchReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CardEaseReference: ';
		$str .= htmlentities($this->m_cardEaseReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CardHash: ';
		$str .= htmlentities($this->m_cardHash, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CardReference: ';
		$str .= htmlentities($this->m_cardReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Contactless: ';
		$str .= htmlentities($this->m_contactless, ENT_QUOTES);
		$str .= $eol;		
		$str .= 'CSC: ';
		$str .= htmlentities($this->m_csc, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CurrencyCode: ';
		$str .= htmlentities($this->m_currencyCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExpiryDate: ';
		$str .= htmlentities($this->m_expiryDate, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExpiryDateFormat: ';
		$str .= htmlentities($this->m_expiryDateFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExtendedProperties: ';
		$str .= htmlentities(print_r($this->m_extendedProperties, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'FeatureTokens: ';
		$str .= htmlentities(print_r($this->m_featureTokens, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCFallback: ';
		$str .= htmlentities($this->m_iccFallback, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCTags: ';
		$str .= htmlentities(print_r($this->m_iccTags, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCType: ';
		$str .= htmlentities($this->m_iccType, ENT_QUOTES);
		$str .= $eol;
		$str .= 'IssueNumber: ';
		$str .= htmlentities($this->m_issueNumber, ENT_QUOTES);
		$str .= $eol;
		$str .= 'MachineReference: ';
		$str .= htmlentities($this->m_machineReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ManualType: ';
		$str .= htmlentities($this->m_manualType, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddress: ';
		$str .= htmlentities($this->m_originatingIPAddress, ENT_QUOTES);
		$str .= $eol;
		$str .= 'PAN: ';
		$str .= htmlentities($this->m_pan, ENT_QUOTES);
		$str .= $eol;
		$str .= 'RequestType: ';
		$str .= htmlentities($this->m_requestType, ENT_QUOTES);
		$str .= $eol;
		$str .= 'SoftwareName: ';
		$str .= htmlentities($this->m_softwareName, ENT_QUOTES);
		$str .= $eol;
		$str .= 'SoftwareVersion: ';
		$str .= htmlentities($this->m_softwareVersion, ENT_QUOTES);
		$str .= $eol;
		$str .= 'StartDate: ';
		$str .= htmlentities($this->m_startDate, ENT_QUOTES);
		$str .= $eol;
		$str .= 'StartDateFormat: ';
		$str .= htmlentities($this->m_startDateFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'SubType: ';
		$str .= htmlentities($this->m_subType, ENT_QUOTES);
		$str .= $eol;
		$str .= 'TerminalID: ';
		$str .= htmlentities($this->m_terminalID, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Track1: ';
		$str .= htmlentities($this->m_track1, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Track2: ';
		$str .= htmlentities($this->m_track2, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Track3: ';
		$str .= htmlentities($this->m_track3, ENT_QUOTES);
		$str .= $eol;
		$str .= 'TransactionKey: ';
		$str .= htmlentities($this->m_transactionKey, ENT_QUOTES);
		$str .= $eol;
		$str .= 'UserReference: ';
		$str .= htmlentities($this->m_userReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'VoidReason: ';
		$str .= htmlentities($this->m_voidReason, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ZipCode: ';
		$str .= htmlentities($this->m_zipCode, ENT_QUOTES);
		$str .= $eol;

		return $str;
	}
}

if (!defined('CARD_EASE_REFERENCE_LENGTH')) define('CARD_EASE_REFERENCE_LENGTH', 36);
if (!defined('CARD_HASH_LENGTH')) define('CARD_HASH_LENGTH', 28);
if (!defined('CARD_REFERENCE_LENGTH')) define('CARD_REFERENCE_LENGTH', 36);
if (!defined('CSC_MAX_LENGTH')) define('CSC_MAX_LENGTH', 4);
if (!defined('CSC_MIN_LENGTH')) define('CSC_MIN_LENGTH', 3);
if (!defined('CURRENCY_CODE_LENGTH')) define('CURRENCY_CODE_LENGTH', 3);
if (!defined('ECI_MAX_LENGTH')) define('ECI_MAX_LENGTH', 2);
if (!defined('ECI_MIN_LENGTH')) define('ECI_MIN_LENGTH', 1);
if (!defined('EXPIRY_DATE_FORMAT_MAX_LENGTH')) define('EXPIRY_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('ISSUE_NUMBER_MAX_LENGTH')) define('ISSUE_NUMBER_MAX_LENGTH', 2);
if (!defined('ISSUE_NUMBER_MIN_LENGTH')) define('ISSUE_NUMBER_MIN_LENGTH', 1);
if (!defined('OFFLINE_DATE_TIME_FORMAT_MAX_LENGTH')) define('OFFLINE_DATE_TIME_FORMAT_MAX_LENGTH', 19); // 'ab/ab/abcd ab:ab:ab'
if (!defined('PAN_MAX_LENGTH')) define('PAN_MAX_LENGTH', 19);
if (!defined('PAN_MIN_LENGTH')) define('PAN_MIN_LENGTH', 12);
if (!defined('RECURRING_ACTION_DATE_FORMAT_MAX_LENGTH')) define('RECURRING_ACTION_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('RECURRING_FINAL_DATE_FORMAT_MAX_LENGTH')) define('RECURRING_FINAL_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('RECURRING_INITIAL_DATE_FORMAT_MAX_LENGTH')) define('RECURRING_INITIAL_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('RECURRING_REGULAR_END_DATE_FORMAT_MAX_LENGTH')) define('RECURRING_REGULAR_END_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('RECURRING_REGULAR_START_DATE_FORMAT_MAX_LENGTH')) define('RECURRING_REGULAR_START_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('SOFTWARE_NAME_MAX_LENGTH')) define('SOFTWARE_NAME_MAX_LENGTH', 50);
if (!defined('SOFTWARE_VERSION_MAX_LENGTH')) define('SOFTWARE_VERSION_MAX_LENGTH', 20);
if (!defined('START_DATE_FORMAT_MAX_LENGTH')) define('START_DATE_FORMAT_MAX_LENGTH', 10); // 'ab/ab/abcd'
if (!defined('TERMINAL_ID_LENGTH')) define('TERMINAL_ID_LENGTH', 8);
if (!defined('TRACK1_MAX_LENGTH')) define('TRACK1_MAX_LENGTH', 79);
if (!defined('TRACK2_MAX_LENGTH')) define('TRACK2_MAX_LENGTH', 40);
if (!defined('TRACK2_START_SENTINEL')) define('TRACK2_START_SENTINEL', ';');
if (!defined('TRACK2_END_SENTINEL')) define('TRACK2_END_SENTINEL', '?');
if (!defined('TRACK3_MAX_LENGTH')) define('TRACK3_MAX_LENGTH', 107);

?>
