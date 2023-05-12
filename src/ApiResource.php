<?php

namespace NotchPay;

use NotchPay\Exceptions\InvalidArgumentException;

class ApiResource
{
    const OBJECT_NAME = 'apiresource';

    use ApiOperations\Request;


    public static function baseUrl(): string
    {
        return NotchPay::$apiBase;
    }


    public static function classUrl(): string
    {
        $base = static::OBJECT_NAME;

        return "{$base}";
    }


    /**
     * @throws InvalidArgumentException
     */
    public static function resourceUrl(?string $id = null): string
    {
        if (null === $id) {
            $message = 'Invalid ID supplied. ID cannot be null';

            throw new InvalidArgumentException($message);
        }
        $id = Util\Util::utf8($id);
        $base = static::classUrl();
        $extn = urlencode($id);

        return "{$base}/{$extn}";
    }

    public static function endPointUrl(string $slug): string
    {
        $slug = Util\Util::utf8($slug);
        $base = static::classUrl();

        return "{$base}/{$slug}";
    }


    public static function buildQueryString(string $slug, array $params = null): string
    {
        $url = self::endPointUrl($slug);
        if (! empty($params)) {
            $url .= '?'.http_build_query($params);
        }

        return $url;
    }
}
