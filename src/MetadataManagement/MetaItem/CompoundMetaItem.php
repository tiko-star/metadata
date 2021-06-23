<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

use App\Utilities\ObjectMap;
use JsonSerializable;

use function iterator_to_array;

class CompoundMetaItem implements JsonSerializable
{
    protected ObjectMap $items;

    public function __construct(iterable $items = [])
    {
        $this->items = new ObjectMap($items);
    }

    public function set(string $key, MetaItem $item) : CompoundMetaItem
    {
        $this->items->set($key, $item);

        return $this;
    }

    /**
     * @param string $key
     *
     * @return \App\MetadataManagement\MetaItem\MetaItem|null|object
     */
    public function get(string $key) : ?MetaItem
    {
        return $this->items->get($key);
    }

    public function has(string $key) : bool
    {
        return isset($this->items[$key]);
    }

    public function delete(string $key) : ?MetaItem
    {
        if (!$this->has($key)) {
            return null;
        }

        $item = $this->get($key);
        unset($this->items[$key]);

        return $item;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize() : array
    {
        return iterator_to_array($this->items);
    }
}
