<?php

namespace NotchPay;

use NotchPay\Exceptions\InvalidArgumentException;

class Payment extends ApiResource
{
    const OBJECT_NAME = 'payments';

    use ApiOperations\All;
    use ApiOperations\Fetch;

    /**
     *
     * @link https://developer.notchpay.co/#transaction-initialize
     * @throws InvalidArgumentException
     */
    public static function initialize(array $params): array|object
    {
        self::validateParams($params, true);
        $url = static::endPointUrl('initialize');

        return static::staticRequest('POST', $url, $params);
    }

    /**
     *
     * @link https://developer.notchpay.co/#transaction-verify
     *
     * @throws InvalidArgumentException
     */
    public static function verify(string $reference): array|object
    {
        $url = static::endPointUrl($reference);

        return static::staticRequest('GET', $url);
    }

    /**
     *
     * @link https://developer.notchpay.co/#transaction-charge-authorization
     *
     * @throws InvalidArgumentException
     */
    public static function complete(string $reference, array $params): array|object
    {
        self::validateParams($params, true);
        $url = static::endPointUrl($reference);

        return static::staticRequest('PUT', $url, $params);
    }

    /**
     *
     * @link https://developer.notchpay.co/#transaction-charge-authorization
     *
     * @throws InvalidArgumentException
     */
    public static function cancel(string $reference): array|object
    {
        $url = static::endPointUrl($reference);

        return static::staticRequest('DELETE', $url);
    }
}
