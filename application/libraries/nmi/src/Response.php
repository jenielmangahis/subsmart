<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

require_once('CertificationAuthority.php');
require_once('CexmlError.php');
require_once('ErrorCode.php');
require_once('ICCTag.php');
require_once('ICCTagValueType.php');
require_once('PublicKey.php');
require_once('ResultCode.php');
require_once('VerificationResult.php');
require_once('FundingCard.php');
require_once('CardToken.php');

/**
 * A class holding all of the data that constitutes a Response from CardEaseXML. The necessary
 * components of the request should be retrieved (using the 'getters'). The
 * response can only be obtained from the Client in response to a Request.
 * @author Creditcall Ltd
 * @see Client
 * @see Request
 */
class Response {
	/**
	 * The Funding Card associated with the card.
	 * @private
	 */
	var $m_fundingCard = null;
	
	/**
	 * The raw response data received from the address verification.
	 * @private
	 */
	var $m_addressResponseData = null;

	/**
	 * The result of the address verification.
	 * @private
	 */
	var $m_addressResult = VerificationResult_Empty;

	/**
	 * The authorisation code for an approved transaction.
	 * @private
	 */
	var $m_authCode = null;

	/**
	 * The authorisation entity for the transaction.
	 * @private
	 */
	var $m_authorisationEntity = null;

	/**
	 * The CardEase system reference for the response.
	 * @private
	 */
	var $m_cardEaseReference = null;

	/**
	 * The hash of an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardHash = null;

	/**
	 * The reference to an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardReference = null;

	/**
	 * The description of the card scheme.
	 * @private
	 */
	var $m_cardScheme = null;

	/**
	 * Array of the card tokens.
	 * @private
	 */
	var $m_cardTokens = array();

	/**
	 * The raw response data received from the csc verfication.
	 * @private
	 */
	var $m_cscResponseData = null;

	/**
	 * The result of the csc verification.
	 * @private
	 */
	var $m_cscResult = VerificationResult_Empty;

	/**
	 * Whether the transaction has been declined and the issuer has indicated
	 * that the same transaction should not be reattempted with the same parameters.
	 * @private
	 */
	var $m_doNotReauthorize = false;

	/**
	 * The reason the issuer has indicated that the same transaction
	 * should not be reattempted with the same parameters.
	 * @private
	 */
	var $m_doNotReauthorizeReason = null;

	/**
	 * Whether the transaction is a duplicate.
	 * @private
	 */
	var $m_duplicate = false;

	/**
	 * List of errors encountered.
	 * @private
	 */
	var $m_errors = array();

	/**
	 * The expiry date associated with the card.
	 * @private
	 */
	var $m_expiryDate = null;

	/**
	 * The format of the expiry date associated with the card.
	 * @private
	 */
	var $m_expiryDateFormat = null;

	/**
	 * The list of extended properties.
	 * @private
	 */
	var $m_extendedProperties = array();

	/**
	 * Whether fallforward to contact is required
	 * @private
	 */
	var $m_fallforwardToContact = false;
	
	/**
	 * The list of certification authorities.
	 * @private
	 */
	var $m_iccCertificationAuthorities = array();

	 /**
	 * Whether to clear the existing public key list.
	 * @private
	 */
	var $m_iccPublicKeyClearExisting = false;

	 /**
	 * The content of the public key list.
	 * @private
	 */
	var $m_iccPublicKeyContent = null;

	 /**
	 * Whether to replace the existing public key list.
	 * @private
	 */
	var $m_iccPublicKeyReplaceExisting = false;

	 /**
	 * The type of public key list.
	 * @private
	 */
	var $m_iccPublicKeyType = null;

	/**
	 * The list of ICC tags associated with the transaction.
	 * @private
	 */
	var $m_iccTags = array();

	/**
	 * The type of ICC transaction.
	 * @private
	 */
	var $m_iccType = null;

	/**
	 * The issue number associated with the card.
	 * @private
	 */
	var $m_issueNumber = null;

	/**
	 * The date and time at the terminals location.
	 * @private
	 */
	var $m_localDateTime = null;

	/**
	 * The format of the date and time at the terminals location.
	 * @private
	 */
	var $m_localDateTimeFormat = null;

	/**
	 * Whether online pin is required
	 * @private
	 */
	var $m_onlinePinRequired = false;
	
	/**
	 * The city of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressCity = null;

	/**
	 * The continent of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressContinent = null;

	/**
	 * The ISO 3166 alpha-2 continent of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressContinentAlpha2 = null;

	/**
	 * The country of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressCountry = null;

	/**
	 * The ISO 3166 alpha-2 country of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressCountryAlpha2 = null;

	/**
	 * The ISO 3166ode country of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressCountryCode = null;

	/**
	 * Whether the originating IP address is black listed.
	 * @private
	 */
	var $m_originatingIPAddressIsBlackListed = false;

	/**
	 * Whether the originating IP address is a known proxy.
	 * @private
	 */
	var $m_originatingIPAddressIsKnownProxy = false;

	/**
	 * The region of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressRegion = null;

	/**
	 * The region code of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressRegionCode = null;

	/**
	 * The zip code of the originating IP address.
	 * @private
	 */
	var $m_originatingIPAddressZipCode = null;

	/**
	 * The PAR (Primary Account Reference) associated with the card.
	 * @private
	 */
	var $m_par = null;
	
	/**
	 * The PAN (Primary Account Number) associated with the card.
	 * @private
	 */
	var $m_pan = null;
		
	/**
	 * The result code from CardEase.
	 * @private
	 */
	var $m_resultCode = ResultCode_Empty;

	/**
	 * The name of the server software.
	 * @private
	 */
	var $m_serverName = null;

	/**
	 * The version of the server software.
	 * @private
	 */
	var $m_serverVersion = null;

	/**
	 * The start date associated with the card.
	 * @private
	 */
	var $m_startDate = null;

	/**
	 * The format of the start date associated with the card.
	 * @private
	 */
	var $m_startDateFormat = null;

	/**
	 * In response to an authorisation request the issuer
	 * has indicated that 3-D Secure authentication is required.
	 * @private
	 */
	var $m_3DSecureRequired = false;

	/**
	 * An optional user reference.
	 * @private
	 */
	var $m_userReference = null;

	/**
	 * The Coordinated Universal Time.
	 * @private
	 */
	var $m_utc = null;

	/**
	 * The format of the Coordinated Universal Time.
	 * @private
	 */
	var $m_utcFormat = null;

	/**
	 * The voice referral telephone number.
	 * @private
	 */
	var $m_voiceReferralTelephoneNumber = null;

