<?php

declare(strict_types = 1);

namespace App\MetadataManagement;

use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;
use stdClass;

use function App\Utilities\is_assoc;

/**
 * Compiles metadata information and generates appropriate instances of MetaItemInterface.
 *
 * @package App\MetadataManagement
 */
class Compiler
{
    /**
     * Compile metadata into object representation.
     *
     * @param array $metadata
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface
     */
    public function compile(array $metadata) : MetaItemInterface
    {
        return $this->hydrate($metadata);
    }

    /**
     * Recursively create MetaItemInterface instances based on given data.
     *
     * @param $data
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface
     */
    protected function hydrate($data) : MetaItemInterface
    {
        if ($this->looksLikeArray($data)) {
            if ($this->looksLikeAssoc($data)) {
                $object = new MetaItemObject();

                foreach ($data as $key => $item) {
                    $metaItem = $this->hydrate($item);
                    $object->set($key, $metaItem);
                }

                return $object;
            }

            $collection = new MetaItemCollection();

            foreach ($data as $item) {
                $collection[] = $this->hydrate($item);
            }

            return $collection;
        }

        return new MetaItemScalar($data);
    }

    /**
     * Determine whether the given data is an array-like data structure.
     *
     * @param $data
     *
     * @return bool
     */
    protected function looksLikeArray($data) : bool
    {
        return $data instanceof stdClass || is_array($data);
    }

    /**
     * Determine whether the given data is an associative array-like data structure.
     *
     * @param $data
     *
     * @return bool
     */
    protected function looksLikeAssoc($data) : bool
    {
        return $data instanceof stdClass || is_assoc($data);
    }
}
