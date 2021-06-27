<?php

declare(strict_types = 1);

namespace App\MetadataManagement;

use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;

/**
 * Class Metadata is an object oriented representation of the metadata definition.
 *
 * @package App\MetadataManagement
 */
final class Metadata
{
    /**
     * @var \App\MetadataManagement\MetaItem\MetaItemObject Root object to store meta item entries.
     */
    protected MetaItemObject $root;

    public function __construct(MetaItemObject $root)
    {
        $this->root = $root;
    }

    /**
     * Get the root object.
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemObject|null
     */
    public function getRoot() : MetaItemObject
    {
        return $this->root;
    }

    /**
     * Set the root object.
     *
     * @param \App\MetadataManagement\MetaItem\MetaItemObject $root
     */
    public function setRoot(MetaItemObject $root) : void
    {
        $this->root = $root;
    }

    /**
     * Associate a key with a value, overwriting a previous association if one exists.
     *
     * @param string                                             $key  The key to associate the value with.
     * @param \App\MetadataManagement\MetaItem\MetaItemInterface $item The value to be associated with the key.
     *
     * @return \App\MetadataManagement\Metadata
     */
    public function set(string $key, MetaItemInterface $item) : Metadata
    {
        $this->root->set($key, $item);

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
        return $this->root->get($key);
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
        return $this->root->has($key);
    }

    /**
     * Remove and return a value by key.
     *
     * @param string $key The key to remove.
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface|null
     */
    public function delete(string $key) : ?MetaItemInterface
    {
        return $this->root->delete($key);
    }
}
