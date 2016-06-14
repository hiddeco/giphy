<?php

namespace Giphy\Entity;

use Giphy\Api\Utils;

/**
 * Class Entity
 * @package Giphy\Entity
 * @author  Hidde Beydals <hello@hidde.co>
 */
abstract class Entity
{
    /**
     * Entity constructor.
     *
     * @param \stdClass $class
     */
    public function __construct(\stdClass $class)
    {
        $parameters = get_object_vars($class);

        $this->build($parameters);
    }

    /**
     * 'Magically' build the entity by setting the properties based upon an array of parameters.
     *
     * @param array $parameters
     */
    protected function build(array $parameters)
    {
        foreach ($parameters as $key => $value) {
            $property = Utils::camelCase($key);

            if (property_exists($this, $property)) {
                // Make integers true integers
                $this->$property = is_numeric($value) ? (int) $value : $value;
            }
        }
    }
}