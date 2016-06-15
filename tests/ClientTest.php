<?php

namespace Giphy\Tests;

use Giphy\Api\Gif;
use Giphy\Api\Sticker;
use Giphy\Api\Upload;
use Giphy\Client;
use Giphy\Exceptions\InvalidArgumentException;
use Giphy\Http\HttpClient;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function test_should_not_have_to_pass_http_client_on_construct()
    {
        $client = new Client(null, 'foobar');
        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }

    public function test_should_not_have_to_pass_api_key_on_construct()
    {
        $client = new Client(new HttpClient(null, null, 'foobar'));

        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }

    public function test_need_to_pass_api_key_or_http_client_on_construct()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Either the API key or the HTTP client must be specified'
        );

        $client = new Client();
        $client->getHttpClient();
    }

    public function test_can_change_api_key()
    {
        $client = new Client(null, 'foobar');
        $client->setApiKey('barfoo');

        $this->assertEquals('barfoo', $client->getApiKey());
    }

    public function test_can_change_http_client()
    {
        $client = new Client(null, null);
        $client->setHttpClient(new HttpClient(null, null, 'foo'));

        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }

    public function test_can_get_gif_instance()
    {
        $client = new Client(null, 'foobar');

        $this->assertInstanceOf(Gif::class, $client->gif());
    }

    public function test_can_get_sticker_instance()
    {
        $client = new Client(null, 'foobar');

        $this->assertInstanceOf(Sticker::class, $client->sticker());
    }

    public function test_can_get_upload_instance()
    {
        $client = new Client(null, 'foobar');

        $this->assertInstanceOf(Upload::class, $client->upload());
    }
}