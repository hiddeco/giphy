<?php

namespace Giphy\Api;

use Giphy\Client;

/**
 * Class Api
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
abstract class Api
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Api constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a GET request with optional query parameters.
     *
     * @param string $path
     * @param array  $parameters
     * @param array  $headers
     *
     * @return object|string
     */
    protected function get($path, array $parameters = array(), array $headers = array())
    {
        $response = $this->client->getHttpClient()->get(
            $path,
            $parameters,
            $headers
        );

        if ($response->getHeader('Content-Type') === ['application/json']) {
            return json_decode($response->getBody()->getContents());
        }

        return $response->getBody()->getContents();
    }

    /**
     * Send a POST request with form-urlencoded parameters.
     *
     * @param string $path
     * @param array  $parameters
     * @param array  $headers
     *
     * @return object
     */
    protected function post($path, array $parameters = array(), array $headers = array())
    {
        return json_decode($this->postRaw(
            $path,
            http_build_query($parameters, null, '&'),
            array_merge($headers, array(
                'Content-Type' => 'application/x-www-form-urlencoded'
            ))
        )->getContents());
    }

    /**
     * Send a raw HTTP POST request.
     *
     * @param string $path
     * @param mixed  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    protected function postRaw($path, $body, array $headers = array())
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $body,
            $headers
        );

        return $response->getBody();
    }
}