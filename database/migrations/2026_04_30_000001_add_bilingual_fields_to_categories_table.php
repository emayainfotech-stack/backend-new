<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (! Schema::hasColumn('categories', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (! Schema::hasColumn('categories', 'name_hi')) {
                $table->string('name_hi')->nullable()->after('name_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $cols = ['name_en', 'name_hi'];
            $toDrop = array_values(array_filter($cols, fn ($c) => Schema::hasColumn('categories', $c)));
            if (! empty($toDrop)) {
                $table->dropColumn($toDrop);
            }
        });
    }
};

