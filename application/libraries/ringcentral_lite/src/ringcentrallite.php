<?php

class RingCentralLite {
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015-2018 John Wang
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
    const RC_SERVER_PRODUCTION = 'https://platform.ringcentral.com';
    const RC_SERVER_SANDBOX    = 'https://platform.devtest.ringcentral.com';
    const RC_SERVER_URL_PART   = '/restapi/v1.0';

    protected $clientID        = '';
    protected $clientSecret    = '';
    protected $serverUrl       = '';
    protected $username        = '';
    protected $extension       = '';
    protected $accessToken     = '';
    protected $refreshToken    = '';
    protected $authData        = array();

    function __construct($clientID='', $clientSecret='', $serverUrl = self::RC_SERVER_SANDBOX) {
        $this->clientID     = $clientID;
        $this->clientSecret = $clientSecret;

        if (strtolower($serverUrl)=='production') {
            $this->serverUrl = self::RC_SERVER_PRODUCTION;
        } else if (strtolower($serverUrl)=='sandbox') {
            $this->serverUrl = self::RC_SERVER_SANDBOX;
        } else {
            $this->serverUrl = $serverUrl;
        }
    }

    public function authorize($username='', $extension='', $password='') {
        $this->username  = $username;
        $this->extension = $extension;
        $requestData = array(
            'grant_type' => 'password',
            'username'   => $username,
            'extension'  => $extension,
            'password'   => $password
        );
        return $this->authCall($requestData);
    }

    public function refreshToken() {
        $requestData = array(
            'grant_type'    => 'refresh_token',
            'refresh_token' => $this->refreshToken
        );
        return $this->authCall($requestData);
    }

    protected function authCall($requestData = array()) {
        $ch = curl_init($this->tokenUrl());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . $this->getApiKey(),
            'Content-Type: ' . 'application/x-www-form-urlencoded;charset=UTF-8'
         ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $responseData = json_decode($responseBody,true);

        $this->authData = $responseData;
        $this->inflateAuthData($responseData);
        return $responseData;
    }

    protected function inflateAuthData($authData = array()) {
        if (array_key_exists('access_token', $authData)) {
            $this->accessToken = $this->authData['access_token'];
        }
        if (array_key_exists('refresh_token', $authData)) {
            $this->refreshToken = $this->authData['refresh_token'];
        }
    }

    protected function getApiKey() {
        $apiKey = base64_encode($this->clientID . ':' . $this->clientSecret);
        return preg_replace('/[\s\t\r\n]/','',$apiKey);
    }

    protected function tokenUrl() {
        return $this->serverUrl . '/restapi/oauth/token';
    }

    protected function prepareBody($contentType,$body) {
        if ($contentType == 'application/json') {
            if (is_array($body)) {
                $body = json_encode($body);
            }
        } elseif ($contentType =='application/x-www-form-urlencoded') {
            if (is_array($body)) {
                $body = http_build_query($body);
            }
        }
        return $body;
    }

    public function get($url, $params) {
        return $this->apiCall('GET', $url, $params);
    }

    public function post($url, $params) {
        return $this->apiCall('POST', $url, $params);
    }

    public function put($url, $params) {
        return $this->apiCall('PUT', $url, $params);
    }

    public function delete($url, $params) {
        return $this->apiCall('DELETE', $url, $params);
    }

    protected function apiCall($verb, $url, $params, $try=0) {
        $ch = curl_init($this->inflateUrl($url));
        $ct = $this->getContentTypeForParams($params);
        if (strlen($ct) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->accessToken,
                'Content-Type: ' . $ct
            ));
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->accessToken
            ));
        }
        if ($verb=='POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getBodyForParams($params));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($try==0 && preg_match('/^4[0-9][0-9]$/', $httpCode)	) {
            $this->refreshToken();
            return $this->apiCall($verb, $url, $params, $try+1);
        }

        $responseData = json_decode($responseBody, true);
        return $responseData;
    }

    protected function getContentTypeForParams($params) {
        if (array_key_exists('json', $params)) {
            return 'application/json';
        }
        return '';
    }

    protected function getBodyForParams($params) {
        if (array_key_exists('json', $params)) {
            return $this->prepareBody('application/json', $params['json']);
        }
        return $params;
    }

    protected function inflateUrl($urlIn = '') {
        $urlOut = '';
        $m = array();
        if (strlen($urlIn)==0) {
            $urlOut = $urlIn;
        } elseif (preg_match('/^https?:\/\//', $urlIn)) {
            $urlOut = $urlIn;
        } elseif (preg_match('/^(\/)?restapi/', $urlIn, $m)) {
            if ($m && count($m)>0 && $m[1] == '/') {
                $urlOut = $this->serverUrl . $urlIn;
            } else {
                $urlOut = $this->serverUrl . '/' . $urlIn;
            }
        } else {
            if (preg_match('/^\//',$urlIn)) {
                $urlOut = $this->serverUrl . self::RC_SERVER_URL_PART . $urlIn;
            } else {
                $urlOut = $this->serverUrl . self::RC_SERVER_URL_PART . '/' . $urlIn;
            }
        }
        return $urlOut;
    }
}

?>