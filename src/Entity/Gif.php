<?php

namespace Giphy\Entity;

/**
 * Class Gif
 * @package Giphy\Entity
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Gif extends Entity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $bitlyGifUrl;

    /**
     * @var string
     */
    public $bitlyUrl;

    /**
     * @var string
     */
    public $embedUrl;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $rating;

    /**
     * @var string
     */
    public $caption;

    /**
     * @var string
     */
    public $contentUrl;

    /**
     * @var string
     */
    public $sourceTld;

    /**
     * @var string
     */
    public $sourcePostUrl;

    /**
     * @var string
     */
    public $importDatetime;

    /**
     * @var string
     */
    public $trendingDatetime;

    /**
     * @var \stdClass
     */
    public $images;
}