<?php

namespace NotchPay;

class Customer extends ApiResource
{
    const OBJECT_NAME = 'customers';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Fetch;
    use ApiOperations\Update;

    /**
     * @param string $customerId containing the id of the customer to block
     *
     * @link https://developer.notchpay.co/#customer-whitelist-blacklist
     */
    public static function block(string $customerId): array|object
    {
        $url = static::classUrl().'/'.$customerId.'/block';

        return static::staticRequest('PUT', $url);
    }

    /**
     * @param string $customerId containing the id of the customer to unblock
     *
     * @link https://developer.notchpay.co/#customer-whitelist-blacklist
     */
    public static function unblock(string $customerId): array|object
    {
        $url = static::classUrl().'/'.$customerId.'/unblock';

        return static::staticRequest('PUT', $url);
    }

    /**
     * @param string $customerId containing the id of the customer to delete
     *
     * @link https://developer.notchpay.co/#customer-whitelist-blacklist
     */
    public static function delete(string $customerId): array|object
    {
        $url = static::classUrl().'/'.$customerId;

        return static::staticRequest('delete', $url);
    }
}
