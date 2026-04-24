<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('device_id', 128)->index(); // from mobile app (unique per device install)
            $table->foreignId('category_id')->nullable()->index(); // denormalized for faster analytics
            $table->timestamp('clicked_at')->useCurrent();
            $table->timestamps();

            $table->index(['device_id', 'clicked_at']);
            $table->index(['news_id', 'clicked_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_clicks');
    }
};

