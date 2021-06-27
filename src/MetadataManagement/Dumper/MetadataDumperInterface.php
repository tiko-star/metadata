<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Dumper;

use App\MetadataManagement\Metadata;

/**
 * Interface MetadataDumperInterface declares methods for dumping metadata definition instances.
 *
 * @package App\MetadataManagement\Dumper
 */
interface MetadataDumperInterface
{
    /**
     * Dump metadata instance into string.
     *
     * @param \App\MetadataManagement\Metadata $metadata
     *
     * @return string
     */
    public function dump(Metadata $metadata) : string;
}