	/**
	 * The raw response data received from the zip code verfication.
	 * @private
	 */
	var $m_zipCodeResponseData = null;

	/**
	 * The result of the zip code verification.
	 * @private
	 */
	var $m_zipCodeResult = VerificationResult_Empty;

	/**
	 * The identifier for transactions using the gateway.
	 */
	var $m_transactionId = null;

	/**
	 * ID of the Customer Vault.
	 */
	var $m_customerVaultId = null;

	/**
	 * Constructs a new response and initialises all variables.
	 */
	function Response()
	{
		$this->m_addressResponseData = null;
		$this->m_addressResult = VerificationResult_Empty;
		$this->m_authCode = null;
		$this->m_authorisationEntity = null;
		$this->m_cardEaseReference = null;
		$this->m_cardHash = null;
		$this->m_cardReference = null;
		$this->m_cardScheme = null;
		$this->m_cscResponseData = null;
		$this->m_cscResult = VerificationResult_Empty;
		$this->m_cardTokens = array();
		$this->m_doNotReauthorize = false;
		$this->m_doNotReauthorizeReason = null;
		$this->m_duplicate = false;
		$this->m_errors = array();
		$this->m_expiryDate = null;
		$this->m_expiryDateFormat = null;
		$this->m_extendedProperties = array();
		$this->m_fallforwardToContact = false;
		$this->m_iccCertificationAuthorities = array();
		$this->m_iccPublicKeyClearExisting = false;
		$this->m_iccPublicKeyContent = null;
		$this->m_iccPublicKeyReplaceExisting = false;
		$this->m_iccPublicKeyType = null;
		$this->m_iccTags = array();
		$this->m_iccType = null;
		$this->m_issueNumber = null;
		$this->m_localDateTime = null;
		$this->m_localDateTimeFormat = null;
		$this->m_onlinePinRequired = false;
		$this->m_originatingIPAddressCity = null;
		$this->m_originatingIPAddressContinent = null;
		$this->m_originatingIPAddressContinentAlpha2 = null;
		$this->m_originatingIPAddressCountry = null;
		$this->m_originatingIPAddressCountryAlpha2 = null;
		$this->m_originatingIPAddressCountryCode = null;
		$this->m_originatingIPAddressIsBlackListed = false;
		$this->m_originatingIPAddressIsKnownProxy = false;
		$this->m_originatingIPAddressRegion = null;
		$this->m_originatingIPAddressRegionCode = null;
		$this->m_originatingIPAddressZipCode = null;
		$this->m_par = null;
		$this->m_pan = null;
		$this->m_fundingCard = new FundingCard();
		$this->m_resultCode = ResultCode_Empty;
		$this->m_serverName = null;
		$this->m_serverVersion = null;
		$this->m_startDate = null;
		$this->m_startDateFormat = null;
		$this->m_3DSecureRequired = false;
		$this->m_utc = null;
		$this->m_utcFormat = null;
		$this->m_userReference = null;
		$this->m_voiceReferralTelephoneNumber = null;
		$this->m_zipCodeResponseData = null;
		$this->m_zipCodeResult = VerificationResult_Empty;
		$this->m_transactionId = null;
		$this->m_customerVaultId = null;
	}

	/**
	 * Gets the identifier for a transaction using the gateway.
	 *
	 * @return string The identifier for a transaction that uses the gateway.
	 * 		   This will be null if the gateway is not used.
	 */
	function getTransactionId(){
		return $this->m_transactionId;
	}

	/**
	 * Gets the Customer Vault ID associated with this request for the Omni Gateway.
	 * If the Customer Vault Command is add-customer this is optional, if the Customer Vault ID is not supplied it will be generated.
	 * If the Customer Vault Command is update-customer then this field is mandatory. The value must be one that was
	 * previously used with an add-customer Customer Vault Command.
	 *
	 * @return string Customer Vault ID associated with this request.
	 */
	function getCustomerVaultId(){
		return $this->m_customerVaultId;
	}

	/**
	 * Gets the raw response data received from the address verification with
	 * the issuer. The content of this is dependant upon the acquirer, country,
	 * protocol etc. This is an alphanumeric string.
	 * This will be available if required in the original request.
	 *
	 * @return string The raw response data received from the address verfication. This
	 *	 will be null if no raw address data was found in this response.
	 */
	function getAddressResponseData() {
		return $this->m_addressResponseData;
	}

	/**
	 * Gets the result of the address verification with the issuer. This will be
	 * available if required in the original request.
	 *
	 * @return string The result of the address verification:
	 *
	 * <table border=1>
	 *	 <tr>
	 *	 <th>NotChecked</th>
	 *	 <td>The address was not checked against the issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>NotMatched</th>
	 *	 <td>The address did not match issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>Matched</th>
	 *	 <td>The address matched issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>PartialMatch</th>
	 *	 <td>The address partially matched issuer records</td>
	 *	 </tr>
	 *	 </table> This will be null if no result data was found in the
	 *	 response.
	 */
	function getAddressResult() {
		return $this->m_addressResult;
	}

	/**
	 * Gets the authorisation code found in this response. This will only be
	 * present if the transaction was approved. This is an alphanumeric string
	 * with a maximum length of 12 characters.
	 *
	 * @return string The authorisation code found in this response. This will be null
	 *	 if no authorisation code was found in this response.
	 */
	function getAuthCode() {
		return $this->m_authCode;
	}

	/**
	 * Gets the authorisation entity found in the response.
	 *
	 * @return string The authorisation entity found in the response.  This will be null
	 * if no authorisation entity was found in the response.
	 */
	function getAuthorisationEntity() {
		return $this->m_authorisationEntity;
	}

	/**
	 * Gets the CardEaseXML reference found in this response. This is a unique
	 * reference that can be used with CardEaseXML during follow-up requests
	 * related to the original such as confirmations, refunds and voids. This is
	 * an alphanumeric string with a fixed length of 36 characters.
	 *
	 * @return string The CardEaseXML reference found in this response. This will be
	 *	 null if no CardEase reference was found in this response.
	 */
	function getCardEaseReference() {
		return $this->m_cardEaseReference;
	}

	/**
	 * Gets the card hash found in the response that can be used to reference a
	 * card in a follow-up transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 28 characters. Used
	 * in conjunction with the CardReference property. The benefit of being able
	 * to reference a previously used card is that an integrator need not store
	 * actual card details on their system for repeat transactions. This reduces
	 * the risk of card information being compromised, and reduces the
	 * integrators PCI requirements.
	 *
	 * @return string The card hash found in the response that can be used to reference
	 *	 a card in a follow-up transaction.
	 * @see getCardReference()
	 */
	function getCardHash() {
		return $this->m_cardHash;
	}

