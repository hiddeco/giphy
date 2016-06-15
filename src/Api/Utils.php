<?php

namespace Giphy\Api;

/**
 * Class Utils
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Utils
{
    /**
     * Return encoded JSON of an array of parameters.
     *
     * @param  array $body
     * @return null|string
     */
    public static function json(array $body)
    {
        if (count($body) > 0) {
            return json_encode($body, JSON_FORCE_OBJECT);
        }

        return null;
    }

    /**
     * Return camelcase version of a string.
     *
     * @param  $string
     * @return string
     */
    public static function camelCase($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }
}
