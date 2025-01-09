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
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->text('keywords');
            $table->unsignedBigInteger('order')->default('1');
            $table->string('page_name');
            $table->string('page_url');
            $table->string('title_en');
            $table->string('title_nl');
            $table->boolean('status')->default(false);
            $table->text('content_nl');
            $table->text('content_en');
            $table->boolean('deletable')->default(true);
            $table->boolean('nav_item')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
