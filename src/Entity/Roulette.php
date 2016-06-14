<?php

namespace Giphy\Entity;

/**
 * Class Roulette
 * @package Giphy\Entity
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Roulette extends Entity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $imageOriginalUrl;

    /**
     * @var string
     */
    public $imageUrl;

    /**
     * @var string
     */
    public $imageMp4Url;

    /**
     * @var int
     */
    public $imageFrames;

    /**
     * @var int
     */
    public $imageWidth;

    /**
     * @var int
     */
    public $imageHeight;

    /**
     * @var string
     */
    public $fixedHeightDownsampledUrl;

    /**
     * @var int
     */
    public $fixedHeightDownsampledWidth;

    /**
     * @var int
     */
    public $fixedHeightDownsampledHeight;

    /**
     * @var string
     */
    public $fixedHeightSmallUrl;

    /**
     * @var string
     */
    public $fixedHeightSmallStillUrl;

    /**
     * @var int
     */
    public $fixedHeightSmallWidth;

    /**
     * @var int
     */
    public $fixedHeightSmallHeight;

    /**
     * @var string
     */
    public $fixedWidthSmallUrl;

    /**
     * @var string
     */
    public $fixedWidthSmallStillUrl;

    /**
     * @var int
     */
    public $fixedWidthSmallWidth;

    /**
     * @var int
     */
    public $fixedWidthSmallHeight;
}
