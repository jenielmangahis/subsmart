<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class TerminalCapabilitiesContactless
{
    var $consumerDevice = 'ConsumerDevice';
    var $onlinePin = 'OnlinePIN';
    var $signature = 'Signature';

    var $emvTerminalCapabilities;
    var $fallForward;
    var $singleTap;
    var $magstripe;
    var $cvmCapabilities;

    public function __construct()
    {
        $this->emvTerminalCapabilities = null;
        $this->fallForward = null;
        $this->singleTap = null;
        $this->magstripe = null;
        $this->cvmCapabilities = array();
    }
}
?>