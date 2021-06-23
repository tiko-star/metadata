<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Metadata\Parser;

use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;

class Compiler
{
    public function compile(array $metadata) : MetaItemInterface
    {
        return $this->createItem($metadata);
    }

    protected function createItem($data) : MetaItemInterface
    {
        if (is_array($data) && $this->isStaticArray($data)) {
            $collection = new MetaItemCollection();

            foreach ($data as $item) {
                $collection[] = $this->createItem($item);
            }

            return $collection;
        }

        if (is_array($data) && $this->isAssoc($data)) {
            $object = new MetaItemObject();

            foreach ($data as $key => $item) {
                $metaItem = $this->createItem($item);
                $object->set($key, $metaItem);
            }

            return $object;
        }

        return new MetaItemScalar($data);
    }

    protected function isAssoc(array $arr) : bool
    {
        if ([] === $arr) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    protected function isStaticArray(array $arr) : bool
    {
        return !$this->isAssoc($arr);
    }
}
