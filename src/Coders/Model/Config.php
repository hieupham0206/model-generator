<?php

/**
 * Created by Cristian.
 * Date: 11/09/16 09:00 PM.
 */

namespace Cloudteam\ModelGenerator\Coders\Model;

use Illuminate\Support\Arr;
use Cloudteam\ModelGenerator\Meta\Blueprint;

class Config
{
    /**
     * @var array
     */
    protected $config;

    /**
     * ModelConfig constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * @param \Cloudteam\ModelGenerator\Meta\Blueprint $blueprint
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(Blueprint $blueprint, $key, $default = null)
    {
        $default = Arr::get($this->config, "*.$key", $default);
        $schema = Arr::get($this->config, "{$blueprint->schema()}.$key", $default);
        $specific = Arr::get($this->config, "{$blueprint->qualifiedTable()}.$key", $schema);

        return $specific;
    }
}
