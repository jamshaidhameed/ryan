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
        Schema::create('issue_ticket_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_ticket_id');
            $table->float('cost');
            $table->boolean('paid')->default(false);
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('paid_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_ticket_invoices');
    }
};
