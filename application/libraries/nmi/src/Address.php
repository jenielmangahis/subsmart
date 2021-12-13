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
 * A class used to hold address information.
 *
 * @author Creditcall Ltd
 */
class Address {

	/**
	 * The town/city of the address.
	 * @private
	 */
	var $m_city = null;

	/**
	 * The country of the address.
	 * @private
	 */
	var $m_country = null;

	/**
	 * The address lines of the address.
	 * @private
	 */
	var $m_lines = array();

	/**
	 * The recipient lines of the address.
	 * @private
	 */
	var $m_recipient = array();

	/**
	 * The county/state of the address.
	 * @private
	 */
	var $m_state = null;

	/**
	 * The post/zip code of the address.
	 * @private
	 */
	var $m_zipCode = null;

	/**
	 * Creates a new address with the fields.
	 *
	 * @param recipient The recipient lines of the address.
	 * @param lines The address lines of the address.
	 * @param city The town/city of the address.
	 * @param state The county/state of the address.
	 * @param country The country of the address.
	 * @param zipCode The post/zip code of the address.
	 */
	function Address(
		$recipient = array(),
		$lines = array(),
		$city = null,
		$state = null,
		$zipCode = null,
		$country = null) {

		if ($recipient !== null && !is_array($recipient)) {
			$this->m_recipient = array($recipient);
		} else {
			$this->m_recipient = $recipient;
		}

		if ($lines !== null && !is_array($lines)) {
			$this->m_lines = array($lines);
		} else {
			$this->m_lines = $lines;
		}

		$this->m_city = $city;
		$this->m_state = $state;
		$this->m_zipCode = $zipCode;
		$this->m_country = $country;
	}

	/**
	 * Gets the town/city of the address.
	 * If null it has not been set.
	 * @return town/city of the address.
	 * @see setCity()
	 */
	function getCity() {
		return $this->m_city;
	}

	/**
	 * Gets the country of the address.
	 * If null it has not been set.
	 * @return string The country of the address.
	 * @see setCountry()
	 */
	function getCountry() {
		return $this->m_country;
	}

	/**
	 * Gets the address lines of the address.
	 * If null it has not been set.
	 * @return string The address lines of the address.
	 * @see setLines()
	 */
	function getLines() {
		return $this->m_lines;
	}

	/**
	 * The recipient lines of the address.
	 * If null it has not been set.
	 * @return string The recipient lines of the address.
	 * @see setRecipient()
	 */
	function getRecipient() {
		return $this->m_recipient;
	}

	/**
	 * The county/state of the address.
	 * If null it has not been set.
	 * @return string The county/state of the address.
	 * @see setState()
	 */
	function getState() {
		return $this->m_state;
	}

	/**
	 * The post/zip code of the address.
	 * If null it has not been set.
	 * @return string The post/zip code of the address.
	 * @see setZipCode()
	 */
	function getZipCode() {
		return $this->m_zipCode;
	}

	/**
	 * Determines whether the address is empty.
	 *
	 * @return bool Whether the address is empty.
	 */
	function isEmpty() {
		return $this->m_city === null && $this->m_country === null
				&& ($this->m_lines === null || count($this->m_lines) === 0)
				&& ($this->m_recipient === null || count($this->m_recipient) === 0)
				&& $this->m_state === null && $this->m_zipCode === null;
	}

	/**
	 * Sets the city of the address.
	 * @param city The city of the address.  If null it is removed.
	 * @see getCity()
	 */
	function setCity($city) {
		$this->m_city = $city;
	}

	/**
	 * Sets the country of the address.
	 * @param country The country of the address.  If null it is removed.
	 * @see getCountry()
	 */
	function setCountry($country) {
		$this->m_country = $country;
	}

	/**
	 * Sets the address lines of the address.
	 * @param lines The address lines of the address.  If null it is removed.
	 * @see getLines()
	 */
	function setLines($lines) {
		if ($lines !== null && !is_array($lines)) {
			$this->m_lines = array($lines);
		} else {
			$this->m_lines = $lines;
		}
	}

	/**
	 * Sets the recipient lines of the address.
	 * @param recipient The recipient lines of the address.  If null it is removed.
	 * @see getRecipient()
	 */
	function setRecipient($recipient) {
		if ($recipient !== null && !is_array($recipient)) {
			$this->m_recipient = array($recipient);
		} else {
			$this->m_recipient = $recipient;
		}
	}

	/**
	 * Sets the county/state of the address.  If null it is removed.
	 * @param state
	 * @see getState()
	 */
	function setState($state) {
		$this->m_state = $state;
	}

	/**
	 * Sets the post/zip code of the address.  If null it is removed.
	 * @param zipCode
	 * @see getZipCode()
	 */
	function setZipCode($zipCode) {
		$this->m_zipCode = $zipCode;
	}

	/**
	 * Returns a string detailing the values of the address.
	 * @return string A string detailing the values of the address.
	 */
	function toString() {

		$str = '';

		foreach ($this->m_recipient as $recipient) {
			$str .= htmlentities($recipient, ENT_QUOTES);
			$str .= ':';
		}

		foreach ($this->m_lines as $line) {
			$str .= htmlentities($line, ENT_QUOTES);
			$str .= ':';
		}

		$str .= htmlentities($this->m_city, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_state, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_zipCode, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_country, ENT_QUOTES);

		return $str;
	}
}

?>
