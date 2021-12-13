<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class TerminalCapabilitiesCardInput
{
    var $keyed;
    var $magstripe;
    var $contactEMV;
    var $contactlessEMV;

    public function __construct() {
        $this->keyed = null;
        $this->magstripe = null;
        $this->contactEMV = null;
        $this->contactlessEMV = null;
    }
}
?>