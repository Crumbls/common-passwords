<?php

namespace Crumbls\CommonPasswords\Providers;

use Crumbls\CommonPasswords\Commands\Install;
use Illuminate\Support\ServiceProvider;

class CommonPasswordServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(dirname(__DIR__).'/Migrations/');
        $this->commands([Install::class]);
    }
}
