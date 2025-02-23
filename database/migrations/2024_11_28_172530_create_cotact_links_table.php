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
        Schema::create('cotact_links', function (Blueprint $table) {
            $table->id();
            $table->string('contractable_type');
            $table->unsignedBigInteger('contractable_id');
            $table->string('link');
            $table->boolean('is_signed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotact_links');
    }
};
