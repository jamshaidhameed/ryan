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
            $table->unsignedBigInteger('issue_ticket_type');
            $table->string('issue_code');
            $table->text('title');
            $table->text('slug');
            $table->text('description');
            $table->boolean('is_urgent')->default(false);
            $table->string('status');
            $table->boolean('need_update');
            $table->unsignedBigInteger('updated_by');
            $table->string('priority');
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('assigned_by');
            $table->text('issue_identification');
            $table->text('issue_resolved_description');
            $table->boolean('issue_created_by_admin')->default(false);
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
