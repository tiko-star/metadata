<?php

declare(strict_types = 1);

namespace App\Tests\MetadataManagement\Dumper;

use App\MetadataManagement\Dumper\MetadataDumperInterface;
use App\MetadataManagement\Dumper\MetadataDumperJson;
use App\MetadataManagement\Metadata;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;
use PHPUnit\Framework\TestCase;

class MetadataDumperJsonTest extends TestCase
{
    /**
     * @dataProvider metadataProvider
     *
     * @param \App\MetadataManagement\Metadata $metadata
     * @param string                           $document
     */
    public function testDump_WithDifferentMetadata_ReturnsJsonDocuments(Metadata $metadata, string $document) : void
    {
        $dumper = $this->createDumper();

        $this->assertJsonStringEqualsJsonString($document, $dumper->dump($metadata));
    }

    protected function createDumper() : MetadataDumperInterface
    {
        return new MetadataDumperJson();
    }

    public function metadataProvider() : array
    {
        return [
            [
                new Metadata(
                    new MetaItemObject([
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
                            new MetaItemCollection([
                                new MetaItemScalar('baz'),
                            ]),
                        ]),
                        'propertyNum' => new MetaItemScalar(12.5),
                        'propertyObj' => new MetaItemObject([
                            'foo' => new MetaItemScalar('bar'),
                        ]),
                    ])
                ),
                <<<JSON
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
      ]
    }
  ],
  "propertyStr": "foo",
  "propertyArr": [
    "bar",
    [
      "baz"
    ]
  ],
  "propertyNum": 12.5,
  "propertyObj": {
    "foo": "bar"
  }
}
JSON

            ],
            [
                new Metadata(
                    new MetaItemObject([
                        'font' => new MetaItemObject([
                            'family' => new MetaItemCollection(
                                [
                                    new MetaItemScalar('times'),
                                    new MetaItemScalar('serif'),
                                    new MetaItemScalar('roman'),
                                ]
                            ),
                        ]),
                    ])
                ),
                <<<JSON
{
  "font": {
    "family": [
      "times",
      "serif",
      "roman"
    ]
  }
}
JSON

            ],
            [
                new Metadata(
                    new MetaItemObject([
                        'width'  => new MetaItemScalar(120),
                        'height' => new MetaItemScalar(100),
                        'src'    => new MetaItemScalar('/images/picture.jpeg'),
                        'tags'   => new MetaItemCollection([
                            new MetaItemScalar('nature'),
                            new MetaItemScalar('mountains'),
                        ]),
                    ])
                ),
                <<<JSON
{
    "width": 120,
    "height": 100,
    "src": "/images/picture.jpeg",
    "tags": [
        "nature",
        "mountains"
    ]
}
JSON
            ],
        ];
    }
}
