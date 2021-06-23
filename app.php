<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';

use App\MetadataManagement\Metadata\Metadata;
use App\MetadataManagement\MetaItem\MetaDataItemCollection;
use App\MetadataManagement\MetaItem\CompoundMetaItem;
use App\MetadataManagement\MetaItem\MetaItem;

$metadata = new Metadata([
    'widgets'     => new MetaDataItemCollection([
        new CompoundMetaItem([
            'hash'  => new MetaItem('e6a1ab4e-a753-4214-85b7-6b83f1d07025'),
            'media' => new MetaDataItemCollection([
                new CompoundMetaItem([
                    'path' => new MetaItem('images/foo.png'),
                    'name' => new MetaItem('foo.png'),
                ]),
            ]),
        ]),
        new CompoundMetaItem([
            'hash'  => new MetaItem('443ce372-6a3a-4b33-855a-383e64a0c966'),
            'media' => new MetaDataItemCollection([
                new CompoundMetaItem([
                    'path' => new MetaItem('images/bar.png'),
                    'name' => new MetaItem('bar.png'),
                ]),
            ]),
        ]),
    ]),
    'propertyStr' => new MetaItem('foo'),
    'propertyArr' => new MetaDataItemCollection([
        new MetaItem('bar'),
    ]),
    'propertyNum' => new MetaItem(12.5),
]);

exit((string) $metadata);
