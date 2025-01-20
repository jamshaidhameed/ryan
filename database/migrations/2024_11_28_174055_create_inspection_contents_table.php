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
        Schema::create('inspection_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_id');
            $table->string('title')->nullable;
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('completed')->default(false);
            $table->string('inspected_date')->nullable();
            $table->string('united_homes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_contents');
    }
};
