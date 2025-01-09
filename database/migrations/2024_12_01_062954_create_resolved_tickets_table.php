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
        Schema::create('resolved_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('issue_ticket_id');
            $table->text('issue_note');
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->text('issue_identification')->nullable();
            $table->text('issue_resolved_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolved_tickets');
    }
};
