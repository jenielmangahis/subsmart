# RingCentral PHP Webhook Demo App

This is a small demo app to demonstrate webhooks

## Installation

```bash
$ git clone https://github.com/grokify/ringcentral-sdk-php-lite
$ cd ringcentral-sdk-php-lite/examples/webhook
$ cp rc-credentials-sample.json .rc-credentials.json
$ vi .rc-credentials.json
```

### Using ngrok

A webhook service must be available on the Internet since the URL must be reachable by RingCentral's servers. If you do not have a server that is publicly accessible, you can use a tunneling service such as ngrok.

### Using ngrok and PHP built-in server

In this section, we will use the PHP built-in server and ngrok. We will start the local server on port `8080` and direct ngrok to that port. 

Open a terminal and start ngrok pointing to port `8080`:

`$ ngrok http 8080`

You will see a URL like:

`https://12345678.ngrok.io -> localhost:8080`

We will use this ngrok URL with the `hook.php` for the webhook URL:

`https://12345678.ngrok.io/hook.php`

Now you can set up the file and use that above URL as the `webhookURL` property in the `.rc-credentials.json` file.

```bash
$ git clone https://github.com/grokify/ringcentral-sdk-php-lite
$ cd ringcentral-sdk-php-lite/examples/webhook
$ cp rc-credentials-sample.json .rc-credentials.json
$ vi .rc-credentials.json
$ php -S localhost:8080
```

Use the hostname found in ngrok (no need to add local port number).

Open a web browser and go to:

* https://12345678.ngrok.io/listhooks.php
* https://12345678.ngrok.io/createhook.php
* https://12345678.ngrok.io/listhooks.php

Now send a SMS message to the extension you specified in the `.rc-credentials.json` file and then look in the error log and you will see an entry for the SMS. RingCentral will send the SMS event to the `hook.php` end point which will be logged.

Note, the built-in server may be too slow to respond and result in a webhook error from RingCentral. You may need to use a faster server to account for this. Instructions for using the MacOS built-in Apache server are below.

### Using ngrok and MacOS built-in Apache server

To use the built-in Apache web server on MacOS, you can simply copy the files to the webserver document root at `/Library/WebServer/Documents`.

Ensure you have ngrok running, if needed, so you have the proper URL to add to `.rc-credentials.json`. Since the built-in webserver runs on port `80` you will need to have ngrok point to port 80:

`$ ngrok http 80`

You will see a URL like:

`https://12345678.ngrok.io -> localhost:80`

In this case, your webhook URL will have the repo path and look like:

`https://12345678.ngrok.io/ringcentral-sdk-php-lite/examples/webhook/hook.php`

```bash
$ cd /Library/WebSever/Documents
$ git clone https://github.com/grokify/ringcentral-sdk-php-lite
$ cd ringcentral-sdk-php-lite/examples/webhook
$ cp rc-credentials-sample.json .rc-credentials.json
$ vi .rc-credentials.json
```

Open a web browser and go to:

* https://12345678.ngrok.io/ringcentral-sdk-php-lite/examples/webhook/listhooks.php
* https://12345678.ngrok.io/ringcentral-sdk-php-lite/examples/webhook/createhook.php
* https://12345678.ngrok.io/ringcentral-sdk-php-lite/examples/webhook/listhooks.php

On MacOS Apache, the inbound webhook messages will be written to the error log located at:

`/var/log/apache2/error_log`

You can view this file staticly:

`$ cat /var/log/apache2/error_log`

Or you can monitor this live with `tail -F`:

`$ tail -F /var/log/apache2/error_log`

To stop the `tail`, you can use Ctrl-C (holding down the `control` and `c` keys together).
