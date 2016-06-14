<?php

namespace Giphy\Exceptions;

use Http\Client\Exception\HttpException;

/**
 * Class ServerErrorException
 * @package Giphy\Exceptions
 * @author  Hidde Beydals <hello@hidde.co>
 */
class ServerErrorException extends HttpException
{
}
