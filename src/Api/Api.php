<?php

namespace Giphy\Api;

use Giphy\Http\HttpClient;

/**
 * Class Api
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
abstract class Api
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Api constructor.
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
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
        $response = $this->httpClient->get(
            $path,
            $parameters,
            $headers
        );

        $body = $response->getBody()->getContents();

        if ($response->getHeader('Content-Type') === ['application/json']) {
            $body = json_decode($body);
        }

        return $body;
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
        $response = $this->httpClient->post(
            $path,
            $body,
            $headers
        );

        return $response->getBody();
    }
}
