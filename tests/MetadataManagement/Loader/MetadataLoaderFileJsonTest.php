<?php

declare(strict_types = 1);

namespace App\Tests\MetadataManagement\Loader;

use App\MetadataManagement\Loader\MetadataLoaderFileJson;
use App\MetadataManagement\Loader\MetadataLoaderInterface;
use App\MetadataManagement\Metadata;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;
use PHPUnit\Framework\TestCase;

class MetadataLoaderFileJsonTest extends TestCase
{
    /**
     * @dataProvider metadataProvider
     *
     * @param string                           $path
     * @param \App\MetadataManagement\Metadata $metadata
     */
    public function testLoad_WithDifferentDocuments_ReturnsMetadataInstances(string $path, Metadata $metadata) : void
    {
        $loader = $this->createLoader();

        $this->assertEquals($metadata, $loader->load($path));
    }

    protected function createLoader() : MetadataLoaderInterface
    {
        return new MetadataLoaderFileJson();
    }

    public function metadataProvider() : array
    {
        return [
            [
                __DIR__.'/../metadata/widget.json',
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
                )
            ],
            [
                __DIR__.'/../metadata/font.json',
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
                )
            ],
            [
                __DIR__.'/../metadata/image.json',
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
                )
            ],
        ];
    }
}
