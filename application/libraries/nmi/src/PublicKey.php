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
 * A class to hold information about a public key.
 *
 * @author Creditcall Ltd
 */
class PublicKey {

	/**
	 * The algorithm.
	 */
	var $m_algorithm = null;

	/**
	 * The exponent.
	 */
	var $m_exponent = null;

	/**
	 * The hash.
	 */
	var $m_hash = null;

	/**
	 * The hash algorithm.
	 */
	var $m_hashAlgorithm = null;

	/**
	 * The index.
	 */
	var $m_index = null;

	/**
	 * The modulus.
	 */
	var $m_modulus = null;

	/**
	 * The valid from date.
	 */
	var $m_validFromDate = null;

	/**
	 * The valid from date format.
	 */
	var $m_validFromDateFormat = null;

	/**
	 * The valid to date.
	 */
	var $m_validToDate = null;

	/**
	 * The valid to date format.
	 */
	var $m_validToDateFormat = null;

	/**
	 * Creates a new public key with the given information.
	 *
	 * @param index
	 *	The public key index. This is an alphanumeric string. If null
	 *	no index is set.
	 * @param hash
	 *	The public key hash. This is an alphanumeric string. If null
	 *	no hash is set.
	 * @param hashAlgorithm
	 *	The public key hash algorithm. This is an alphanumeric string.
	 *	If null no hash algorithm is set.
	 * @private
	 */
	function PublicKey(
		$index,
		$hash,
		$hashAlgorithm) {

		$this->m_algorithm = null;
		$this->m_exponent = null;
		$this->m_hash = $hash;
		$this->m_hashAlgorithm = $hashAlgorithm;
		$this->m_index = $index;
		$this->m_modulus = null;
		$this->m_validFromDate = null;
		$this->m_validFromDateFormat = null;
		$this->m_validToDate = null;
		$this->m_validToDateFormat = null;
	}

	/**
	 * Gets the public key algorithm. This is an alphanumeric string. For
	 * example 'RSA'.
	 *
	 * @return string The public key algorithm. If null no algorithm has been set.
	 */
	function getAlgorithm() {
		return $this->m_algorithm;
	}

	/**
	 * Gets the public key exponent. This is an alphanumeric string.
	 *
	 * @return string The public key exponent. If null no exponent has been set.
	 */
	function getExponent() {
		return $this->m_exponent;
	}

	/**
	 * Gets the public key hash. This is an alphanumeric string.
	 *
	 * @return string The public key hash. If null no hash has been set.
	 */
	function getHash() {
		return $this->m_hash;
	}

	/**
	 * Gets the public key hash algorithm. This is an alphanumeric string. For
	 * example 'SHA1'.
	 *
	 * @return string The public key hash algorithm. If null no hash algorithm has been
	 *	set.
	 */
	function getHashAlgorithm() {
		return $this->m_hashAlgorithm;
	}

	/**
	 * Gets the public key index. This is a alphanumeric string.
	 *
	 * @return string The public key index. If null no index has been set.
	 */
	function getIndex() {
		return $this->m_index;
	}

	/**
	 * Gets the public key modulus. This is an alphanumeric string.
	 *
	 * @return string The public key modulus. If null no modulus has been set.
	 */
	function getModulus() {
		return $this->m_modulus;
	}

	/**
	 * Gets the public key valid from date. This will match the valid from date
	 * format. This is a character string.
	 *
	 * @return string The public key valid from date. If null no valid from date has
	 *	been set.
	 */
	function getValidFromDate() {
		return $this->m_validFromDate;
	}

	/**
	 * Gets the public key valid from format. This will match the format of the
	 * valid from date and can include separators such as - and /.
	 * This is a character string.
	 * The available options are shown in the following table:
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
	 * @return string The public key valid from format. If null no valid from date
	 *	format has been set.
	 */
	function getValidFromDateFormat() {
		return $this->m_validFromDateFormat;
	}

	/**
	 * Gets the public key valid to date. This will match the valid to date
	 * format. This is an alphanumeric string.
	 *
	 * @return string The public key valid to date. If null no valid to date has been
	 *	set.
	 */
	function getValidToDate() {
		return $this->m_validToDate;
	}

