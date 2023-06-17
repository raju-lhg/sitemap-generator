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
        Schema::create('site_maps', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->string('xml_path');
            $table->json('dns_data')->nullable();
            $table->longText('who_is_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_maps');
    }
};
