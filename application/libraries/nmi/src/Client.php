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
 * @mainpage
 * <p><img src='creditcall.gif' alt='Creditcall'>
 * <p>
 * CardEaseXML is a flexible client-server framework for processing credit
 * and debit card transactions over an internet connection.
 * <p>&copy; Copyright Creditcall Limited 2005 - 2020
 * <p><center><b><a href='../TermsAndConditions.htm'>TERMS AND CONDITIONS</a></b></center>
 * <p>
 * It has the
 * ability to handle manual, magnetic stripe and EMV details for a number
 * of different request types such as authorisations and refunds.
 * <p>
 * To facilitate the use of CardEaseXML, Creditcall manage a set of secure
 * servers which accept XML formatted messages over a TCP/IP connection which
 * describe the required transactions.
 * <p>
 * There are essentially three ways of communicating with the Creditcall
 * CardEaseXML servers; SSL connection, HTTPS connection or by using an
 * established SDK made available by Creditcall. These SDKs are supported
 * by detailed protocol documentation and a test environment under which
 * integration can be performed.
 * <p>
 * Using an SDK developed by Creditcall allows for quicker integration as it
 * is using a code base that has been tested to conform to the CardEaseXML
 * protocol.
 * <p>
 * At this time client SDKs are available for the following development
 * platforms:
 * <ul>
 *	<li>Java
 *	<li>.NET 2.0
 *	<li>PHP
 *	<li>Android
 *	<li>Objective-C
 * </ul>
 * This documentation describes the interfaces for using the PHP SDK,
 * it does not provide a detailed CardEaseXML protocol description, or
 * documentation regarding other SDKs. These are available separately from
 * Creditcall.
 * <p>
 * The PHP SDK has the following dependencies:
 * <ul>
 *	<li>PHP 5.6
 *  <li>PHP Curl Support
 *  <li>PHP XML Support
 * </ul>
 * <p>
 * Registration to use CardEaseXML can be performed by visiting this web
 * site and completely the necessary form:
 * <p>
 * <a href='https://testwebmis.creditcall.com/'>https://testwebmis.creditcall.com/</a>
 * <p>
 * During the process of registration it will be necessary to supply a valid
 * email address and choose a password. An email will be sent to the
 * supplied email address which will enable confirmation of registration.
 * <p>
 * Registration will provide details of a CardEase Terminal ID and a
 * CardEase Transaction Key. It will be necessary to make a note of these as
 * they will be required for integration, testing and using CardEaseXML.
 * <p>
 * Once registration is complete and all of the necessary details have been
 * obtained, development can proceed.
 * <p>
 * 
 */

require_once('ServerURL.php');
require_once('Request.php');
require_once('Response.php');
require_once('XMLEncoding.php');
require_once('internal/XMLWriter.php');

/**
 * This class is used to process requests by sending them
 * to CardEaseXML servers. This client supports PHP 4.x and 5.x.
 * <p>
 * To use the Client a Request object should be created and populated
 * with the necessary transaction information such as the request type and
 * terminal id, as well as any optional information that is required such as a
 * user reference or address verification information.
 * <p>
 * Due to the redundancy available in the CardEase platform, the client can
 * communicate with any number of CardEaseXML servers until a successful
 * connection is made. Therefore, it is necessary to specify the
 * ServerURLs with which you would like the client to communicate
 * with in the order that you would like the communication to occur. Each of the
 * servers will be contacted in turn until a successful request is made.
 * <p>
 * If a connection is successful processing stops and the Response can be
 * retrieved. If a connection is unsuccessful the next host is tried until there
 * are no more available. If the Client runs out of servers to
 * contact, the request fails.
 * <p>
 * A successful request will obtain a Response object from the CardEase
 * platform. The response should be examined for error information and the
 * results of the specified transaction.
 *
 * @author Creditcall Ltd
 * @see Request
 * @see Response
 * @see ServerURL
 */
class Client
{
	/**
	 * Gets the internal name of this CardEaseXML SDK.
	 * @return string The name of this CardEaseXML SDK. This will not be null.
	 */
	static function getCardEaseXMLSDKName() {
		return 'CardEaseXMLClient-PHP';
	}

	/**
	 * Gets the internal version of this CardEaseXML SDK.
	 * @return string The version of this CardEaseXML SDK. This will not be null.
	 */
	static function getCardEaseXMLSDKVersion() {
		return '3.0.1';
	}

	/**
	 * The list of servers to communicate with.
	 * @private
	 */
	var $m_serverURLs = array();

