<?php

namespace MacsiDigital\Xero\Contracts;

interface Xero
{
    public function __construct($type = 'Private');

    public function getClient();

    public function __get($key);

    public function getNode($key);
}