	/**
	 * Gets the card reference found in the response that can be used to
	 * reference a card in a follow-up transaction.
	 * <p>
	 * This is an alphanumeric string with a fixed length of 36 characters. Used
	 * in conjunction with the CardHash property. The benefit of being able to
	 * reference a previously used card is that an integrator need not store
	 * actual card details on their system for repeat transactions. This reduces
	 * the risk of card information being compromised, and reduces the
	 * integrators PCI requirements.
	 *
	 * @return string The card reference found in the response that can be used to
	 *	 reference a card in a follow-up transaction.
	 * @see getCardHash()
	 */
	function getCardReference() {
		return $this->m_cardReference;
	}

	/**
	 * Gets the description of the card scheme used in the request. This can be
	 * used on a receipt. This is an alphanumeric string with a maximum length
	 * of 50 characters.
	 *
	 * @return string The description of the card scheme used in the request. This will
	 *	 be null if no card scheme was found in this response.
	 */
	function getCardScheme() {
		return $this->m_cardScheme;
	}

	/**
	 * Gets the card tokens received in the response.
	 *
	 * @return array The card tokens received in the response. This will
	 *         be null if no card tokens were not found in this response.
	 */
	function getCardTokens() {
		return $this->m_cardTokens;
	}

	/**
	 * Gets the raw response data received from the security code verification
	 * with the issuer. This is also referred to as CVV, CVC and CV2. The
	 * content of this is dependant upon the acquirer, country, protocol etc.
	 * This is an alphanumeric string. This will be available if required in the original request.
	 * If the CSC validation fails the authorisation may be automatically declined or may continue to be approved.  If the authorisation is approved the CSC result should be checked.
	 *
	 * @return string The raw response data received from the security code
	 *	 verfication. This will be null if no raw security code data was
	 *	 found in this response.
	 */
	function getCSCResponseData() {
		return $this->m_cscResponseData;
	}

	/**
	 * Gets the result of the security code verification with the issuer. This
	 * will be available if required in the original request.
	 * If the CSC validation fails the authorisation may be automatically declined or may continue to be approved.  If the authorisation is approved the CSC result should be checked.
	 *
	 * @return string The result of the security code verification:
	 *
	 * <table border=1>
	 *	 <tr>
	 *	 <th>NotChecked</th>
	 *	 <td>The security code was not checked against the issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>NotMatched</th>
	 *	 <td>The security code did not match the issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>Matched</th>
	 *	 <td>The security code matched the issuer records</td>
	 *	 </tr>
	 *	 </table> This will be null if no result data was found in the
	 *	 response.
	 */
	function getCSCResult() {
		return $this->m_cscResult;
	}

	/**
	 * Gets whether the transaction has been declined
	 * and the issuer has indicated that the same transaction should not be reattempted with the same parameters.
	 *
	 * @return bool Whether the transaction has been declined
	 * and the issuer has indicated that the same transaction should not be reattempted with the same parameters.
	 */
	function getDoNotReauthorize() {
		return $this->m_doNotReauthorize;
	}

	/**
	 * Gets the reason the issuer has indicated
	 * that the same transaction should not be reattempted with the same parameters.
	 *
	 * @return String The reason the issuer has indicated
	 * that the same transaction should not be reattempted with the same parameters.
	 */
	function getDoNotReauthorizeReason() {
		return $this->m_doNotReauthorizeReason;
	}

	/**
	 * Gets whether the transaction was recognised as a duplicate.
	 * @return bool Whether the transaction was recognised as a duplicate.
	 */
	function getDuplicate() {
		return $this->m_duplicate;
	}

	/**
	 * Gets a list of the errors that we encountered when trying to process the
	 * request. Each error contains an error code and an error message.
	 *
	 * @return array A list of the errors that we encountered when trying to process
	 *	 the request. This will be empty if no errors were found in the
	 *	 response.
	 * @see CexmlError
	 */
	function getErrors() {
		return $this->m_errors;
	}

	/**
	 * Gets the expiry date associated with the card in this response. This will
	 * match the expiry date format. This is a character string with a maximum length of 10 characters.
	 *
	 * @return string The expiry date associated with the card in this response. This
	 *	 will be null if no expiry date was found in this response.
	 * @see getExpiryDateFormat()
	 */
	function getExpiryDate() {
		return $this->m_expiryDate;
	}

	/**
	 * Gets the expiry date format associated with the card in the response.
	 * This will match the format of the expiry date and can include separators such as - and /.
	 * This is a character string with a maximum length of 10 characters.
	 * The available options are
	 * shown in the following table:
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
	 * @return string The expiry date format associated with the card in this response.
	 *	 This will be null if no expiry date format was found in the
	 *	 response.
	 * @see getExpiryDate()
	 */
	function getExpiryDateFormat() {
		return $this->m_expiryDateFormat;
	}

	/**
	 * Gets the list of extended properties found in the response.
	 *
	 * @return array The list of extended properties found in the response.
	 * This will be null if no extended properties were found in the response.
	 */
	function getExtendedProperties() {
		return $this->m_extendedProperties;
	}
	
	/**
	 * Gets if it is needed to fallforward to contact.
	 *
	 * @return boolean The boolean value of fallforward to contact
	 * This will be false if fallforward to contact is not found in the response.
	 */
	function getFallforwardToContact() {
	    return $this->m_fallforwardToContact;
	}

	/**
	 * Gets the list of ICC certification authorities found in the response.
	 *
	 * @return array The list of certification authorities found in the response. This
	 *	 will be null if no certification authorities were found in the
	 *	 response.
	 */
	function getICCCertificationAuthorities() {
		return $this->m_iccCertificationAuthorities;
	}

	/**
	 * Gets the indicator in the response that says whether to clear the
	 * existing public key list.
	 *
	 * @return bool The indicator in the response that says whether to clear the
	 *	 existing public key list. This will be null if no indicator was
	 *	 found.
	 * @see getICCPublickeyReplaceExisting()
	 */
	function getICCPublicKeyClearExisting() {
		return $this->m_iccPublicKeyClearExisting;
	}

	/**
	 * Gets a description of the public key list content. For example
	 * 'complete'. It is an alphanumeric string.
	 *
	 * @return string A description of the public key list content. This will be null
	 *	 if no description was found.
	 * @see getICCPublicKeyType()
	 */
	function getICCPublicKeyContent() {
		return $this->m_iccPublicKeyContent;
	}

