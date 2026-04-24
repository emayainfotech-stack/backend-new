<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Increase column size to support long URLs (avoid 1406 Data too long).
        DB::statement("ALTER TABLE `news` MODIFY `source_link` VARCHAR(2048) NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `news` MODIFY `source_link` VARCHAR(255) NULL");
    }
};

