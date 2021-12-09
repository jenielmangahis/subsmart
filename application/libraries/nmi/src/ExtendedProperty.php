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
 * A class to hold extended property information.
 * <p>
 * Each extended property has a name and a value.
 * @author Creditcall Ltd
 */
class ExtendedProperty {

	/**
	 * The name of the extended property.
	 * @private
	 */
	var $m_name = null;

	/**
	 * The value of the extended property.
	 * @private
	 */
	var $m_value = null;

	/**
	 * Creates a new extended property with the specified name and value.
	 * @param name The name of the extended property
	 * @param value The value of the extended property
	 */
	function ExtendedProperty($name, $value) {
		$this->m_name = $name;
		$this->m_value = $value;
	}

	/**
	 * Returns the name of the extended property.
	 * @return string The name of the extended property.
	 * @see setName()
	 */
	function getName() {
		return $this->m_name;
	}

	/**
	 * Returns the value of the extended property.
	 * @return string The value of the extended property.
	 * @see setValue()
	 */
	function getValue() {
		return $this->m_value;
	}

	/**
	 * Sets the name of the extended property.
	 * @param name The name of the extended property.
	 * @see getName()
	 */
	function setName($name) {
		$this->m_name = $name;
	}

	/**
	 * Sets the value of the extended property.
	 * @param value The value of the extended property.
	 * @see getValue()
	 */
	function setValue($value) {
		$this->m_value = $value;
	}

	/**
	 * Returns a string detailing the name and value of this extended property.
	 *
	 * @return string A string detailing the name and value of this extended property.
	 */
	function toString() {

		$str = '';
		$str .= htmlentities($this->m_name, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_value, ENT_QUOTES);

		return $str;
	}
}

?>
