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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_contract_id');
            $table->string('invoice_number');
            $table->enum('invoice_type',['landlord invoice','tenant invoice','quiry invoice'])->default('tenant invoice');
            $table->unsignedBigInteger('property_id');
            $table->float('amount')->default('0');
            $table->date('from_date');
            $table->date('till_date');
            $table->enum('status',['paid','unpaid'])->default('unpaid');
            $table->datetime('paid_at')->nullable();
            $table->text('remarks')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
