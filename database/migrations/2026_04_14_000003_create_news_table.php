<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();

            $table->string('title');
            $table->string('short_description', 500);
            
            $table->string('city')->default('Jaipur');

            $table->string('media_type')->nullable(); // image|video
            $table->string('media_path')->nullable();

            $table->json('tags')->nullable();

            $table->string('status')->default('pending'); // pending|published|rejected
            $table->timestamp('publish_at')->nullable(); // schedule or publish time

            $table->boolean('is_important')->default(false);
            $table->boolean('send_push_notification')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

