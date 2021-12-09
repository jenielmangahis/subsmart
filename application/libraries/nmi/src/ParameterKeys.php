<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

class ParameterKeys
{
    /**
     * Parameter key for attended type.
     * @public
     */
    public static $attendedType = 'ATTENDED_TYPE';

    /**
     * Parameter key for device type.
     * @public
     */
    public static $deviceType = 'DEVICE_TYPE';

    /**
     * Parameter key for mobile pos.
     * @public
     */
    public static $mobilePos = 'MOBILE_POS';

    /**
     * Parameter key for premises.
     * @public
     */
    public static $premises = 'PREMISES';

    /**
     * Parameter key to set Cardholder Activated Terminal Level to Automated Dispensing Machine
     * @public
     */
    public static $catLevelAutomatedDispensingMachine = 'CAT_LEVEL_AUTOMATED_DISPENSING_MACHINE';

    /**
     * Parameter key to set Cardholder Activated Terminal Level to Self Service
     * @public
     */
    public static $catLevelSelfService = 'CAT_LEVEL_SELF_SERVICE';

    /**
     * Parameter key for keyed.
     * @public
     */
    public static $keyed = 'KEYED';

    /**
     * Parameter key for if magstripe is supported.
     * @public
     */
    public static $magstripe = 'MAGSTRIPE';

    /**
     * Parameter key for if contact EMV is supported.
     * @public
     */
    public static $contactEMV = 'CONTACT_EMV';

    /**
     * Parameter key for if contactless EMV is supported.
     * @public
     */
    public static $contactlessEMV = 'CONTACTLESS_EMV';

    /**
     * Parameter key for visa being supported.
     * @public
     */
    public static $visa = 'VISA';

    /**
     * Parameter key for mastercard being supported.
     * @public
     */
    public static $mastercard = 'MASTERCARD';

    /**
     * Parameter key for amex being supported.
     * @public
     */
    public static $amex = 'AMEX';

    /**
     * Parameter key for if 3-D Secure Version 1 is supported.
     * @public
     */
    public static $threeDSecureVersion1 = 'THREE_D_SECURE_VERSION_1';

    /**
     * Parameter key for if 3-D Secure Version 2 is supported.
     * @public
     */
    public static $threeDSecureVersion2 = 'THREE_D_SECURE_VERSION_2';

    /**
     * Parameter key for if signature is supported.
     * @public
     */
    public static $signature = 'SIGNATURE';

    /**
     * Parameter key for if online pin is supported.
     * @public
     */
    public static $onlinePin = 'ONLINE_PIN';

    /**
     * Parameter key for if pin retry is supported.
     * @public
     */
    public static $pinRetry = 'PIN_RETRY';

    /**
     * Parameter key for if offline pin is supported.
     * @public
     */
    public static $offlinePin = 'OFFLINE_PIN';

    /**
     * Parameter key for if pin bypass is supported.
     * @public
     */
    public static $pinBypass = 'PIN_BYPASS';

    /**
     * Parameter key for CDCVM.
     * @public
     */
    public static $cdcvm = 'CDVCM';

    /**
     * Parameter key for fall back.
     * @public
     */
    public static $fallBack = 'FALL_BACK';

    /**
     * Parameter key for Contact EMV terminal capabilities.
     * @public
     */
    public static $contactEmvTerminalCapabilities = "CONTACT_EMV_TERMINAL_CAPABILITIES";

    /**
     * Parameter key for Contactless EMV terminal capabilities.
     * @public
     */
    public static $contactlessEmvTerminalCapabilities = "CONTACTLESS_EMV_TERMINAL_CAPABILITIES";

    /**
     * Parameter key for if fall forward is supported.
     * @public
     */
    public static $fallForward = 'FALL_FORWARD';

    /**
     * Parameter key for if single tap is supported.
     * @public
     */
    public static $singleTap = 'SINGLE_TAP';

    /**
     * Parameter key for if the Consumer Device as a Cardholder Verification Method is supported.
     * @public
     */
    public static $cvmConsumerDevice = "CVM_CONSUMER_DEVICE";

    /**
     * Parameter key for if an Online Pin as a Cardholder Verification Method is supported.
     * @public
     */
    public static $cvmOnlinePin = "CVM_ONLINE_PIN";

    /**
     * Parameter key for if Signature as a Cardholder Verification Method is supported.
     * @public
     */
    public static $cvmSignature = "CVM_SIGNATURE";

    /**
     * Parameter key for if address verification service is supported.
     * @public
     */
    public static $avs = 'AVS';

    /**
     * Parameter key for if card security code is supported.
     * @public
     */
    public static $csc = 'CSC';

    /**
     * Parameter key for the ecommerce URL.
     * @public
     */
    public static $ecomUrl = 'ECOM_URL';

    /**
     * Parameter key for card capture.
     * @public
     */
    public static $cardCapture = 'CARD_CAPTURE';

    /**
     * Parameter key for if dynamic currency conversion is supported.
     * @public
     */
    public static $dcc = 'DCC';

    /**
     * Parameter key for if multi currency is supported.
     * @public
     */
    public static $multiCurrency = 'MULTI_CURRENCY';

    /**
     * Parameter key for if partial auth is supported.
     * @public
     */
    public static $partialAuth = 'PARTIAL_AUTH';

    /**
     * Parameter key for if partial reversal is supported.
     * @public
     */
    public static $partialReversal = 'PARTIAL_REVERSAL';

    /**
     * Parameter key for if voice referral is supported.
     * @public
     */
    public static $voiceReferral = 'VOICE_REFERRAL';

    /**
     * Parameter key for if on device tipping is supported.
     * @public
     */
    public static $onDeviceTipping = 'ON_DEVICE_TIPPING';

    /**
     * Parameter key for if end of day tipping is supported.
     * @public
     */
    public static $endOfDayTipping = 'END_OF_DAY_TIPPING';

    /**
     * Parameter key for digital signature.
     * @public
     */
    public static $digitalSignature = 'DIGITAL_SIGNATURE';

    /**
     * Parameter key for the terminal having a screen.
     * @public
     */
    public static $screen = 'SCREEN';

    /**
     * Parameter key for the terminal having a printer.
     * @public
     */
    public static $printer = 'PRINTER';

    /**
     * Parameter key for the terminal having the ability to print receipts.
     * @public
     */
    public static $receipt = 'RECEIPT';
}
?>