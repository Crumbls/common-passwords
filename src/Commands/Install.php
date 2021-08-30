<?php

namespace Crumbls\CommonPasswords\Commands;

use Crumbls\CommonPasswords\Seeders\CommonPasswordsSeeder;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'common-passwords:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the common passwords migration and data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Run our migration.
         */
        $this->info('Running migration.');
        $temp = sprintf('migrate --path=%s', dirname(__DIR__));
        $response = \Artisan::call($temp);

        $this->info('Running seeder.');
        $seeder = new CommonPasswordsSeeder();
        $seeder->run();
//        $temp = sprintf('db:seed --class="\%s"', CommonPasswordsSeeder::class);
  //      $response = \Artisan::call($temp);

        $this->info('Done!');
    }

}
