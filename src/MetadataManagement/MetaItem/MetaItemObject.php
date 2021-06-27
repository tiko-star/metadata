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
     * Retrieve an external iterator
     *
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @throws Exception on failure.
     */
    public function getIterator()
    {
        return $this->items->getIterator();
    }
}
