<?php

namespace Cloudteam\ModelGenerator\Coders\Model;

use Illuminate\Support\Str;

class Mutation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $body;

    /**
     * Mutation constructor.
     *
     * @param string $name
     * @param string $body
     */
    public function __construct($name, $body)
    {
        $this->name = $name;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'get'.Str::studly($this->name).'Attribute';
    }

    /**
     * @return string
     */
    public function body()
    {
        return 'return '.$this->body.';';
    }
}
