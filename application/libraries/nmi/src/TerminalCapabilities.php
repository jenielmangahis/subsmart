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
 * Supplementary information for both the terminal and integration used to complete this transaction,
 * such as the device type and card authentication method.  The supply of this information is
 * optional for existing integrations and certifications, however newer integrations should populate this data.
 *
 * @author Creditcall Ltd
 */

class TerminalCapabilities
{
    var $terminalCapabilitiesGeneric;
    var $terminalCapabilitiesCardInput;
    var $terminalCapabilitiesThreeDSecure;
    var $terminalCapabilitiesCatLevel;
    var $terminalCapabilitiesCardholderAuthentication;
    var $terminalCapabilitiesContactEmv;
    var $terminalCapabilitiesContactless;
    var $terminalCapabilitiesEcomCnp;
    var $terminalCapabilitiesFeatures;

    public function __construct() {
        $this->terminalCapabilitiesGeneric = null;
        $this->terminalCapabilitiesCardInput = null;
        $this->terminalCapabilitiesThreeDSecure = null;
        $this->terminalCapabilitiesCatLevel = null;
        $this->terminalCapabilitiesCardholderAuthentication = null;
        $this->terminalCapabilitiesContactEmv = null;
        $this->terminalCapabilitiesContactless = null;
        $this->terminalCapabilitiesEcomCnp = null;
        $this->terminalCapabilitiesFeatures = null;
    }

    /**
     * Adds the generic properties for Terminal Capabilities.
     *
     * @param genericParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#AttendedType} (Optional) The Attended Type being used. Values can be {@link ParameterValues#AttendedTypeAttended} or {@link ParameterValues#AttendedTypeUnattended}.</p>
     * <p>{@link ParameterKeys#DeviceType} (Optional) The Device Type being used. Values can be {@link ParameterValues#DeviceTypeConsumer} or {@link ParameterValues#DeviceTypeMerchant}.</p>
     * <p>{@link ParameterKeys#MobilePos} (Optional) If the device is a Mobile Point Of Sale. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Premises} (Optional) The type of Premises. Values can be {@link ParameterValues#PremisesTypeOnPremises} or {@link ParameterValues#PremisesTypeOffPremises}.</p>
     */
    public function addGenericCapabilities($genericParameters)
    {
        if ($this->terminalCapabilitiesGeneric == null)
        {
            $this->terminalCapabilitiesGeneric = new TerminalCapabilitiesGeneric();
        }

        if ($genericParameters->containsKey(ParameterKeys::$attendedType))
        {
            $this->terminalCapabilitiesGeneric->attendedType = $genericParameters->getValue(ParameterKeys::$attendedType);
        }

        if ($genericParameters->containsKey(ParameterKeys::$deviceType))
        {
            $this->terminalCapabilitiesGeneric->deviceType = $genericParameters->getValue(ParameterKeys::$deviceType);
        }

        if ($genericParameters->containsKey(ParameterKeys::$mobilePos))
        {
            $this->terminalCapabilitiesGeneric->mobilePos = $genericParameters->getValue(ParameterKeys::$mobilePos);
        }

        if ($genericParameters->containsKey(ParameterKeys::$premises))
        {
            $this->terminalCapabilitiesGeneric->premises = $genericParameters->getValue(ParameterKeys::$premises);
        }
    }

    /**
     * Adds the Three D Secure properties for Terminal Capabilities.
     *
     * @param threeDSecureParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#ThreeDSecureVersion1} (Optional) If 3-D secure version 1 is supported by the integration. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}}</p>
     * <p>{@link ParameterKeys#ThreeDSecureVersion1} (Optional) If 3-D secure version 2 is supported by the integration. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}}</p>
     * <p>{@link ParameterKeys#Visa} (Optional) If Visa's 3-D Secure solution is supported by the integration. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Mastercard} (Optional) If Mastercard's 3-D Secure solution is supported by the integration. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Amex} (Optional) If American Express's 3-D is supported by the integration. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */
    public function addThreeDSecureCapabilities($threeDSecureParameters)
    {
        if ($this->terminalCapabilitiesThreeDSecure == null)
        {
            $this->terminalCapabilitiesThreeDSecure = new TerminalCapabilitiesThreeDSecure();
        }

        if ($threeDSecureParameters->containsKey(ParameterKeys::$threeDSecureVersion1))
        {
            $this->terminalCapabilitiesThreeDSecure->threeDSecureVersion1 = $threeDSecureParameters->getValue(ParameterKeys::$threeDSecureVersion1);
        }

        if ($threeDSecureParameters->containsKey(ParameterKeys::$threeDSecureVersion2))
        {
            $this->terminalCapabilitiesThreeDSecure->threeDSecureVersion2 = $threeDSecureParameters->getValue(ParameterKeys::$threeDSecureVersion2);
        }

        if ($threeDSecureParameters->containsKey(ParameterKeys::$visa))
        {
            $this->terminalCapabilitiesThreeDSecure->visa = $threeDSecureParameters->getValue(ParameterKeys::$visa);
        }

        if ($threeDSecureParameters->containsKey(ParameterKeys::$mastercard))
        {
            $this->terminalCapabilitiesThreeDSecure->mastercard = $threeDSecureParameters->getValue(ParameterKeys::$mastercard);
        }

        if ($threeDSecureParameters->containsKey(ParameterKeys::$amex))
        {
            $this->terminalCapabilitiesThreeDSecure->amex = $threeDSecureParameters->getValue(ParameterKeys::$amex);
        }
    }

