<?php

namespace LaravelLinear\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Marshmallow\Components\ComponentsServiceProvider;

class InstallLinear extends Command
{
    public $signature = 'linear:install';

    public $description = 'Install the linear package';

    public function handle(): int
    {
        Artisan::call('vendor:publish', [
            '--tag' => 'linear-migrations',
        ], $this->output);

        Artisan::call('vendor:publish', [
            '--tag' => 'linear-assets',
        ], $this->output);

        Artisan::call('vendor:publish', [
            '--provider' => ComponentsServiceProvider::class,
            '--force' => true,
        ], $this->output);

        $this->comment('Installation is ready!');
        $this->newLine();
        $this->comment('Dont forget to create an OAuth application in your Linear account. Check the readme for more information.');

        return self::SUCCESS;
    }
}