	/**
	 * The hostname of the HTTP/HTTPS proxy.
	 * @private
	 */
	var $m_proxyHost = null;

	/**
	 * The password of the HTTP/HTTPS proxy.
	 * @private
	 */
	var $m_proxyPassword = null;

	/**
	 * The port number of the HTTP/HTTPS proxy.
	 * @private
	 */
	var $m_proxyPort = 80;

	/**
	 * The username of the HTTP/HTTPS proxy.
	 * @private
	 */
	var $m_proxyUserName = null;

	/**
	 * The request to send to the CardEaseXML server.
	 * @private
	 */
	var $m_request = null; // Cannot initialise here

	/**
	 * The response received from the CardEaseXML server.
	 * @private
	 */
	var $m_response = null;

	/**
	 * The XML encoding used in communication with the CardEaseXML server.
	 * @private
	 */
	var $m_xmlEncoding = XMLEncoding_UTF_8;
	
	/**
	 * Constructs a Client and initialises variables.
	 */
	function Client() {
		$this->m_serverURLs = array();
		$this->m_proxyHost = null;
		$this->m_proxyPassword = null;
		$this->m_proxyPort = 80;
		$this->m_proxyUserName = null;
		$this->m_request = new Request();
		$this->m_response = null;
		$this->m_xmlEncoding = XMLEncoding_UTF_8;
	}

	/**
	 * Adds a CardEaseXML server URL to the list used for communication. During
	 * processing of a request each of these are used in turn until
	 * communication is successful.
	 *
	 * @param serverURL
	 *	The server URL to add to the end of the server URL list. This
	 *	should not be null. For convenience this can also be specified
	 *	as a url/timeout pair rather than as a ServerURL. For example:
	 *	addServerURL($url, $timeout) or addServerURL($serverURL).
	 * @see getServerURLs()
	 * @see setServerURLs()
	 */
	function addServerURL($serverURL) {
		if ($this->m_serverURLs === null) {
			$this->m_serverURLs = array();
		}

		if (func_num_args() === 2) {
			$timeout = func_get_arg(1);
			$serverURL = new ServerURL($serverURL, $timeout);
		}

		$this->m_serverURLs[] = $serverURL;
	}

	/**
	 * Gets the list of CaseEaseXML server URLs which will be used used for
	 * communication. During processing of a request each of these are used in
	 * turn until communication is successful.
	 *
	 * @return array The list of CardEaseXML server URLs which will be used for
	 *	 communication. If null is returned no ServerURLs have
	 *	 been specified.
	 * @see addServerURL()
	 * @see setServerURLs()
	 */
	function getServerURLs() {
		return $this->m_serverURLs;
	}

	/**
	 * Gets the proxy host required to connect to the CardEaseXML server URLs.
	 * This must be specified in order for a proxy to be used.
	 *
	 * @return string The proxy host required to connect to the CardEaseXML server
	 *	 URLs. If null is returned no proxy host has been specified.
	 * @see setProxyHost()
	 */
	function getProxyHost() {
		return $this->m_proxyHost;
	}

	/**
	 * Gets the proxy password required to connect to the CardEaseXML server
	 * URLs. The proxy password will only be used if the proxy username and
	 * proxy host are also specified.
	 *
	 * @return string The proxy password required to connect to the CardEaseXML server
	 *	 URLs. If null is returned no proxy password has been specified.
	 * @see setProxyPassword()
	 */
	function getProxyPassword() {
		return $this->m_proxyPassword;
	}

	/**
	 * Gets the proxy port required to connect to the CardEaseXML server URLs.
	 * The default is port 80.
	 *
	 * @return string The proxy port required to connect to the CardEaseXML server
	 *	 URLs.
	 * @see setProxyPort()
	 */
	function getProxyPort() {
		return $this->m_proxyPort;
	}

	/**
	 * Gets the proxy username required to connect to the CardEaseXML server
	 * URLs. The proxy username will only be used if the proxy password and
	 * proxy host are also specified.
	 *
	 * @return string The proxy username required to connect to the CardEaseXML server
	 *	 URLs. If null is returned no proxy username has been specified.
	 * @see setProxyUserName()
	 */
	function getProxyUserName() {
		return $this->m_proxyUserName;
	}

	/**
	 * Gets the request currently associated with the CardEaseXML client.
	 *
	 * @return Request The request currently associated with the CardEaseXML client. If
	 *	 null is returned no request has been specified.
	 * @see setRequest()
	 */
	function getRequest() {
		return $this->m_request;
	}

