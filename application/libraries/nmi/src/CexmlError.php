<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

require_once('ErrorCode.php');

/**
 * An error that can be returned as the result of a CardEaseXML request in a CardEase response. Contains
 * both an error code and a error message. This class is used to hold these.
 *
 * @author Creditcall Ltd
 */
class CexmlError {
	function CexmlError($code, $message) {
		$this->m_code = ErrorCode::parse($code);
		$this->m_message = $message;
	}
	/**
	 * The error code associated with this error.
	 * @private
	 */
	var $m_code = ErrorCode_Empty;

	/**
	 * The error message associated with this error code.
	 * @private
	 */
	var $m_message = null;

	/**
	 * Constructs a new error with the given error code and error message.
	 * @private
	 *
	 * @param code
	 *	The error code associated with this error. This should be a
	 *	valid integer.
	 * @param message
	 *	The error message associated with this error. This is an alphanumeric string. This should not
	 *	be null.
	 */
	function Error($code, $message) {
		$this->m_code = ErrorCode::parse($code);
		$this->m_message = $message;
	}

	/**
	 * Gets the error code associated with this error.
	 *
	 * @return string The error code associated with this error. If null is returned
	 *	 the error code has not been specified.
	 */
	function getCode() {
		return $this->m_code;
	}

	/**
	 * Gets the error message associated with this error. This is an alphanumeric string.
	 *
	 * @return string The error message associated with this error. If null is returned
	 *	 the error message has not been specified.
	 */
	function getMessage() {
		return $this->m_message;
	}

	/**
	 * Returns a string showing both the error code and error message associated
	 * with this error.
	 *
	 * @return string A string showing both the error code and error message associated
	 *	 with this error.
	 */
	function toString() {

		$str = '';
		$str .= htmlentities($this->m_code, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_message, ENT_QUOTES);

		return $str;
	}
}

?>
