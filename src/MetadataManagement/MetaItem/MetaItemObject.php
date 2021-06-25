<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

use App\Utilities\ObjectMap;

class MetaItemObject implements MetaItemInterface
{
    protected ObjectMap $items;

    public function __construct(iterable $items = [])
    {
        $this->items = new ObjectMap($items);
    }

    public function set(string $key, MetaItemInterface $item) : MetaItemObject
    {
        $this->items->set($key, $item);

        return $this;
    }

    /**
     * @param string $key
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface|null|object
     */
    public function get(string $key) : ?MetaItemInterface
    {
        return $this->items->get($key);
    }

    public function has(string $key) : bool
    {
        return isset($this->items[$key]);
    }

    public function delete(string $key) : ?MetaItemInterface
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
     * @return ObjectMap data which can be serialized by <b>json_encode</b>,
     *                   which is a value of any type other than a resource.
     */
    public function jsonSerialize() : ObjectMap
    {
        return $this->items;
    }
}