	/**
	 * Gets the indicator in the response that says whether to replace the
	 * existing public key list.
	 *
	 * @return bool The indicator in the response that says whether to replace the
	 *	 existing public key list. This will be null if no indicator was
	 *	 found.
	 * @see getICCPublicKeyClearExisting()
	 */
	function getICCPublickeyReplaceExisting() {
		return $this->m_iccPublicKeyReplaceExisting;
	}

	/**
	 * Gets the type of the public key list. For example 'EMV'. It is an
	 * alphanumeric string.
	 *
	 * @return string The type of the public key list. This will be null if no type was
	 *	 found.
	 * @see getICCPublicKeyContent()
	 */
	function getICCPublicKeyType() {
		return $this->m_iccPublicKeyType;
	}

	/**
	 * Gets the list of ICC tags found in this response. Each ICC tag has an id,
	 * type and value. For example, a tag of 0x9f02/AsciiHex/000000000100 is
	 * using to specify the transaction amount. These are mandatory for an EMV
	 * transaction.
	 *
	 * @return array The list of ICC tags found in this response. This will be null if
	 *	 no ICC tags were found in this response.
	 * @see ICCTag
	 */
	function getICCTags() {
		return $this->m_iccTags;
	}

	/**
	 * Gets the type of ICC transaction associated with this response. This is
	 * an alphanumeric string. This is
	 * mandatory for ICC authorisations and by default is 'EMV'. An EMV
	 * transaction must have associated ICC tags.
	 *
	 * @return string The type of ICC transaction associated with the request. This
	 *	 will be null if no ICC type was found in this response.
	 * @see ICCTag
	 * @see getICCTags()
	 */
	function getICCType() {
		return $this->m_iccType;
	}

	/**
	 * Gets the issue number associated with the card in this response. This is
	 * dependant upon the card scheme associated with the card and will be
	 * exactly as found on the card (including any leading 0's). This is a
	 * numeric string with a maximum length of 2 characters.
	 *
	 * @return string The issue number associated with the card in this response. This
	 *	 will be null if no issue number was found in this response.
	 */
	function getIssueNumber() {
		return $this->m_issueNumber;
	}

	/**
	 * Gets the date and time at the terminal's location. This can be used on a
	 * receipt and will match the local date and time format.
	 * This is a character string.
	 *
	 * @return string The date and time at the terminal's location. This will be null
	 *	 if no local date and time was found in this response.
	 * @see getLocalDateTimeFormat()
	 */
	function getLocalDateTime() {
		return $this->m_localDateTime;
	}

	/**
	 * Gets the local date and time format at the terminal's location. This will
	 * match the format of the local date and time and can include separators such as :, - and /.
	 * This is a character string. The available options are
	 * shown in the following table:
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
	 * <td>HH</td>
	 * <td>Hour of day (24 hour)</td>
	 * <td>17</td>
	 * </tr>
	 * <tr>
	 * <td>mm</td>
	 * <td>Minute of hour</td>
	 * <td>53</td>
	 * </tr>
	 * <tr>
	 * <td>ss</td>
	 * <td>Second of minute</td>
	 * <td>43</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The local date and time format at the terminal's location. This
	 *	 will be null if no local date and time format was found in the
	 *	 response.
	 * @see getLocalDateTime()
	 */
	function getLocalDateTimeFormat() {
		return $this->m_localDateTimeFormat;
	}

	/**
	 * Gets if it is needed to online pin required.
	 *
	 * @return boolean The boolean value of online pin required.
	 * This will be false if online pin required is not found in the response.
	 */
	function getOnlinePinRequired() {
	    return $this->m_onlinePinRequired;
	}
	
	/**
	 * Gets the city of the originating IP address found in this response.
	 * @return string The city of the originating IP address found in this response.
	 * This will be null if no city was found in this response.
	 */
	 function getOriginatingIPAddressCity() {
	 	return $this->m_originatingIPAddressCity;
	 }

	/**
	 * Gets the continent of the originating IP address found in this response.
	 * @return string The continent of the originating IP address found in this response.
	 * This will be null if no continent was found in this response.
	 */
	 function getOriginatingIPAddressContinent() {
	 	return $this->m_originatingIPAddressContinent;
	 }

	/**
	 * Gets the ISO 3166 continent alpha-2 of the originating IP address found in this response.
	 * @return string The ISO 3166 continent alpha-2 of the originating IP address found in this response.
	 * This will be null if no ISO 3166 continent alpha-2 was found in this response.
	 */
	 function getOriginatingIPAddressContinentAlpha2() {
	 	return $this->m_originatingIPAddressContinentAlpha2;
	 }

	/**
	 * Gets the country of the originating IP address found in this response.
	 * @return string The country of the originating IP address found in this response.
	 * This will be null if no country was found in this response.
	 */
	 function getOriginatingIPAddressCountry() {
	 	return $this->m_originatingIPAddressCountry;
	 }

	/**
	 * Gets the ISO 3166 country alpha-2 of the originating IP address found in this response.
	 * @return string The ISO 3166 country alpha-2 of the originating IP address found in this response.
	 * This will be null if no ISO 3166 country alpha-2 was found in this response.
	 */
	 function getOriginatingIPAddressCountryAlpha2() {
	 	return $this->m_originatingIPAddressCountryAlpha2;
	 }

	/**
	 * Gets the ISO 3166 country code of the originating IP address found in this response.
	 * @return string The ISO 3166 country code of the originating IP address found in this response.
	 * This will be null if no ISO 3166 country code was found in this response.
	 */
	 function getOriginatingIPAddressCountryCode() {
	 	return $this->m_originatingIPAddressCountryCode;
	 }

	/**
	 * Gets whether the originating IP address is black listed.
	 * @return bool Whether the originating IP address is black listed.
	 * This will be false if this was not found in the response.
	 */
	function getOriginatingIPAddressIsBlackListed() {
		return $this->m_originatingIPAddressIsBlackListed;
	}

	/**
	 * Gets whether the originating IP address is a known proxy.
	 * @return bool Whether the originating IP address is a known proxy.
	 * This will be false if this was not found in the response.
	 */
	function getOriginatingIPAddressIsKnownProxy() {
		return $this->m_originatingIPAddressIsKnownProxy;
	}

	/**
	 * Gets the region of the originating IP address found in this response.
	 * @return string The region of the originating IP address found in this response.
	 * This will be null if no region was found in this response.
	 */
	function getOriginatingIPAddressRegion() {
		return $this->m_originatingIPAddressRegion;
	}

	/**
	 * Gets the region code of the originating IP address found in this response.
	 * @return string The region code of the originating IP address found in this response.
	 * This will be null if no region code was found in this response.
	 */
	function getOriginatingIPAddressRegionCode() {
		return $this->m_originatingIPAddressRegionCode;
	}

