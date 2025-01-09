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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('inspectionable_id');
            $table->string('inspectionable_type');
            $table->string('inspection_code');
            $table->string('inspection_type');
            $table->date('inspection_date');
            $table->text('inspection_notes');
            $table->boolean('is_ready');
            $table->unsignedBigInteger('inspected_by');
            $table->unsignedBigInteger('parent_id');
            $table->integer('total_persons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
