<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class SupportedCardSchemeResponse
{
	var $m_supportedCardSchemes = array();

	/**
	 * A stack of the tags that have been parsed.
	 * @private
	 */
	var $m_tagStack;

	/**
	 * Constructs a new response and initialises all variables.
	 */
	function SupportedCardSchemeResponse()
	{
		$this->m_supportedCardSchemes = array();
	}

	/**
	 * Handles an end tag.
	 * @private
	 */
	function elementEndHandler($parser, $name)
	{
		$name = trim($name);

		if (array_pop($this->m_tagStack) !== $name)
		{
			trigger_error('CardEaseXMLResponse: Unexpected response end tag: '.$name, E_USER_ERROR);
		}
	}

	/**
	 * Handles a start tag.
	 * @private
	 */
	function elementStartHandler($parser, $name, $attrs)
	{
		$name = trim($name);

		array_push($this->m_tagStack, $name);

		if (empty($attrs))
		{
			return;
		}

		if ($this->m_tagStack === array('CardSchemes', 'CardScheme')) {

			$cardschemeid = $cardtypeid = null;
			
			foreach ($attrs as $key => $value) {
				switch ($key) {
					case 'cardschemeid':
						$cardschemeid = $value;
						break;
					case 'cardtypeid':
						$cardtypeid = $value;
						break;
				}
			}
			
			$this->m_supportedCardSchemes[] = array('scheme' => $cardschemeid, 'type' => $cardtypeid);
			
			unset($cardschemeid, $cardtypeid);
			
			return;
		}
	}

	/**
	 * Returns the list of supported card schemes.
	 * @return array The list of supported card schemes.
	 */
	function getSupportedCardSchemes()
	{
		return $this->m_supportedCardSchemes;
	}

	/**
	 * Parses the XML response.
	 * @private
	 *
	 * @param xml
	 *	 The XML to parse.
	 * @throws E_USER_ERROR
	 *	 If the XML encoding is missing or the XML is badly formed.
	 */
	function parseResponseXML($xml)
	{
		if (empty($xml))
		{
			trigger_error('CardEaseXMLResponse: Unable to parse XML', E_USER_ERROR);
		}

		$this->m_tagStack = array();

		// Note: This could be done with xml_parse_into_struct.
		// Then we would have to deal with levels in a different way.
		$xml_parser = xml_parser_create();
		xml_set_object($xml_parser, $this);
		// Setting this as true creates issues when using setlocale().
		xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, false);
		xml_set_character_data_handler($xml_parser, false);
		xml_set_element_handler($xml_parser, 'elementStartHandler', 'elementEndHandler');
		xml_parse($xml_parser, $xml);
		xml_parser_free($xml_parser);
	}
}

?>
