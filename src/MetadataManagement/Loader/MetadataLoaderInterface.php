<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Loader;

use App\MetadataManagement\Metadata;

/**
 * Interface MetadataLoaderInterface declares methods for loading metadata definition files.
 *
 * @package App\MetadataManagement\Loader
 */
interface MetadataLoaderInterface
{
    /**
     * Load metadata file and convert into Metadata instance.
     *
     * @param string $path
     *
     * @return \App\MetadataManagement\Metadata
     */
    public function load(string $path) : Metadata;
}
