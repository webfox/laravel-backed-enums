<?php

use Illuminate\Support\Collection;
use Workbench\App\Enums\VolumeUnitEnum;

it('can test', function () {
    $model = new \Workbench\App\Models\TestModel([
        'cast_a'       => 'grams',
        'collection_a' => ['grams', 'kilograms'],
        'collection_b' => ['grams', 'kilograms'],
    ]);

    expect($model->cast_a)->toBeInstanceOf(VolumeUnitEnum::class)
        // Single value cast
        ->and($model->cast_a->value)->toEqual('grams')
        // class::enum_class cast
        ->and($model->collection_a)->toBeInstanceOf(Collection::class)
        ->and($model->collection_a->first())->toBeInstanceOf(VolumeUnitEnum::class)
        ->and($model->collection_a->first()->value)->toEqual('grams')
        ->and($model->collection_a->toArray())->toEqual([
            VolumeUnitEnum::GRAMS->toArray(),
            VolumeUnitEnum::KILOGRAMS->toArray(),
        ])
        // class::of(enum_class) cast
        ->and($model->collection_b)->toBeInstanceOf(Collection::class)
        ->and($model->collection_b->first())->toBeInstanceOf(VolumeUnitEnum::class)
        ->and($model->collection_b->first()->value)->toEqual('grams')
        ->and($model->collection_a->toArray())->toEqual([
            VolumeUnitEnum::GRAMS->toArray(),
            VolumeUnitEnum::KILOGRAMS->toArray(),
        ]);


});