    /**
     * Adds the Cardholder Activated Terminal properties for Terminal Capabilities.
     *
     * @param catParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#CatLevelAutomatedDispensingMachine} (Optional) Unattended terminal that only supports PIN and doesn't support NoCVM. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}}</p>
     * <p>{@link ParameterKeys#CatLevelSelfService} (Optional) Unattended terminal that supports only NoCVM. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}}</p>
     * <p>A CAT device may have dual capability as a CAT 1 and a CAT 2 - Contactless only unattended terminal or Contact/Contactless unattended terminal that supports PIN and NoCVM. To indicate the device has dual capability, set both CatLevelAutomatedDispensingMachine and CatLevelSelfService to {@link ParameterValues#True} </p>
     *
     */

    public function addCardholderActivatedTerminalCapabilities($catParameters)
    {
        if ($this->terminalCapabilitiesCatLevel == null)
        {
            $this->terminalCapabilitiesCatLevel = new TerminalCapabilitiesCatLevel();
        }

        if ($catParameters->containsKey(ParameterKeys::$catLevelAutomatedDispensingMachine))
        {
            $this->terminalCapabilitiesCatLevel->catLevelMap[$this->terminalCapabilitiesCatLevel->automatedDispensingMachine] = $catParameters->getValue(ParameterKeys::$catLevelAutomatedDispensingMachine);
        }

        if ($catParameters->containsKey(ParameterKeys::$catLevelSelfService))
        {
            $this->terminalCapabilitiesCatLevel->catLevelMap[$this->terminalCapabilitiesCatLevel->selfService] = $catParameters->getValue(ParameterKeys::$catLevelSelfService);
        }
    }

    /**
     * Adds the Card Input properties for Terminal Capabilities.
     *
     * @param cardInputParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#Keyed} (Optional) If Keyed transactions are supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#DeviceType} (Optional) If Magstripe transactions are supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#ContactEMV} (Optional) If ContactEMV transactions are supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#ContactlessEMV} (Optional) If Contactless EMV transactions are supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */

    public function addCardInputCapabilities($cardInputParameters)
    {
        if ($this->terminalCapabilitiesCardInput == null)
        {
            $this->terminalCapabilitiesCardInput = new TerminalCapabilitiesCardInput();
        }

        if ($cardInputParameters->containsKey(ParameterKeys::$keyed))
        {
            $this->terminalCapabilitiesCardInput->keyed = $cardInputParameters->getValue(ParameterKeys::$keyed);
        }

        if ($cardInputParameters->containsKey(ParameterKeys::$magstripe))
        {
            $this->terminalCapabilitiesCardInput->magstripe = $cardInputParameters->getValue(ParameterKeys::$magstripe);
        }

        if ($cardInputParameters->containsKey(ParameterKeys::$contactEMV))
        {
            $this->terminalCapabilitiesCardInput->contactEMV = $cardInputParameters->getValue(ParameterKeys::$contactEMV);
        }

        if ($cardInputParameters->containsKey(ParameterKeys::$contactlessEMV))
        {
            $this->terminalCapabilitiesCardInput->contactlessEMV = $cardInputParameters->getValue(ParameterKeys::$contactlessEMV);
        }
    }

    /**
     * Adds the Cardholder Authentication properties for Terminal Capabilities.
     *
     * @param cardholderAuthenticationParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#Cdcvm} (Optional) If Consumer Device Cardholder Verification Method input is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#PinBypass} (Optional) If PIN Bypass is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#OfflinePin} (Optional) If Offline PIN is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#PinRetry} (Optional) If PIN Retry is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#OnlinePin} (Optional) If Online PIN is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Signature} (Optional) If Signature is supported by the terminal. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */

