<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';

use App\MetadataManagement\Loader\MetadataLoaderFileJson;
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
        new MetaItemCollection([
            new MetaItemScalar('baz'),
        ]),
    ]),
    'propertyNum' => new MetaItemScalar(12.5),
]);

$dumper = new \App\MetadataManagement\Dumper\MetadataDumperJson();
dump($metadata);
echo($dumper->dump(new \App\MetadataManagement\Metadata($metadata)));



$loader = new MetadataLoaderFileJson();

$m = $loader->load(__DIR__ . '/metadata.json');

////dump($m);
//
//$m = $compiler->compile(
//    json_decode(
//        <<<JSON
//[
//    {
//        "foo": "bar",
//        "baz": {"qux": "bat"}
//    },
//    123
//]
//JSON,
//        true
//    )
//);

dd($m);
