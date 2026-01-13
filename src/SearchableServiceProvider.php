<?php

namespace Karabin\Searchable;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class SearchableServiceProvider extends ServiceProvider
{
    /**
     * Like statmement
     *
     * @var string
     */
    protected $likeStatement = 'LIKE';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            /** @var Builder $this * */
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $model = $query->getModel();
                            $table = $model->getTable();
                            $connection = $model->getConnection();

                            try {
                                $type = $connection->getSchemaBuilder()->getColumnType($table, $attribute);
                            } catch (Exception $e) {
                                // Handle unknown types like enum - treat as string
                                $type = 'string';
                            }

                            if ($type === 'json') {
                                // Cast to CHAR and use case-insensitive collation
                                $query->orWhereRaw("LOWER(CAST(`{$table}`.`{$attribute}` AS CHAR)) COLLATE utf8mb4_unicode_ci LIKE ?", [strtolower("%{$searchTerm}%")]);
                            } else {
                                $query->orWhere($table.'.'.$attribute, 'LIKE', "%{$searchTerm}%");
                            }
                        }
                    );
                }
            });

            return $this;
        });
    }
}
