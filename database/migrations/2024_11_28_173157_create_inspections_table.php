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
            $table->unsignedBigInteger('inspectionable_id')->nullable();
            $table->string('inspectionable_type')->nullable();
            $table->string('inspection_code')->nullable();
            $table->string('inspection_type')->nullable();
            $table->date('inspection_date')->nullable();
            $table->text('inspection_notes')->nullable();
            $table->boolean('is_ready')->default(false);
            $table->unsignedBigInteger('inspected_by')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('total_persons')->nullable();
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
