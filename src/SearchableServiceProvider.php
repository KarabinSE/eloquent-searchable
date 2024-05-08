<?php

namespace Karabin\Searchable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Karabin\Searchable\Commands\SearchableCommand;

class SearchableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-searchable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_eloquent-searchable_table')
            ->hasCommand(SearchableCommand::class);
    }
}