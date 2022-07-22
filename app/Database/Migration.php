<?php

namespace App\Database;

use App\Database\DB;

class Migration
{
    public static function fresh(): void
    {
        self::down();

        self::up();
    }

    public static function down(): void
    {
        /* @phpstan-ignore-next-line */
        (new DB())->execute(file_get_contents(__DIR__ . '/sql/down.sql'));
    }

    public static function up(): void
    {
        /* @phpstan-ignore-next-line */
        (new DB())->execute(file_get_contents(__DIR__ . '/sql/up.sql'));
    }

    public static function seed(): void
    {
        //
    }
}
