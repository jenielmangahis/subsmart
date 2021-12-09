<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class TerminalCapabilitiesCardholderAuthentication
{
    var $signature;
    var $onlinePin;
    var $pinRetry;
    var $offlinePin;
    var $pinBypass;
    var $cdcvm;

    public function __construct()
	{
		$this->signature = null;
		$this->onlinePin = null;
		$this->pinRetry = null;
		$this->offlinePin = null;
		$this->pinBypass = null;
		$this->cdcvm = null;
	}
}
?>
