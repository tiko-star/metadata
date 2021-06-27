<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

use App\Utilities\ObjectMap;
use Exception;
use IteratorAggregate;
use Traversable;

/**
 * Map of MetaItemInterface instances.
 *
 * @package App\MetadataManagement\MetaItem
 */
class MetaItemObject implements MetaItemInterface, IteratorAggregate
{
    protected ObjectMap $items;

    /**
     * MetaItemObject constructor.
     * Create a new instance, using either a iterable object or an array for the initial values.
     *
     * @param array|iterable $items A iterable object or an array to use for the initial values.
     */
    public function __construct(iterable $items = [])
    {
        $this->items = new ObjectMap($items);
    }

    /**
     * Associate a key with a value, overwriting a previous association if one exists.
     *
     * @param string                                             $key  The key to associate the value with.
     * @param \App\MetadataManagement\MetaItem\MetaItemInterface $item The value to be associated with the key.
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemObject
     */
    public function set(string $key, MetaItemInterface $item) : MetaItemObject
    {
        $this->items->set($key, $item);

        return $this;
    }

    /**
     * Return the value for a given key.
     *
     * @param string $key The key to look up.
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface|null|object
     */
    public function get(string $key) : ?MetaItemInterface
    {
        return $this->items->get($key);
    }

    /**
     * Determine whether the meta item contains a given key.
     *
     * @param string $key The key to look for.
     *
     * @return bool
     */
    public function has(string $key) : bool
    {
        return $this->items->has($key);
    }

    /**
     * Remove and return a value by key.
     *
     * @param string $key The key to remove.
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface|object|null
     */
    public function delete(string $key) : ?MetaItemInterface
    {
        return $this->items->delete($key);
    }

    /**
     * Retrieve an external iterator
     *
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or <b>Traversable</b>
     *
     * @throws Exception on failure.
     */
    public function getIterator()
    {
        return $this->items->getIterator();
    }
}
