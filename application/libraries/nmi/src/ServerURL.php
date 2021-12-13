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
 * A URL and associated attributes that can be used for processing CardEaseXML
 * requests. At least one of these needs to be supplied to the Client for processing to take place.
 *
 * @author Creditcall Ltd
 */

class ServerURL
{
	/**
	 * The read timeout.
	 * @private
	 */
	var $m_timeout = 45000;

	/**
	 * The connection URL.
	 * @private
	 */
	var $m_url = null;

	/**
	 * Constructs a new server URL with specified URL and timeout.
	 *
	 * @param url
	 *	The actual URL of the server URL. This should be a HTTP URL
	 *	and in the form: 'http://...' or 'https://...'. This must not
	 *	be null.
	 * @param timeout
	 *	The read timeout for the specified server URL in milliseconds.
	 *	If zero is specified an infinite timeout is used.
	 *	For most requests a timeout of 45 seconds (45000) is recommended.
	 */
	function ServerURL($url, $timeout) {
		if ($timeout < 30000) {
			trigger_error('CardEaseXMLCommunication: Timeout cannot be less than 30 seconds', E_USER_ERROR);
		}
		$this->m_url = $url;
		$this->m_timeout = $timeout;
	}

	/**
	 * Gets the server URL read timeout in milliseconds. If this
	 * is zero an infinite timeout is used. For most requests a timeout of 45
	 * seconds (45000) is recommended.
	 *
	 * @return int The server URL read timeout in milliseconds.
	 */
	function getTimeout() {
		return $this->m_timeout;
	}

	/**
	 * Gets the server URL for the connection.
	 *
	 * @return ServerURL The server URL for the connection. If null is returned the URL
	 *	 has not been specified.
	 */
	function getURL() {
		return $this->m_url;
	}

	/**
	 * Sets the server URL read timeout in milliseconds. If zero
	 * is specified an infinite timeout is used. For most requests a timeout of
	 * 45 seconds (45000) is recommended.  A timeout of less than 30 seconds is
	 * not permitted as some authorisations may take this long.
	 *
	 * @param timeout
	 *	The server URL read timeout in milliseconds.
	 */
	function setTimeout($timeout) {
		if ($timeout < 30000) {
			trigger_error('CardEaseXMLCommunication: Timeout cannot be less than 30 seconds', E_USER_ERROR);
		}
		$this->m_timeout = $timeout;
	}

	/**
	 * Sets the server URL for the connection.
	 *
	 * @param url
	 *	The server URL for the connection. This must not be null.
	 * @see setURL()
	 */
	function setURL($url) {
		$this->m_url = $url;
	}

	/**
	 * Returns a string describing this server URL and its attributes.
	 *
	 * @return string A string describing this server URL and its attributes.
	 */
	function  toString() {

		$str = '';
		$str .= htmlentities($this->m_url, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_timeout, ENT_QUOTES);

		return $str;
	}
}
?>
