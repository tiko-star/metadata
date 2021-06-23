<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';

use App\MetadataManagement\Metadata\Parser\Compiler;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;

$metadata = new MetaItemObject([
    'widgets'     => new MetaItemCollection([
        new MetaItemObject([
            'hash'  => new MetaItemScalar('e6a1ab4e-a753-4214-85b7-6b83f1d07025'),
            'media' => new MetaItemCollection([
                new MetaItemObject([
                    'path' => new MetaItemScalar('images/foo.png'),
                    'name' => new MetaItemScalar('foo.png'),
                ]),
            ]),
        ]),
        new MetaItemObject([
            'hash'  => new MetaItemScalar('443ce372-6a3a-4b33-855a-383e64a0c966'),
            'media' => new MetaItemCollection([
                new MetaItemObject([
                    'path' => new MetaItemScalar('images/bar.png'),
                    'name' => new MetaItemScalar('bar.png'),
                ]),
            ]),
        ]),
    ]),
    'propertyStr' => new MetaItemScalar('foo'),
    'propertyArr' => new MetaItemCollection([
        new MetaItemScalar('bar'),
    ]),
    'propertyNum' => new MetaItemScalar(12.5),
]);

dump(json_encode($metadata, JSON_PRETTY_PRINT));


$compiler = new Compiler();

$m = $compiler->compile(
    json_decode(
        <<<METADATA
{
    "widgets": [
        {
            "hash": "e6a1ab4e-a753-4214-85b7-6b83f1d07025",
            "media": [
                {
                    "path": "images/foo.png",
                    "name": "foo.png"
                }
            ]
        },
        {
            "hash": "443ce372-6a3a-4b33-855a-383e64a0c966",
            "media": [
                {
                    "path": "images/bar.png",
                    "name": "bar.png"
                }
            ],
            "css": {
                "bg-color": "green",
                "text-width": "13px"
            }
        }
    ],
    "propertyStr": "foo",
    "propertyArr": [
        "bar"
    ],
    "propertyNum": 12.5,
    "propertyObj": {"foo": "bar"}
}
METADATA,
        true
    )
);

dd($m);
