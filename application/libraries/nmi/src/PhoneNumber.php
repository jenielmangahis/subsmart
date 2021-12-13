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
 * A class used to hold phone number information.
 * <p>
 * Each phone number has a number and a type.
 *
 * @author Creditcall Ltd
 */
class PhoneNumber {

	/**
	 * The phone number.
	 * @private
	 */
	var $m_number = null;

	/**
	 * The type of the phone number.
	 * @private
	 */
	var $m_type = PhoneNumberType_Unknown;

	/**
	 * Creates a new phone number with the fields.
	 *
	 * @param number The phone number
	 * @param type The type of the phone number.
	 */
	function PhoneNumber($number, $type) {
		$this->m_number = $number;
		$this->m_type = $type;
	}

	/**
	 * Gets the phone number.
	 * If null it is not set.
	 * @return string The phone number.
	 * @see setNumber()
	 */
	function getNumber() {
		return $this->m_number;
	}

	/**
	 * Gets the phone number type.
	 * If null it is not set.
	 * @return string The phone number type.
	 * @see setType()
	 */
	function getType() {
		return $this->m_type;
	}

	/**
	 * Sets the phone number.
	 * @param number The phone number.  If null it is removed.
	 * @see getNumber()
	 */
	function setNumber($number) {
		$this->m_number = $number;
	}

	/**
	 * Sets the phone number type.
	 * @param type The phone number type.  If null it is removed.
	 * @see getType()
	 */
	function setType($type) {
		$this->m_type = $type;
	}

	/**
	 * Returns a string detailing the number and type of the phone number.
	 * @return string A string detailing the number and type of the phone number.
	 */
	function toString() {

		$str = '';
		$str .= htmlentities($this->m_number, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_type, ENT_QUOTES);

		return $str;
	}
}

?>
