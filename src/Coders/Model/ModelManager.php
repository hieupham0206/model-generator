<?php

namespace Cloudteam\ModelGenerator\Coders\Model;

use ArrayIterator;
use IteratorAggregate;
use Illuminate\Support\Arr;

class ModelManager implements IteratorAggregate
{
    /**
     * @var \Cloudteam\ModelGenerator\Model\Factory
     */
    protected $factory;

    /**
     * @var \Cloudteam\ModelGenerator\Model\Model[]
     */
    protected $models = [];

    /**
     * ModelManager constructor.
     *
     * @param \Cloudteam\ModelGenerator\Model\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $schema
     * @param string $table
     * @param \Cloudteam\ModelGenerator\Model\Mutator[] $mutators
     * @param bool $withRelations
     *
     * @return \Cloudteam\ModelGenerator\Model\Model
     */
    public function make($schema, $table, $mutators = [], $withRelations = true)
    {
        $mapper = $this->factory->makeSchema($schema);

        $blueprint = $mapper->table($table);

        if (Arr::has($this->models, $blueprint->qualifiedTable())) {
            return $this->models[$schema][$table];
        }

        $model = new Model($blueprint, $this->factory, $mutators, $withRelations);

        if ($withRelations) {
            $this->models[$schema][$table] = $model;
        }

        return $model;
    }

    /**
     * Get Models iterator.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->models);
    }
}
