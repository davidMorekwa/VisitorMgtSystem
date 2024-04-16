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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('purpose_of_visit');
            $table->foreign('purpose_of_visit')->references('purpose')->on('visit_purposes');
            $table->string("person_to_see")->nullable();
            $table->foreignId("sacco_id")->nullable()->constrained("saccos", "id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("time_in");
            $table->string("time_out")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
