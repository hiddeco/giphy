<?php

namespace Giphy\Api;

/**
 * Class Gif
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Gif extends Api
{
    /**
     * Search all Giphy GIFs for a word or phrase.
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
        return $this->get('gifs/search', array(
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * Return meta data about a GIF, by GIF id.
     *
     * @param string|array $id
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function find($id)
    {
        if (is_array($id)) {
            return $this->get('gifs', array(
                'ids' => $id
            ));
        }

        return $this->get('gifs/' . urlencode($id));
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
        return $this->get('gifs/translate', array(
            's' => $query,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * Return a random GIF, limited by tag. Excluding the tag parameter will return a random GIF from the Giphy catalog.
     *
     * @param null|string $tag
     * @param null|string $rating
     * @param string      $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function random($tag = null, $rating = null, $format = 'json')
    {
        return $this->get('gifs/random', array(
            'tag' => $tag,
            'rating' => $rating,
            'fmt' => $format
        ));
    }

    /**
     * Fetch GIFs currently trending online. Hand curated by the Giphy editorial team.
     *
     * @param int    $limit
     * @param null   $rating
     * @param string $format
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function trending($limit = 25, $rating = null, $format = 'json')
    {
        return $this->get('gifs/trending', array(
            'limit' => $limit,
            'rating' => $rating,
            'format' => $format
        ));
    }
}