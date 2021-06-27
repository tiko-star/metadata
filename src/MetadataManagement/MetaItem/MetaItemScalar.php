<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

/**
 * Scalar value representation as a MetaItemInterface instance.
 *
 * @package App\MetadataManagement\MetaItem
 */
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
}
