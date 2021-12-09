<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */


require_once('TransactionInitiatedBy.php');
/**
 * A class used to hold Credential-on-File information.
 *
 * @author Creditcall Ltd
 */
class CredentialOnFile {

	/**
	 * Who initiated the transaction.
	 * @private
	 */
	var $m_initiatedBy = null;

	/**
	 * The merchant's reason for the transaction. Must be supplied if the transaction was initiated by the merchant.
	 * @private
	 */
	var $m_reason = null;

	/**
	 * The CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @private
	 */
	var $m_cardEaseReference = null;

	/**
	 * Optional indicator as to whether this transaction is from a stored card. This is needed when using your
	 * own card store and sending card details in each transaction instead of a token.
	 * @private
	 */
	var $m_firstStore = null;

	/**
	 * Creates a new Credential-on-File instance with the fields.
	 *
	 * @param initiatedBy Who initiated the transaction.
	 * @param reason The merchant's reason for the transaction. Must be supplied if the transaction was initiated by the merchant.
	 * @param cardEaseReference The CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @param firstStore Optional indicator as to whether this transaction is from a stored card. This is needed when using
	 *						your own card store and sending card details in each transaction instead of a token.
	 */
	function CredentialOnFile(
		$initiatedBy = null,
		$reason = null,
		$cardEaseReference = null,
		$firstStore = null) {

		$this->m_initiatedBy = $initiatedBy;
		$this->m_reason = $reason;
		$this->m_cardEaseReference = $cardEaseReference;
		$this->m_firstStore = ($firstStore != null) ? $firstStore : TransactionFirstStore_Default;
	}

	/**
	 * Gets who initiated the transaction.
	 * If null it has not been set.
	 * @return TransactionInitiatedBy initiated the transaction.
	 * @see setTransactionInitiatedBy()
	 */
	function getInitiatedBy() {
		return $this->m_initiatedBy;
	}

	/**
	 * Gets the merchant's reason for the transaction. Must be supplied if the transaction was initiated by the merchant.
	 * If null it has not been set.
	 * @return TransactionReason The merchant's reason for the transaction.
	 * @see setTransactionReason()
	 */
	function getTransactionReason() {
		return $this->m_reason;
	}

	/**
	 * Gets the CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @return The CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @see setCardEaseReference(String)
	 */
	function getCardEaseReference() {
		return $this->m_cardEaseReference;
	}

	/**
	 * Gets the optional indicator as to whether this transaction is from a stored card. This is needed when
	 * using your own card store and sending card details in each transaction instead of a token.
	 * @return firstStore The optional flag to indicate whether this transaction is from a stored card. This is needed when
	 * 						using your own card store and sending card details in each transaction instead of a token.
	 * @see setFirstStore(firstStore)
	 */
	function getFirstStore() {
		return $this->m_firstStore;
	}

	/**
	 * Determines whether the credential on file object is empty.
	 *
	 * @return bool Whether the credential on file is object is empty.
	 */
	function isEmpty() {
		return $this->m_initiatedBy === null && $this->m_reason === null
				&& $this->m_cardEaseReference === null;
	}

	/**
	 * Sets who initiated the transaction.
	 * @param initiatedBy Who initiated the transaction.
	 * @see getInitiatedBy()
	 */
	function setInitiatedBy($initiatedBy) {
		$this->m_initiatedBy = $initiatedBy;
	}

	/**
	 * Sets the merchant's reason for the transaction. Must be supplied if the transaction was initiated by the merchant.
	 * @param reason The merchant's reason for the transaction. Must be supplied if the transaction was initiated by the merchant.
	 * @see getReason()
	 */
	function setReason($reason) {
		$this->m_reason = $reason;
	}

	/**
	 * Sets the CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @param cardEaseReference The CardEaseReference of the initial transaction.  Must be supplied when using a CardReference and CardHash.  Otherwise leave as null.
	 * @see getCardEaseReference()
	 */
	function setCardEaseReference($cardEaseReference) {
		$this->m_cardEaseReference = $cardEaseReference;
	}

	/**
	 * Sets the optional indicator as to whether this transaction is from a stored card. This is needed when
	 * using your own card store and sending card details in each transaction instead of a token.
	 * @param firstStore The optional flag to indicate whether this transaction is from a stored card. This is needed when
	 * 						using your own card store and sending card details in each transaction instead of a token.
	 * @see  getFirstStore()
	 */
	function setFirstStore($firstStore) {
		$this->m_firstStore = $firstStore;
	}

	/**
	 * Returns a string detailing the values of the Credential-on-File.
	 * @return string A string detailing the values of the Credential-on-File.
	 */
	function toString() {
		$str = '';
		$str .= htmlentities($this->m_initiatedBy, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_reason, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_cardEaseReference, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_firstStore, ENT_QUOTES);
		return $str;
	}
}
?>
