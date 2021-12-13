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
 * A class to hold the information about a certification authority.
 *
 * @author Creditcall Ltd
 */
class CertificationAuthority {

	/**
	 * The description.
	 * @private
	 */
	var $m_description = null;

	/**
	 * The public keys.
	 * @private
	 */
	var $m_publicKeys = array();

	/**
	 * The registered identity.
	 * @private
	 */
	var $m_rid = null;

	/**
	 * Creates a new certification authority with the given description and
	 * registered identity.
	 *
	 * @param description
	 *	The description of the certification authority. If null no
	 *	description is set.
	 * @param rid
	 *	The registered identity of the certification authority. If
	 *	null no registered identity is set.
	 * @private
	 */
	function CertificationAuthority($description, $rid) {
		$this->m_description = $description;
		$this->m_rid = $rid;
		$this->m_publicKeys = array();
	}

	/**
	 * Adds a public key to the certification authority.
	 *
	 * @param publicKey
	 *	The public key to add to the certification authority. This
	 *	should not be null.
	 * @private
	 */
	function addPublicKey($publicKey) {
		if ($this->m_publicKeys === null) {
			$this->m_publicKeys = array();
		}

		$this->m_publicKeys[] = $publicKey;
	}

	/**
	 * Gets the description of the certification authority. This is an
	 * alphanumeric string. For example, Visa, Amex etc.
	 *
	 * @return string The description of the certification authority. If this is null
	 *	no description has been set.
	 */
	function getDescription() {
		return $this->m_description;
	}

	/**
	 * Gets the public keys of the certification authority.
	 *
	 * @return array The public keys of the certification authority. If this is null
	 *	no public keys have been set.
	 */
	function getPublicKeys() {
		return $this->m_publicKeys;
	}

	/**
	 * Gets the registered identifier of the certification authority. The first
	 * five bytes of an applications AID indicates the certification authority
	 * (ie. Visa, Amex etc). This is an alphanumeric string.
	 *
	 * @return string The registered identifier of the certification authority. If this
	 *	is null no registered identifier has been set.
	 */
	function getRID() {
		return $this->m_rid;
	}

	/**
	 * Sets the public keys of the certification authority.
	 *
	 * @param string publicKeys The public keys of the certification authority. If this is null
	 *	the public keys are removed.
	 * @private
	 */
	function setPublicKeys($publicKeys) {
		$this->m_publicKeys = $publicKeys;
	}

	/**
	 * Returns a string version of this certification authority.
	 *
	 * @return string A string version of this certification authority.
	 */
	function toString() {
		$eol = '<br>'."\n";
		$str = '';
		$str .= 'CERTIFICATION_AUTHORITY: ';
		$str .= $eol;
		$str .= '  Description: ';
		$str .= htmlentities($this->m_description, ENT_QUOTES);
		$str .= $eol;
		$str .= '  RID: ';
		$str .= htmlentities($this->m_rid, ENT_QUOTES);
		$str .= $eol;
		$str .= '  PublicKeys: ';
		$str .= $eol;
		foreach ($this->m_publicKeys as $publicKey) {
			$str .= '  PublicKey: ';
			foreach ($publicKey as $publicKeyField => $publicKeyFieldValue) {
				$str .= htmlentities("$publicKeyField:$publicKeyFieldValue", ENT_QUOTES);
				$str .= $eol;
			}
		}
		$str .= $eol;
		return $str;
	}
}
?>
