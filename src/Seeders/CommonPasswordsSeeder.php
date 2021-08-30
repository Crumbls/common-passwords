<?php

namespace Crumbls\CommonPasswords\Seeders;

use Crumbls\CommonPasswords\Models\Password;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommonPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $file = dirname(dirname(__DIR__)).'/invalid-passwords.txt';
        $content = \File::get($file);
        $content = array_filter(preg_split("/\r\n|\n|\r/", $content));
        $content = array_chunk($content, 20);

        $model = Password::class;
        $table = with(new $model)->getTable();

        foreach($content as $idx => $chunk) {
            $chunk = array_map(function($e) {
                return ['password' => $e];
            }, $chunk);
            \DB::table($table)->insertOrIgnore($chunk);
        }
    }
}
