<?php

namespace Karabin\Searchable\Filters;

use Illuminate\Database\Eloquent\Builder;
use Karabin\Searchable\Concerns\IsSearchable;
use Karabin\Searchable\Exceptions\ModelNotSearchable;
use Spatie\QueryBuilder\Filters\Filter;

class TermSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $model = $query->getModel();

        if (! in_array(IsSearchable::class, class_uses_recursive($model))) {
            throw new ModelNotSearchable(class_basename($model).' does not implement trait "IsSearchable".');
        }

        $attributes = $model->getSearchable();

        if (! $attributes) {
            $attributes = collect($model->getFillable())->diff($model->getHidden());
        }

        $terms = explode(' ', $value);

        foreach ($terms as $term) {
            $query->whereLike($attributes, $term);
        }
    }
}
