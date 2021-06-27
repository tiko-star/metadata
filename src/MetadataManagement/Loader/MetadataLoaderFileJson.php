<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Loader;

use App\MetadataManagement\Loader\Exception\InvalidMetadataContentException;
use App\MetadataManagement\Loader\Exception\MetadataFileNotFoundException;
use App\MetadataManagement\Metadata;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;
use JsonException;
use stdClass;

use function App\Utilities\is_assoc;

/**
 * MetadataLoaderFileJson loads JSON files metadata definitions.
 *
 * @package App\MetadataManagement\Loader
 */
class MetadataLoaderFileJson implements MetadataLoaderInterface
{
    /**
     * Load metadata file and convert into Metadata instance.
     *
     * @param string $path
     *
     * @return \App\MetadataManagement\Metadata
     */
    public function load(string $path) : Metadata
    {
        $content = $this->loadFile($path);
        $root = $this->hydrate($content);

        return new Metadata($root);
    }

    /**
     * Load JSON file and convert it into an array.
     *
     * @param string $path
     *
     * @return array
     */
    protected function loadFile(string $path) : array
    {
        if (!is_readable($path)) {
            throw new MetadataFileNotFoundException('Metadata file not found.');
        }

        $content = file_get_contents($path);

        try {
            $data = json_decode($content, true, JSON_THROW_ON_ERROR);

            if (!is_array($data)) {
                throw new InvalidMetadataContentException('Metadata content must be an array.');
            }

            return $data;
        } catch (JsonException $ex) {
            throw new InvalidMetadataContentException('Invalid metadata content.', $ex->getCode(), $ex);
        }
    }

    /**
     * Recursively create MetaItemInterface instances based on given data.
     *
     * @param $data
     *
     * @return \App\MetadataManagement\MetaItem\MetaItemInterface|MetaItemObject
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