	/**
	 * Gets the public key valid to date format. This will match the format of the
	 * valid to date and can include separators such as - and /.
	 * This is a character string.
	 * The available options are shown in the following table:
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
	 * @return string The public key valid to date format. If null no valid to date
	 *	format has been set.
	 */
	function getValidToDateFormat() {
		return $this->m_validToDateFormat;
	}

	/**
	 * Sets the public key algorithm. This is an alphanumeric string. For
	 * example 'RSA'.
	 *
	 * @param algorithm
	 *	The public key algorithm. If null the algorithm is removed.
	 * @private
	 */
	function setAlgorithm($algorithm) {
		$this->m_algorithm = $algorithm;
	}

	/**
	 * Sets the public key exponent. This is an alphanumeric string.
	 *
	 * @param exponent
	 *	The public key exponent. If null the exponent is removed.
	 * @private
	 */
	function setExponent($exponent) {
		$this->m_exponent = $exponent;
	}

	/**
	 * Sets the public key modulus. This is an alphanumeric string.
	 *
	 * @param modulus
	 *	The public key modulus. If null the modulus is removed.
	 * @private
	 */
	function setModulus($modulus) {
		$this->m_modulus = $modulus;
	}

	/**
	 * Sets the public key valid from date. This is a character string.
	 *
	 * @param validFromDate
	 *	The public key valid from date. If null the valid from date is
	 *	removed.
	 * @private
	 */
	function setValidFromDate($validFromDate) {
		$this->m_validFromDate = $validFromDate;
	}

	/**
	 * Sets the public key valid from format. This is an alphanumeric string.
	 * The available options are shown in the following table:
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
	 * @param validFromDateFormat
	 *	The public key valid from format. If null the valid from date
	 *	format is removed.
	 * @private
	 */
	function setValidFromDateFormat($validFromDateFormat) {
		$this->m_validFromDateFormat = $validFromDateFormat;
	}

	/**
	 * Sets the public key valid to date. This is a character string.
	 *
	 * @param validToDate
	 *	The public key valid to date. If null the valid to date is
	 *	removed.
	 * @private
	 */
	function setValidToDate($validToDate) {
		$this->m_validToDate = $validToDate;
	}

	/**
	 * Sets the public key valid to format. This is an alphanumeric string. The
	 * available options are shown in the following table:
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
	 * @param validToDateFormat
	 *	The public key valid to format. If null the valid to date
	 *	format is removed.
	 * @private
	 */
	function setValidToDateFormat($validToDateFormat) {
		$this->m_validToDateFormat = $validToDateFormat;
	}

	/**
	 * Returns a string version of this public key.
	 *
	 * @return string A string version of this public key.
	 */
	function toString() {

		$eol = '<br>'."\n";

		$str = '';
		$str .= 'PUBLIC_KEY: ';
		$str .= $eol;
		$str .= '  Index: ';
		$str .= htmlentities($this->m_index, ENT_QUOTES);
		$str .= $eol;
		$str .= '  Hash: ';
		$str .= htmlentities($this->m_hash, ENT_QUOTES);
		$str .= $eol;
		$str .= '  HashAlgorithm: ';
		$str .= htmlentities($this->m_hashAlgorithm, ENT_QUOTES);
		$str .= $eol;
		$str .= '  Algorithm: ';
		$str .= htmlentities($this->m_algorithm, ENT_QUOTES);
		$str .= $eol;
		$str .= '  Modulus: ';
		$str .= htmlentities($this->m_modulus, ENT_QUOTES);
		$str .= $eol;
		$str .= '  Exponent: ';
		$str .= htmlentities($this->m_exponent, ENT_QUOTES);
		$str .= $eol;
		$str .= '  ValidFromDate: ';
		$str .= htmlentities($this->m_validFromDate, ENT_QUOTES);
		$str .= $eol;
		$str .= '  ValidFromDateFormat: ';
		$str .= htmlentities($this->m_validFromDateFormat, ENT_QUOTES);
		$str .= $eol;
		$str .= '  ValidToDate: ';
		$str .= htmlentities($this->m_validToDate, ENT_QUOTES);
		$str .= $eol;
		$str .= '  ValidToDateFormat: ';
		$str .= htmlentities($this->m_validToDateFormat, ENT_QUOTES);
		$str .= $eol;

		return $str;
	}
}
?>
