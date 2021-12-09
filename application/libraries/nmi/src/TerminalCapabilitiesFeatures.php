<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class TerminalCapabilitiesFeatures
{
    var $cardCapture = null;
    var $dcc = null;
    var $multiCurrency = null;
    var $partialAuth = null;
    var $partialReversal = null;
    var $voiceReferral = null;
    var $onDeviceTipping = null;
    var $endOfDayTipping = null;
    var $digitalSignature = null;
    var $screen = null;
    var $printer = null;
    var $receipt = null;

    public function __construct()
    {
        $this->cardCapture = null;
        $this->dcc = null;
        $this->multiCurrency = null;
        $this->partialAuth = null;
        $this->partialReversal = null;
        $this->voiceReferral = null;
        $this->onDeviceTipping = null;
        $this->endOfDayTipping = null;
        $this->digitalSignature = null;
        $this->screen = null;
        $this->printer = null;
        $this->receipt = null;
    }
}
?>