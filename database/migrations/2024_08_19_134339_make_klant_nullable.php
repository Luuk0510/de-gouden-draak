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
        Schema::table('klanten', function (Blueprint $table) {
            $table->string('voornaam')->nullable()->change();
            $table->string('tussenvoegsel')->nullable()->change();
            $table->string('achternaam')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klanten', function (Blueprint $table) {
            $table->string('voornaam')->nullable(false)->change();
            $table->string('tussenvoegsel')->nullable(false)->change();
            $table->string('achternaam')->nullable(false)->change();
        });
    }
};