	/**
	 * Gets the zip code of the originating IP address found in this response.
	 * @return string The zip code of the originating IP address found in this response.
	 * This will be null if no zip code was found in this response.
	 */
	function getOriginatingIPAddressZipCode() {
		return $this->m_originatingIPAddressZipCode;
	}

	/**
	 * Gets the PAR (Primary Account Reference) found in this response.
	 *
	 * @return string The PAR (Primary Account Reference) found in the response. This
	 *	 will be null if no PAR was found in the response. This is an alphanumeric string with a length of 29 characters.
	 */
	function getPAR() {
		return $this->m_par;
	}
	
	/**
	 * Gets the masked PAN (Primary Account Number) found in this response. The
	 * PAN is masked with x's for security. This is an alphanumeric string with a
	 * minimum length of 12 characters and a maximum length of 19 characters.
	 *
	 * @return string The PAN (Primary Account Number) found in this response. This
	 *	 will be null if no PAN was found in this response.
	 */
	function getPAN() {
		return $this->m_pan;
	}

	/**
	 * Gets the Funding Card found in this response.
	 *
	 * @return FundingCard The Funding Card found in this response.
	 */
	function getFundingCard(){
		return $this->m_fundingCard;
	}
	
	/**
	 * Gets the result code that has been obtained from the CardEase platform
	 * when processing the source request.
	 *
	 * @return string The result code that has been obtained from the CardEase platform
	 *	 when processing the source request. This will be null if no
	 *	 result code was found in this response.
	 */
	function getResultCode() {
		return $this->m_resultCode;
	}

	/**
	 * Gets the start date associated with the card in this response. This will
	 * match the start date format. This is a character string with a
	 * maximum length of 10 characters.
	 *
	 * @return string The start date associated with the card in this response. This
	 *	 will be null if no start date was found in this response.
	 * @see getStartDateFormat()
	 */
	function getStartDate() {
		return $this->m_startDate;
	}

	/**
	 * Gets the start date format associated with the card in this response.
	 * This will match the format of the start date and can include separators such as - and /.
	 * This is a character string with a maximum length of 10 characters.
	 * The available options are shown in the following table:
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
	 * @return string The start date format associated with the card in this response.
	 *	 This will be null if no start date format was found in the
	 *	 response.
	 * @see getStartDate()
	 */
	function getStartDateFormat() {
		return $this->m_startDateFormat;
	}

	/**
	 * Gets if it is 3-D Secure required.
	 *
	 * @return boolean Gets if in the response to an authorisation request the issuer
	 * has indicated that 3-D Secure authentication is required
	 *
	 * This will be false if the issuer has indicated that 3-D Secure authentication
	 * is not required in the authorisation response.
	 */
	function getThreeDSecureRequired() {
		return $this->m_3DSecureRequired;
	}

	/**
	 * Gets the voice referral telephone number found in the response.
	 * @return string The voice referral telephone number found in the response.
	 */
	function getVoiceReferralTelephoneNumber() {
		return $this->m_voiceReferralTelephoneNumber;
	}

	/**
	 * Gets the user reference found in this response. This will be the same as
	 * that in the original request. This allows a user to attached their own
	 * reference against a request and verify it against this response.
	 * This is an alphanumeric string with a maximum length of 50 characters. Use of
	 * the user reference is optional for all requests.
	 *
	 * @return string The user reference found in this response. This will be null if
	 *	 no user reference was found in this response.
	 */
	function getUserReference() {
		return $this->m_userReference;
	}

	/**
	 * Gets the Coordinated Universal Time.
	 * This is a character string.
	 *
	 * @return string The Coordinated Universal Time.  This will be null
	 *	 if no UTC was found in this response.
	 * @see getLocalDateTimeFormat()
	 */
	function getUTC() {
		return $this->m_utc;
	}

	/**
	 * Gets the Coordinated Universal Time. This will
	 * match the format of the UTC and can include separators such as :, - and /.
	 * This is a character string. The available options are
	 * shown in the following table:
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
	 * <td>HH</td>
	 * <td>Hour of day (24 hour)</td>
	 * <td>17</td>
	 * </tr>
	 * <tr>
	 * <td>mm</td>
	 * <td>Minute of hour</td>
	 * <td>53</td>
	 * </tr>
	 * <tr>
	 * <td>ss</td>
	 * <td>Second of minute</td>
	 * <td>43</td>
	 * </tr>
	 * </table>
	 *
	 * @return string The Coordinated Universal Time. This
	 *	 will be null if no UTC was found in the
	 *	 response.
	 * @see getUTC()
	 */
	function getUTCFormat() {
		return $this->m_utcFormat;
	}

	/**
	 * Gets the raw response data received from the zip code/post code
	 * verification with the issuer. The content of this is dependant upon the
	 * acquirer, country, protocol etc. This is an alphanumeric string.
	 * This will be available if required in
	 * the original request.
	 *
	 * @return string The raw response data received from the zip code/post code
	 *	 verfication. This will be null if no raw zip code/post code data
	 *	 was found in this response.
	 */
	function getZipCodeResponseData() {
		return $this->m_zipCodeResponseData;
	}

	/**
	 * Gets the result of the zip code/post code verification with the issuer.
	 * This will be available if required in the original request.
	 *
	 * @return string The result of the zip code/post code verification:
	 *
	 * <table border=1>
	 *	 <tr>
	 *	 <th>NotChecked</th>
	 *	 <td>The zip code/post code was not checked against the issuer
	 *	 records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>NotMatched</th>
	 *	 <td>The zip code/post code did not match issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>Matched</th>
	 *	 <td>The zip code/post code matched issuer records</td>
	 *	 </tr>
	 *	 <tr>
	 *	 <th>PartialMatch</th>
	 *	 <td>The zip code/post code partially matched issuer records</td>
	 *	 </tr>
	 *	 </table> This will be null if no result data was found in the
	 *	 response.
	 */
	function getZipCodeResult() {
		return $this->m_zipCodeResult;
	}

	/**
	 * Parses the XML response.
	 * @private
	 *
	 * @param xml
	 *	 The XML to parse.
	 * @throws E_USER_ERROR
	 *	 If the XML encoding is missing or the XML is badly formed.
	 */
	function parseResponseXML($xml)
	{
		if (empty($xml))
			trigger_error('CardEaseXMLResponse: Unable to parse XML', E_USER_ERROR);

		$dom = new DOMDocument();
		$dom->loadXML($xml);
		$responseNodes = $dom->getElementsByTagName("Response");
		if ($responseNodes->length == 0 || $responseNodes->length > 1)
			return;

		$responseNode = $responseNodes->item(0);
		$this->parseTransactionDetails($responseNode);
		$this->parseResult($responseNode);
		$this->parseCardDetails($responseNode);
		$this->parseAdditionalVerification($responseNode);
		$this->parseICCPublicKeys($responseNode);
	}

