<?php

namespace Karabin\Searchable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Karabin\Searchable\Searchable
 */
class Searchable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Karabin\Searchable\Searchable::class;
    }
}
