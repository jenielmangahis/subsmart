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
 * A class used to hold name information.
 *
 * @author Creditcall Ltd
 */
class Name {

	/**
	 * The first name of the person.
	 * @private
	 */
	var $m_firstName = null;

	/**
	 * The initials of the person.
	 * @private
	 */
	var $m_initials = null;

	/**
	 * The last name of the person.
	 * @private
	 */
	var $m_lastName = null;

	/**
	 * The title of the person.
	 * @private
	 */
	var $m_title = null;

	/**
	 * Creates a new name with the fields.
	 *
	 * @param title The title of the person.
	 * @param firstName The first name of the person.
	 * @param initials The initials of the person.
	 * @param lastName The last name of the person.
	 */
	function Name(
		$title = null,
		$firstName = null,
		$initials = null,
		$lastName = null) {
		$this->m_title = $title;
		$this->m_firstName = $firstName;
		$this->m_initials = $initials;
		$this->m_lastName = $lastName;
	}

	/**
	 * Gets the first name of the person.
	 * If null it has not been set.
	 * @return string The first name of the person.
	 * @see setFirstName()
	 */
	function getFirstName() {
		return $this->m_firstName;
	}

	/**
	 * Gets the initials of the person.
	 * If null it has not been set.
	 * @return string The initials of the person.
	 * @see setInitials()
	 */
	function getInitials() {
		return $this->m_initials;
	}

	/**
	 * Gets the last name of the person.
	 * If null it has not been set.
	 * @return string The last name of the person.
	 * @see setLastName()
	 */
	function getLastName() {
		return $this->m_lastName;
	}

	/**
	 * Gets the title of the person.
	 * If null it has not been set.
	 * @return string The last name of the person.
	 * @see setTitle()
	 */
	function getTitle() {
		return $this->m_title;
	}

	/**
	 * Determines whether the name is empty.
	 * @private
	 * @return bool Whether the name is empty.
	 */
	function isEmpty() {
		return $this->m_title === null && $this->m_firstName === null
				&& $this->m_initials === null && $this->m_lastName === null;
	}

	/**
	 * Sets the first name of the person.
	 * @param firstName The first name of the person.  If null it is removed.
	 * @see getFirstName()
	 */
	function setFirstName($firstName) {
		$this->m_firstName = $firstName;
	}

	/**
	 * Sets the initials of the person.
	 * @param initials The initials of the person.  If null it is removed.
	 * @see getInitials()
	 */
	function setInitials($initials) {
		$this->m_initials = $initials;
	}

	/**
	 * Sets the last name of the person.
	 * @param lastName The last name of the person.  If null it is removed.
	 * @see getLastName()
	 */
	function setLastName($lastName) {
		$this->m_lastName = $lastName;
	}

	/**
	 * Sets the title of the person.
	 * @param title The title of the person.  If null it is removed.
	 * @see getTitle()
	 */
	function setTitle($title) {
		$this->m_title = $title;
	}

	/**
	 * Returns a string detailing the values of the name.
	 * @return string A string detailing the values of the name.
	 */
	function toString() {

		$str = '';
	    $str .= htmlentities($this->m_title, ENT_QUOTES);
	    $str .= ':';
	    $str .= htmlentities($this->m_firstName, ENT_QUOTES);
	    $str .= ':';
	    $str .= htmlentities($this->m_initials, ENT_QUOTES);
	    $str .= ':';
        $str .= htmlentities($this->m_lastName, ENT_QUOTES);

        return $str;
	}
}

?>
