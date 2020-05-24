<?php


namespace App;


class Example
{
    protected $container;

    protected $foo;

    public function __construct(Container $container, $foo)
    {
        $this->container = $container;
        $this->foo = $foo;
    }
}