	/**
	 * Gets the response last obtained from the CardEaseXML server.
	 *
	 * @return Response The response last obtained from the CardEaseXML server. If null
	 *	 is returned the request has not been sent or the communication
	 *	 has not been successful.
	 */
	function getResponse() {
		return $this->m_response;
	}

	/**
	 * Gets the XML encoding used to communicate with the CardEaseXML server. By
	 * default this is 'UTF-8' (XMLEncoding.UTF_8).
	 *
	 * @return string The XML encoding used to communicate with the CardEaseXML server.
	 *	 If null is returned XML encoding has not been specified.
	 */
	function getXMLEncoding() {
		return $this->m_xmlEncoding;
	}
	
	/**
	 * This method uses all of the internal settings to process a CardEaseXML
	 * request.
	 * <p>
	 * <b>A request and server URL must be set before processing can begin.</b>
	 * <p>
	 * In turn each of the CardEaseXML server URLs are connected to and the
	 * transaction is attempted. If a communication error occurs the next server
	 * URL is used and so on. This continues until the list of server URLs is
	 * exhausted. If communication totally fails a
	 * error is thrown detailing the last connection
	 * failure.
	 * <p>
	 * If a proxy host has been set this communication is attempted through a
	 * proxy with the optional proxy username and password.
	 * <p>
	 * This method has an optional argument of the request.
	 *
	 * @throws E_USER_ERROR
	 *	There was a problem with communication.
	 * @throws E_USER_ERROR
	 *	There was a problem with the request.
	 * @throws E_USER_ERROR
	 *	There was a problem with the response.
	 * @return Response The CardEaseXML response.
	 */
	function processRequest() {
		// Cleanup any previous response.
		$this->m_response = null;

		// Optional argument is the request.
		if (func_num_args() === 1) {
			$this->m_request = func_get_arg(0);
		}

		if ($this->m_request === null) {
			trigger_error('CardEaseXMLRequest: No request to process', E_USER_ERROR);
		}

		if ($this->m_serverURLs === null || count($this->m_serverURLs) === 0) {
			trigger_error('CardEaseXMLCommunication: No servers to contact', E_USER_ERROR);
		}

		$lastCommunicationException = null;

		// Try each of the server URLs
		foreach ($this->m_serverURLs as $url) {

			if ($url === null) {
				continue;
			}

			$xmlWriter = new XMLWriterCreditcall($this->m_xmlEncoding);
			$requestXml = $this->m_request->generateRequestXml($xmlWriter);

			// Set the HTTP settings
			$curl = $this->initCurlSession($url, $requestXml);

			// Create a connection to the server and send the XML
			$responseXML = curl_exec($curl);

			$curlError = curl_error($curl);
			$curlInfo = curl_getinfo($curl);

			curl_close($curl);

			if (!empty($curlError)) {
				$lastCommunicationException = 'CardEaseXMLCommunication: '.$curlError;
				continue;
			}

			// Read the response code from the server and check it
			$responseCode = $curlInfo['http_code'];

			// Check the response code
			if ($responseCode !== 200) {
				$lastCommunicationException = 'CardEaseXMLCommunication: Unexpected HTTP response: ' . $responseCode;
				continue;
			}

			if (strlen($responseXML) === 0) {
				$lastCommunicationException = 'CardEaseXMLCommunication: Unable to retrieve server response';
				continue;
			}

			// Convert the XML string to a response
			$this->m_response = new Response();
			$this->m_response->parseResponseXML($responseXML);

			// If we have got this far the connection has been successful
			return $this->m_response;
		}

		// Communication hasn't been successful and an exception exists
		if ($lastCommunicationException !== null) {
			trigger_error($lastCommunicationException, E_USER_ERROR);
		}

		return $this->m_response;
	}
	
