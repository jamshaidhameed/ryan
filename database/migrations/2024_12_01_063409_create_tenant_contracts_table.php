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
        Schema::create('tenant_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('contract_code');
            $table->unsignedBigInteger('user_id');
            $table->float('price')->default('0');
            $table->timestamp('start_from')->nullable();
            $table->integer('contract_period');
            $table->string('link');
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->float('commission_amount');
            $table->timestamp('commission_paid_at')->nullable();
            $table->timestamp('commission_verified_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('contract_verified_by')->nullable();
            $table->integer('persons')->default('1');
            $table->unsignedBigInteger('terminated_by')->nullable();
            $table->timestamp('terminated_on')->nullable();
            $table->text('termination_reason')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_contracts');
    }
};
