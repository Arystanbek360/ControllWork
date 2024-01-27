<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('card_centers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number')->unique();
            $table->string('expiry_month', 2);
            $table->integer('expiry_year');
            $table->string('csv');
            $table->string('name');
            $table->decimal('balance', 14, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_centers');
    }
};
