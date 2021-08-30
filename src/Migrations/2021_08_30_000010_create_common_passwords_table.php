<?php declare(strict_types=1);

use Crumbls\CommonPasswords\Models\Password;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonPasswordsTable extends Migration
{
    /**
     * Get the table.
     * @return string
     */
    private function getTable() : string {
        $model = Password::class;
        $table = with(new $model)->getTable();
        return $table;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('password')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void {
        Schema::drop($this->getTable());
    }
}
