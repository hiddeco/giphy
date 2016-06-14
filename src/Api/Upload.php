<?php

namespace Giphy\Api;

/**
 * Class Upload
 * @package Giphy\Api
 * @author  Hidde Beydals <hello@hidde.co>
 */
class Upload extends Api
{
    /**
     * Upload a GIF by URL to Giphy.
     *
     * @param  string      $url
     * @param  string|null $username
     * @param  array       $tags
     * @param  string|null $source
     * @param  bool        $hidden
     * @return object
     */
    public function url($url, $username = null, array $tags = array(), $source = null, $hidden = true)
    {
        return $this->post('gifs', array(
            'source_image_url' => $url,
            'username' => $username,
            'tags' => $tags,
            'source' => $source,
            'is_hidden' => $hidden
        ));
    }
}
