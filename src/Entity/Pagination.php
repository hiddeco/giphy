<?php

namespace Giphy\Entity;

/**
 * Class Pagination
 * @package Giphy\Entity
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Pagination extends Entity
{
    /**
     * @var int
     */
    public $count;

    /**
     * @var int
     */
    public $totalCount;

    /**
     * @var int
     */
    public $offset;
}
