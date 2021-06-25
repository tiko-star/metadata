<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

class MetaItemScalar implements MetaItemInterface
{
    /**
     * @var mixed Scalar value of the MetaItem.
     */
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by json_encode,
     *               which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
