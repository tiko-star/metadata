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
final class Metadata implements MetaItemInterface
{
    protected MetaItemObject $root;

    public function __construct(MetaItemObject $root)
    {
        $this->root = $root;
    }

    /**
     * @return \App\MetadataManagement\MetaItem\MetaItemObject|null
     */
    public function getRoot() : MetaItemObject
    {
        return $this->root;
    }

    /**
     * @param \App\MetadataManagement\MetaItem\MetaItemObject $root
     */
    public function setRoot(MetaItemObject $root) : void
    {
        $this->root = $root;
    }
}
