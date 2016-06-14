<?php

namespace Giphy\Api;

use Giphy\Entity\Gif as GifEntity;
use Giphy\Entity\Roulette as RouletteEntity;

/**
 * Class Sticker
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Sticker extends Api
{
    /**
     * Search all Giphy animated stickers for a word or phrase.
     *
     * @param string      $query
     * @param int         $limit
     * @param int         $offset
     * @param string|null $rating
     *
     * @return GifEntity
     */
    public function search($query, $limit = 25, $offset = 0, $rating = null)
    {
        $results = $this->get('stickers/search', array(
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
            'rating' => $rating
        ));

        $this->extractPagination($results);

        return array_map(function ($gif) {
            return new GifEntity($gif);
        }, $results->data);
    }

    /**
     * The translate API draws on search, but uses the Giphy "special sauce"
     * to handle translating from one vocabulary to another.
     *
     * @param string      $query
     * @param null|string $rating
     *
     * @return Gif
     */
    public function translate($query, $rating = null)
    {
        $translation = $this->get('stickers/translate', array(
            's' => $query,
            'rating' => $rating,
        ));

        $this->pagination = null;

        return new GifEntity($translation->data);
    }

    /**
     * Return a random animated sticker GIF, limited by tag.
     * Excluding the tag parameter will return a random GIF from the Giphy catalog.
     *
     * @param null|string $tag
     * @param null|string $rating
     *
     * @return GifEntity
     */
    public function random($tag = null, $rating = null)
    {
        $gif = $this->get('stickers/random', array(
            'tag' => $tag,
            'rating' => $rating
        ));

        $this->pagination = null;

        return new RouletteEntity($gif->data);
    }

    /**
     * Fetch animated sticker GIFs currently trending online. Hand curated by the Giphy editorial team.
     *
     * @param int    $limit
     * @param null   $rating
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function trending($limit = 25, $rating = null)
    {
        $trending = $this->get('stickers/trending', array(
            'limit' => $limit,
            'rating' => $rating
        ));

        $this->pagination = null;

        return array_map(function ($gif) {
            new GifEntity($gif);
        }, $trending->data);
    }
}
