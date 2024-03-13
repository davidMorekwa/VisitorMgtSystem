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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("phone_number");
            $table->string("email")->nullable();
            $table->string("ID/Passport_number");
            $table->string("purpose_of_visit");
            $table->foreignId("sacco_id")->nullable()->constrained("saccos", "id");
            $table->string("person_to_visit")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