	function initCurlSession(ServerURL $url, $requestXml) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10000);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	    curl_setopt($curl, CURLOPT_POST, TRUE);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($curl, CURLOPT_TIMEOUT, $url->getTimeout());
	    curl_setopt($curl, CURLOPT_URL, $url->getURL());
	    curl_setopt($curl, CURLOPT_USERAGENT, 'Creditcall CardEaseXML');
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $requestXml);

	    // Setup the proxy information
	    if ($this->m_proxyHost !== null) {
	        curl_setopt($curl, CURLOPT_PROXY, $this->m_proxyHost.':'.$this->m_proxyPort);
	        
	        if ($this->m_proxyUserName !== null || $this->m_proxyPassword !== null) {
	            curl_setopt($curl, CURLOPT_PROXYUSERPWD, ($this->m_proxyUserName === null ? '' : $this->m_proxyUserName).':'.($this->m_proxyPassword === null ? '' : $this->m_proxyPassword));
	        }
	    }
	    return $curl;
	}

	/**
	 * Sets the list of CardEaseXML server URLs to process. During processing of
	 * a request each of these are used in turn until communication is
	 * successful.
	 *
	 * @param serverURLs
	 *	The list of CardEaseXML server URLs to process. If null is
	 *	specified the list of URLs is removed.
	 * @see addServerURL()
	 * @see getServerURLs()
	 */
	function setServerURLs($serverURLs) {
		$this->m_serverURLs = $serverURLs;
	}

	/**
	 * Sets the proxy host required to connect to the CardEaseXML server URLs.
	 * This must be specified in order for a proxy to be used.
	 *
	 * @param proxyHost
	 *	The proxy host required to connect to the CardEaseXML server
	 *	URLs. If null is specified the proxy host is removed.
	 * @see getProxyHost()
	 * @see setProxyPort()
	 * @see setProxySettings()
	 */
	function setProxyHost($proxyHost) {
		$this->m_proxyHost = $proxyHost;
	}

	/**
	 * Sets the proxy password required to connect to the CardEaseXML server
	 * URLs. The proxy password will only be used if the proxy username and
	 * proxy host are also specified.
	 *
	 * @param proxyPassword
	 *	The proxy password required to connect to the CardEaseXML
	 *	server URLs. If null is specified the proxy password is
	 *	removed.
	 * @see getProxyPassword()
	 * @see setProxyUserName()
	 * @see setProxySettings()
	 */
	function setProxyPassword($proxyPassword) {
		$this->m_proxyPassword = $proxyPassword;
	}

	/**
	 * Sets the proxy port required to connect to the CardEaseXML server URLs.
	 * The default is port 80.
	 *
	 * @param proxyPort
	 *	The proxy port required to connect to the CardEaseXML server
	 *	URLs.
	 * @see getProxyPort()
	 * @see setProxyHost()
	 * @see setProxySettings()
	 */
	function setProxyPort($proxyPort) {
		$this->m_proxyPort = $proxyPort;
	}

	/**
	 * Sets proxy settings required to connect to any of the CardEaseXML server
	 * URLs. By default the port number is 80.
	 *
	 * @param proxyHost
	 *	The hostname of the proxy. If null is specified the proxy host
	 *	is removed.
	 * @param proxyPort
	 *	The port number of the proxy.
	 * @param proxyUserName
	 *	The username of the proxy. If null is specified the proxy
	 *	username is removed.
	 * @param proxyPassword
	 *	The password of the proxy. If null is specified the proxy
	 *	password is removed.
	 * @see setProxyHost()
	 * @see setProxyPort()
	 * @see setProxyUserName()
	 * @see setProxyPassword()
	 */
	function setProxySettings($proxyHost, $proxyPort, $proxyUserName, $proxyPassword) {
		$this->m_proxyHost = $proxyHost;
		$this->m_proxyPort = $proxyPort;
		$this->m_proxyUserName = $proxyUserName;
		$this->m_proxyPassword = $proxyPassword;
	}

	/**
	 * Sets the proxy username required to connect to the CardEaseXML server
	 * URLs. The proxy username will only be used if the proxy password and
	 * proxy host are also specified.
	 *
	 * @param proxyUserName
	 *	The proxy username required to connect to the CardEaseXML
	 *	server URLs. If null is specified the proxy username is
	 *	removed.
	 * @see getProxyUserName()
	 * @see setProxyUserName()
	 * @see setProxySettings()
	 */
	function setProxyUserName($proxyUserName) {
		$this->m_proxyUserName = $proxyUserName;
	}

	/**
	 * Sets the request which will be used when communicating with the
	 * CardEaseXML server URLs.
	 *
	 * @param request
	 *	The request which wil be used when communication with the
	 *	CardEaseXML server URLs. If null is specified the request is
	 *	removed.
	 * @see getRequest()
	 */
	function setRequest($request) {
		$this->m_request = $request;
	}

	/**
	 * Sets the XML encoding which will be used when communicating with the
	 * CardEaseXML server URLs.
	 *
	 * @param xmlEncoding
	 *	The XML encoding which will be used when communicating with
	 *	the CardEaseXML server URLs. If null is specified the XML
	 *	encoding specification is removed.
	 * @see getXMLEncoding()
	 */
	function setXMLEncoding($xmlEncoding) {
		$this->m_xmlEncoding = $xmlEncoding;
	}
	
}
?>
