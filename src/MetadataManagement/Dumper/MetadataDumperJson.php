<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Dumper;

use App\MetadataManagement\Metadata;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;

use function json_encode;
use const JSON_PRETTY_PRINT;

/**
 * MetadataDumperJson dumps a metadata object as a JSON string.
 *
 * @package App\MetadataManagement\Dumper
 */
class MetadataDumperJson implements MetadataDumperInterface
{
    /**
     * Dump metadata instance into string.
     *
     * @param \App\MetadataManagement\Metadata $metadata
     *
     * @return string
     */
    public function dump(Metadata $metadata) : string
    {
        $root = $metadata->getRoot();

        return json_encode($this->dumpArray($root), JSON_PRETTY_PRINT);
    }

    /**
     * Dump MetaItemInterface instance into array.
     *
     * @param \App\MetadataManagement\MetaItem\MetaItemInterface $metaItem
     *
     * @return array
     */
    protected function dumpArray(MetaItemInterface $metaItem) : array
    {
        $data = [];

        if ($metaItem instanceof MetaItemObject) {
            foreach ($metaItem as $key => $item) {
                if ($item instanceof MetaItemScalar) {
                    $data[$key] = $item->getValue();
                    continue;
                }

                $data[$key] = $this->dumpArray($item);
            }

            return $data;
        }

        if ($metaItem instanceof MetaItemCollection) {
            foreach ($metaItem as $item) {
                if ($item instanceof MetaItemScalar) {
                    $data[] = $item->getValue();
                    continue;
                }

                $data[] = $this->dumpArray($item);
            }

            return $data;
        }

        return $data;
    }
}
