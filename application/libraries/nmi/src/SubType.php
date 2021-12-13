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
 * The query for the card's scheme and type.
 */
define('SubType_QueryCardScheme', 'CardScheme');

/**
 * The query for the fraud state.
 */
define('SubType_QueryFraudState', 'FraudState');

/**
 * The query for the settlement state.
 */
define('SubType_QuerySettlementState', 'SettlementState');

/**
 * The query for the supported card schemes.
 */
define('SubType_QuerySupportedCardScheme', 'SupportedCardScheme');

/**
 * The public key update sub type for ICCManagement requests.
 */
define('SubType_ICCManagementPublicKeyUpdate', 'PublicKeyUpdate');

/**
 * The DoExpressCheckoutPayment call for PayPal requests.
 */
define('SubType_PayPalDoExpressCheckoutPayment', 'DoExpressCheckoutPayment');

/**
 * The GetExpressCheckoutDetails call for PayPal requests.
 */
define('SubType_PayPalGetExpressCheckoutDetails', 'GetExpressCheckoutDetails');

/**
 * The SetExpressCheckout call for PayPal requests.
 */
define('SubType_PayPalSetExpressCheckout', 'SetExpressCheckout');

/**
 * The ad hoc authorisation for recurring requests.
 */
define('SubType_RecurringAdHoc', 'AdHoc');

/**
 * The cancellation message for recurring requests.
 */
define('SubType_RecurringCancel', 'Cancel');

/**
 * The setup message for recurring requests.
 */
define('SubType_RecurringSetup', 'Setup');

/**
 * The fraud message for update requests.
 */
define('SubType_UpdateFraud', 'Fraud');

?>
