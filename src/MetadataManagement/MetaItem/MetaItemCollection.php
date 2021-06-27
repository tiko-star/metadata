<?php

declare(strict_types = 1);

namespace App\MetadataManagement\MetaItem;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Collection of MetaItemInterface instances.
 *
 * @package App\MetadataManagement\MetaItem
 */
class MetaItemCollection extends ArrayCollection implements MetaItemInterface
{
}
