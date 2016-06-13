<?php

namespace Giphy\Http;

use Giphy\Exceptions\ClientErrorException;
use Giphy\Exceptions\ServerErrorException;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient as BaseClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\Authentication\QueryParam;
use Http\Message\MessageFactory;

/**
 * Class HttpClient
 * @package Giphy\Http
 * @author  Hidde Beydals <hello@hidde.co>
 */
class HttpClient
{
    /**
     * @var string
     */
    const BASE_URL = 'https://api.giphy.com/v1';

    /**
     * @var string
     */
    const BASE_UPLOAD_URL = 'https://upload.giphy.com/v1';

    /**
     * @var string
     */
    const HTTP_AGENT = 'Giphy (PHP API wrapper)';

    /**
     * @var BaseClient
     */
    private $httpClient;

    /**
     * @var MessageFactory
     */
    private $factory;

    /**
     * @var QueryParam
     */
    private $authentication;

    /**
     * HttpClient constructor.
     *
     * @param BaseClient|null     $client
     * @param MessageFactory|null $factory
     * @param string              $apiKey
     */
    public function __construct(BaseClient $client = null, MessageFactory $factory = null, $apiKey)
    {
        $this->httpClient = $client ?: HttpClientDiscovery::find();
        $this->factory = $factory ?: MessageFactoryDiscovery::find();
        $this->authentication = new QueryParam(['api_key' => $apiKey]);
    }

    /**
     * Make a GET request using the given/discovered HTTP client.
     *
     * @param string $path
     * @param array  $query
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($path, $query = [], $headers = [])
    {
        return $this->request(
            sprintf(
                '%s/%s?%s',
                rtrim(self::BASE_URL, '/'),
                ltrim($path, '/'),
                http_build_query($query)
            ),
            null,
            'GET',
            $headers
        );
    }

    /**
     * Make a POST request using the given/discovered HTTP client.
     *
     * @param string $path
     * @param mixed  $body
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($path, $body = null, $headers = [])
    {
        return $this->request(
            sprintf(
                '%s/%s',
                rtrim(self::BASE_UPLOAD_URL, '/'),
                ltrim($path, '/')
            ),
            $body,
            'POST',
            $headers
        );
    }

    /**
     * Make a request using the given/discovered HTTP client.
     *
     * @param string $path
     * @param mixed  $body
     * @param string $method
     * @param array  $headers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request($path, $body, $method, $headers = [])
    {
        $headers = array_merge([
            'User-Agent' => self::HTTP_AGENT,
        ], $headers);

        $request = $this->factory->createRequest($method, $path, $headers, $body);
        $response = $this->httpClient->sendRequest($this->authentication->authenticate($request));

        if ($response->getHeader('Content-Type') === ['application/json']) {
            $body = json_decode($response->getBody()->getContents());
            $statusCode = $body->meta->status;

            if ($statusCode >= 400 && $statusCode < 500) {
                throw new ClientErrorException($body->meta->msg, $request, $response);
            }

            if ($statusCode >= 500 && $statusCode < 600) {
                throw new ServerErrorException($body->meta->msg, $request, $response);
            }
        }

        return $response;
    }
}
