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
        Schema::create('issue_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_contract_id');
            $table->unsignedBigInteger('issue_raised_by');
            $table->string('issue_ticket_type');
            $table->string('issue_code');
            $table->text('title');
            $table->text('slug');
            $table->text('description');
            $table->boolean('is_urgent')->default(false);
            $table->string('status');
            $table->boolean('need_update')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('priority')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->text('issue_identification')->nullable();
            $table->text('issue_resolved_description')->nullable();
            $table->boolean('issue_created_by_admin')->default(false);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_tickets');
    }
};
