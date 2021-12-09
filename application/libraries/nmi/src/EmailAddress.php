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
 * A class used to hold email address information.
 * <p>
 * Each email address has an address and a type.
 *
 * @author Creditcall Ltd
 */
class EmailAddress {

	/**
	 * The email address.
	 * @private
	 */
	var $m_address = null;

	/**
	 * The type of the email address.
	 * @private
	 */
	var $m_type = EmailAddressType_Unknown;

	/**
	 * Creates a new email address with the fields.
	 *
	 * @param address The email address.
	 * @param type The type of the email address.
	 */
	function EmailAddress($address, $type) {
		$this->m_address = $address;
		$this->m_type = $type;
	}

	/**
	 * Gets the email address.
	 * If null it has not been set.
	 * @return string The email address.
	 * @see setAddress()
	 */
	function getAddress() {
		return $this->m_address;
	}

	/**
	 * Gets the type of the email address.
	 * If null it has not been set.
	 * @return string The type of the email address.
	 * @see setType()
	 */
	function getType() {
		return $this->m_type;
	}

	/**
	 * Sets the email address.
	 * @param address The email address.  If null it is removed.
	 * @see getAddress()
	 */
	function setAddress($address) {
		$this->m_address = $address;
	}

	/**
	 * Sets the type of the email address.
	 * @param type The type of the email address.  If null it is removed.
	 * @see getType()
	 */
	function setType($type) {
		$this->m_type = $type;
	}

	/**
	 * Returns a string detailing the address and type of the email address.
	 * @return string A string detailing the address and type of the email address.
	 */
	function toString() {

		$str = '';
		$str .= htmlentities($this->m_address, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_type, ENT_QUOTES);

		return $str;
	}
}

?>
