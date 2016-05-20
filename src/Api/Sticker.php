<?php

namespace Giphy\Api;

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
     * @param string      $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function search($query, $limit = 25, $offset = 0, $rating = null, $format = 'json')
    {
        return $this->get('stickers/search', array(
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * The translate API draws on search, but uses the Giphy "special sauce"
     * to handle translating from one vocabulary to another.
     *
     * @param string      $query
     * @param null|string $rating
     * @param string      $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function translate($query, $rating = null, $format = 'json')
    {
        return $this->get('stickers/translate', array(
            's' => $query,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * Return a random animated sticker GIF, limited by tag.
     * Excluding the tag parameter will return a random GIF from the Giphy catalog.
     *
     * @param null|string $tag
     * @param null|string $rating
     * @param string      $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function random($tag = null, $rating = null, $format = 'json')
    {
        return $this->get('stickers/random', array(
            'tag' => $tag,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * Fetch animated sticker GIFs currently trending online. Hand curated by the Giphy editorial team.
     *
     * @param int    $limit
     * @param null   $rating
     * @param string $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function trending($limit = 25, $rating = null, $format = 'json')
    {
        return $this->get('stickers/trending', array(
            'limit' => $limit,
            'rating' => $rating,
            'format' => $format
        ));
    }
}
