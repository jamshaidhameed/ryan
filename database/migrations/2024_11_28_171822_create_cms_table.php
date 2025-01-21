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
            // $table->id();
            // $table->unsignedBigInteger('parent_id');
            // $table->text('keywords');
            // $table->unsignedBigInteger('order')->default('1');
            // $table->string('page_name');
            // $table->string('page_url');
            // $table->string('title_en');
            // $table->string('title_nl');
            // $table->boolean('status')->default(false);
            // $table->text('content_nl');
            // $table->text('content_en');
            // $table->boolean('deletable')->default(true);
            // $table->boolean('nav_item')->default(true);
            // $table->timestamps();
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->LongText('content_en')->nullable();
            $table->LongText('content_nl')->nullable();
            $table->enum('show_on',['header','footer'])->default('header');
            $table->enum('status',['active','inactive'])->default('active');
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
