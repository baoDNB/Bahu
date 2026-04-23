<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('link_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('url_id')->constrained('urls')->onDelete('cascade');
            $table->string('platform')->nullable(); // Facebook, Zalo, TikTok...
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable(); // Thông tin trình duyệt/thiết bị
            $table->timestamps(); // Sẽ tự động có cột created_at (thời điểm ấn)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_histories');
    }
};
