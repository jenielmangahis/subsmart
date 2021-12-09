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
 * A utility class the helps with the construction of XML data.
 *
 * @error This should not be part of the documentation for CardEaseXML.
 * @author Creditcall Ltd
 */
// Note: This cannot be called XMLWriter due to PHP name clash.
class XMLWriterCreditcall {

	/**
	 * The encoding of the XML document.
	 */
	var $m_encoding;

	/**
	 * Whether the current XML node is empty.
	 */
	var $m_isNodeEmpty;

	/**
	 * Whether the current XML tag is open.
	 */
	var $m_isTagOpen;

	/**
	 * The tag of current tags.
	 */
	var $m_tags;

	/**
	 * The destination for the XML data.
	 */
	var $m_writer;

	/**
	 * The construction of an XML Writer with the specified encoding.
	 *
	 * @param encoding
	 *            The encoding of the XML data. This should not be null.
	 */
	function XMLWriterCreditcall($encoding = XMLEncoding_UTF_8) {
		$this->m_encoding = $encoding;
		$this->m_isNodeEmpty = false;
		$this->m_isTagOpen = false;
		$this->m_tags = array();
		$this->m_writer = null;
	}

	/**
	 * Closes the XML writer.
	 *
	 * @throws exception
	 *             If writing to the XML writer fails for any reason (including
	 *             open tags).
	 */
	function close() {
		if (count($this->m_tags) !== 0) {
			trigger_error('Tags are not all closed (' . array_pop($this->m_tags) . '?)', E_USER_ERROR);
		}

		return $this->m_writer;
	}

	/**
	 * @private
	 * Closes the current tag if it is open.
	 *
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function closeTag() {
		if ($this->m_isTagOpen) {
			$this->m_writer .= '>';
			$this->m_isTagOpen = false;
		}
	}

	/**
	 * Writes an attribute to the currently open tag.
	 *
	 * @param name
	 *            The attribute name. This should not be null.
	 * @param value
	 *            The attribute value. This should not be null.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason (including
	 *             missing tag).
	 */
	function writeAttributeString($name, $value) {
		if (!$this->m_isTagOpen) {
			trigger_error('No open tag found', E_USER_ERROR);
		}

		$this->m_writer .= ' ' . $name . '=\'' . $this->xmlSpecialChars($value) . '\'';
	}

	/**
	 * Writes a comment to the XML writer.
	 *
	 * @param comment
	 *            The comment to write. This should not be null.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function writeComment($comment) {
		$this->writeString('<!--' . $comment . '-->');
	}

	/**
	 * Writes an element to the XML writer.
	 *
	 * @param name
	 *            The tag name. This should not be null.
	 * @param text
	 *            The element text. This should not be null.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function writeElementString($name, $text) {
		$this->writeStartElement($name);
		$this->writeString($text);
		$this->writeEndElement();
	}

	/**
	 * Ends the XML document.
	 */
	function writeEndDocument() {}

	/**
	 * Closes the last opened element.
	 *
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason (including
	 *             lack of open elements).
	 */
	function writeEndElement() {
		if (count($this->m_tags) === 0) {
			trigger_error('No open element found', E_USER_ERROR);
		}

		$tag = array_pop($this->m_tags);

		if ($this->m_isNodeEmpty) {
			$this->m_writer .= '/>';
		} else {
			$this->m_writer .= '</' . $tag . '>';
		}
		$this->m_isNodeEmpty = false;
		$this->m_isTagOpen = false;
	}

	/**
	 * Starts the XML document with specified standalone attribute.
	 *
	 * @param standalone
	 *            Whether the XML document is standalone.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function writeStartDocument($standalone = false) {
		$this->m_writer .= '<?xml version=\'1.0\'';

		if ($this->m_encoding !== null) {
			$this->m_writer .= ' encoding=\'' . $this->xmlSpecialChars($this->m_encoding) . '\'';
		}

		if ($standalone) {
			$this->m_writer .= ' standalone=\'yes\'';
		}

		$this->m_writer .= '?>';
	}

	/**
	 * Opens a new tag by closing the previous tag.
	 *
	 * @param name
	 *            The name of the tag to open. This should not be null.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function writeStartElement($name) {
		$this->closeTag();
		$this->m_writer .= '<' . $name;
		$this->m_isTagOpen = true;
		$this->m_isNodeEmpty = true;
		$this->m_tags[] = $name;
	}

	/**
	 * Writes the specified text as a string in the open tag.
	 *
	 * @param text
	 *            The text to write in the open tag. This should not be null.
	 * @throws Exception
	 *             If writing to the XML writer fails for any reason.
	 */
	function writeString($text) {
		$this->closeTag();
		$this->m_writer .= $this->xmlSpecialChars($text);
		$this->m_isNodeEmpty = false;
	}

	/**
	 * The XML equivalent of htmlspecialchars
	 * @param str The string to convert.
	 * @private
	 */
	function xmlSpecialChars($str) {
		return strtr($str, array(
			'&'  => '&amp;',
			'"'  => '&quot;',
			'\'' => '&apos;',
			'<'  => '&lt;',
			'>'  => '&gt;'));
	}
}
?>
