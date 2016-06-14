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
     *
     * @return array|\Giphy\Entity\Gif[]
     */
    public function search($query, $limit = 25, $offset = 0, $rating = null)
    {
        $results = $this->get('gifs/search', array(
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset,
            'rating' => $rating
        ));

        $this->extractPagination($results);

        return array_map(function ($gif) {
            return new \Giphy\Entity\Gif($gif);
        }, $results->data);
    }

    /**
     * Return meta data about a GIF, by GIF id.
     *
     * @param string|array $id
     *
     * @return \Giphy\Entity\Gif|array|\Giphy\Entity\Gif[]
     */
    public function find($id)
    {
        $this->pagination = null;

        if (!is_array($id)) {
            $gif = $this->get('gifs/' . urlencode($id));

            return new \Giphy\Entity\Gif($gif->data);
        }

        $gifs = $this->get('gifs', array(
            'ids' => implode(',', $id)
        ));

        return array_map(function ($gif) {
            return new \Giphy\Entity\Gif($gif);
        }, $gifs->data);
    }

    /**
     * The translate API draws on search, but uses the Giphy "special sauce"
     * to handle translating from one vocabulary to another.
     *
     * @param string      $query
     * @param null|string $rating
     *
     * @return \Giphy\Entity\Gif
     */
    public function translate($query, $rating = null)
    {
        $translation = $this->get('gifs/translate', array(
            's' => $query,
            'rating' => $rating,
        ));

        $this->pagination = null;

        return new \Giphy\Entity\Gif($translation->data);
    }

    /**
     * Return a random GIF, limited by tag. Excluding the tag parameter will return a random GIF from the Giphy catalog.
     *
     * @param null|string $tag
     * @param null|string $rating
     *
     * @return \Giphy\Entity\Roulette
     */
    public function random($tag = null, $rating = null)
    {
        $gif = $this->get('gifs/random', array(
            'tag' => $tag,
            'rating' => $rating
        ));

        $this->pagination = null;

        return new \Giphy\Entity\Roulette($gif->data);
    }

    /**
     * Fetch GIFs currently trending online. Hand curated by the Giphy editorial team.
     *
     * @param int    $limit
     * @param null   $rating
     *
     * @return array|\Giphy\Entity\Gif[]
     */
    public function trending($limit = 25, $rating = null)
    {
        $trending = $this->get('gifs/trending', array(
            'limit' => $limit,
            'rating' => $rating
        ));

        $this->pagination = null;

        return array_map(function ($gif) {
            return new \Giphy\Entity\Gif($gif);
        }, $trending->data);
    }
}
