# Introduction

A PHP API wrapper for [Notch Pay](https://notchpay.co/).

## Installation

You can install the package via composer:

```bash
composer require notchpay/php-sdk-next
```

## Usage

Do a redirect to the authorization URL received from calling the payments/initialize endpoint. This URL is valid for one time use, so ensure that you generate a new URL per payment.

When the payment is successful, we will call your callback URL (as setup in your dashboard or while initializing the transaction) and return the reference sent in the first step as a query parameter.

If you use a test public key, we will call your test callback url, otherwise, we'll call your live callback url.

### 0. Prerequisites

Confirm that your server can conclude a TLSv1.2 connection to Notch Pay's servers. Most up-to-date software have this capability. Contact your service provider for guidance if you have any SSL errors.
_Don't disable SSL peer verification!_

### 1. Prepare your parameters

`email`, `amount` and `currency` are the most common compulsory parameters. Do send a unique email per customer.
The amount accept numeric value value.
The currency accept currency ISO 3166.
For instance, to accept `For US Dollar`, please send `USD` as the currency.


### 2. Initialize a onetime payments

Initialize a payment by calling our API.

```php
use NotchPay\NotchPay;
use NotchPay\Payment;

NotchPay::setApiKey('sk_1234abcd');

try {
    $tranx = Payment::initialize([
        'amount'=>$amount,       // according to currency format
        'email'=>$email,         // unique to customers
        'currency'=>$currency,         // currency iso code
        'callback'=>$callback,         // optional callback url
        'reference'=>$reference, // unique to transactions
    ]);
} catch(\NotchPay\Exceptions\ApiException $e){
    print_r($e->errors);
    die($e->getMessage());
}
// redirect to page so User can pay
header('Location: ' . $tranx->authorization_url);

```

When the user enters their payment details, NotchPay will validate and charge the card. It will do all the below:

Send a payment.complete event to your Webhook URL set at: https://business.notchpay.co/settings/developer

If receipts are not turned off, an HTML receipt will be sent to the customer's email.


### 3. Verify Transaction

After we redirect to your callback, please verify the transaction before giving value.

```php
    $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    if(!$reference){
      die('No reference supplied');
    }

    // initiate the Library's NotchPay Object
    NotchPay::setApiKey('sk_1234abcd');

    try {
    $tranx = Payment::verify($reference);

    if ($tranx->transaction->status === 'complete') {
      // transaction was successful...
      // please check other things like whether you already gave value for this ref
      // if the email matches the customer who owns the product etc
      // Give value
    }
} catch(\NotchPay\Exceptions\ApiException $e){
    print_r($e->errors);
    die($e->getMessage());
}

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email hello@notchpay.co instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
