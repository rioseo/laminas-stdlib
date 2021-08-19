<?php

declare(strict_types=1);

namespace Laminas\Stdlib;

use Serializable;

use function serialize;
use function unserialize;

/**
 * Serializable version of SplStack
 */
class SplStack extends \SplStack implements Serializable
{
    /**
     * Serialize to an array representing the stack
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];
        foreach ($this as $item) {
            $array[] = $item;
        }
        return $array;
    }

    /**
     * Serialize
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * Magic method used for serializing of an instance.
     *
     * @return array
     */
    public function __serialize()
    {
        return $this->toArray();
    }

    /**
     * Unserialize
     *
     * @param  string $data
     * @return void
     */
    public function unserialize($data)
    {
        foreach (unserialize($data) as $item) {
            $this->unshift($item);
        }
    }

   /**
     * Magic method used to rebuild an instance.
     *
     * @param array $data Data array.
     * @return void
     */
    public function __unserialize($data)
    {
        foreach ($data as $item) {
            $this->unshift($item);
        }
    }
}
