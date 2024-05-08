<?php

namespace Karabin\Searchable\Commands;

use Illuminate\Console\Command;

class SearchableCommand extends Command
{
    public $signature = 'eloquent-searchable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
