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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
           
            $table->float('usage_duration_in_ms', 5)->default(0);
            $table->float('cost_per_ms');
            $table->float('total')->default(0);
           
            $table->unsignedBigInteger('api_token_id');
            $table->foreign('api_token_id')->references('id')->on('api_tokens');
           
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            
            $table->foreignId('workspace_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
