<?php

namespace Giphy\Exceptions;

use Http\Client\Exception\HttpException;

/**
 * Class ClientErrorException
 * @package Giphy\Exceptions
 * @author  Hidde Beydals <hello@hidde.co>
 */
class ClientErrorException extends HttpException
{}