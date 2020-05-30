<?php


namespace App;


class Example
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function handle()
    {
        die('its works');
    }
}
