<?php

namespace Giphy\Tests\Api;

use Giphy\Api\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function test_json_returns_null_on_empty_array()
    {
        $json = Utils::json(array());

        $this->assertEquals(null, $json);
    }

    public function test_json_returns_json()
    {
        $array =  array(
            'foo' => 'bar',
            'barDepth' => [
                'fooKey' => 'FooValue'
            ]
        );

        $json = Utils::json($array);

        $this->assertJsonStringEqualsJsonString('{"foo":"bar","barDepth":{"fooKey":"FooValue"}}', $json);
    }

    public function test_camelcase_returns_camelcase()
    {
        $string = "underscores_are_the_feature";

        $camelCase = Utils::camelCase($string);

        $this->assertSame('underscoresAreTheFeature', $camelCase);
    }
}
