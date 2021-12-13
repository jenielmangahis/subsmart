<?php
/**
 * A class used to hold Funding Card information.
 */
class FundingCard{
	/**
	 * The reference to an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardReference = null;
	
	/**
	 * The hash of an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @private
	 */
	var $m_cardHash = null;
	
	/**
	 * The PAN (Primary Account Number) associated with the card.
	 * @private
	 */
	var $m_pan = null;
	
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
	 * The Card Tokens associated with the card.
	 * @private
	 */
	var $m_cardTokens = null;
	
	/**
	 * Creates a new Funding Card with these fields.
	 * 
	 * @param cardReference The reference to an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @param cardHash The hash of an existing card to use for manual payment in place of the PAN, ExpiryDate etc.
	 * @param pan The PAN (Primary Account Number) associated with the card.
	 * @param expiryDate The expiry date associated with the card.
	 * @param expiryDateFormat The format of the expiry date associated with the card.
	 * @param cardTokens The Card Tokens associated with the card.
	 */
	function FundingCard(
		$cardReference = null,
		$cardHash = null,
		$pan = null,
		$expiryDate = null,
		$expiryDateFormat = null,
		$cardTokens = null)
	{
		$this->m_cardReference = $cardReference;
		$this->m_cardHash = $cardHash;
		$this->m_pan = $pan;
		$this->m_expiryDate = $expiryDate;
		$this->m_expiryDateFormat = $expiryDateFormat;
		$this->m_cardTokens = $cardTokens;
	}

	/**
	 * Gets the card reference found in the Funding Card within the response that can be 
	 * used to reference a card in a follow-up transaction.
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
	function getCardReference(){
		return $this->m_cardReference;
	}
	
	/**
	 * Gets the card hash found in the Funding Card within the response that can be used to reference a
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
	function getCardHash(){
		return $this->m_cardHash;
	}
	
	/**
	 * Gets the masked PAN (Primary Account Number) found in the Funding Card within the response.
	 * The PAN is masked with x's for security. This is an alphanumeric string with a
	 * minimum length of 12 characters and a maximum length of 19 characters.
	 *
	 * @return string The PAN (Primary Account Number) found in this response. This
	 *	 will be null if no PAN was found in this response.
	 */
	function getPan(){
		return $this->m_pan;
	}
	
	/**
	 * Gets the expiry date associated with the card in the Funding Card within the response.
	 * This will match the expiry date format. This is a character string with a maximum length of 10 characters.
	 *
	 * @return string The expiry date associated with the card in this response. This
	 *	 will be null if no expiry date was found in this response.
	 * @see getExpiryDateFormat()
	 */
	function getExpiryDate(){
		return $this->m_expiryDate;
	}
	
	/**
	 * Gets the expiry date format associated with the card found in the Funding Card within the response.
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
	function getExpiryDateFormat(){
		return $this->m_expiryDateFormat;
	}

	/**
	 * Gets the card tokens of the Funding Card associated with the card in the response.
	 *
	 * @return The Card Tokens found in the Funding Card within the response. This
	 *         will be null if no Card Tokens were found in the response.
	 */
	function  getCardTokens() {
		return $this->m_cardTokens;
	}

    /**
	 * Sets the card reference.
	 * @param cardReferenceThe card reference.  If null it is removed.
	 * @see getCardReference()
	 */
	function setCardReference($cardReference){
		$this->m_cardReference = $cardReference;
	}
	
	/**
	 * Sets the card hash.
	 * @param cardHash The card hash.  If null it is removed.
	 * @see getCardHash()
	 */
	function setCardHash($cardHash){
		$this->m_cardHash = $cardHash;
	}
	
	/**
	 * Sets the PAN (Primary Account Reference)
	 * @param pan The  PAN (Primary Account Reference).  If null it is removed.
	 * @see getPan()
	 */
	function setPan($pan){
		$this->m_pan = $pan;
	}
	
	/**
	 * Sets the expiry date format.
	 * @param expiryDateFormat The expiry date format.  If null it is removed.
	 * @see getExpiryDateFormat()
	 */
	function setExpiryDate($expiryDate){
		$this->m_expiryDate = $expiryDate;
	}
	
	/**
	 * Sets the expiry date format of the funding card.
	 * @param expiryDateFormat The expiry date format of the funding card.  If null it is removed.
	 * @see getExpiryDateFormat()
	 */
	function setExpiryDateFormat($expiryDateFormat){
		$this->m_expiryDateFormat = $expiryDateFormat;
	}

	/**
	 * Sets the Card Tokens of the funding card.
	 * @param cardTokens The Card Tokens of the funding card.  If null it is removed.
	 * @see getCardTokens()
	 */
	function setCardTokens($cardTokens){
		$this->m_cardTokens = $cardTokens;
	}

	function cardTokensToString(){
		if(!empty($this->m_cardTokens)){
			$tokenString = "";
			foreach($this->m_cardTokens as $token){
				$tokenString .= $token->toString();
				$tokenString .= " ";
			}
			return $tokenString;
		}
	}
	
	/**
	 * Returns a string detailing the values of the Funding Card.
	 * @return string A string detailing the values of the Funding Card.
	 */
	function toString()
	{
		return $this->m_cardReference.
		":".
		$this->m_cardHash.
		":".
		$this->m_pan.
		":".
		$this->m_expiryDate.
		":".
		$this->m_expiryDateFormat.
		":".
		$this->cardTokensToString();
	}
}