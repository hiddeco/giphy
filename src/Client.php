<?php

namespace Giphy;

use Giphy\Api\Gif;
use Giphy\Api\Sticker;
use Giphy\Api\Upload;
use Giphy\Http\HttpClient;

/**
 * Class Client
 * @package Giphy
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Client
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param HttpClient $httpClient
     * @param string     $apiKey
     */
    public function __construct(HttpClient $httpClient = null, $apiKey = null)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * Return the GIF API.
     *
     * @return Gif
     */
    public function gif()
    {
        return new Gif($this->getHttpClient());
    }

    /**
     * Return the sticker API.
     *
     * @return Sticker
     */
    public function sticker()
    {
        return new Sticker($this->getHttpClient());
    }

    /**
     * Return the upload API.
     *
     * @return Upload
     */
    public function upload()
    {
        return new Upload($this->getHttpClient());
    }

    /**
     * Return the HTTP client used to issue request to the Giphy API.
     *
     * When no HTTP client is given on construction of the Client it will try
     * to auto resolve the HTTP client's dependencies using http\discovery.
     *
     * @see http://docs.php-http.org/en/latest/discovery.html
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (is_null($this->apiKey) && is_null($this->httpClient)) {
            throw new \InvalidArgumentException("Either the API key or the HTTP client must be specified");
        }

        if (null === $this->httpClient) {
            $this->httpClient = new HttpClient(null, null, $this->apiKey);
        }

        return $this->httpClient;
    }

    /**
     * Set the HTTP client used to issue request to the Giphy API.
     *
     * @param HttpClient $client
     */
    public function setHttpClient(HttpClient $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Return the set API key.
     *
     * @return null|string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the API key.
     *
     * @param $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
