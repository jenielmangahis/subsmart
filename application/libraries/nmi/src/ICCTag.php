<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

require_once('ICCTagValueType.php');

/**
 * A class used to hold ICC tag information required for an EMV transaction.
 * Each ICC tag has an associated ID, type and value.
 * <p>
 * The ID indicates what value is held, the type indicates the type of the value
 * held and the value is the actual data.
 *
 * @author Creditcall Ltd
 */
class ICCTag {

	/**
	 * The ID of the ICC tag. The type of this cannot be numeric due to
	 * IssuerRequest.
	 * @private
	 */
	var $m_id = null;

	/**
	 * The type of the ICC tag value.
	 * @private
	 */
	var $m_type = ICCTagValueType_AsciiHex;

	/**
	 * The value of the ICC tag.
	 * @private
	 */
	var $m_value = null;

	/**
	 * Creates a new ICC tag with the specified ID, type and value.
	 *
	 * @param id
	 *	The ID of the ICC tag. These are specified in hex and defined in the EMV specification. This is an alphanumeric string. If this is null no ID is specified.
	 * @param type_or_value
	 *	The type or value of the ICC tag. If this is null no type or value is specified.
	 *	If only two arguments to this function are found the second is taken to be the value: ICCTag(id, value).
	 *	If three arguments are found the second is taken as being the type, the third the value: ICCTag(id, type, value).
	 */
	function ICCTag($id, $type_or_value) {

		$this->m_id = $id;

		if (func_num_args() === 2) {
			$this->m_type = ICCTagValueType_AsciiHex;
			$this->m_value = $type_or_value;
		} else {
			$this->m_type = $type_or_value;
			$this->m_value = func_get_arg(2);
		}
	}

	/**
	 * Gets the ICC tag ID. These are specified in hex and defined in the EMV specification. For example 0x9f02. This is an alphanumeric string.
	 *
	 * @return string The ICC tag ID. If null is returned no ID has been specified.
	 * @see setID()
	 */
	function getID() {
		return $this->m_id;
	}

	/**
	 * Gets the ICC tag value type. The data held in the ICC tag value should be
	 * of the same type.
	 *
	 * @return string The ICC tag value type. If null is returned no type has been
	 *	 specified.
	 * @see setType()
	 */
	function getType() {
		return $this->m_type;
	}

	/**
	 * Gets the ICC tag value. This should be of the same type as that specified
	 * in the ICC tag type. This is an alphanumeric string.
	 *
	 * @return string The ICC tag value. If null is returned no value has been
	 *	 specified.
	 * @see setValue()
	 */
	function getValue() {
		return $this->m_value;
	}

	/**
	 * Sets the ICC tag ID. These are specified in hex and defined in the EMV specification. For example 0x9f02. This is an alphanumeric string.
	 *
	 * @param id
	 *	The ICC tag ID. If this is null the ID is removed.
	 * @see getID()
	 */
	function setID($id) {
		$this->m_id = $id;
	}

	/**
	 * Sets the ICC tag value type. The data held in the ICC tag value should be
	 * of the same type.
	 *
	 * @param type
	 *	The ICC tag value type. If this is null the type is removed.
	 * @see getType()
	 */
	function setType($type) {
		$this->m_type = $type;
	}

	/**
	 * Sets the ICC tag value. This should be of the same type as that specified
	 * in the ICC tag type. This is an alphanumeric string.
	 *
	 * @param value
	 *	The ICC tag value. If this is null the value is removed.
	 * @see getValue()
	 */
	function setValue($value) {
		$this->m_value = $value;
	}

	/**
	 * Returns a string detailing the id, type and value of this ICC tag.
	 *
	 * @return string A string detailing the id, type and value of this ICC tag.
	 */
	function toString() {

		$str = '';
		$str .= htmlentities($this->m_id, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_type, ENT_QUOTES);
		$str .= ':';
		$str .= htmlentities($this->m_value, ENT_QUOTES);

		return $str;
	}
}

?>