    public function addCardholderAuthenticationCapabilities($cardholderAuthenticationParameters)
    {
        if ($this->terminalCapabilitiesCardholderAuthentication == null)
        {
            $this->terminalCapabilitiesCardholderAuthentication = new TerminalCapabilitiesCardholderAuthentication();
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$cdcvm))
        {
            $this->terminalCapabilitiesCardholderAuthentication->cdcvm = $cardholderAuthenticationParameters->getValue(ParameterKeys::$cdcvm);
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$pinBypass))
        {
            $this->terminalCapabilitiesCardholderAuthentication->pinBypass = $cardholderAuthenticationParameters->getValue(ParameterKeys::$pinBypass);
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$offlinePin))
        {
            $this->terminalCapabilitiesCardholderAuthentication->offlinePin = $cardholderAuthenticationParameters->getValue(ParameterKeys::$offlinePin);
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$pinRetry))
        {
            $this->terminalCapabilitiesCardholderAuthentication->pinRetry = $cardholderAuthenticationParameters->getValue(ParameterKeys::$pinRetry);
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$onlinePin))
        {
            $this->terminalCapabilitiesCardholderAuthentication->onlinePin = $cardholderAuthenticationParameters->getValue(ParameterKeys::$onlinePin);
        }

        if ($cardholderAuthenticationParameters->containsKey(ParameterKeys::$signature))
        {
            $this->terminalCapabilitiesCardholderAuthentication->signature = $cardholderAuthenticationParameters->getValue(ParameterKeys::$signature);
        }
    }

    /**
     * Adds the Card Input properties for Terminal Capabilities.
     *
     * @param $contactEmvParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#EmvTerminalCapabilities} (Optional) The EMV Terminal Capabilities of the terminal. This value is a Hexadecimal String, with a fixed length of 6.</p>
     * <p>{@link ParameterKeys#FallBack} (Optional) If Fall Back is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */
    public function addContactEmvCapabilities($contactEmvParameters)
    {
        if ($this->terminalCapabilitiesContactEmv == null)
        {
            $this->terminalCapabilitiesContactEmv = new TerminalCapabilitiesContactEmv();
        }

        if ($contactEmvParameters->containsKey(ParameterKeys::$contactEmvTerminalCapabilities))
        {
            $this->terminalCapabilitiesContactEmv->emvTerminalCapabilities = $contactEmvParameters->getValue(ParameterKeys::$contactEmvTerminalCapabilities);
        }

        if ($contactEmvParameters->containsKey(ParameterKeys::$fallBack))
        {
            $this->terminalCapabilitiesContactEmv->fallBack = $contactEmvParameters->getValue(ParameterKeys::$fallBack);
        }
    }

    /**
     * Adds the Card Input properties for Terminal Capabilities.
     *
     * @param contactlessParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#ParameterKeys.ContactlessEmvTerminalCapabilities} (Optional) The Contactless EMV Terminal Capabilities of the terminal being used. This value is a Hexadecimal String, with a fixed length of 6.</p>
     * <p>{@link ParameterKeys#CvmConsumerDevice} (Optional) If the terminal supports a Consumer Device being used as a method of Cardholder Verification during a contactless transaction. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#CvmOnlinePin} (Optional) If the terminal supports Online PIN as a method of Cardholder Verification during a contactless transaction. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#CvmSignature} (Optional) If the terminal supports a Signature as a method of Cardholder Verification during a contactless transaction. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Magstripe} (Optional) If Magstripe is supported by the terminal being used. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#SingleTap} (Optional) If Single Tap is supported by the terminal being used. For this to be true the terminal must support contactless Online PIN and be deployed within the EEA. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#FallForward} (Optional) If the terminal being used is able fall forward to contact. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */

    public function addContactlessCapabilities($contactlessParameters)
    {
        if ($this->terminalCapabilitiesContactless == null)
        {
            $this->terminalCapabilitiesContactless = new TerminalCapabilitiesContactless();
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$magstripe))
        {
            $this->terminalCapabilitiesContactless->magstripe = $contactlessParameters->getValue(ParameterKeys::$magstripe);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$singleTap))
        {
            $this->terminalCapabilitiesContactless->singleTap = $contactlessParameters->getValue(ParameterKeys::$singleTap);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$fallForward))
        {
            $this->terminalCapabilitiesContactless->fallForward = $contactlessParameters->getValue(ParameterKeys::$fallForward);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$contactlessEmvTerminalCapabilities))
        {
            $this->terminalCapabilitiesContactless->emvTerminalCapabilities = $contactlessParameters->getValue(ParameterKeys::$contactlessEmvTerminalCapabilities);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$cvmConsumerDevice))
        {
            $this->terminalCapabilitiesContactless->cvmCapabilities[$this->terminalCapabilitiesContactless->consumerDevice] = $contactlessParameters->getValue(ParameterKeys::$cvmConsumerDevice);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$cvmOnlinePin))
        {
            $this->terminalCapabilitiesContactless->cvmCapabilities[$this->terminalCapabilitiesContactless->onlinePin] = $contactlessParameters->getValue(ParameterKeys::$cvmOnlinePin);
        }

        if ($contactlessParameters->containsKey(ParameterKeys::$cvmSignature))
        {
            $this->terminalCapabilitiesContactless->cvmCapabilities[$this->terminalCapabilitiesContactless->signature] = $contactlessParameters->getValue(ParameterKeys::$cvmSignature);
        }
    }

    /**
     * Adds the Card Input properties for Terminal Capabilities.
     *
     * @param $ecomCnpParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#Avs} (Optional) If Address Verification Service is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Csc} (Optional) If Card Security Code is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#EcomUrl} (Optional) The Ecommerce URL. This value is a String.</p>
     *
     */
    public function addEcomCnpCapabilities($ecomCnpParameters)
    {
        if ($this->terminalCapabilitiesEcomCnp == null)
        {
            $this->terminalCapabilitiesEcomCnp = new TerminalCapabilitiesEcomCnp();
        }

        if ($ecomCnpParameters->containsKey(ParameterKeys::$ecomUrl))
        {
            $this->terminalCapabilitiesEcomCnp->ecomUrl = $ecomCnpParameters->getValue(ParameterKeys::$ecomUrl);
        }

        if ($ecomCnpParameters->containsKey(ParameterKeys::$csc))
        {
            $this->terminalCapabilitiesEcomCnp->csc = $ecomCnpParameters->getValue(ParameterKeys::$csc);
        }

        if ($ecomCnpParameters->containsKey(ParameterKeys::$avs))
        {
            $this->terminalCapabilitiesEcomCnp->avs = $ecomCnpParameters->getValue(ParameterKeys::$avs);
        }
    }

    /**
     * Adds the Card Input properties for Terminal Capabilities.
     *
     * @param $featuresParameters {@link Parameters} collection which can contain:
     * <p>{@link ParameterKeys#Printer} (Optional) If the terminal has a Printer. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Screen} (Optional) If the terminal has a Screen. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#DigitalSignature} (Optional) If Digital Signature is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#EndOfDayTipping} (Optional) If End Of Day Tipping is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#OnDeviceTipping} (Optional) If On Device Tipping is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#VoiceReferral} (Optional) If Voice Referral is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#PartialReversal} (Optional) If Partial Reversal is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#PartialAuth} (Optional) If Partial Authentication is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#MultiCurrency} (Optional) If Multi Currency is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#CardCapture} (Optional) If Card Capture is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Dcc} (Optional) If Dynamic Currency Conversion is supported. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     * <p>{@link ParameterKeys#Receipt} (Optional) If the terminal has a can print Receipts. Values can be {@link ParameterValues#True} or {@link ParameterValues#False}.</p>
     *
     */
    public function addFeaturesCapabilities($featuresParameters) {
        if ($this->terminalCapabilitiesFeatures == null)
        {
            $this->terminalCapabilitiesFeatures = new TerminalCapabilitiesFeatures();
        }

        if ($featuresParameters->containsKey(ParameterKeys::$printer))
        {
            $this->terminalCapabilitiesFeatures->printer = $featuresParameters->getValue(ParameterKeys::$printer);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$screen))
        {
            $this->terminalCapabilitiesFeatures->screen = $featuresParameters->getValue(ParameterKeys::$screen);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$digitalSignature))
        {
            $this->terminalCapabilitiesFeatures->digitalSignature = $featuresParameters->getValue(ParameterKeys::$digitalSignature);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$endOfDayTipping))
        {
            $this->terminalCapabilitiesFeatures->endOfDayTipping = $featuresParameters->getValue(ParameterKeys::$endOfDayTipping);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$onDeviceTipping))
        {
            $this->terminalCapabilitiesFeatures->onDeviceTipping = $featuresParameters->getValue(ParameterKeys::$onDeviceTipping);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$voiceReferral))
        {
            $this->terminalCapabilitiesFeatures->voiceReferral = $featuresParameters->getValue(ParameterKeys::$voiceReferral);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$partialReversal))
        {
            $this->terminalCapabilitiesFeatures->partialReversal = $featuresParameters->getValue(ParameterKeys::$partialReversal);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$partialAuth))
        {
            $this->terminalCapabilitiesFeatures->partialAuth = $featuresParameters->getValue(ParameterKeys::$partialAuth);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$multiCurrency))
        {
            $this->terminalCapabilitiesFeatures->multiCurrency = $featuresParameters->getValue(ParameterKeys::$multiCurrency);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$cardCapture))
        {
            $this->terminalCapabilitiesFeatures->cardCapture = $featuresParameters->getValue(ParameterKeys::$cardCapture);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$dcc))
        {
            $this->terminalCapabilitiesFeatures->dcc = $featuresParameters->getValue(ParameterKeys::$dcc);
        }

        if ($featuresParameters->containsKey(ParameterKeys::$receipt))
        {
            $this->terminalCapabilitiesFeatures->receipt = $featuresParameters->getValue(ParameterKeys::$receipt);
        }
    }
}