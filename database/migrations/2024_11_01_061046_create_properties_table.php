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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->text('description_en');
            $table->string('slug');
            $table->string('property_code');
            $table->float('price');
            $table->integer('contract_period');
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('province_id');
            $table->string('postcode');
            $table->string('city');
            $table->string('street_address');
            $table->boolean('status')->default(false);
            $table->boolean('featured')->default(false);
            $table->date('available_from')->nullable();
            $table->integer('area')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('kitchens')->nullable();
            $table->integer('garages')->nullable();
            $table->string('parkings')->nullable();
            $table->integer('toilets')->default('0');
            $table->string('youtube_url')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->float('landlord_price')->default('0');
            $table->text('title_nl')->nullable();
            $table->text('description_nl')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('property_image')->nullable();
            $table->boolean('banner')->default(false);
            $table->string('features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
