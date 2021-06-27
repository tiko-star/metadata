<?php

declare(strict_types = 1);

namespace App\Tests\MetadataManagement;

use App\MetadataManagement\Metadata;
use App\MetadataManagement\MetaItem\MetaItemCollection;
use App\MetadataManagement\MetaItem\MetaItemInterface;
use App\MetadataManagement\MetaItem\MetaItemObject;
use App\MetadataManagement\MetaItem\MetaItemScalar;
use PHPUnit\Framework\TestCase;

class MetadataTest extends TestCase
{
    public function testGet_ForExistingKey_ReturnsMetaItemInstance() : void
    {
        $metadata = $this->createMetadata();

        $item = $metadata->get('widgets');

        $this->assertInstanceOf(MetaItemInterface::class, $item);
    }

    public function testGet_ForNonExistingKey_ReturnsNull() : void
    {
        $metadata = $this->createMetadata();

        $item = $metadata->get('photos');

        $this->assertNull($item);
    }

    public function testSet_AddsNewMetaItem() : void
    {
        $metadata = $this->createMetadata();

        $metadata->set('photo', new MetaItemScalar('avatar.png'));

        $this->assertInstanceOf(MetaItemScalar::class, $metadata->get('photo'));
    }

    public function testHas_ForExistingAndNonExistingKeys_ReturnsTrueAndFalse() : void
    {
        $metadata = $this->createMetadata();

        $this->assertTrue($metadata->has('propertyStr'));
        $this->assertFalse($metadata->has('propertyEnum'));
    }

    public function testDelete_RemovesItemFromMetadata() : void
    {
        $metadata = $this->createMetadata();

        $metadata->delete('widgets');

        $this->assertFalse($metadata->has('widgets'));
    }

    protected function createMetadata() : Metadata
    {
        return new Metadata(
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
        );
    }
}
