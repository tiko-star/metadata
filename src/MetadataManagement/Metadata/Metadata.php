<?php

declare(strict_types = 1);

namespace App\MetadataManagement\Metadata;

use App\Utilities\ObjectMap;
use JsonSerializable;

class Metadata implements JsonSerializable
{
    protected ObjectMap $items;

    public function __construct(iterable $items = [])
    {
        $this->items = new ObjectMap($items);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize() : array
    {
        return iterator_to_array($this->items);
    }

    public function __toString() : string
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }
}
