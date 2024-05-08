<?php

namespace Karabin\Searchable\Concerns;

trait IsSearchable
{
    /**
     * Define a protected $searchable array for a model to allow fuzzy searching across all provided attributes.
     * If trait is present but no $searchable, all $fillable attributes will be used for searching
     */
    public function getSearchable()
    {
        return $this->searchable ?? null;
    }
}
