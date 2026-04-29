<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (! Schema::hasColumn('news', 'title_en')) {
                $table->string('title_en')->nullable()->after('title');
            }
            if (! Schema::hasColumn('news', 'title_hi')) {
                $table->string('title_hi')->nullable()->after('title_en');
            }
            if (! Schema::hasColumn('news', 'short_description_en')) {
                $table->string('short_description_en', 500)->nullable()->after('short_description');
            }
            if (! Schema::hasColumn('news', 'short_description_hi')) {
                $table->string('short_description_hi', 500)->nullable()->after('short_description_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $cols = [
                'title_en',
                'title_hi',
                'short_description_en',
                'short_description_hi',
            ];

            $toDrop = array_values(array_filter($cols, fn ($c) => Schema::hasColumn('news', $c)));
            if (! empty($toDrop)) {
                $table->dropColumn($toDrop);
            }
        });
    }
};

