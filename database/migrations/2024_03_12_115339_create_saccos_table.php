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
        Schema::create('saccos', function (Blueprint $table) {
            $table->id();
            $table->string("sacco_name");
            $table->foreignId("portfolio_id")->constrained("sacco_portfolios", "id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("sacco_type");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saccos');
    }
};