	function parseTransactionDetails($responseNode)
	{
		$transactionDetailsNodes = $responseNode->getElementsByTagName("TransactionDetails");
		if ($transactionDetailsNodes->length == 0)
			return;

		$transactionDetailsNode = $transactionDetailsNodes->item(0);
		foreach ($transactionDetailsNode->childNodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "REFERENCE":
					$this->m_userReference = $node->textContent;
					break;
				case "CARDEASEREFERENCE":
					$this->m_cardEaseReference = $node->textContent;
					break;
				case "LOCALDATETIME":
					$this->m_localDateTimeFormat = $node->getAttribute('format');
					$this->m_localDateTime = $node->textContent;
					break;
				case "UTC":
					$this->m_utcFormat = $node->getAttribute('format');
					$this->m_utc = $node->textContent;
					break;
				case "EXTENDEDPROPERTYLIST":
					$this->parseExtendedPropertyList($node);
					break;
				case "GEOIP":
					$this->m_originatingIPAddressIsBlackListed = filter_var($node->getAttribute('IsBlackListed'), FILTER_VALIDATE_BOOLEAN);
					$this->m_originatingIPAddressIsKnownProxy = filter_var($node->getAttribute('IsKnownProxy'), FILTER_VALIDATE_BOOLEAN);

					foreach ($node->childNodes as $geoipNode)
					{
						switch (strtoupper($geoipNode->nodeName)){
							case "CITY":
								$this->m_originatingIPAddressCity = $geoipNode->textContent;
								break;
							case "CONTINENT":
								$this->m_originatingIPAddressContinent = $geoipNode->textContent;
								$this->m_originatingIPAddressContinentAlpha2 = $geoipNode->getAttribute('alpha2');
								break;
							case "COUNTRY":
								$this->m_originatingIPAddressCountry = $geoipNode->textContent;
								$this->m_originatingIPAddressCountryAlpha2 = $geoipNode->getAttribute('alpha2');
								$this->m_originatingIPAddressCountryCode = $geoipNode->getAttribute('code');
								break;
							case "REGION":
								$this->m_originatingIPAddressRegion = $geoipNode->textContent;
								$this->m_originatingIPAddressRegionCode = $geoipNode->getAttribute('code');
								break;
							case "ZIPCODE":
								$this->m_originatingIPAddressZipCode = $geoipNode->textContent;
								break;
						}
					}
					break;
				case "GWTRANSACTIONID":
					$this->m_transactionId = $node->textContent;
					break;
				case "GWCUSTOMERVAULTID":
					$this->m_customerVaultId = $node->textContent;
					break;
			}
		}
	}

	function parseResult($responseNode)
	{
		$resultNodes = $responseNode->getElementsByTagName('Result');
		if ($resultNodes->length == 0)
			return;

		$resultNode = $resultNodes->item(0);

		if ($resultNode->hasAttribute('duplicate'))
			$this->m_duplicate = filter_var($resultNode->getAttribute('duplicate'), FILTER_VALIDATE_BOOLEAN);

		if (!$resultNode->hasChildNodes())
			return;
		foreach ($resultNode->childNodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "LOCALRESULT":
					$this->m_resultCode = (new ResultCode)->parse($node->textContent);
					break;
				case "AUTHORISATIONENTITY":
					$this->m_authorisationEntity = $node->textContent;
					break;
				case "DONOTREAUTHORIZE":
					$this->m_doNotReauthorize = $node->textContent;
					if ($node->hasAttribute('reason'))
						$this->m_doNotReauthorizeReason = $node->getAttribute('reason');
					break;
				case "AUTHCODE":
					$this->m_authCode = $node->textContent;
					break;
				case "REFERRALTELEPHONENUMBER":
					$this->m_voiceReferralTelephoneNumber = $node->textContent;
					break;
				case "FALLFORWARDTOCONTACT":
				    $this->m_fallforwardToContact = (strcmp($node->textContent, 'true') == 0);
				    break;
				case "ONLINEPINREQUIRED":
				    $this->m_onlinePinRequired = (strcmp($node->textContent, 'true') == 0);
				    break;
				case "THREEDSECUREREQUIRED":
				    $this->m_3DSecureRequired = (strcmp($node->textContent, 'true') == 0);
				    break;
				case "ERRORS":
					if (!$node->hasChildNodes())
						break;

					foreach ($node->childNodes as $errorNode)
					{
						$code = (new ErrorCode)->parse($errorNode->getAttribute("code"));
                        $message = $errorNode->textContent;
                        array_push($this->m_errors, new CexmlError($code, $message));
					}
					break;
			}
		}
	}

	function parseCardDetails($responseNode)
	{
		$cardDetailsNodes = $responseNode->getElementsByTagName('CardDetails');
		if ($cardDetailsNodes->length == 0)
			return;

		$cardDetailsNode = $cardDetailsNodes->item(0);
		foreach ($cardDetailsNode->childNodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "CARDREFERENCE":
					$this->m_cardReference = $node->textContent;
					break;
				case "CARDHASH":
					$this->m_cardHash = $node->textContent;
					break;
				case "PAN":
					$this->m_pan = $node->textContent;
					break;
				case "PAR":
					$this->m_par = $node->textContent;
					break;
				case "EXPIRYDATE":
					$this->m_expiryDateFormat = $node->getAttribute("format");
					$this->m_expiryDate = $node->textContent;
					break;
				case "STARTDATE":
					$this->m_startDateFormat = $node->getAttribute("format");
					$this->m_startDate = $node->textContent;
					break;
				case "ISSUENUMBER":
					$this->m_issueNumber = $node->textContent;
					break;
				case "CARDSCHEME":
					if (!$node->hasChildNodes())
						break;

					if ($node->hasAttribute('id'))
						$this->m_cardSchemeId = $node->getAttribute('id');

					if ($node->hasAttribute('accountType'))
						$this->m_cardSchemeAccountType = $node->getAttribute('accountType');

					foreach ($node->childNodes as $schemeNode)
					{
						$schemeName = strtoupper($schemeNode->nodeName);
						if ($schemeName == 'DESCRIPTION')
							$this->m_cardScheme = $node->textContent;
					}
					break;
				case "ICC":
					$this->parseICCTags($node);
					break;
				case "FUNDINGCARD":
					$this->parseFundingCard($node);
					break;
				case "CARDTOKENS":
					if (!$node->hasChildNodes())
						break;
					else
						foreach ($node->childNodes as $childNode){
							$cardToken = $this->parseCardToken($childNode);
							$this->m_cardTokens[] = $cardToken;
						}
					break;
			}
		}
	}

	function parseICCTags($iccNode)
	{
		if ($iccNode->hasAttribute('type'))
			$this->m_iccType = $iccNode->getAttribute('type');

		$iCCTagNodes = $iccNode->getElementsByTagName('ICCTag');
		if ($iCCTagNodes->length == 0)
			return;

		foreach ($iCCTagNodes as $node)
		{
			if ($node->hasAttribute('tagid'))
				$id = $node->getAttribute('tagid');
			else
				$id = null;
			if ($node->hasAttribute('type'))
				$type = $node->getAttribute('type');
			else
				$type = null;
            $value = $node->textContent;

            if ($type)
				array_push($this->m_iccTags, new ICCTag($id, (new ICCTagValueType)->parse($type), $value));
            else
				array_push($this->m_iccTags, new ICCTag($id, $value));
		}
	}

	function parseFundingCard($fundingCardNode)
	{
		if ($fundingCardNode == null || !$fundingCardNode->hasChildNodes())
			return;

		$cardReference = "";
        $cardHash = "";
        $pan = "";
        $expiryDate = "";
        $expiryDateFormat = "";
        $fundingCardTokens = array();

		foreach ($fundingCardNode->childNodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "CARDREFERENCE":
					$cardReference = $node->textContent;
					break;
				case "CARDHASH":
					$cardHash = $node->textContent;
					break;
				case "PAN":
					$pan = $node->textContent;
					break;
				case "EXPIRYDATE":
					$expiryDateFormat = $node->getAttribute("format");
					$expiryDate = $node->textContent;
					break;
				case "CARDTOKENS":
					if ($node->hasChildNode())
						foreach ($node->childNodes as $childNode){
							$cardToken = $this->parseCardToken($childNode);
							$fundingCardTokens[] = $cardToken;
						}
					break;
			}

			if (!($this->isNullOrEmptyString($cardReference) &&
				$this->isNullOrEmptyString($cardHash) &&
				$this->isNullOrEmptyString($pan) &&
				$this->isNullOrEmptyString($expiryDate) &&
				$this->isNullOrEmptyString($expiryDateFormat)
			))
				$this->m_fundingCard = new FundingCard($cardReference, $cardHash, $pan, $expiryDate, $expiryDateFormat, $fundingCardTokens);
		}
	}

	function parseCardToken($cardTokenChildNode)
	{
		if ($cardTokenChildNode == null)
			return;

		$algorithm = "";
        $key = "";
        $value = "";

		if ($cardTokenChildNode->hasAttribute('alg'))
			$algorithm = $cardTokenChildNode->getAttribute('alg');
		else
			$algorithm = null;
		if ($cardTokenChildNode->hasAttribute('kid'))
			$key = $cardTokenChildNode->getAttribute('kid');
		else
			$key = null;
		$value = $cardTokenChildNode->textContent;

		if (!($this->isNullOrEmptyString($algorithm) &&
			$this->isNullOrEmptyString($key) &&
			$this->isNullOrEmptyString($value)
		))
			return new CardToken($algorithm, $key, $value);
	}

	function parseAdditionalVerification($responseNode)
	{
		$nodes = $responseNode->getElementsByTagName("AdditionalVerification");
		if ($nodes->length == 0)
			return;

		$nodes = $nodes->item(0)->childNodes;
		if ($nodes->length == 0)
			return;

		foreach ($nodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "ADDRESS":
					$this->m_addressResult = (new VerificationResult)->parse($node->textContent);
					$this->m_addressResponseData = $node->getAttribute("raw");
					break;
				case "ZIP":
					$this->m_zipCodeResult = (new VerificationResult)->parse($node->textContent);
					$this->m_zipCodeResponseData = $node->getAttribute("raw");
					break;
				case "CSC":
					$this->m_cscResult = (new VerificationResult)->parse($node->textContent);
					$this->m_cscResponseData = $node->getAttribute("raw");
					break;
			}
		}
	}

	function parseICCPublicKeys($responseNode)
	{
		$nodes = $responseNode->getElementsByTagName("ICCPublicKeys");
		if ($nodes->length == 0)
			return;

		$iccNode = $nodes->item(0);
		$this->m_iccPublicKeyType = $iccNode->getAttribute("type");
		$this->m_iccPublicKeyContent = $iccNode->getAttribute("content");
		$this->m_iccPublicKeyClearExisting = filter_var($iccNode->getAttribute('clearexisting'), FILTER_VALIDATE_BOOLEAN);
		$this->m_iccPublicKeyReplaceExisting = filter_var($iccNode->getAttribute('replaceexisting'), FILTER_VALIDATE_BOOLEAN);

		foreach ($iccNode->childNodes as $node)
		{
			if (strtoupper($node->nodeName) == 'CERTIFICATIONAUTHORITY')
				$this->parseCertificationAuthority($node);
		}
	}

	function parseCertificationAuthority($certificationAuthorityNode)
	{
		$description = $certificationAuthorityNode->getAttribute('description');
		$rid = $certificationAuthorityNode->getAttribute('rid');

		$certificationAuthority = new CertificationAuthority($description, $rid);
		array_push($this->m_iccCertificationAuthorities, $certificationAuthority);

		foreach ($certificationAuthorityNode->childNodes as $node)
		{
			if (strtoupper($node->nodeName) == 'PUBLICKEY')
				$this->parsePublicKey($node, $certificationAuthority);
		}
	}

	function parsePublicKey($publicKeyNode, $certificationAuthority)
	{
		$index = $publicKeyNode->getAttribute("index");
        $hash = $publicKeyNode->getAttribute("hash");
        $hashAlgorithm = $publicKeyNode->getAttribute("hashalgorithm");

		$publicKey = new PublicKey($index, $hash, $hashAlgorithm);
		$certificationAuthority->AddPublicKey($publicKey);

		foreach ($publicKeyNode->childNodes as $node)
		{
			switch (strtoupper($node->nodeName)){
				case "ALGORITHM":
					$publicKey->m_algorithm = $node->textContent;
					break;
				case "MODULUS":
					$publicKey->m_modulus = $node->textContent;
					break;
				case "EXPONENT":
					$publicKey->m_exponent = $node->textContent;
					break;
				case "VALIDFROM":
					$publicKey->m_validFromDate = $node->textContent;
					$publicKey->m_validFromDateFormat =  $node->getAttribute('format');
					break;
				case "VALIDTO":
					$publicKey->m_validToDate = $node->textContent;
					$publicKey->m_validToDateFormat =  $node->getAttribute('format');
					break;
			}
		}
	}

	function parseExtendedPropertyList($node)
	{
		$extendedPropertyListNode = $node->getElementsByTagName("ExtendedProperty");
		if ($extendedPropertyListNode->length == 0)
			return;

		foreach ($extendedPropertyListNode as $extendedPropertyNode)
		{
			$id = $extendedPropertyNode->getAttribute('id');
			$value = $extendedPropertyNode->textContent;
			array_push($this->m_extendedProperties, new ExtendedProperty($id, $value));
		}
	}

	function isNullOrEmptyString($str){
		return (!isset($str) || trim($str) === '');
	}

	function cardTokensToString(){
		$tokenString = "";
		foreach($this->m_cardTokens as $token){
			$tokenString .= $token->toString();
			$tokenString .= " ";
		}
		return $tokenString;
	}

	/**
	 * Returns a detailed string showing this response.
	 *
	 * @return string A detailed string showing this response.
	 */
	function toString() {

		$eol = '<br>'."\n";

		$str = '';
		$str .= 'RESPONSE:';
		$str .= $eol;
		$str .= 'AddressResponseData: ';
		$str .= htmlentities($this->m_addressResponseData, ENT_QUOTES);
		$str .= $eol;
		$str .= 'AddressResult: ';
		$str .= htmlentities($this->m_addressResult, ENT_QUOTES);
		$str .= $eol;
		$str .= 'AuthCode: ';
		$str .= htmlentities($this->m_authCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'AuthorisationEntity: ';
		$str .= htmlentities($this->m_authorisationEntity, ENT_QUOTES);
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
		$str .= 'CardScheme: ';
		$str .= htmlentities($this->m_cardScheme, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CardTokens: ';
		$str .= htmlentities($this->cardTokensToString(), ENT_QUOTES);
		$str .= $eol;
		$str .= 'CSCResponseData: ';
		$str .= htmlentities($this->m_cscResponseData, ENT_QUOTES);
		$str .= $eol;
		$str .= 'CSCResult: ';
		$str .= htmlentities($this->m_cscResult, ENT_QUOTES);
		$str .= $eol;
		$str .= 'DoNotReauthorize: ';
		$str .= htmlentities($this->m_doNotReauthorize, ENT_QUOTES);
		$str .= $eol;
		$str .= 'DoNotReauthorizeReason: ';
		$str .= htmlentities($this->m_doNotReauthorizeReason, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Duplicate: ';
		$str .= htmlentities($this->m_duplicate, ENT_QUOTES);
		$str .= $eol;
		$str .= 'Errors: ';
		$str .= htmlentities(print_r($this->m_errors, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExpiryDate: ';
		$str .= htmlentities($this->m_expiryDate, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExpiryDateFormat: ';
		$str .= htmlentities($this->m_expiryDateFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'FallforwardToContact: ';
		$str .= htmlentities($this->m_fallforwardToContact, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ExtendedProperties: ';
		$str .= htmlentities(print_r($this->m_extendedProperties, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCCertificationAuthorities: ';
		$str .= htmlentities(print_r($this->m_iccCertificationAuthorities, true), ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCPublicKeyClearExisting: ';
		$str .= htmlentities($this->m_iccPublicKeyClearExisting, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCPublicKeyContent: ';
		$str .= htmlentities($this->m_iccPublicKeyContent, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCPublicKeyReplaceExisting: ';
		$str .= htmlentities($this->m_iccPublicKeyReplaceExisting, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ICCPublicKeyType: ';
		$str .= htmlentities($this->m_iccPublicKeyType, ENT_QUOTES);
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
		$str .= 'LocalDateTime: ';
		$str .= htmlentities($this->m_localDateTime, ENT_QUOTES);
		$str .= $eol;
		$str .= 'LocalDateTimeFormat: ';
		$str .= htmlentities($this->m_localDateTimeFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OnlinePinRequired: ';
		$str .= htmlentities($this->m_onlinePinRequired, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressCity: ';
		$str .= htmlentities($this->m_originatingIPAddressCity, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressContinent: ';
		$str .= htmlentities($this->m_originatingIPAddressContinent, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressContinentAlpha2: ';
		$str .= htmlentities($this->m_originatingIPAddressContinentAlpha2, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressCountry: ';
		$str .= htmlentities($this->m_originatingIPAddressCountry, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressCountryAlpha2: ';
		$str .= htmlentities($this->m_originatingIPAddressCountryAlpha2, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressCountryCode: ';
		$str .= htmlentities($this->m_originatingIPAddressCountryCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressIsBlackListed: ';
		$str .= htmlentities($this->m_originatingIPAddressIsBlackListed, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressIsKnownProxy: ';
		$str .= htmlentities($this->m_originatingIPAddressIsKnownProxy, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressRegion: ';
		$str .= htmlentities($this->m_originatingIPAddressRegion, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressRegionCode: ';
		$str .= htmlentities($this->m_originatingIPAddressRegionCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'OriginatingIPAddressZipCode: ';
		$str .= htmlentities($this->m_originatingIPAddressZipCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'FundingCard: ';
		$str .= htmlentities($this->m_fundingCard->toString(),ENT_QUOTES);
		$str .= $eol;
		$str .= 'PAN: ';
		$str .= htmlentities($this->m_pan, ENT_QUOTES);
		$str .= $eol;
		$str .= 'PAR: ';
		$str .= htmlentities($this->m_par, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ResultCode: ';
		$str .= htmlentities($this->m_resultCode, ENT_QUOTES);
		$str .= $eol;
		$str .= 'StartDate: ';
		$str .= htmlentities($this->m_startDate, ENT_QUOTES);
		$str .= $eol;
		$str .= 'StartDateFormat: ';
		$str .= htmlentities($this->m_startDateFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ThreeDSecureRequired: ';
		$str .= htmlentities($this->m_3DSecureRequired, ENT_QUOTES);
		$str .= $eol;
		$str .= 'UserReference: ';
		$str .= htmlentities($this->m_userReference, ENT_QUOTES);
		$str .= $eol;
		$str .= 'UTC: ';
		$str .= htmlentities($this->m_utc, ENT_QUOTES);
		$str .= $eol;
		$str .= 'UTCFormat: ';
		$str .= htmlentities($this->m_utcFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ZipCodeResponseData: ';
		$str .= htmlentities($this->m_zipCodeResponseData, ENT_QUOTES);
		$str .= $eol;
		$str .= 'ZipCodeResult: ';
		$str .= htmlentities($this->m_zipCodeResult, ENT_QUOTES);
		$str .= $eol;
		return $str;
	}
}
?>
