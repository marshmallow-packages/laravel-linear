<?php

namespace LaravelLinear\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateLinear extends Command
{
    public $signature = 'linear:update';

    public $description = 'Update the linear package resources';

    public function handle(): int
    {
        Artisan::call('vendor:publish', [
            '--tag' => 'linear-assets',
        ], $this->output);

        Artisan::call('vendor:publish', [
            '--provider' => ComponentsServiceProvider::class,
        ], $this->output);

        $this->comment('Update is ready!');

        return self::SUCCESS;
    }
}
