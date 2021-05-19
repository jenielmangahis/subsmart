RingCentral Lite SDK for PHP
============================

[![Scrutinizer Code Quality][scrutinizer-status-svg]][scrutinizer-status-link]
[![License][license-svg]][license-link]
[![Stack Overflow][stackoverflow-svg]][stackoverflow-url]

- [Overview](#overview)
- [Quickstart](#quickstart)
  - [Send a SMS](#send-a-sms)
  - [Send a Fax](#send-a-fax)
  - [Create a Webhook](#create-a-webhook)

## Overview

This is an experimental, lightweight, minimal dependency RingCentral SDK for PHP.

Goals include:

1. Legacy PHP support: No namespace usage
1. Self-contained: No dependencies
1. Embedded support: Single file deployment

Please use the [official RingCentral PHP SDK](https://github.com/ringcentral/ringcentral-php) if possible.

## Quickstart

### Send a SMS

See [`examples/sms`](examples/sms) for working example.

```php
require_once('/path/to/ringcentrallite.php');

$rc = new RingCentralLite('myClientId', 'myClientSecret', RingCentralLite::RC_SERVER_SANDBOX);
$resAuth = $rc->authorize('myUsername', 'myExtension', 'myPassword');

$params = array(
    'json'     => array(
        'to'   => array( array('phoneNumber' => '+16505550111') ), // Text this number
        'from' => array('phoneNumber' => '+16505550100'), // From a valid RingCentral number
        'text' => 'SMS from RingCentral Lite PHP SDK'
    )
);
$res = $rc->post('/restapi/v1.0/account/~/extension/~/sms', $params);
```

### Send a Fax

See [`examples/fax`](examples/fax) for working example.

```php
require_once('/path/to/ringcentrallite.php');

$rc = new RingCentralLite('myClientId', 'myClientSecret', RingCentralLite::RC_SERVER_SANDBOX);
$resAuth = $rc->authorize('myUsername', 'myExtension', 'myPassword');

$params = array(
    'to'         => '+16505550111',
    'attachment' => '@'.realpath('test_file.pdf')
);
$res = $rc->post('/restapi/v1.0/account/~/extension/~/fax', $params);
```

### Create a Webhook

See [`examples/webhook`](examples/webhook) for working example.

```php
$reqBody = array(
    'eventFilters' => array(
        '/restapi/v1.0/account/~/extension/~/message-store/instant?type=SMS',
        '/restapi/v1.0/subscription/~?threshold=86400&interval=3600'
    ),
    'deliveryMode'      => array(
        'transportType' => 'WebHook',
        'address'       => 'https://12345678.ngrok.io/hook.php'
    )
);

$res = $rc->post('subscription', array('json' => $body));
```

 [scrutinizer-status-svg]: https://scrutinizer-ci.com/g/grokify/ringcentral-sdk-php-lite/badges/quality-score.png?b=master
 [scrutinizer-status-link]: https://scrutinizer-ci.com/g/grokify/ringcentral-sdk-php-lite/?branch=master
 [license-svg]: https://img.shields.io/badge/license-MIT-blue.svg
 [license-link]: https://github.com/grokify/ringcentral-sdk-php-lite/blob/master/LICENSE.txt
 [stackoverflow-svg]: https://img.shields.io/badge/Stack%20Overflow-ringcentral-orange.svg
 [stackoverflow-url]: https://stackoverflow.com/questions/tagged/ringcentral
