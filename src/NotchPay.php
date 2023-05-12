<?php

namespace NotchPay;

use NotchPay\Exceptions\InvalidArgumentException;

class NotchPay
{
    /** @var string The Paystack API key to be used for requests. */
    public static string $apiKey;

    /** @var string The instance API key, settable once per new instance */
    private $instanceApiKey;

    /** @var string The base URL for the Paystack API. */
    public static $apiBase = 'https://api-dev1239.notchpay.test';

    /**
     * @return string the API key used for requests
     */
    public static function getApiKey(): string
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     */
    public static function setApiKey(string $apiKey): void
    {
        self::validateApiKey($apiKey);
        self::$apiKey = $apiKey;
    }

    private static function validateApiKey($apiKey): bool
    {
        if ($apiKey == '' || ! is_string($apiKey)) {
            throw new InvalidArgumentException('Api key must be a string and cannot be empty');
        }

        if(substr( $apiKey, 0, 2 ) !== "b." && substr( $apiKey, 0, 3 ) !== "sb." ) {
            throw new InvalidArgumentException('Api key must have a valid signature.');
        }
        return true;
    }
}
